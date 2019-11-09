<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define("PAGESIZE", 30);

class Resource extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('adminsignin_m');
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

    public function index()
    {
        $this->learning();
    }

    public function previewPlayer($id = 0)
    {
        if (!$this->adminsignin_m->loggedin()) {
            if (!$this->signin_m->loggedin()) {
                $recommendItem = $this->recommend_m->get_where(array(
                    'content_id' => $id, 'type' => '1', 'status' => '1'
                ));
                if ($recommendItem == null) {
                    redirect(base_url('home/index'));
                    return;
                }
            }
        }

        $this->data['parentView'] = 'back';
        $this->data['pageType'] = 0;

        if ($id == 0) {
//            redirect(base_url('home/index'));
//            return;
            $this->data['parentView'] = 'back';
            $this->data["lessonItem"] = array();
            $this->data["courseList"] = array();
            $this->data["title"] = '_';
            $this->data["lesson_id"] = 0;
            $this->data["usage"] = (object)array(
                'usage_id' => 0,
                'is_favorite' => 0,
                'is_like' => 0,
                'share_count' => 0
            );;
            $this->data["like_num"] = 0;
        } else {
            $user_id = $this->session->userdata('loginuserID');
            $lessonItems = $this->lessons_m->get_where(array('id' => $id, 'status' => 1));
            if ($lessonItems == null) {
                redirect(base_url('home/index'));
                return;
            }
            $this->data["lessonItem"] = $lessonItems[0];

            // get usage
            if ($lessonItems)
                $usages = $this->usage_m->get_where(array(
                    'lesson_id' => $this->data["lessonItem"]->id
                ));
            $usage = (object)array(
                'usage_id' => null,
                'is_favorite' => 0,
                'is_like' => 0,
                'share_count' => 0,
                'favorite_count' => 0,
                'download_count' => 0,
                'like_count' => 0,
            );
            if ($usages != null) {
                foreach ($usages as $item) {
                    if ($item->user_id == $user_id && $item->is_like == 1) $usage->is_like = 1;
                    if ($item->user_id == $user_id && $item->is_favorite == 1) $usage->is_favorite = 1;
                    $usage->like_count += $item->is_like;
                    $usage->favorite_count += $item->is_favorite;
                    $usage->download_count += $item->download_count;
                    $usage->share_count += $item->share_count;
                }
            }
            log_message('info', 'previewPlayer usage : ' . var_export($usage, true));

            // like num
            $like_num = $this->usage_m->get_where(['lesson_id' => $id, 'is_like' => 1]);
            $like_num = count($like_num);

            $contentLists = json_decode($this->data['lessonItem']->lesson_info);
            $this->data["courseList"] = $this->contents_m->getContentsFromLesson($contentLists);

            $this->data["title"] = $this->data["lessonItem"]->title;
            $this->data["lesson_id"] = $id;

            $this->data["usage"] = $usage;
            $this->data["like_num"] = $like_num;
        }
        $this->data["subview"] = "resource/previewplayer";
        $this->load->view('_layout_main', $this->data);
    }

    public function warePreviewPlayer($id = 0)
    {
        if (!$this->adminsignin_m->loggedin()) {
            if (!$this->signin_m->loggedin()) {
                $recommendItem = $this->recommend_m->get_where(array(
                    'content_id' => $id, 'type' => '0', 'status' => '1'
                ));
                if ($recommendItem == null) {
                    redirect(base_url('home/index'));
                    return;
                }
            }
        }

        $this->data['parentView'] = 'back';
        $contentItems = $this->contents_m->get_where(array('id' => $id, 'status' => 1));
        if ($contentItems == null) {
            redirect(base_url('home/index'));
            return;
        }
        $this->data["contentItem"] = $contentItems[0];

        // get usage
        $user_id = $this->session->userdata('loginuserID');
        $usages = $this->usage_m->get_where(array(
            'user_id' => $user_id,
            'content_id' => $this->data["contentItem"]->id
        ));
        $usage = (object)array(
            'usage_id' => null,
            'is_favorite' => 0,
            'is_like' => 0,
            'share_count' => 0
        );
        if ($usages != null) {
            $usage = (object)array(
                'usage_id' => $usages[0]->id,
                'is_favorite' => $usages[0]->is_favorite,
                'is_like' => $usages[0]->is_like,
                'share_count' => $usages[0]->share_count
            );
        }
        log_message('info', 'warePreviewPlayer usage : ' . var_export($usage, true));

        // like num
        $like_num = $this->usage_m->get_where(['content_id' => $id, 'is_like' => 1]);
        $like_num = count($like_num);

        // favorite num
        $favorite_num = $this->usage_m->get_where(['content_id' => $id, 'is_favorite' => 1]);
        $favorite_num = count($favorite_num);

        $this->data["courseList"] = $contentItems;

        $this->data["title"] = $this->data["contentItem"]->title;
        $this->data["content_id"] = $id;
        $this->data["usage"] = $usage;
        $this->data["like_num"] = $like_num;
        $this->data["favorite_num"] = $favorite_num;
        $this->data["pageType"] = 0;

        $this->data["subview"] = "resource/warePreviewplayer";
        $this->load->view('_layout_main', $this->data);
    }

    public function additionalPreviewPlayer($id = 0)
    {
        if (!$this->adminsignin_m->loggedin())
            $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $this->data['parentView'] = 'back';
        $contentItems = $this->contents_m->get_where(array('id' => $id, 'status' => 1));
        if ($contentItems == null) {
            redirect(base_url('home/index'));
            return;
        }
        $this->data["contentItem"] = $contentItems[0];

        // get usage
        $user_id = $this->session->userdata('loginuserID');
        $usages = $this->usage_m->get_where(array(
            'user_id' => $user_id,
            'content_id' => $this->data["contentItem"]->id
        ));

        $this->data["courseList"] = $contentItems;

        $this->data["title"] = '附件内容';
        $this->data["content_id"] = $id;
        $this->data["pageType"] = 1;

        $this->data["subview"] = "resource/additionalPreviewplayer";
        $this->load->view('_layout_main', $this->data);
    }

    public function guide($id = 0)
    {
        if (!$this->adminsignin_m->loggedin())
            $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $this->data['parentView'] = 'back';
        $this->data["title"] = '慧教乐学应用操作演示';
        $this->data["subview"] = "resource/guide";

        $this->load->view('_layout_main', $this->data);
    }

    public function education()
    {
//        $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));

        $this->data['showHelp'] = 1;

        $this->session->unset_userdata('learning_subject_id');
        $this->session->unset_userdata('learning_term_id');
        $this->session->unset_userdata('learning_coursetype_id');
        $this->session->unset_userdata('learning_curQuery');

        $term_id = $this->session->userdata('term_id');
        log_message('info', 'Resource/index $term_id : ' . var_export($term_id, true));
        $term = $this->terms_m->get_single(['id' => $term_id]);
        log_message('info', 'Resource/index term : ' . var_export($term, true));
        if ($term == null) {
            $term = $this->terms_m->get_single(['status' => 1]);
            $term_id = $term->id;
        }

        $subject = $this->subject_m->get_single(['id' => $term->subject_id]);

        $this->data['perPage'] = $perPage = 25;
        $this->data['cntPage'] = $cntPage = $this->lessons_m->get_count(array('tbl_huijiao_lessons.term_id' => $term_id, 'tbl_huijiao_lessons.status' => 1), 'user');

        $ret = $this->paginationCompress('resource/education/', $cntPage, $perPage);

        $this->data['curPage'] = $curPage = $ret['pageId'];
        $lessons = $this->lessons_m->getItemsByPage(
            array('tbl_huijiao_lessons.term_id' => $term_id, 'tbl_huijiao_lessons.status' => 1), $ret['pageId'], $ret['cntPerPage'], 'user');
        if ($lessons == null) {
            $curSeg = $segment = $this->uri->segment(SEGMENT);
            if ($curSeg != 0 && $curSeg != '') {
                $curSeg -= $perPage;
                redirect(base_url('resource/education/' . $curSeg));
                return;
            }
        }

        $this->data["lessons"] = $this->get_lessons_html($lessons);
        $this->data["curPage"] = $curPage;

        $this->data['parentView'] = 'home/index';

        $this->data['all_subjects'] = $this->subject_m->getItems();
        $this->data['all_terms'] = $this->terms_m->getItems();

        $this->data["term"] = $term;
        $this->data["subject"] = $subject;
        $this->data["subview"] = "resource/index";
        $this->load->view('_layout_main_resource', $this->data);
    }

    public function courselist($id = NULL)
    {
        if (!is_numeric($id) || $id == NULL) {
            show_404();
            return;
        }
        $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));

        $this->data['parentView'] = 'resource';
        $this->data["courseList"] = $this->courses_m->get_where(['lesson_id' => $id, 'status' => 1]);
        $this->data["courseList_content"] = $this->courselist_output_content($this->data["courseList"]);
        $this->data['lessonItem'] = $this->lessons_m->get_where(['id' => $id, 'status' => 1])[0];
        $this->data["selectedIndex"] = 0;
        $this->data["subview"] = "resource/courselist";
        $this->load->view('_layout_main_resource', $this->data);


    }

    public function courselist_output_content($items)
    {
        $output = '';
        $j = 0;
        foreach ($items as $unit):
            $j++;
            $output .= '<tr>';
            $output .= '<td>' . $unit->course_name . '</td>';
            $output .= '<td>&nbsp;&nbsp;&nbsp;' . $unit->information . '</td>';
            $output .= '<td>'
                . '<img src="' . base_url($unit->image_path) . '">'
                . '<div class="play-btn" src="' . base_url('assets/images/frontend/resource/play-btn.png') . '" '
                . ' onclick="showVideoPlayer(' . $unit->id . ')">'
                . '</td>';
            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function userplayerview()
    {

    }

    public function lessonware()
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));

        $this->data['showHelp'] = 1;

        $this->session->unset_userdata('learning_subject_id');
        $this->session->unset_userdata('learning_term_id');
        $this->session->unset_userdata('learning_coursetype_id');
        $this->session->unset_userdata('learning_curQuery');

        $userID = $this->session->userdata('loginuserID');
        $this->data['parentView'] = 'back';

        $this->data['perPage'] = $perPage = 11;
        $this->data['cntPage'] = $cntPage = $this->lessons_m->get_count(array('tbl_huijiao_lessons.user_id' => $userID, 'tbl_huijiao_lessons.status' => 1), 'teacher');

        $ret = $this->paginationCompress('resource/lessonware/', $cntPage, $perPage);

        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["lessonList"] = $this->lessons_m->getItemsByPage(
            array('tbl_huijiao_lessons.user_id' => $userID, 'tbl_huijiao_lessons.status' => 1), $ret['pageId'], $ret['cntPerPage'], 'teacher');
        if ($this->data["lessonList"] == null) {
            $curSeg = $segment = $this->uri->segment(SEGMENT);
            if ($curSeg != 0 && $curSeg != '') {
                $curSeg -= $perPage;
                redirect(base_url('resource/lessonware/' . $curSeg));
                return;
            }
        }
        $this->data["lessonList_content"] = $this->lessonware_output_content($this->data["lessonList"]);

        $this->data["selectedIndex"] = 1;
        $this->data["subview"] = "resource/lessonware";
        $this->load->view('_layout_main_resource', $this->data);
    }

    public function lessonware_output_content($items)
    {
        $output = '';
        $j = 0;
        $all_subjects = $this->terms_m->get_where(['status' => 1]);
        if ($items == null) return '';
        foreach ($items as $unit):
            $j++;
            $subject = "";
            foreach ($all_subjects as $sub) {
                if ($unit->term_id != $sub->id) continue;
                $subject = $unit->subject . ' ' . $sub->title;
                break;
            }

            $output .= '<div class="list-item"><div>';
            $output .= '<div class="item-main-info" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview-wrapper" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview" style="background:url(' . base_url() . $unit->image_icon . ');" onclick="showLessonPlayer(' . $unit->id . ',1)"></div>';
            $output .= '</div>';
            $output .= '<div class="item-coursename" onclick="showLessonPlayer(' . $unit->id . ',1)" '
                . ' item_id="' . $unit->id . '"'
                . ' style="cursor:pointer;">' . $unit->title . '</div>';
            $output .= '<div class="item-subjectname">' . $subject . '</div>';
            $output .= '<div class="item-subjectname">新建时间 : ' . $unit->create_time . '</div>';
            $output .= '</div>';
            $output .= '<div class="item-infobar">';
            $output .= '<div class="lessonware_operation">'
                . '<div class="edit-btn" '
                . ' onclick="edit_lw(this)" item_id=' . $unit->id . '><i class="fa fa-pencil" style="margin: 0 5px;" ></i> 编 辑</div>'
                . '<div class="delete-btn" '
                . ' onclick="delete_lw(this)" item_id=' . $unit->id . '><i class="fa fa-trash" style="margin: 0 5px;" ></i> 删 除</div>'
                . '</div>';
            $output .= '</div>';
            $output .= '</div></div>';

        endforeach;
        return $output;
    }

    public function lessonware_home($id = 0, $title = '')
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $user_id = $this->session->userdata('loginuserID');
        $this->data['lesson'] = array();
        $this->data['lessonContents'] = array();
        if ($id != 0) {
            $this->data['lesson'] = $this->lessons_m->get_single(array('id' => $id, 'user_id' => $user_id));
            if ($this->data['lesson'] != null)
                $this->data['lessonContents'] = $this->contents_m->getContentsFromLessonId($this->data['lesson']->lesson_info);
            else {
                redirect(base_url('resource/lessonware'));
                return;
            }
        }
