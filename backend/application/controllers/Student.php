<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define("PAGESIZE", 16);

class Student extends CI_Controller
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
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library("pagination");
        $this->load->model("banner_m");
        $this->load->model("teacherwork_m");
        $this->load->model("wrongset_m");
        $this->load->model("questions_m");
        $this->load->model("recommend_m");
        $this->load->library('form_validation');

        $this->load->model('users_m');
        $this->users_m->update_usage_time();
    }

    public function login()
    {
        $user_id = 0;
        $user_class = '1-1';
        $banners = $this->banner_m->getItems();
        $this->data['banners'] = $banners;

        $recommandsArr = [];
        $recommands = $this->recommend_m->getItems();
        for ($i = 0; $i < count($recommands); $i++) {
            $recommand = $recommands[$i];
            $content = $this->contents_m->get_single(['id' => $recommand->content_id, 'status' => 1]);
            $usages = $this->usage_m->get_where(['is_like' => 1, 'content_id' => $content->id]);

            $usage_like = $this->usage_m->get_where(['user_id' => $user_id, 'content_id' => $content->id]);
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
            $usages_read_mine = $this->usage_m->get_where(['user_id' => $user_id, 'content_id' => $content->id]);

            array_push($recommandsArr, array(
                'recommand' => $recommand,
                'content' => $content,
                'usages' => $usages,
                'usage_id' => $usage_id,
                'usage_like' => $usage_like,
                'read_count' => $read_count,
                'usages_read_mine' => $usages_read_mine
            ));
        }
        $this->data['recommandsArr'] = $recommandsArr;

        $classArr = explode('-', $user_class);
        $subjects = [];
        $subjectsArr = [];
        if (count($classArr) == 2) {
            $classYear = $classArr[0];
            if ($classYear < 4) {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 0]);
            } else if ($classYear < 7) {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 1]);
            } else {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 2]);
            }
        }

        for ($i = 0; $i < count($subjects); $i++) {
            $subject = $subjects[$i];
            $coursetypes = $this->coursetype_m->get_where_join(['tbl_huijiao_subject.id' => $subject->id]);

            $courseTypeArr = [];
            for ($j = 0; $j < count($coursetypes); $j++) {
                $coursetype = $coursetypes[$j];
                $contents = $this->contents_m->get_where_limit(['course_type_id' => $coursetype->id, 'status' => 1], 1);
                array_push($courseTypeArr, array(
                    'coursetype' => $coursetype,
                    'contents' => $contents
                ));
            }

            array_push($subjectsArr, array(
                'courseTypeArr' => $courseTypeArr,
                'subject' => $subject
            ));
        }

        $this->data["subjectsArr"] = $subjectsArr;
        $this->data["subview"] = "student/index";
        $this->load->view('_layout_main_mobile', $this->data);
        return;
        $this->data["subview"] = "student/login";
        $this->load->view('_layout_main_mobile', $this->data);
    }

    public function signin()
    {
        $this->signin_m->loggedin() == FALSE || redirect(base_url('student/index'));

        $this->data['parentView'] = 'signin';
        $this->data['form_validation'] = 'No';
        if ($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if (false && $this->form_validation->run() == FALSE) {
                $this->data['form_validation'] = validation_errors();
                $this->data["subview"] = "student/login";
                $this->load->view('_layout_main_mobile', $this->data);
            } else {
                if ($this->signin_m->signin('230103200209101916', 2, '1553211880188') == TRUE) {
                    redirect(base_url('student/index'));
                } else {
                    $this->session->set_flashdata("errors", "用户没有登录了");
                    $this->data['form_validation'] = "Incorrect Signin";
                    $this->data["subview"] = "student/login";
                    $this->load->view('_layout_main_mobile', $this->data);
                }
            }
        } else {
            $this->data["subview"] = "signin/login";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function signout()
    {
        $this->signin_m->signout();
        redirect(base_url() . 'api/signoutRequest');
//        redirect(base_url("student/login"));
    }

    public function setClass()
    {
        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        if ($userInfo->user_class != null) redirect(base_url('student'));

        $this->data["user"] = $userInfo;
        $this->data["subview"] = "student/setClass";
        $this->load->view('_layout_main_mobile', $this->data);
    }

    public function index()
    {
        //$this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        if ($userInfo->user_class == null) {
            $this->users_m->edit(array('user_class' => '1-1'), $user_id);
//            redirect(base_url('student/setClass'));
            $userInfo->user_class = '1-1';
        }

        $banners = $this->banner_m->getItems();
        $this->data['banners'] = $banners;

        $recommandsArr = [];
        $recommands = $this->recommend_m->getItems();
        for ($i = 0; $i < count($recommands); $i++) {
            $recommand = $recommands[$i];
            $content = $this->contents_m->get_single(['id' => $recommand->content_id, 'status' => 1]);
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
            $usages_read_mine = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);

            array_push($recommandsArr, array(
                'recommand' => $recommand,
                'content' => $content,
                'usages' => $usages,
                'usage_id' => $usage_id,
                'usage_like' => $usage_like,
                'read_count' => $read_count,
                'usages_read_mine' => $usages_read_mine
            ));
        }
        $this->data['recommandsArr'] = $recommandsArr;

        $classArr = explode('-', $userInfo->user_class);
        $subjects = [];
        $subjectsArr = [];
        if (count($classArr) == 2) {
            $classYear = $classArr[0];
            if ($classYear < 4) {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 0]);
            } else if ($classYear < 7) {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 1]);
            } else {
                $subjects = $this->subject_m->get_where(['status' => 1, 'type' => 2]);
            }
        }

        for ($i = 0; $i < count($subjects); $i++) {
            $subject = $subjects[$i];
            $coursetypes = $this->coursetype_m->get_where_join(['tbl_huijiao_subject.id' => $subject->id]);

            $courseTypeArr = [];
            for ($j = 0; $j < count($coursetypes); $j++) {
                $coursetype = $coursetypes[$j];
                $contents = $this->contents_m->get_where_limit(['course_type_id' => $coursetype->id, 'status' => 1], 1);
                array_push($courseTypeArr, array(
                    'coursetype' => $coursetype,
                    'contents' => $contents
                ));
            }

            array_push($subjectsArr, array(
                'courseTypeArr' => $courseTypeArr,
                'subject' => $subject
            ));
        }

        $this->data["subjectsArr"] = $subjectsArr;
        $this->data["subview"] = "student/index";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function coursetype($id = 0)
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $coursetype = $this->coursetype_m->get_single(['id' => $id]);
        $contents = $this->contents_m->get_where(['course_type_id' => $id, 'status' => 1]);

        $contentsArr = [];
        for ($i = 0; $i < count($contents); $i++) {
            $content = $contents[$i];
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
            $usages_read_mine = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);

            array_push($contentsArr, array(
                'content' => $content,
                'usages' => $usages,
                'usage_id' => $usage_id,
                'usage_like' => $usage_like,
                'read_count' => $read_count,
                'usages_read_mine' => $usages_read_mine
            ));
        }

        $this->data["coursetype"] = $coursetype;
        $this->data["contentsArr"] = $contentsArr;
        $this->data["subview"] = "student/coursetype";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function contentplayer($id = 0)
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

