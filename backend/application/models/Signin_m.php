<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signin_m extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function hash($string)
    {
        return parent::hash($string);
    }

    public function signout()
    {
        //$this->session->sess_destroy();
        $this->session->unset_userdata('loginuserID');
        $this->session->unset_userdata('user_account');
        $this->session->unset_userdata('user_UID');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('term_id');
        $this->session->unset_userdata('lang');
        $this->session->unset_userdata('loggedin');
        $this->session->unset_userdata('learning_subject_id');
        $this->session->unset_userdata('learning_term_id');
        $this->session->unset_userdata('learning_coursetype_id');
        $this->session->unset_userdata('learning_curQuery');
    }

    public function loggedin()
    {
        $isLoggedIn = (bool)$this->session->userdata("loggedin");
        if($isLoggedIn) $this->users_m->update_usage_time();
        return $isLoggedIn;
    }

    public function signin($uaccount = '', $utype = '', $upassword = '')
    {
        $lang = 'chinese';

        $username = $uaccount;
        $user_pass = $upassword;
        $user_type = $utype;
        if ($uaccount == '') {
            $username = $this->input->post('username');
            $user_type = $this->input->post('user_type');
            $user_pass = $this->input->post('password');//$this->hash($this->input->post('password'));
			// teacher
            //$username = '8295050';
            //$user_pass = '1553063041122';
            //$user_type = '1';

			// student
            //$username = '230103200209101915';
            //$user_pass = '1553211880187';
            //$user_type = '2';
        }


        $ret = $this->curl_login_token();
        if ($ret != true) return FALSE;

        $ret = $this->curl_login($username, $user_pass);
        log_message('info', 'signin ret : ' . var_export($ret, true));

        if ($ret->result != 'success') return FALSE;

        $user = $this->users_m->get_single_by_name(array('user_account' => $ret->user->user_account));

        if ($user == null) {
            $user = $ret->user;
            $user->register_time = date('Y-m-d H:i:s');
            $user->information = $this->get_client_ip();
            $user_id = $this->users_m->add((array)$user);
            $user->id = $user_id;
        }

        $this->signout();
        $this->session->unset_userdata('admin_loginuserID');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin_user_type');
        $this->session->unset_userdata('adminlang');
        $this->session->unset_userdata('admin_loggedin');

        $data = array(
            "loginuserID" => $user->id,
            "user_account" => $user->user_account,
            "user_UID" => $user->user_pass,
            "user_name" => $user->user_nickname,
            "user_type" => $user->user_type,
            "term_id" => $user->term_id,
            "lang" => $lang,
            "loggedin" => TRUE
        );
        $this->session->set_userdata($data);

        $user_id = $this->session->userdata("loginuserID");
        $arr = array();
        $arr['password'] = $user_pass;
        $arr['register_time'] = date('Y-m-d H:i:s');
        $arr['update_time'] = date('Y-m-d H:i:s');
        $arr['information'] = $this->get_client_ip();

        $this->users_m->update_user($arr, $user_id);
        $this->users_m->update_user_login_num($user_id);

        return TRUE;
    }

    public function curl_login_token()
    {
        $ret = true;
        return $ret;
    }

    public function curl_login($account, $passwd)
    {
        $ret = (object)array(
            'result' => 'success',
            'user' => (object)array(
                'user_account' => $account,
                'user_name' => $account,
                'password' => $passwd,
                'user_type' => '1',
                'user_nickname' => $account,
                'term_id' => '0',
                'status' => '1',
                'user_info' => '',
                'information' => $this->get_client_ip(),
                'register_count' => '',
                'create_time' => date('Y-m-d H:i:s'),
                'register_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s')
            )
        );
        return $ret;
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
/* End of file signin_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/signin_m.php */