//        $this->courses_m->clearUnusedCourses();
        $this->data['parentView'] = 'resource/lessonware';
        $this->data['subjects'] = $this->subject_m->get_where(array('status' => 1));
        $this->data['terms'] = $this->terms_m->get_where(array('status' => 1));
        $this->data["subview"] = "resource/lessonware_home";
        $this->load->view('_layout_main_resource', $this->data);
    }

    public function getCourseTypes()
    {
        $ret = array(
            'data' => array(),
            'status' => false
        );
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $term_id = $_POST['term_id'];
            $result = $this->coursetype_m->get_where(
                array(
                    'term_id' => $term_id,
                    'user_id' => $user_id,
                    'status' => 1
                )
            );

            $ret['status'] = true;
            $ret['data'] = $result;
        }
        echo json_encode($ret);
    }

    public function getContents()
    {
        $ret = array(
            'data' => array(),
            'status' => false
        );
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $coursetype_id = $_POST['coursetype_id'];
            $result = $this->contents_m->get_where(
                array(
                    'course_type_id' => $coursetype_id,
                    'user_id' => $user_id,
                    'status' => 1
                )
            );

            $ret['status'] = true;
            $ret['data'] = $result;
        }
        echo json_encode($ret);
    }

    public function getLessons()
    {
        $ret = array(
            'data' => array(),
            'status' => false
        );
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $coursetype_id = $_POST['coursetype_id'];
            $result = $this->lessons_m->get_where(
                array(
                    'course_type_id' => $coursetype_id,
                    'user_id' => $user_id,
                    'status' => 1
                )
            );

            $ret['status'] = true;
            $ret['data'] = $result;
        }
        echo json_encode($ret);
    }

    public function updateLessonInfo()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $id = $_POST['id'] . '';
            $lessonItem = array();
            $lessonItem['title'] = '';
            if (isset($_POST['title']))
                $lessonItem['title'] = str_replace('script>', 'div>', $this->db->escape_str($_POST['title']));
            if ($lessonItem['title'] == '') {
                $ret['data'] = '请输入课件名称';
                echo json_encode($ret);
                return;
            }
            $lessonItem['term_id'] = $_POST['term_id'];
            $lessonItem['lesson_info'] = $_POST['lesson_info'];
            $lessonItem['user_id'] = $this->session->userdata('loginuserID');
            $lessonItem['status'] = 1;
            $lessonItem['update_time'] = date('Y-m-d H:i:s');
            $ncw_type = $_POST['icon_format'];

            $config['upload_path'] = "./uploads/lessons";
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path']);
            }

            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = 'qd' . $id . $tt;
            $config['file_name'] = $filename . '_icon.' . $ncw_type;
            if (file_exists(substr($config['upload_path'], 2) . '/' . $config['file_name'])) {
                unlink(substr($config['upload_path'], 2) . '/' . $config['file_name']);
            }
            $this->load->library('upload', $config);
            $this->upload->initialize($config, TRUE);

            $imgPath = '';//'assets/images/huijiao/tab2/icon0.png';

            $ncw_file = '';
            // .png,.jpg,.bmp,.gif,.jpeg,.mp4,.mp3,.pdf,.html,.htm,.doc,.docx,.ppt,.pptx,.zip
            $ncw_type1 = '';

            if ($_FILES["add_file_name1"]["name"] != '') {
                switch ($ncw_type) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('add_file_name1')) {
                            $data = $this->upload->data();
                            $imgPath = substr($config['upload_path'], 2) . '/' . $config['file_name'];
                        } else {
                            $ret['data'] = '图片上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    default:
                        $ret['data'] = '封面图格式不正确';
                        echo json_encode($ret);
                        return;
                        break;
                }
            } else if ($id == '0') {
                $ret['data'] = '请上传封面图';
                echo json_encode($ret);
                return;
            }
            if ($imgPath != '') $lessonItem['image_icon'] = $imgPath;

            if ($id == '0') {
                $lessonItem['create_time'] = date('Y-m-d H:i:s');
                $this->lessons_m->add($lessonItem);
            } else {
                $this->lessons_m->edit($lessonItem, $id);
            }
            $ret['status'] = 'success';
            $ret['data'] = '操作成功';
        }
        echo json_encode($ret);
    }

    public function delete()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            //At first courseware directory with specified courseware id  in uploads directory
            $delete_lw_id = $_POST['delete_lw_id'];
            $this->data['cwsets'] = $this->lessons_m->delete($delete_lw_id);
            $ret['data'] = '';//$this->lessonware_output_content($this->data['cwsets']);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function publish()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $publish_lw_id = $_POST['publish_lw_id'];
            $publish_lw_st = $_POST['publish_state'];
            $this->data['cwsets'] = $this->lessons_m->publish($publish_lw_id, $publish_lw_st);
            $ret['data'] = $this->lessonware_output_content($this->data['cwsets']);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function learning()
    {
        //$this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $this->data['parentView'] = 'home/index';
        $this->data['showHelp'] = 1;

        $subjects = $this->subject_m->get_where(['status' => 1]);
        $subject = null;
        $term_id = null;
        $coursetype_id = null;
        $curQuery = '';
        if ($_SERVER['REQUEST_URI'] == '/resource' || $_SERVER['REQUEST_URI'] == '/resource/learning') {

            $this->session->set_userdata('learning_subject_id', $subjects[0]->id);
            $this->session->set_userdata('learning_term_id', null);
            $this->session->set_userdata('learning_coursetype_id', null);
            $this->session->set_userdata('learning_curQuery', '');

        }
        $subject_id = $this->session->userdata('learning_subject_id');
        $term_id = $this->session->userdata('learning_term_id');
        $coursetype_id = $this->session->userdata('learning_coursetype_id');
        $curQuery = $this->session->userdata('learning_curQuery');

        $filter = array();
        if ($subject_id) $filter['tbl_huijiao_subject.id'] = $subject_id;
        if ($term_id) $filter['tbl_huijiao_terms.id'] = $term_id;
        if ($coursetype_id) $filter['tbl_huijiao_contents.content_type_no'] = $coursetype_id;
        $filter['tbl_huijiao_contents.status'] = 1;

        $this->data['perPage'] = $perPage = 30;
        $this->data['cntPage'] = $cntPage = $this->contents_m->get_count($filter, $curQuery, 'teacher');
        $ret = $this->paginationCompress('resource/learning/', $cntPage, $perPage);

        $this->data['curPage'] = $curPage = $ret['pageId'];
        $contents = $this->contents_m->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $curQuery, 'teacher');

