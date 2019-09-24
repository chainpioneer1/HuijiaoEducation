<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Api extends CI_Controller
{

    protected $clientId = '5481';
    protected $clientSecret = 'd25632a8d59323fd4a2c871a6942803c';
    protected $reqURL = 'http://www.qdedu.net/';

    protected $getAuthCodeURL = 'auth/oauth/authorize';
    protected $getAccessTokenURL = 'auth/oauth/token';
    protected $getUserInfoURL = 'auth/api/user/get_user_basicInfo/1.0';
    protected $getTeacherInfoURL = 'auth/api/user/getTeacherBasicInfo/1.0';
    protected $getStudentInfoURL = 'auth/api/user/getStudentBasicInfo/1.0';
    protected $requestSigninURL = 'uc/login/login.do?method=samlsso';
    protected $requestSignoutURL = 'uc/j_hh_security_logout';

//    protected $decryptURL = 'http://127.0.0.1:8080/singleLoginTest/UserAction';
    protected $decryptURL = 'http://172.16.19.31:8080/singleLoginTest/UserAction';

    protected $authRedirect = 'api/authorize';
    protected $validateRedirect = 'api/validate';
    protected $notifyRedirect = 'api/notify';

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('admins_m');
        $this->load->model('signin_m');
        $this->load->model('users_m');
        $this->load->library("pagination");
        $this->load->library("session");
    }

    public function signoutRequest()
    {
//        redirect($this->reqURL.'auth/j_hh_security_logout');
        redirect($this->reqURL . $this->requestSignoutURL
            . '?method=logoutAll'
            . '&callback_url=' . urlencode(base_url('signin')));
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

    public function uploadImgData()
    {
        $request = $_POST;
        if (!isset($request['imageData'])) {
            $this->response(array('status' => false, 'data' => 'Image Data is none.'), 400);
            return;
        }
        $imgdata = $request['imageData'];
        $imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));

        //$imgdata = base64_decode($data);

        $imageName = 'class' . rand(10000, 99999) . '.png';
        if (file_put_contents('uploads/codes/' . $imageName, $imgdata))
            echo json_encode(array('status' => true, 'data' => base_url() . 'uploads/codes/' . $imageName));
        else
            echo json_encode(array('status' => false, 'data' => 'Image uploading failed.'));
    }

    public function uploadPureMedia()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            $ncw_type = $this->input->post('format');
            $idx = $this->input->post('idx');

            $_uploadPath = "uploads/mediadata";
            if (isset($_POST['upload_path'])) $_uploadPath = 'uploads/' . $this->input->post('upload_path');

            $config['upload_path'] = "./" . $_uploadPath;
            if (!is_dir($config['upload_path'])) {
                // mkdir($config['upload_path'], 0755, true);
            }

            $config['allowed_types'] = '*';
            $tt = sprintf('%03d', $idx) . date('0ymdHis0') . $this->generateRandomString(5);
            $filename = 'qd' . $tt;
            $config['file_name'] = $filename . '.' . $ncw_type;
            $this->load->library('upload', $config);
            $this->upload->initialize($config, TRUE);
            $ncw_file = '';
            switch ($ncw_type) {
                case 'gif':
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'bmp':
                    ///Image file uploading........
                    if ($this->upload->do_upload('fileUploader')) {
                        $data = $this->upload->data();
                        $ncw_file = $_uploadPath . '/' . $filename . '.' . $ncw_type;
                    } else {
                        $ret['data'] = '图片上传失败' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
                case 'mp3':
                case 'wav':
                case 'mp4':
                    ///Video file uploading........
                    if ($this->upload->do_upload('fileUploader')) {
                        $data = $this->upload->data();
                        $ncw_file = $_uploadPath . '/' . $filename . '.' . $ncw_type;
                    } else {
                        $ret['data'] = '视频或音频上传失败' . $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                    break;
            }
            $ret['data'] = $ncw_file;
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function setUserStorage()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            $id = $this->input->post('user_id');
            $user_media_info = $this->input->post('user_storage');
            $this->users_m->edit(array('user_media_info' => $user_media_info), $id);
            $ret['data'] = $user_media_info;
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function getUserStorage()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            $id = $this->input->post('user_id');
            $result = $this->users_m->get_single(array('id' => $id));
            if ($result != null) {
                $ret['data'] = $result->user_media_info;
                $ret['status'] = 'success';
            }
        }
        echo json_encode($ret);
    }

    public function getSecretInfo()
    {
        $ret = array(
            'status' => 'success',
            'data' => '用户验证失败'
        );
        $ret['data'] = $this->admins_m->getSecretInfo();
        echo json_encode($ret);
    }

    public function authorize()
    {
        $ret = array(
            'status' => 'fail',
            'data' => '用户验证失败'
        );
        $url = $this->decryptURL;
        $param = 'SAMLResponse=' . urlencode($_POST['SAMLResponse']);
        $result = $this->http($url, 'POST', $param);
        if ($result[0] == 200) {
            $userInfo = explode('||', $result[1]);
            $this->signin_m->signin($userInfo[0], 1, $userInfo[1]); // [0]:username, [1]:userId
            $this->admins_m->edit(array('auth_code' => $userInfo[0]), 1);
            $this->getAuthCode();
//            $url = base_url().'api/getAuthCode';
//            redirect($url);
//            redirect(base_url() . 'home/index');
            return;
        }
        echo json_encode($result);
    }

    public function getAuthCode()
    {
        $state = intval(rand(1000000, 9999999));
        $this->admins_m->edit(array('auth_code' => $state), 7);
        $url = $this->reqURL . $this->getAuthCodeURL
            . '?client_id=' . $this->clientId
            . '&redirect_uri=' . urlencode(base_url() . $this->notifyRedirect)
            . '&state=' . $state
            . '&response_type=code';
        redirect($url);
    }

    public function notify()
    {
        $code = '';
        if (!empty($_GET) && isset($_GET['code'])) {
            $code = $_GET['code'];
        } else {
            if ($this->signin_m->loggedin()) redirect(base_url('home/index'));
            else redirect(base_url('api/getAuthCode'));
            return;
        }

//        $this->admins_m->edit(array('auth_code' => $code), 1);
//        echo json_encode(array('Code' => $code)) . '<br>';
        redirect(
            base_url() . 'api/getAccessToken'
            . '?code=' . $code
            . '&uid=' . $this->admins_m->get_single_admin('1')->auth_code
        );
    }

    public function getAccessToken()
    {
        $session_uid = '';
        $code = '';
        if (!empty($_GET)) {
            $code = $_GET['code'];
            $session_uid = $_GET['uid'];
        }
        $redirect_domain = base_url();
//        $redirect_domain = 'http://www.hjle.qdedu.net/';
        $url = $this->reqURL . $this->getAccessTokenURL
            . '?client_id=' . $this->clientId
            . '&client_secret=' . $this->clientSecret
//            . '&grant_type=client_credentials'
            . '&grant_type=authorization_code'
            . '&state=' . $this->admins_m->get_single_admin('7')->auth_code
            . '&resource_provider_id=sco'
            . '&code=' . $code
            . '&redirect_uri=' . urlencode($redirect_domain . $this->notifyRedirect);
        $header = array('Content-Type' => 'application/json');
        $ret = $this->http($url, 'POST', array(), $header);
        echo 'Get Access Token: ' . $url . '<br>  ' . json_encode($ret) . '<br>';

        if ($ret[0] == 200) {
            $ret = json_decode($ret[1]);
            $access_token = $ret->access_token . '';
            $this->admins_m->edit(array('access_token' => $access_token), 1);
            $ret = redirect(base_url() . 'api/getDetailInfo'
                . '?token=' . $access_token
                . '&uid=' . $session_uid
            );
        }

        echo 'Received information is invalid: ' . json_encode($ret);
    }

    public function getDetailInfo()
    {
        $access_token = '';
        $session_uid = '';
        if (!empty($_GET)) {
            $access_token = $_GET['token'];
            $session_uid = $_GET['uid'];
        }
        $url = $this->reqURL . $this->getUserInfoURL
            . '?client_id=' . $this->clientId
            . '&access_token=' . $access_token
            . '&session_uid=' . $session_uid;
        $ret = $this->http($url, 'POST');
        echo 'Get Teacher Info: ' . $url . '<br>  ' . json_encode($ret) . '<br>';


        if ($ret[0] == 200) {
            $ret = json_decode($ret[1]);
            $userInfo = $ret->result;
            if (isset($userInfo->uid)) {
                $session_uid = $userInfo->uid;
                if($userInfo->organName=='访客'){
                    $this->signin_m->signout();
                    redirect(base_url().'home/index');
                    return;
                }
                $this->signin_m->signin($session_uid, 1, $session_uid);
                $dbInfo = $this->users_m->get_single(array('user_account' => $session_uid));

                if ($userInfo != null) {
                    if ($userInfo->user_type == '8') { // if user is teacher
                        $this->users_m->edit(array(
                            'user_nickname' => $userInfo->nick_name,
                            'user_info' => json_encode($userInfo),
                            'user_school' => $userInfo->organName,
                            'user_type' => '1'
                        ), $dbInfo->id);
                    } else if ($userInfo->user_type == '9') { // if user is student
                        $this->users_m->edit(array(
                            'user_nickname' => $userInfo->nick_name,
                            'user_info' => json_encode($userInfo),
                            'user_school' => $userInfo->organName,
                            'user_type' => '2'
                        ), $dbInfo->id);
                        $this->signin_m->signin($dbInfo->user_account, 2, $dbInfo->password);
                        //redirect(base_url() . 'student/index');
                        //return 'success';
                    }else if ($userInfo->user_type == '5') { // if user is student
                        $this->users_m->edit(array(
                            'user_nickname' => $userInfo->nick_name,
                            'user_info' => json_encode($userInfo),
                            'user_school' => $userInfo->organName,
                            'user_type' => '3'
                        ), $dbInfo->id);
                        $this->signin_m->signin($dbInfo->user_account, 3, $dbInfo->password);
                        //redirect(base_url() . 'student/index');
                        //return 'success';
                    } else { // if other user
                        $this->users_m->edit(array(
                            'user_nickname' => $userInfo->nick_name,
                            'user_info' => json_encode($userInfo),
                            'user_school' => $userInfo->organName,
                            'user_type' => '0'
                        ), $dbInfo->id);
                    }
                }
                redirect(base_url() . 'home/index');
                return 'success';
            }
        }
//
//        $url = $this->reqURL . $this->getStudentInfoURL
//            . '?client_id=' . $this->clientId
//            . '&access_token=' . $access_token
//            . '&session_uid=' . $session_uid;
//        $ret = $this->http($url, 'POST');
//        echo 'Get Student Info: ' . $url . '<br> ' . json_encode($ret) . '<br>';
//        if ($ret[0] == 200) {
//            $ret = json_decode($ret[1]);
//            $userInfo = $ret->result;
//            if (isset($userInfo->xxjbxx_zh)) {
//                $dbInfo = $this->users_m->get_single(array('user_account' => $session_uid));
//                if ($dbInfo != null) {
//                    $this->users_m->edit(array(
//                        'user_info' => json_encode($userInfo),
//                        'user_type' => '2'
//                    ), $dbInfo->id);
//                }
//                redirect(base_url() . 'home/index');
//                return 'success';
//            }
//        }
        redirect(base_url() . 'home/index');
        return 'fail';
    }

    public function validate()
    {
        $ret = array(
            'status' => 'success',
            'data' => '用户验证测试成功'
        );
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
}

?>