<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Apimobile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('adminsignin_m');
        $this->load->model('banner_m');
        $this->load->model('signin_m');
        $this->load->model('subject_m');
        $this->load->model('terms_m');
        $this->load->model('coursetype_m');
        $this->load->model('contents_m');
        $this->load->model('contenttype_m');
        $this->load->model('lessons_m');
        $this->load->model('usage_m');
        $this->load->model('recommend_m');
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library("pagination");

        $this->load->model('users_m');
    }

    public function generateRandomString($length = 10)
    {
        $characters = '23456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function update_user_actions()
    {
        $result = $this->users_m->getItems();
        $action_date = array();
        foreach ($result as $item) {
            array_push($action_date, substr($item->create_time, 0, 10));
            array_push($action_date, substr($item->register_time, 0, 10));
        }
        $action_date = array_unique($action_date);
        echo 'total count of users: ' . count($result) . '<br>';
        foreach ($action_date as $item) {
            $registers = array_filter($result, function ($_item) use ($item) {
                return substr($_item->create_time, 0, 10) == $item;
            }, ARRAY_FILTER_USE_BOTH);
            $logins = array_filter($result, function ($_item) use ($item) {
                return substr($_item->register_time, 0, 10) == $item;
            }, ARRAY_FILTER_USE_BOTH);

            $arr = array(
                'action_date' => $item,
                'register_count' => count($registers),
                'login_count' => count($logins) + count($registers)
            );

            $this->users_m->addUserAction($item, $arr);
        }
        echo 'successfully recovered';
    }

    public function getHomeInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $user_id = $request->{'id'};


        $banners = $this->banner_m->get_where(array(
            'status' => 1, 'type' => 1
        ));
        $bannerData = array();
        if ($banners != null) {
            foreach ($banners as $item) {
                $item->icon_path_m = $item->icon_path;
                array_push($bannerData, $item);
            }
        }

        $recommends = $this->recommend_m->getItems();
        $recommendData = array();
        if ($recommends != null) {
            foreach ($recommends as $item) {
                if ($item->type >= 2) {
                    array_push($recommendData, $item);
                }
            }
        }
        $subjectData = $this->subject_m->getItems();
        if ($subjectData == null) $subjectData = array();
        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;
        $result = $this->usage_m->get_where("user_id = '$user_id' and is_favorite > 0");
        $favoriteData = array();
        foreach ($result as $item) {
            array_push($favoriteData, $item->content_id);
        }
        $result = $this->usage_m->get_where("user_id = '$user_id' and is_like > 0");
        $likeData = array();
        foreach ($result as $item) {
            array_push($likeData, $item->content_id);
        }
        $ret['data'] = array(
            'bannerData' => $bannerData,
            'recommendData' => $recommendData,
            'subjectData' => $subjectData,
            'favoriteData' => $favoriteData,
            'likeData' => $likeData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getFilteredContents()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $searchStr = 'searchStr';

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'search_txt'};

        if ($id) $searchStr = $id;

        $contentData = $this->contents_m->getItemsByPage(array('tbl_huijiao_contents.status' => 1), 0, 10000, $searchStr);
        if ($contentData == null) $contentData = array();

        $ret['data'] = array(
            'contentData' => $contentData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getSubjectInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};

        $subject_id = 0;
        $subjectData = $this->subject_m->getItems();
        $termFilter = array();
        if ($subjectData == null) $subjectData = array();
        else {
            $subject_id = $subjectData[0]->id;
//            if ($_POST['id']) $subject_id = $_POST['id'];
            if ($id) $subject_id = $id;
            $termFilter = array('tbl_huijiao_subject.id' => $subject_id, 'tbl_huijiao_terms.status' => 1);
        }

        $term_id = 0;
        $termData = $this->terms_m->getItemsByPage($termFilter, 0, 10000);
        if ($termData == null) $termData = array();
        else $term_id = $termData[0]->id;

        $courseTypeData = $this->coursetype_m->get_where(array('term_id' => $term_id, 'status' => 1));
        if ($courseTypeData == null) $courseTypeData = array();
        else {
            foreach ($courseTypeData as $item) {
                $item->startIdx = 0;
            }
        }

        $contentData = $this->contents_m->getItemsByPage(array(
            'tbl_huijiao_terms.id' => $term_id,
            'tbl_huijiao_contents.status' => 1
        ), 0, 10000, '', 'teacher');
        if ($contentData == null) $contentData = array();

        $ret['data'] = array(
            'subjectData' => $subjectData,
            'termData' => $termData,
            'courseTypeData' => $courseTypeData,
            'contentData' => $contentData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getTermInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};

        $term_id = 0;
        if ($id) $term_id = $id;

        $termData = $this->terms_m->get_where(array('id' => $term_id, 'status' => 1));
        if ($termData == null) $termData = array();

        $courseTypeData = $this->coursetype_m->get_where(array('term_id' => $term_id, 'status' => 1));
        if ($courseTypeData == null) $courseTypeData = array();
        else {
            foreach ($courseTypeData as $item) {
                $item->startIdx = 0;
            }
        }

        $contentData = $this->contents_m->getItemsByPage(array(
            'tbl_huijiao_terms.id' => $term_id,
            'tbl_huijiao_contents.status' => 1
        ), 0, 10000, '', 'teacher');
        if ($contentData == null) $contentData = array();

        $ret['data'] = array(
            'termData' => $termData,
            'courseTypeData' => $courseTypeData,
            'contentData' => $contentData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getCourseTypeInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};

        $coursetype_id = 0;
        if ($id) $coursetype_id = $id;

        $courseTypeData = $this->coursetype_m->get_where(array('id' => $coursetype_id, 'status' => 1));
        if ($courseTypeData == null) $courseTypeData = array();
        else {
            $coursetype_id = $courseTypeData[0]->id;
        }
        $contentData = $this->contents_m->getItemsByPage(array(
            'tbl_huijiao_course_type.id' => $coursetype_id,
            'tbl_huijiao_contents.status' => 1
        ), 0, 10000, '', 'teacher');
        if ($contentData == null) $contentData = array();

        $ret['data'] = array(
            'coursetypeData' => $courseTypeData,
            'contentData' => $contentData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getContentInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $content_id = 0;
        if ($id) $content_id = $id;

        $contentData = $this->contents_m->getItemsByPage(array(
            'tbl_huijiao_contents.id' => $content_id,
            'tbl_huijiao_contents.status' => 1
        ), 0, 10000, '', 'teacher');
        if ($contentData == null) $contentData = array();

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        if ($userData == null) {
            $ret['data'] = '用户不存在';
            echo json_encode($ret);
            return;
        }
        $user_id = $userData[0]->id;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'read_count' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'read_count' => $usageItem->read_count + 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $result = $this->usage_m->get_where(array('content_id' => $content_id));
        $usageData = array(
            'is_favorite' => 0,
            'is_like' => 0,
            'read_count' => 0,
            'share_count' => 0,
            'download_count' => 0,
        );
        if ($result != null) {
            foreach ($result as $item) {
                $usageData['is_favorite'] += $item->is_favorite;
                $usageData['is_like'] += $item->is_like;
                $usageData['read_count'] += $item->read_count;
                $usageData['share_count'] += $item->share_count;
                $usageData['download_count'] += $item->download_count;
            }
        }


        $ret['data'] = array(
            'contentData' => $contentData,
            'usageData' => $usageData
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setFavorite()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $content_id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;
        if (!$content_id) $content_id = 0;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'is_favorite' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'is_favorite' => 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $result = $this->usage_m->get_where("user_id = '$user_id' and is_favorite > 0");
        $retData = array();
        foreach ($result as $item) {
            array_push($retData, $item->content_id);
        }
        $ret['data'] = $retData;
        $ret['info'] = $retData;
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setLike()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $content_id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;

        if (!$user_id) $user_id = 0;
        if (!$content_id) $content_id = 0;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'is_like' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'is_like' => 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $result = $this->usage_m->get_where("user_id = '$user_id' and is_like > 0");
        $retData = array();
        foreach ($result as $item) {
            array_push($retData, $item->content_id);
        }

        $result = $this->usage_m->get_where(array('content_id' => $content_id));
        $usageData = array(
            'is_favorite' => 0,
            'is_like' => 0,
            'read_count' => 0,
            'share_count' => 0,
            'download_count' => 0,
        );
        if ($result != null) {
            foreach ($result as $item) {
                $usageData['is_favorite'] += $item->is_favorite;
                $usageData['is_like'] += $item->is_like;
                $usageData['read_count'] += $item->read_count;
                $usageData['share_count'] += $item->share_count;
                $usageData['download_count'] += $item->download_count;
            }
        }
        $ret['data'] = $retData;
        $ret['usageData'] = $usageData;
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setDownload()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $content_id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;

        if (!$user_id) $user_id = 0;
        if (!$content_id) $content_id = 0;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'download_count' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'download_count' => $usageItem->download_count + 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $ret['data'] = 'Download Success';
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setRead()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $content_id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;

        if (!$user_id) $user_id = 0;
        if (!$content_id) $content_id = 0;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'read_count' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'read_count' => $usageItem->read_count + 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $ret['data'] = 'Read Success';
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setShare()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $content_id = $request->{'id'};
        $user_id = $request->{'user_id'};

        $userData = $this->users_m->get_where(array('user_account' => $user_id));
        $user_id = 0;
        if ($userData != null) $user_id = $userData[0]->id;

        if (!$user_id) $user_id = 0;
        if (!$content_id) $content_id = 0;

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $this->usage_m->add(array(
                'user_id' => $user_id,
                'content_id' => $content_id,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'share_count' => 1
            ));
        } else {
            $usageItem = $usageData[0];
            $this->usage_m->edit(array(
                'share_count' => $usageItem->share_count + 1,
                'update_time' => date('Y-m-d H:i:s')
            ), $usageItem->id);
        }

        $ret['data'] = 'Share Success';
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getProfileInfo()
    {

        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $user_id = $userItem->id;

        $ret['data'] = array(
            'userInfo' => $userItem
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getFavorite()
    {

        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $pageId = $request->{'pid'};
        $cntPerPage = $request->{'pcnt'};
        if (!$pageId) $pageId = 0;
        if (!$cntPerPage) $cntPerPage = 100;

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $user_id = $userItem->id;

        $result = $this->contents_m->get_where_usage_limit(
            "tbl_usage.user_id = $user_id and tbl_usage.content_id is not null and tbl_usage.is_favorite > 0",
            $cntPerPage, $pageId * $cntPerPage
        );
        $ret['data'] = array(
            'favoriteData' => $result
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getLike()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $pageId = $request->{'pid'};
        $cntPerPage = $request->{'pcnt'};
        if (!$pageId) $pageId = 0;
        if (!$cntPerPage) $cntPerPage = 100;

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $user_id = $userItem->id;

        $result = $this->contents_m->get_where_usage_limit(
            "tbl_usage.user_id = $user_id and tbl_usage.content_id is not null and tbl_usage.is_like > 0",
            $cntPerPage, $pageId * $cntPerPage
        );
        $ret['data'] = array(
            'likeData' => $result
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getHistory()
    {

        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $user_id = $userItem->id;

        $result = $this->usage_m->get_where("user_id = '$user_id' and read_count > 0");
        $readData = array();
        foreach ($result as $item) {
            array_push($readData, $item->content_id);
        }
        $readData = $this->contents_m->get_where_in('id', $readData);
        $j = 0;
        foreach ($readData as $item) {
            $item->action_time = substr($result[$j]->update_time, 0, 16);
            $j++;
        }

        $result = $this->usage_m->get_where("user_id = '$user_id' and is_like > 0");
        $likeData = array();
        foreach ($result as $item) {
            array_push($likeData, $item->content_id);
        }
        $likeData = $this->contents_m->get_where_in('id', $likeData);
        $j = 0;
        foreach ($likeData as $item) {
            $item->action_time = substr($result[$j]->update_time, 0, 16);
            $j++;
        }

        $ret['data'] = array(
            'readData' => $readData,
            'likeData' => $likeData,
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getRead()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $pageId = $request->{'pid'};
        $cntPerPage = $request->{'pcnt'};
        if (!$pageId) $pageId = 0;
        if (!$cntPerPage) $cntPerPage = 100;

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $user_id = $userItem->id;

        $result = $this->contents_m->get_where_usage_limit(
            "tbl_usage.user_id = $user_id and tbl_usage.content_id is not null and tbl_usage.read_count > 0",
            $cntPerPage, $pageId * $cntPerPage
        );
        $ret['data'] = array(
            'readData' => $result
        );
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setLogin()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }
        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $type = $request->{'type'};

        $this->signin_m->setPlatformLogin($type);

        $ret['data'] = 'Login Success';
        $ret['status'] = true;
        echo json_encode($ret);
        return;

        $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $this->users_m->add(array(
                'user_account' => $user_account,
                'password' => $user_account,
                'user_name' => $user_account,
                'user_nickname' => $user_account,
                'information' => $this->get_client_ip(),
                'user_school' => 'APP用户',
                'user_class' => '1-1',
                'term_id' => 0,
                'status' => 1,
                'register_count' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'register_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s')
            ));
            $this->signin_m->setLoginAction('register');
        } else {
            $userItem = $userData[0];
            if (substr($userItem->register_time, 0, 10) != date('Y-m-d'))
                $this->signin_m->setLoginAction('login');

            $this->users_m->edit(array(
                'information' => $this->get_client_ip(),
                'register_count' => $userItem->register_count + 1,
                'register_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s')
            ), $userItem->id);
        }

        $ret['data'] = 'Login Success';
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function setUserName()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $request = json_decode(file_get_contents("php://input"));
        $id = $request->{'id'};
        $username = $request->{'username'};

        $user_account = 0;
        if ($id) $user_account = $id;

        $userData = $this->users_m->get_where(array('user_account' => $user_account));
        if ($userData == null) {
            $ret['data'] = '用户没有存在';
            echo json_encode($ret);
            return;
        }
        $userItem = $userData[0];
        $userItem->user_name = $username;
        $userItem->update_time = date('Y-m-d H:i:s');
        $this->users_m->edit(array(
            'user_nickname' => $userItem->user_name,
            'update_time' => $userItem->update_time
        ), $userItem->id);

        $ret['data'] = $userItem;
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function getUsageInfo()
    {
        $ret = array(
            'data' => 'Invalid Request, please use POST.',
            'status' => false
        );

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode($ret);
            return;
        }

        $user_id = 0;
        $content_id = 0;
        if ($_POST['id']) $content_id = $_POST['id'];

        $usageData = $this->usage_m->get_where(array('content_id' => $content_id, 'user_id' => $user_id));
        if ($usageData == null) {
            $usageData = array(
                'is_favorite' => 0,
                'is_like' => 0,
                'read_count' => 0,
                'share_count' => 0,
                'download_count' => 0,
            );
        } else {
            $usageItem = $usageData[0];
            $usageData = array(
                'is_favorite' => $usageItem->is_favorite,
                'is_like' => $usageItem->is_like,
                'read_count' => $usageItem->read_count,
                'share_count' => $usageItem->share_count,
                'download_count' => $usageItem->download_count
            );
        }

        $ret['data'] = $usageData;
        $ret['status'] = true;
        echo json_encode($ret);
    }

    public function http($url, $method = '', $postfields = null, $headers = array(), $debug = false)
    {
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        switch ($method) {
            case 'POST':
            case 'post':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    $this->postdata = $postfields;
                }
                break;
        }
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($ci);
        $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($debug) {
            echo "=====post data======\r\n";
            var_dump($postfields);

            echo '=====info=====' . "\r\n";
            print_r(curl_getinfo($ci));

            echo '=====$response=====' . "\r\n";
            print_r($response);
        }
        curl_close($ci);
        return array($http_code, $response);
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

?>