//        var_dump($contents);
        $this->data["contents"] = $this->get_contents_html($contents);
        $subject = null;
        $term = null;
        $coursetype = null;
        if ($subject_id != '' && $subject_id != null) {
            $subject = $this->subject_m->get_single(['id' => $subject_id]);
            $terms = $this->terms_m->get_where(['subject_id' => $subject_id, 'status' => 1]);
        } else {
            $terms = array();
        }
        if ($coursetype_id != '' && $coursetype_id != null) {
            $coursetype = $this->contenttype_m->get_single(array('id' => $coursetype_id));
        }

        $arr = array(
            'tbl_huijiao_subject.status' => 1,
            'tbl_huijiao_terms.status' => 1,
            'tbl_huijiao_course_type.status' => 1,
            'tbl_huijiao_contents.status' => 1,
            'tbl_huijiao_content_type.status' => 1,
        );
        if ($subject_id != '') $arr['tbl_huijiao_subject.id'] = $subject_id;
        if ($term_id != '') $arr['tbl_huijiao_terms.id'] = $term_id;

        if ($terms)
            foreach ($terms as $item) {
                if ($item->id == $term_id) $term = $item;
            }

        $contenttypes = $this->contenttype_m->getFilteredContentTypes($arr, $curQuery);

        $this->data["subjects"] = $this->get_subjects_select_html($subjects, $subject_id);
        $this->data["subject_id"] = $subject_id;
        $this->data["subject_title"] = $subject == null ? '全部' : $subject->title;
        $this->data['terms'] = $this->get_terms_select_html($terms, $term_id);
        $this->data['coursetypes'] = $this->get_coursetypes_select_html($contenttypes, $coursetype_id);

        $this->data["subject_id"] = $subject_id;
        $this->data["subject"] = $subject;
        $this->data["term_id"] = $term_id;
        $this->data["term"] = $term;
        $this->data["coursetype_id"] = $coursetype_id;
        $this->data["coursetype"] = $coursetype;
        $this->data["curQuery"] = $curQuery;

        log_message('info', 'learning $contents : ' . $this->data["contents"]);

        $this->data["subview"] = "resource/learning";
        $this->load->view('_layout_main_resource', $this->data);
    }

    public function playerview($id = NULL)
    {
        //whenever this function is called..
        ///we have to add access time and update curseware_access table of database.
        if (!is_numeric($id) || $id == NULL) {
            show_404();
            return;
        }
        $this->data['parentView'] = 'resource/learning';
        $this->data["learningList"] = $this->courses_m->get($id, TRUE);
        $item = $this->data["learningList"];
        $this->data['class_id'] = $item->course_path;
        $course_type = $item->course_type;
        $this->data['title_id'] = $id;
        switch ($course_type) {
            case '2':
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/videoplayer";
                break;
            case '3':
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/imageplayer";
                break;
            case '4':
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/docviewer";
                break;
            case '5':
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/pdfviewer";
                break;
            case '6':
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/player";
                break;
            default:
                $this->data['title_id'] = $item->course_name;
                $this->data["subview"] = "resource/docviewer";
        }
        $this->load->view('_layout_main', $this->data);

    }

