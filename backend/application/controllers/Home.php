<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model("signin_m");
        $this->load->model("banner_m");
        $this->load->model("recommend_m");
        $this->load->model("subject_m");
        $this->load->model("terms_m");
        $this->load->model("contents_m");
        $this->load->model("coursetype_m");
        $this->load->model("usage_m");
        $this->load->library("pagination");
        $this->load->library("session");

        $this->load->model('users_m');
        $this->users_m->update_usage_time();
    }

    public function index()
    {
        if (false && $this->signin_m->loggedin() == FALSE) {
            $this->data["subview"] = "signin/login";
            $this->load->view('_layout_main', $this->data);
            return;
        }
        if (false && $this->session->userdata('user_type') == '2') {
            redirect(base_url() . 'student/index');
            return;
        }

        $this->data['showHelp'] = 1;
        $this->data['showDownload'] = 1;

        $this->data['banners'] = $this->banner_m->get_where(array('status' => 1, 'type'=>0));
        $this->data['recommend_contents'] = $this->recommend_m->getItemsByPage(array('tbl_huijiao_recommend.type' => 0, 'tbl_huijiao_recommend.status' => 1), 0, 20);
        $this->data['recommend_lessons'] = $this->recommend_m->getItemsByPage(array('tbl_huijiao_recommend.type' => 1, 'tbl_huijiao_recommend.status' => 1), 0, 20);

        $this->data["subview"] = "home/index_new";
        $this->load->view('_layout_index', $this->data);

    }

    public function get_favorite_lessons_html($favorite_lessons)
    {
        $output = '';

        $i = 0;
        foreach ($favorite_lessons as $favorite_lesson) {
            if ($i % 6 == 0) {
                $output .= '<div class="item-content-page lesson-page-' . ((int)($i / 6) + 1) . '" >';
            }
            $output .= '<div class="item-content">';
            $output .= '<img src="' . base_url($favorite_lesson['lesson']->image_icon) . '">';
            $output .= '<div class="item-body">';
            $output .= '<h5 onclick="cancelFavorite(' . $favorite_lesson['usage']->id . ')">取消收藏</h5>';
            $output .= '<div class="item-title">课程名称</div>';
            $output .= '<div class="item-subject">';
            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_lesson['subject']->title . '</span>';
            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_lesson['term']->title . '</span>';
            $output .= '</div>';
            $output .= '<div class="item-date">收藏时间：' . $favorite_lesson['usage']->update_time;
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            if ($i % 6 == 5) {
                $output .= '</div>';
            }
            $i++;
        }
        if ($i > 0) {
            $output .= '</div>';
        }
        return $output;
    }

    public function get_favorite_contents_html($favorite_contents)
    {
        $output = '';

        $i = 0;
        foreach ($favorite_contents as $favorite_content) {
            if ($i % 6 == 0) {
                $output .= '<div class="item-content-page content-page-' . ((int)($i / 6) + 1) . '" >';
            }
            $output .= '<div class="item-content">';
            $output .= '<img src="' . base_url($favorite_content['content']->icon_path) . '">';
            $output .= '<div class="item-body">';
            $output .= '<h5 onclick="cancelFavorite(' . $favorite_content['usage']->id . ')">取消收藏</h5>';
            $output .= '<div class="item-title">课程名称</div>';
            $output .= '<div class="item-subject">';
            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_content['subject']->title . '</span>';
            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_content['term']->title . '</span>';
            $output .= '</div>';
            $output .= '<div class="item-date">收藏时间：' . $favorite_content['usage']->update_time;
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            if ($i % 6 == 5) {
                $output .= '</div>';
            }
            $i++;
        }
        if ($i > 0) {
            $output .= '</div>';
        }

        return $output;
    }
}

?>