//        if (!$this->adminsignin_m->loggedin())
//            $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $this->data['parentView'] = 'back';
        $content = $this->contents_m->get_where(array('id' => $id, 'status' => 1));
        $this->data["content"] = $content[0];

        // get usage
        $user_id = $this->session->userdata('loginuserID');
        $usages = $this->usage_m->get_where(array(
            'user_id' => $user_id,
            'content_id' => $this->data["content"]->id
        ));
        log_message('info', '-- contentplayer / $usages : ' . var_export($usages, true));
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
        log_message('info', '-- contentplayer / $usage : ' . var_export($usage, true));

        // like num
        $like_num = $this->usage_m->get_where(['content_id' => $id, 'is_like' => 1]);
        $like_num = count($like_num);

        $this->data["courseList"] = $content;
        $this->data["title"] = $this->data["content"]->title;
        $this->data["content_id"] = $id;
        $this->data["usage"] = $usage;
        $this->data["like_num"] = $like_num;
        $this->data["pageType"] = 0;

        $this->data["subview"] = "student/contentplayer";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function work()
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        log_message('info', '-- work $userInfo : ' . var_export($userInfo, true));
        if ($userInfo == null || $userInfo->user_type != 2) {
            redirect(base_url('student/login'));
        }

        $worksArr = [];
        if ($userInfo->teacher_id != null) {
            $works = $this->teacherwork_m->get_where(['teacher_id' => $userInfo->teacher_id, 'class_id' => $userInfo->class_id, 'student_id' => null]);
            log_message('info', '-- work $works : ' . var_export($works, true));
            for ($i = 0; $i < count($works); $i++) {
                $work = $this->teacherwork_m->get_where(['teacher_id' => $works[$i]->teacher_id, 'class_id' => $userInfo->class_id, 'title' => $works[$i]->title, 'student_id' => $user_id]);
                if ($work == null) continue;
                $status = 0;
                if ($work[0]->first_mark != 6) {
                    if ($work[0]->student_mark == 5) $status = 1; else $status = 2;
                }
                $problem_info = json_decode($work[0]->problem_info);
                $question = $this->questions_m->get_single(['id' => $problem_info[0]]);
                array_push($worksArr, array(
                    'work' => $work[0],
                    'coursetype' => $question->course_type,
                    'status' => $status
                ));
            }
        }
        log_message('info', '-- work $worksArr : ' . var_export($worksArr, true));
        $this->data["worksArr"] = $worksArr;
        $this->data["subview"] = "student/work";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function workdetail($id = 0)
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $this->data['parentView'] = 'back';
        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        if ($userInfo == null || $userInfo->user_type != 2 || $userInfo->teacher_id == null) {
            redirect(base_url('student/login'));
        }

        $work = $this->teacherwork_m->get_single(['id' => $id]);
        $questionsArr = [];
        $course_type = '';
        if ($work != null) {
            $question_ids = json_decode($work->problem_info);
            for ($i = 0; $i < count($question_ids); $i++) {
                $question = $this->questions_m->get_single(['id' => $question_ids[$i]]);
                if ($i == 0) $course_type = $question->course_type;
                log_message('info', '-- $question : ' . var_export($question, true));
                if ($question !== null) {
                    array_push($questionsArr, array(
                        'ans' => json_decode($question->question_answer),
                        'desc' => $question->question_description,
                        'id' => $question->id,
                        'qType' => $question->question_type,
                        'ques' => $question->question_content,
                        'type' => $question->question_type,
                    ));
                }
            }
        }

        log_message('info', '-- $questionsArr : ' . var_export($questionsArr, true));
        log_message('info', '-- $work : ' . var_export($work, true));
        $this->data["work"] = $work;
        $this->data["questionsArr"] = $questionsArr;
        $this->data["course_type"] = $course_type;
        $this->data["subview"] = "student/workdetail";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function wrong()
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        if ($userInfo == null || $userInfo->user_type != 2) {
            redirect(base_url('student/login'));
        }

        $wrongs = [];
        if ($userInfo->teacher_id != null) {
            $wrongs = $this->wrongset_m->get_where(['student_id' => $this->session->userdata('loginuserID')]);
        }


        $this->data["wrongs"] = $wrongs;
        $this->data["subview"] = "student/wrong";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function wrongdetail($id = 0)
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $this->data['parentView'] = 'back';
        $user_id = $this->session->userdata('loginuserID');
        $userInfo = $this->users_m->get_student_user($user_id);
        if ($userInfo == null || $userInfo->user_type != 2 || $userInfo->teacher_id == null) {
            redirect(base_url('student/login'));
        }

        $wrong = $this->wrongset_m->get_single(['id' => $id]);
        $question = array(
            'ans' => json_decode($wrong->question_answer),
            'desc' => $wrong->question_description,
            'id' => $wrong->id,
            'qType' => $wrong->question_type,
            'ques' => $wrong->question_content,
            'type' => $wrong->question_type,
        );
        log_message('info', '-- $question : ' . var_export($wrong, true));

        $this->data["wrong"] = $wrong;
        $this->data["question"] = $question;
        $this->data["subview"] = "student/wrongdetail";
        $this->load->view('_layout_main_mobile', $this->data);
    }


    public function profile($user_id = 0)
    {
        $this->signin_m->loggedin() == TRUE || redirect(base_url('student/login'));

        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $this->data['user_id'] = $user_id;
            $userInfo = $this->users_m->get_single_user($user_id);
            log_message('info', 'profile $user_id : ' . $user_id);
            log_message('info', 'profile $userInfo : ' . var_export($userInfo, true));

            // usage
            $usages = $this->usage_m->get_where(['user_id' => $user_id]);
            $usages_content = array_filter($usages, function ($elem) {
                if ($elem->content_id != null) return true;
                return false;
            });

            log_message('info', 'profile $usages_content : ' . var_export($usages_content, true));

            $favorite_contents = array();
            foreach ($usages_content as $usage) {
                //var_dump($usage);
                if ($usage->is_favorite != 1) continue;
                if ($usage->content_id == null) continue;
                $content = $this->contents_m->get_single(['id' => $usage->content_id, 'status' => 1]);
                if ($content == null) continue;
                $coursetype = $this->coursetype_m->get_single(['id' => $content->course_type_id, 'status' => 1]);
                if ($coursetype == null) continue;
                $term = $this->terms_m->get_single(['id' => $coursetype->term_id, 'status' => 1]);
                if ($term == null) continue;
                $subject = $this->subject_m->get_single(['id' => $term->subject_id, 'status' => 1]);

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
                foreach ($usages_read as $usage1) {
                    $read_count += $usage1->read_count;
                }
                $usages_read_mine = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);

                array_push($favorite_contents, [
                    'usage' => $usage,
                    'coursetype' => $coursetype,
                    'term' => $term,
                    'subject' => $subject,
                    'content' => $content,
                    'usages' => $usages,
                    'usage_id' => $usage->id,
                    'usage_like' => $usage_like,
                    'read_count' => $read_count,
                    'usages_read_mine' => $usages_read_mine,
                ]);
            }

            $this->data['user'] = $userInfo;
            $this->data['favorite_contents'] = $favorite_contents;
            $this->data["subview"] = "student/profile";
            $this->load->view('_layout_main_mobile', $this->data);
        } else {
            redirect(base_url('signin'));
        }

    }


    public function get_favorite_contents_html($favorite_contents)
    {
        $output = '';

        $i = 0;
        foreach ($favorite_contents as $favorite_content) {
            if ($i % 6 == 0) {
                $output .= '<div class="item-content-page content-page-' . ((int)($i / 6) + 1) . '" >';
            }
            $title = $favorite_content['content']->title;
            if (mb_strlen($title) > 15) $title = mb_substr($title, 0, 15) . '...';
            $output .= '<div class="item-content">';
            $output .= '<img src="' . base_url() . $favorite_content['content']->icon_path . '" onclick="location.href=\''
                . base_url('resource/warePreviewPlayer') . '/' . $favorite_content['content']->id . '\'">';
            $output .= '<div class="item-body">';
            $output .= '<div class="item-subject">';
            $output .= '<span>' . $favorite_content['subject']->title . '</span>';
            $output .= '</div>';
            $output .= '<h5 onclick="cancelFavorite(' . $favorite_content['usage']->id . ')">';
            $output .= '<img src="' . base_url('assets/images/mobile/recycle.png') . '"/>';
            $output .= '</h5>';
            $output .= '<div class="item-title" onclick="location.href=\''
                . base_url('resource/warePreviewPlayer') . '/' . $favorite_content['content']->id . '\'">'
                . $title . '</div>';

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


    function updateClass()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            log_message('info', '-- $_POST[\'user_id\'] : ' . $_POST['user_id']);
            log_message('info', '-- $_POST[\'user_class\'] : ' . $_POST['user_class']);

            $this->users_m->edit(array(
                'user_class' => $_POST['user_class']
            ), $_POST['user_id']);

            $classArr = explode('-', $_POST['user_class']);
            $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
            $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
            $classStr = '';
            if (isset($classArr[0]) && isset($classYearArr[$classArr[0] - 1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1] - 1])) {
                $classStr = $classYearArr[$classArr[0] - 1] . $classBanArr[$classArr[1] - 1];
            }

            $ret['data'] = $classStr;
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }


        echo json_encode($ret);
    }

    function answerQuestion()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            log_message('info', '-- $answerInfo : ' . var_export($_POST['answerInfo'], true));
            log_message('info', '-- $answerInfo->id : ' . $_POST['workId']);
            log_message('info', '-- $_POST[\'is_first\'] : ' . $_POST['is_first']);
            log_message('info', '-- $_POST[\'is_all_right\'] : ' . $_POST['is_all_right']);
            log_message('info', '-- $_POST[\'student_mark\'] : ' . $_POST['student_mark']);

            $work = $this->teacherwork_m->get_single_package($_POST['workId']);
            log_message('info', '-- $work : ' . var_export($work, true));

            if ($work == null) {
                $ret['data'] = "This work is not exist.";
                echo json_encode($ret);
                return;
            }

            $problemInfo = json_decode($work->problem_info);
            log_message('info', '-- $problemInfo : ' . var_export($problemInfo, true));

            $isAllRight = false;
            if ($_POST['is_all_right'] === true || $_POST['is_all_right'] === 'true') {
                $isAllRight = true;
            }
            log_message('info', '-- $isAllRight : ' . $isAllRight);

            if ($_POST['is_first'] === true || $_POST['is_first'] === 'true') {
                log_message('info', '-- first ');
                $work->first_mark = $_POST['first_mark'] / count($problemInfo);
                $this->teacherwork_m->edit(array(
                    'answer_info' => $_POST['answerInfo'],
                    'first_mark' => $_POST['first_mark'] / count($problemInfo),
                    'student_mark' => $_POST['student_mark'] / count($problemInfo),
                    'status' => $isAllRight ? 1 : 2
                ), $_POST['workId']);
            } else {
                log_message('info', '-- no first ');
                $this->teacherwork_m->edit(array(
                    'answer_info' => $_POST['answerInfo'],
                    'student_mark' => $_POST['student_mark'] / count($problemInfo),
                    'status' => $isAllRight ? 1 : 2
                ), $_POST['workId']);
            }


            // wrong problems
            $anserInfos = json_decode($_POST['answerInfo']);
            for ($i = 0; $i < count($anserInfos); $i++) {
                if ($anserInfos[$i]->is_right == false) {
                    $question = $this->questions_m->get_single(['id' => $anserInfos[$i]->id]);
                    $wrong = $this->wrongset_m->get_where(['question_id' => $anserInfos[$i]->id, 'student_id' => $this->session->userdata('loginuserID')]);
                    $wrongNew = array(
                        'question_id' => $question->id,
                        'question_no' => $question->question_no,
                        'title' => $question->title,
                        'student_id' => $this->session->userdata('loginuserID'),
                        'student_answer' => json_encode($anserInfos[$i]),
                        'student_mark' => $anserInfos[$i]->is_right,
                        'status' => $question->status,
                        'question_type' => $question->question_type,
                        'difficult_type' => $question->difficult_type,
                        'course_type_id' => $question->course_type_id,
                        'question_type_id' => $question->question_type_id,
                        'question_content' => $question->question_content,
                        'question_answer' => $question->question_answer,
                        'question_description' => $question->question_description,
                        'read_count' => $question->read_count,
                        'right_count' => $question->right_count,
                        'wrong_count' => $question->wrong_count,
                        'update_time' => date("Y-m-d H:i:s")
                    );
                    log_message('info', '-- $wrong : ' . var_export($wrong, true));
                    log_message('info', '-- $wrongNew : ' . var_export($wrongNew, true));

                    if ($wrong == null) {
                        $wrongNew['create_time'] = date("Y-m-d H:i:s");
                        $this->wrongset_m->add($wrongNew);
                    } else {
                        $this->wrongset_m->edit($wrongNew, $wrong[0]->id);
                    }
                }
            }


            log_message('info', '-- $work 1 : ' . var_export($work, true));
            $ret['status'] = 'success';
            $ret['data'] = $work->first_mark;
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }

    function answerWrongQuestion()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            log_message('info', '-- $_POST[\'wrongId\'] : ' . $_POST['wrongId']);
            log_message('info', '-- $_POST[\'questionInfo\'] : ' . var_export($_POST['questionInfo'], true));
            log_message('info', '-- $_POST[\'student_mark\'] : ' . $_POST['student_mark']);

            $wrong = $this->wrongset_m->get_single(['id' => $_POST['wrongId']]);
            log_message('info', '-- $wrong : ' . var_export($wrong, true));

            if ($wrong == null) {
                $ret['data'] = "This wrong set is not exist.";
                echo json_encode($ret);
                return;
            }

            $questionInfo = json_decode($_POST['questionInfo']);

            $student_mark = 0;
            log_message('info', '-- $_POST[\'student_mark\'] : ' . $_POST['student_mark']);
            if ($_POST['student_mark'] == 'true') {
                log_message('info', '-- $student_mark 0 : ' . $student_mark);
                $student_mark = 1;
            }
            log_message('info', '-- $student_mark : ' . $student_mark);

            $this->wrongset_m->edit(array(
                'student_answer' => json_encode($questionInfo),
                'student_mark' => $_POST['student_mark'],
                'status' => $student_mark
            ), $_POST['wrongId']);

            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }

    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }

    protected function rules()
    {
        $rules = array(
            array(
                'field' => 'username',
                'label' => "Username",
                'rules' => 'trim|required|max_length[30]'
            ),
            array(
                'field' => 'password',
                'label' => "Password",
                'rules' => 'trim|required|max_length[30]'
            )
        );
        return $rules;
    }

    function profileImgUpload()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        $upload_path = 'uploads/images/profiles/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path);
        }
        $config['upload_path'] = './' . $upload_path;
        $config['allowed_types'] = 'jpg|png|gif|bmp|webp|xpm|wbmp';
        $image_data = array();
        $is_file_error = FALSE;
        log_message('info', '-- profileImgUpload / $_POST : ' . var_export($_POST, true));
        if (!$_FILES || !$_POST['user_id']) {
            $is_file_error = TRUE;
        }
        if (!$is_file_error) {

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_imgfile')) {
            } else {
                //store the file info
                $image_data = $this->upload->data();
                log_message('info', '-- $image_data : ' . var_export($image_data, true));
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path']; //get original image
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 200;
                $config['height'] = 200;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $user_id = $_POST['user_id'];
                log_message('info', '-- $user_id : ' . $user_id);
                $this->users_m->edit(array(
                    'user_avatar' => $upload_path . $image_data['file_name']
                ), $user_id);

                $ret['data'] = $upload_path . $image_data['file_name'];
                $ret['status'] = 'success';
            }
        }
        echo json_encode($ret);
    }
}

?>