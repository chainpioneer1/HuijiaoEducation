<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model("users_m");
        $this->load->model("signin_m");
        $this->load->library("pagination");
        $this->load->library("session");
    }

    public function index()
    {

        if ($this->signin_m->loggedin() == FALSE) {
            redirect(base_url('student/signin'));
        } else {
            $this->data["subview"] = "student/home";
            $this->load->view('_layout_student', $this->data);
        }
    }
}

?>