//FUNCTION :: read a docx file and return the string
    function readDocx($filePath)
    {
        require_once APPPATH . 'controllers/phpdocx/classes/TransformDoc.inc';
        $document = new TransformDoc();
        $document->setStrFile($filePath);
        $document->generateXHTML();
        $document->validatorXHTML();
        return $document->getStrXHTML();
    }

//FUNCTION :: read a docx file and return the string
    function readDocx00($filePath)
    {
        // Create new ZIP archive
        $zip = new ZipArchive;
        $dataFile = 'word/document.xml';
        // Open received archive file
        if (true === $zip->open($filePath)) {
            // If done, search for the data file in the archive
            if (($index = $zip->locateName($dataFile)) !== false) {
                // If found, read it to the string
                $data = $zip->getFromIndex($index);
                // Close archive file
                $zip->close();
                // Load XML from a string
                // Skip errors and warnings
                $handle = new DOMDocument();
                $xml = $handle->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                // Return data without XML formatting tags
//                return $handle->saveXML();
                $contents = explode('\n', strip_tags($handle->saveXML()));
                $text = '';
                foreach ($contents as $i => $content) {
                    $text .= '<p>' . $contents[$i] . '</p>';
                }
                return $text;
            }
            $zip->close();
        }
        // In case of failure return empty string
        return "";
    }

    function wordDownload()
    {
        $ret = array(
            'data' => '无法分析此文档',
            'status' => 'fail'
        );
        if ($_POST) {
            $filename = $this->input->post('filename');
            $ret['data'] = $this->readDocx($filename);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function learningPlayerView($id = NULL)
    {
        if (!is_numeric($id) || $id == NULL) {
            show_404();
            return;
        }
        $this->data['parentView'] = 'resource/learning';
        $this->data["learningList"] = $this->learning_m->get_single_learning($id);
        $this->data['class_id'] = $this->data["learningList"]->path . '.mp4';
        $this->data['title_id'] = $this->data["learningList"]->name;
        $this->data["subview"] = "resource/videoplayer";
        $this->load->view('_layout_main', $this->data);
    }

    public function view($id = NULL)
    {
        //whenever this function is called..
        ///we have to add access time and update curseware_access table of database.
        if (!is_numeric($id) || $id == NULL) {
            show_404();
            return;
        }
        $this->data['parentView'] = 'back';
        $this->data["packageList"] = $this->package_m->get_package();
        $this->data['class_id'] = $this->data["packageList"][$id]->path . '/package';
        $this->data["subview"] = "resource/player";
        $this->load->view('_layout_main', $this->data);
    }

    public function mylesson()
    {
        //whenever this function is called..
        ///we have to add access time and update curseware_access table of database.
        if (!($this->signin_m->loggedin())) redirect(base_url('home/index'));

        $userId = $this->session->userdata('loginuserID');
        $this->data["lessons"] = $this->ncoursewares_m->get_lesson_courses($userId);
        $this->data["coursewares"] = $this->ncoursewares_m->get_ncw_lesson($userId);
        $this->data["subview"] = "coursewares/mylesson";
        $this->load->view('_layout_main', $this->data);

    }

    public function mylesson_prepare()
    {
        //whenever this function is called..
        ///we have to add access time and update curseware_access table of database.
        if (!($this->signin_m->loggedin())) redirect(base_url('home/index'));

        $userId = $this->session->userdata('loginuserID');
        $this->data["courses"] = $this->ncoursewares_m->get_lesson_courses($userId);
        $this->data["coursewares"] = $this->ncoursewares_m->get_ncw_lesson($userId);
        $this->data["subview"] = "coursewares/mylesson_prepare";
        $this->load->view('_layout_main_notool', $this->data);

    }

    public function getLessonItems()
    {
        $ret = array('status' => 'fail', 'data' => array());
        if (!($this->signin_m->loggedin())) {
            echo json_encode($ret);
            return;
        }
        $userId = $_POST['userId'];
        if ($userId == '') $userId = '0';
        $ret['data']['lessons'] = $this->ncoursewares_m->get_lesson_courses($userId);
        $ret['data']['coursewares'] = $this->ncoursewares_m->get_ncw_lesson($userId);
        $ret['status'] = 'success';
        echo json_encode($ret);
    }

    public function addLessonItem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $author_id = $_POST['author_id'];
            $lesson_name = $_POST['lesson_name'];

            $lessonItem = [
                'media_userid' => $author_id,
                'media_name' => $lesson_name,
                'media_infos' => '[]',
            ];

            $this->db->trans_start();
            $this->db->insert('new_lesson', $lessonItem);
            $lesson_id = $this->db->insert_id();
            $this->db->trans_complete();

            $ret['status'] = 'success';
            $ret['data'] = $this->ncoursewares_m->get_lesson_courses();
        }
        echo json_encode($ret);
    }

    public function updateLessonItem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $lesson_name = $_POST['lesson_name'];
            $media_infos = $_POST['media_infos'];
            $lessonItem = [
                'title_id' => $item_id,
            ];
            if ($lesson_name != '')
                $lessonItem['media_name'] = $lesson_name;
            if ($media_infos != '')
                $lessonItem['media_infos'] = $media_infos;

            $this->db->set($lessonItem);
            $this->db->where('title_id', $item_id);
            $this->db->update('new_lesson');

            $ret['status'] = 'success';
            $ret['data'] = $this->ncoursewares_m->get_lesson_courses();
        }
        echo json_encode($ret);
    }

    public function add_content()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            $ncw_name = $this->input->post('upload_lw_name');
            $ncw_type = $this->input->post('upload_lw_type');
            $term_id = $this->input->post('upload_lesson_id');
            $userId = $this->input->post('upload_userId');

            $config['upload_path'] = "./uploads/contents";
            $config['allowed_types'] = '*';
            $tt = sprintf('%05d', $term_id) . date('0ymdHis0') . rand(1000, 9999);
            $filename = 'qd' . sprintf('%05d', $userId) . $tt . 'nr';
            $config['file_name'] = $filename . '.' . $ncw_type;
            $this->load->library('upload', $config);
            $this->upload->initialize($config, TRUE);

            $ncw_file = '';
            // .png,.jpg,.bmp,.gif,.jpeg,.mp4,.mp3,.pdf,.html,.htm,.doc,.docx,.ppt,.pptx,.zip
            $ncw_type1 = '';
            switch ($ncw_type) {
                case 'gif':
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'bmp':
                    ///Image file uploading........
                    if ($this->upload->do_upload('add_file_name')) {
                        $data = $this->upload->data();
                        $ncw_file = 'uploads/contents/' . $filename . '.' . $ncw_type;
                        $ncw_type = '3';
                    } else {
                        $ret['data'] = '图片上传错误' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'mp3':
                    $ncw_type1 = '_1';
                case 'wav':
                case 'mp4':
                    ///Video file uploading........
                    if ($this->upload->do_upload('add_file_name')) {
                        $data = $this->upload->data();
                        $ncw_file = 'uploads/contents/' . $filename . '.' . $ncw_type;
                        $ncw_type = '2';
                    } else {
                        $ret['data'] = '音频或视频上传错误' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'pptx':
                case 'ppt':
                    $ncw_type1 = '_1';
                case 'docx':
                case 'doc':
                    ///Video file uploading........
                    if ($this->upload->do_upload('add_file_name')) {
                        $data = $this->upload->data();
                        $ncw_file = 'uploads/contents/' . $filename . '.' . $ncw_type;
                        $ncw_type = '4';
                    } else {
                        $ret['data'] = 'OFFICE文档上传错误' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'pdf':
                    ///Video file uploading........
                    if ($this->upload->do_upload('add_file_name')) {
                        $data = $this->upload->data();
                        $ncw_file = 'uploads/contents/' . $filename . '.' . $ncw_type;
                        $ncw_type = '5';
                    } else {
                        $ret['data'] = 'PDF文档上传错误' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'html':
                case 'htm':
                    ///Video file uploading........
                    if ($this->upload->do_upload('add_file_name')) {
                        $data = $this->upload->data();
                        $ncw_file = 'uploads/contents/' . $filename . '.' . $ncw_type;
                        $ncw_type = '6';
                    } else {
                        $ret['data'] = 'HTML文档上传错误' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'zip':
                    ///Package file uploading.......
                    if (isset($_FILES['add_file_name']['name'])) {

                        $uploadPath = 'uploads/contents/' . $filename;
                        if (is_dir($uploadPath)) {
                            $this->rrmdir($uploadPath);
                        }
                        mkdir($uploadPath, 0755, true);
                        $configPackage['upload_path'] = './' . $uploadPath;
                        $configPackage['allowed_types'] = '*';
                        $configPackage['file_name'] = $filename . '.' . $ncw_type;
                        $this->load->library('upload', $configPackage);
                        $this->upload->initialize($configPackage, TRUE);
                        if ($this->upload->do_upload('add_file_name')) {
                            $zipData = $this->upload->data();
                            $zip = new ZipArchive;
                            $file = $zipData['full_path'];
                            chmod($file, 0777);
                            if ($zip->open($file) === TRUE) {
                                $zip->extractTo($configPackage['upload_path']);
                                $zip->close();
//                                unlink($file);
                            } else {
                                $ret['data'] = 'H5包上传失败' . $this->upload->display_errors();
                                echo json_encode($ret); // failed
                            }
                            $ncw_file = $uploadPath;
                            $ncw_type = '1';
                        } else {
                            $ret['data'] = $this->upload->display_errors();
                            echo json_encode($ret);
                            return;
                        }
                    } else {
                        $ret['data'] = 'H5包上传错误' . $this->upload->display_errors();
                        echo json_encode($ret); // failed
                    }
                    break;
                default:
                    $ret['data'] = '文档格式错误';
                    echo json_encode($ret);
                    return;
                    break;
            }
            $imgPath = 'assets/images/huijiao/tab2/icon' . $ncw_type . $ncw_type1 . '.png';
//            if ($ncw_type == '3') $imgPath = $ncw_file;
            //At first insert new coureware information to the database table
            $param = array(
                'title' => $ncw_name . '',
                'status' => 1,
                'user_id' => $userId . '',
                'is_download' => 1 . '',
                'course_type_id' => $term_id . '',
                'content_type_id' => $ncw_type . '',
                'content_type_no' => $ncw_type . '',
                'icon_path' => $imgPath . '',
                'content_path' => $ncw_file . '',
                'create_time' => date("Y-m-d H:i:s"),
                'update_time' => date("Y-m-d H:i:s"),
            );
            $ncwId = $this->contents_m->add($param);
            $ret['data'] = '上传成功';
            $ret['contentItem'] = $this->contents_m->get_single(array('id' => $ncwId));
            $ret['status'] = 'success';
        }
        echo json_encode($ret);

    }

    public function removeLessonItem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $lessonId = $_POST['lessonId'];
            if ($lessonId > 4) {
                $this->db->where('title_id', $lessonId);
                $this->db->delete('new_lesson');

                $this->db->where('ncw_sn', $lessonId);
                $this->db->delete('new_coursewares');

                $ret['status'] = 'success';
                $ret['data'] = $lessonId;
            }
        }
        echo json_encode($ret);
    }

    public function removeLessonCourseware()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $coursewareId = $_POST['coursewareId'];
            if ($coursewareId > 52) {
                $this->db->where('ncw_sn', $coursewareId);
                $this->db->delete('new_coursewares');

                $ret['status'] = 'success';
                $ret['data'] = $coursewareId;
            }
        }
        echo json_encode($ret);
    }

    function pdfDownLoad()
    {
        if (!empty($_GET)) {
            $pdfUrl = $_GET['pdfUrl'];
            $pdf = new PDF_AutoPrint();///https://stackoverflow.com/questions/33254679/print-pdf-in-firefox
            $pageCnt = $pdf->setSourceFile("uploads/courseware/" . $pdfUrl);

            for ($i = 1; $i <= $pageCnt; $i++) {
                $tplIdx = $pdf->importPage($i, '/MediaBox');
                $pdf->addPage();
                $pdf->useTemplate($tplIdx);
            }
            $pdf->AutoPrint(true);
            $pdf->Output();
        }
    }

    function iosReadTextHandler()
    {

        $ret = array(
            'status' => 'fail',
            'data' => ''
        );
        if (!empty($_GET)) {

            $cur_readText = $_GET['cur_text'];
            $text_id = $_GET['text_id'];

            $this->session->set_userdata('cur_read_text', $cur_readText);
            $this->session->set_userdata('read_text_id', $text_id);

            $ret['status'] = 'success';
            $ret['data'] = 'Transmitted read text to server';
        }
        echo json_encode($ret);
    }

    function iosCheckReadText()
    {

        $ret = array(
            'status' => 'fail',
            'data' => ''
        );
        if (!empty($_POST)) {
            $textID = $_POST['text_id'];
            if (isset($_SESSION['cur_read_text']) && isset($_SESSION['read_text_id'])) {

                $readTxtID = $this->session->userdata('read_text_id');
                if ($readTxtID !== $textID) {

                    $ret['data'] = "Can't find current text information from server!";
                    echo json_encode($ret);
                    return;
                }
                $ret['status'] = 'success';
                $ret['data'] = $this->session->userdata('cur_read_text');
                echo json_encode($ret);
                return;
            }

        }
        echo json_encode($ret);
    }

    public function lesson_favorite()
    {
        log_message('info', '-- lesson_favorite start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $usage_id = $_POST['usage_id'];
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $lesson_id = $_POST['lesson_id'];
            $favorite = $_POST['favorite'];
            log_message('info', '-- lesson_favorite $usage_id : ' . $usage_id);
            log_message('info', '-- lesson_favorite $user_id : ' . $user_id);
            log_message('info', '-- lesson_favorite $lesson_id : ' . $lesson_id);
            log_message('info', '-- lesson_favorite $favorite : ' . $favorite);

            $usageItem = [
                'is_favorite' => $favorite,
                'update_time' => date('Y-m-d H:i:s'),
            ];

            if ($usage_id == null || $usage_id == '') {
                $param = array(
                    'lesson_id' => $lesson_id,
                    'user_id' => $user_id,
                    'is_favorite' => $favorite,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $this->usage_m->edit($usageItem, $usage_id);
            }
            $fav_count = $this->usage_m->get_where(['lesson_id' => $lesson_id, 'is_favorite' => 1]);
            $ret['fav_count'] = 0;
            if ($fav_count != null)
                $ret['fav_count'] = count($fav_count);

            $ret['status'] = 'success';
            $ret['data'] = $usage_id;
        }
        echo json_encode($ret);
    }

    public function lesson_like()
    {
        log_message('info', '-- lesson_like start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $usage_id = $_POST['usage_id'];
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $lesson_id = $_POST['lesson_id'];
            $like = $_POST['like'];
            log_message('info', '-- lesson_like $usage_id : ' . $usage_id);
            log_message('info', '-- lesson_like $user_id : ' . $user_id);
            log_message('info', '-- lesson_like $lesson_id : ' . $lesson_id);
            log_message('info', '-- lesson_like $like : ' . $like);

            $usageItem = [
                'is_like' => $like,
                'update_time' => date('Y-m-d H:i:s'),
            ];

            if ($usage_id == null || $usage_id == '') {
                $param = array(
                    'lesson_id' => $lesson_id,
                    'user_id' => $user_id,
                    'is_like' => $like,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $like_num = $this->usage_m->get_where(['lesson_id' => $lesson_id, 'is_like' => 1]);
            $like_num = count($like_num);

            $ret['status'] = 'success';
            $ret['data'] = array(
                'usage_id' => $usage_id,
                'like_num' => $like_num
            );
        }
        echo json_encode($ret);
    }

    public function lesson_read()
    {
        log_message('info', '-- lesson_read start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $lesson_id = $_POST['lesson_id'];
            log_message('info', '-- lesson_read $user_id : ' . $user_id);
            log_message('info', '-- lesson_read $lesson_id : ' . $lesson_id);

            $usage = $this->usage_m->get_where(['lesson_id' => $lesson_id, 'user_id' => $user_id]);

            $usage_id = null;
            if ($usage == null) {
                $param = array(
                    'lesson_id' => $lesson_id,
                    'user_id' => $user_id,
                    'read_count' => 1,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $usage_id = $usage[0]->id;
                $read_count = $usage[0]->read_count + 1;
                log_message('info', '-- lesson_read $read_count : ' . $read_count);
                $usageItem = [
                    'read_count' => $read_count,
                    'update_time' => date('Y-m-d H:i:s'),
                ];
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $ret['status'] = 'success';
            $ret['data'] = $usage_id;
        }
        echo json_encode($ret);
    }

    public function content_favorite()
    {
        log_message('info', '-- content_favorite start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $usage_id = $_POST['usage_id'];
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $content_id = $_POST['content_id'];
            $favorite = $_POST['favorite'];
            log_message('info', '-- content_favorite $usage_id : ' . $usage_id);
            log_message('info', '-- content_favorite $user_id : ' . $user_id);
            log_message('info', '-- content_favorite $content_id : ' . $content_id);
            log_message('info', '-- content_favorite $favorite : ' . $favorite);

            $usageItem = [
                'is_favorite' => $favorite,
                'update_time' => date('Y-m-d H:i:s'),
            ];

            if ($usage_id == null || $usage_id == '') {
                $param = array(
                    'content_id' => $content_id,
                    'user_id' => $user_id,
                    'is_favorite' => $favorite,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $favorite_num = $this->usage_m->get_where(['content_id' => $content_id, 'is_favorite' => 1]);
            $favorite_num = count($favorite_num);

            $ret['status'] = 'success';
            $ret['data'] = array(
                'usage_id' => $usage_id,
                'favorite_num' => $favorite_num
            );
        }
        echo json_encode($ret);
    }

    public function content_like()
    {
        log_message('info', '-- content_like start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $usage_id = $_POST['usage_id'];
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $content_id = $_POST['content_id'];
            $like = $_POST['like'];
            log_message('info', '-- content_like $usage_id : ' . $usage_id);
            log_message('info', '-- content_like $user_id : ' . $user_id);
            log_message('info', '-- content_like $content_id : ' . $content_id);
            log_message('info', '-- content_like $like : ' . $like);

            $usageItem = [
                'is_like' => $like,
                'update_time' => date('Y-m-d H:i:s'),
            ];

            if ($usage_id == null || $usage_id == '') {
                $param = array(
                    'content_id' => $content_id,
                    'user_id' => $user_id,
                    'is_like' => $like,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $like_num = $this->usage_m->get_where(['content_id' => $content_id, 'is_like' => 1]);
            $like_num = count($like_num);

            $ret['status'] = 'success';
            $ret['data'] = array(
                'usage_id' => $usage_id,
                'like_num' => $like_num
            );
        }
        echo json_encode($ret);
    }

    public function content_read()
    {
        log_message('info', '-- content_read start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $content_id = $_POST['content_id'];
            log_message('info', '-- content_read $user_id : ' . $user_id);
            log_message('info', '-- content_read $content_id : ' . $content_id);

            $usage = $this->usage_m->get_where(['content_id' => $content_id, 'user_id' => $user_id]);

            $usage_id = null;
            if ($usage == null) {
                $param = array(
                    'content_id' => $content_id,
                    'user_id' => $user_id,
                    'read_count' => 1,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $usage_id = $usage[0]->id;
                $read_count = $usage[0]->read_count + 1;
                log_message('info', '-- content_read $read_count : ' . $read_count);
                $usageItem = [
                    'read_count' => $read_count,
                    'update_time' => date('Y-m-d H:i:s'),
                ];
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $ret['status'] = 'success';
            $ret['data'] = $usage_id;
        }
        echo json_encode($ret);
    }

    public function content_download()
    {
        log_message('info', '-- content_download start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $user_id = $this->session->userdata('loginuserID');
            if (!$user_id) $user_id = '0';
            $content_id = $_POST['content_id'];

            $usage = $this->usage_m->get_where(['content_id' => $content_id, 'user_id' => $user_id]);

            $usage_id = null;
            if ($usage == null) {
                $param = array(
                    'content_id' => $content_id,
                    'user_id' => $user_id,
                    'download_count' => 1,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                );
                $usage_id = $this->usage_m->add($param);
            } else {
                $usage_id = $usage[0]->id;
                $download_count = $usage[0]->download_count + 1;
                $usageItem = [
                    'download_count' => $download_count,
                    'update_time' => date('Y-m-d H:i:s'),
                ];
                $this->usage_m->edit($usageItem, $usage_id);
            }

            $ret['status'] = 'success';
            $ret['data'] = $usage_id;
        }
        echo json_encode($ret);
    }

    public function selectCourseType()
    {
        log_message('info', '-- selectCourseType start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $subject_id = $_POST['subject_id'];
            $term_id = $_POST['term_id'];
            $coursetype_id = $_POST['coursetype_id'];
            $curQuery = $_POST['curQuery'];

            $subjects = $this->subject_m->get_where(['status' => 1]);
            $subject = null;

            $this->session->set_userdata('learning_subject_id', $subject_id);
            $this->session->set_userdata('learning_term_id', $term_id);
            $this->session->set_userdata('learning_coursetype_id', $coursetype_id);
            $this->session->set_userdata('learning_curQuery', $curQuery);

            if ($term_id != '') {
                $term = $this->terms_m->get_single(['id' => $term_id]);
                $subject = null;
                $subject_id = '';
                if ($term != null) {
                    $subject = $this->subject_m->get_single(['id' => $term->subject_id]);
                    $subject_id = $subject->id;
                }
            } else if ($subject_id != '') {
                $subject = $this->subject_m->get_single(['id' => $subject_id]);
            }

            if ($subject_id) $filter['tbl_huijiao_subject.id'] = $subject_id;
            if ($term_id) $filter['tbl_huijiao_terms.id'] = $term_id;
            if ($coursetype_id) $filter['tbl_huijiao_contents.content_type_no'] = $coursetype_id;
            $filter['tbl_huijiao_contents.status'] = 1;

            $this->data['perPage'] = $perPage = 30;
            $this->data['cntPage'] = $cntPage = $this->contents_m->get_count($filter, $curQuery, 'teacher');

            $ret = $this->paginationCompress('resource/learning/', $cntPage, $perPage);

            $this->data['curPage'] = $curPage = $ret['pageId'];
//        $contents = array_slice($contents, $ret['pageId'], $ret['cntPerPage']);
            $contents = $this->contents_m->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $curQuery, 'teacher');

            $ret['data']['contents'] = $this->get_contents_html($contents);

            if ($subject_id != '') {
                $terms = $this->terms_m->get_where(['subject_id' => $subject_id, 'status' => 1]);
            } else {
                $terms = array();
            }
            $arr = array(
                'tbl_huijiao_subject.status' => 1,
                'tbl_huijiao_terms.status' => 1,
                'tbl_huijiao_course_type.status' => 1,
                'tbl_huijiao_contents.status' => 1,
                'tbl_huijiao_content_type.status' => 1,
            );
            if ($subject_id != '') $arr['tbl_huijiao_subject.id'] = $subject_id;
            if ($term_id != '') $arr['tbl_huijiao_terms.id'] = $term_id;
            $contenttypes = $this->contenttype_m->getFilteredContentTypes($arr, $curQuery);

            $ret['status'] = 'success';
            $ret['data']['subjects'] = $this->get_subjects_select_html($subjects, $subject_id);
            $ret['data']['subject_id'] = $subject_id;
            $ret['data']['subject_title'] = $subject == null ? '全部' : $subject->title;
            $ret['data']['terms'] = $this->get_terms_select_html($terms, $term_id);
            $ret['data']['term_id'] = $term_id;
            $ret['data']['coursetype_id'] = $coursetype_id;
            $ret['data']['coursetypes'] = $this->get_coursetypes_select_html($contenttypes, $coursetype_id);
            $ret['data']['curPage'] = $curPage;
            $ret['data']['perPage'] = $perPage;
            $ret['data']['cntPage'] = $cntPage;
            $ret['data']['pagination'] = $this->pagination->create_links();

        }
        echo json_encode($ret);
    }

    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }

    public function get_lessons_html($lessons)
    {
        $output = '';
        for ($i = 0; $i < count($lessons); $i++) {
            $lesson = $lessons[$i];
            $term_id = $lesson->term_id;
            $term = $this->terms_m->get_single(['id' => $term_id]);
            $subject_id = $term->subject_id;
            $subject = $this->subject_m->get_single(['id' => $subject_id]);
            $usages = $this->usage_m->get_where(['is_like' => 1, 'lesson_id' => $lesson->id]);

            $usage_like = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'lesson_id' => $lesson->id]);
            $usage_id = '';
            if ($usage_like != null) {
                $usage_id = $usage_like[0]->id;
                $usage_like = $usage_like[0]->is_like;
            } else {
                $usage_like = 0;
            }

            $usages_read = $this->usage_m->get_where(['lesson_id' => $lesson->id]);
            $read_count = 0;
            foreach ($usages_read as $usage) {
                $read_count += $usage->read_count;
            }

            $usages_read_mine = $this->usage_m->get_where([
                'user_id' => $this->session->userdata('loginuserID'),
                'lesson_id' => $lesson->id
            ]);

            $output .= '<div class="list-item"><div>';
            $output .= '<div class="item-main-info" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview-wrapper" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview" style="background:url(' . base_url() . $lesson->image_icon . ');" '
                . ' onclick="openContents(\'' . base_url('resource/previewPlayer') . '/' . $lesson->id . '\',\'_blank\')"></div>';
            $output .= '</div>';
            $output .= '<div class="item-coursename" onclick="window.location.href = \'' . base_url('resource/previewPlayer') . '/' . $lesson->id . '\'" style="color: black;">' . $lesson->title . '</div>';
            $output .= '<div class="item-subjectname">' . $subject->title . ' ' . $term->title . '</div>';
            $output .= '</div>';
            $output .= '<div class="item-infobar">';
            $output .= '<div class="item-read-icon" data-sel="' . ($usages_read_mine != null ? 1 : 0) . '"></div>';
            $output .= '<div class="item-read-value">' . $read_count . '</div>';
            $output .= '<div class="item-favor-icon ' . ($usage_like > 0 ? 'active' : '') . '" data-sel="' . $usage_like . '" data-lesson_id="' . $lesson->id . '" data-usage_id="' . $usage_id . '"></div>';
            $output .= '<div class="item-favor-value">' . count($usages) . '</div>';
            $output .= '</div>';
            $output .= '</div></div>';
        }

        return $output;
    }

    public function get_contents_html($contents)
    {
        $output = '';
        for ($i = 0; $i < count($contents); $i++) {
            $content = $contents[$i];
            $coursetype_id = $content->course_type_id;
            $coursetype = $this->coursetype_m->get_single(['id' => $coursetype_id]);
            $term_id = $coursetype->term_id;
            $term = $this->terms_m->get_single(['id' => $term_id]);
            $subject_id = $term->subject_id;
            $subject = $this->subject_m->get_single(['id' => $subject_id]);
            $usages = $this->usage_m->get_where(['is_like' => 1, 'content_id' => $content->id]);

            $usage_like = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);
            $usage_id = '';
            if ($usage_like != null) {
                $usage_id = $usage_like[0]->id;
                $usage_like = $usage_like[0]->is_like;
            } else {
                $usage_like = 0;
            }

            $usages_read = $this->usage_m->get_where(['content_id' => $content->id]);
            $read_count = 0;
            foreach ($usages_read as $usage) {
                $read_count += $usage->read_count;
            }

            $iconPath = '';
            $iconCorner = '';
            if ($content->icon_path != null && $content->icon_path != '') $iconPath = base_url() . $content->icon_path;
            if ($content->icon_corner != null && $content->icon_corner != '') $iconCorner = base_url() . $content->icon_corner;
            $bgStr = '';
            if ($iconCorner != '') $bgStr = 'url(' . $iconCorner . ')';

            if ($iconPath != '') {
                if ($bgStr != '') $bgStr .= ',';
                $bgStr .= 'url(' . $iconPath . ')';
            }
            $contentTitle = $content->fulltitle;
//            if (strlen($contentTitle) > 12) $contentTitle = substr($contentTitle, 0, 12);
            $usages_read_mine = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);
            $output .= '<div class="list-item"><div>';
            $output .= '<div class="item-main-info" style="padding: 0; border-radius: 5px" '
                . ' onclick="openContents(\'' . base_url('resource/warePreviewPlayer') . '/' . $content->id . '\',\'_blank\');">';
            $output .= '<div class="item-preview-wrapper" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview" style="background:' . $bgStr . ';"></div>';
            $output .= '</div>';
            $output .= '<div class="item-coursename" style="color: black;">' . $contentTitle . '</div>';
            $output .= '<div class="item-subjectname">' . $content->content_type . '</div>';
            $output .= '<div class="item-subjectname">' . $subject->title . ' ' . $term->title . '</div>';
            $output .= '</div>';
            $output .= '<div class="item-infobar">';
            $output .= '<div class="item-read-icon" data-sel="' . ($usages_read_mine != null ? 1 : 0) . '"></div>';
            $output .= '<div class="item-read-value">' . $read_count . '</div>';
            $output .= '<div class="item-favor-icon ' . ($usage_like > 0 ? 'active' : '') . '" data-sel="' . $usage_like . '" data-content_id="' . $content->id . '" data-usage_id="' . $usage_id . '"></div>';
            $output .= '<div class="item-favor-value">' . count($usages) . '</div>';
            $output .= '</div>';
            $output .= '</div></div>';
        }

        return $output;
    }

    public function get_subjects_select_html($subjects, $subject_id)
    {
        log_message('info', 'get_subjects_select_html $subject_id : ' . $subject_id);

//        $output = '<div class="select-item active" onclick="onSelFilter(this)" data-id="" data-type="subject">全部</div>';
//        if ($subject_id != '')
//            $output = '<div class="select-item" onclick="onSelFilter(this)" data-id="" data-type="subject">全部</div>';
        $output = '';
        foreach ($subjects as $subject) {
            if ($subject->id == $subject_id) {
                log_message('info', 'get_subjects_select_html $term->id : ' . $subject->id);
                $output .= '<div class="select-item active" onclick="onSelFilter(this)" data-id="' . $subject->id . '" data-type="subject">' . $subject->title . '</div>';
            } else {
                $output .= '<div class="select-item" onclick="onSelFilter(this)" data-id="' . $subject->id . '" data-type="subject">' . $subject->title . '</div>';
            }
        }

        return $output;
    }

    public function get_terms_select_html($terms, $term_id)
    {
        log_message('info', 'get_terms_select_html $term_id : ' . $term_id);
//        $output = '<div class="select-item active" onclick="onSelFilter(this)" data-id="" data-type="term">全部</div>';
//
//        if ($term_id != '') {
//            $output = '<div class="select-item" onclick="onSelFilter(this)" data-id="" data-type="term">全部</div>';
//        }
        $output = '';
        foreach ($terms as $term) {
            if ($term->id == $term_id) {
                log_message('info', 'get_terms_select_html $term->id : ' . $term->id);
                $output .= '<div class="select-item active" onclick="onSelFilter(this)" data-id="' . $term->id . '" data-type="term">' . $term->title . '</div>';
            } else {
                $output .= '<div class="select-item" onclick="onSelFilter(this)" data-id="' . $term->id . '" data-type="term">' . $term->title . '</div>';
            }
        }

        return $output;
    }

    public function get_coursetypes_select_html($courseTypes, $courseType_id)
    {
//        $output = '<div class="select-item active" onclick="onSelFilter(this)" data-id="" data-type="coursetype">全部</div>';
//        if ($courseType_id != '')
//            $output = '<div class="select-item" onclick="onSelFilter(this)" data-id="" data-type="coursetype">全部</div>';

        $output = '';
        foreach ($courseTypes as $courseType) {
            if ($courseType->id == $courseType_id) {
                $output .= '<div class="select-item active" onclick="onSelFilter(this)" data-id="' . $courseType->id . '" data-type="coursetype">' . $courseType->title . '</div>';
            } else {
                $output .= '<div class="select-item" onclick="onSelFilter(this)" data-id="' . $courseType->id . '" data-type="coursetype">' . $courseType->title . '</div>';
            }
        }

        return $output;
    }

    public function get_pagination_html($totalPages, $curPage, $base_url)
    {
        $output = '';
        if ($totalPages == 0) return $output;

        if (1 == $curPage) {
            $output .= '<span class="prevlink disabled"><a>上一页</a></span>';
        } else {
            $output .= '<span class="prevlink"><a href="' . base_url($base_url) . '">上一页</a></span>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $curPage) {
                $output .= '<span class="curlink"><a href="' . base_url($base_url) . '/' . $i . '">' . $i . '</a></span>';
            } else {
                $output .= '<span class="numlink"><a href="' . base_url($base_url) . '/' . $i . '">' . $i . '</a></span>';
            }
        }

        if ($totalPages == $curPage) {
            $output .= '<span class="nextlink disabled"><a>下一页</a></span>';
        } else {
            $output .= '<span class="nextlink"><a href="' . base_url($base_url) . '/' . $totalPages . '">下一页</a></span>';
        }

        $output .= '<span class="totalinfo">共' . $totalPages . '页</span>';
        $output .= '<span class="navto">';
        $output .= '<span style="display: inline-block; margin-left: 10px">到第</span>';
        $output .= '<input id="navto-value">';
        $output .= '<span style="display: inline-block; margin-left: 27px">页</span>';
        $output .= '</span>';
        $output .= '<span class="navto-btn"><a onclick="pageNavTo();" >确定</a></span>';

        return $output;
    }
}

?>