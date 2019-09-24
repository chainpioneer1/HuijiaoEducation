<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

define("PERPAGE", 5);

class Work extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('adminsignin_m');
        $this->load->model('subject_m');
        $this->load->model('terms_m');
        $this->load->model('lessons_m');
        $this->load->model('contents_m');
        $this->load->model('coursetype_m');
        $this->load->model('usage_m');
        $this->load->model('signin_m');
        $this->load->model('sclass_m');
        $this->load->model('teacherwork_m');
        $this->load->model('questions_m');
        $this->load->library("pagination");
        $this->load->library("session");

        $this->load->model('users_m');
        $this->users_m->update_usage_time();
    }


    public function index()
    {
        $this->load->model('usage_m');
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);

            $works = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'student_id' => null]);
            $worksArr = [];
            for ($i = 0; $i < count($works); $i++) {
                $totalWork = $this->teacherwork_m->get_where(['teacher_id' => $user_id]);
                $solvedWork = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'title' => $works[$i]->title, 'first_mark !=' => '0', 'first_mark !=' => '6']);
                $sclass = $this->sclass_m->get_single(['id' => $works[$i]->class_id]);
                $students = $this->users_m->get_where(['user_class' => $sclass->class_name, 'user_type' => 2]);
                array_push($worksArr, array(
                    'work' => $works[$i],
                    'sclass' => $sclass,
                    'totalWorkCount' => count($students),
                    'solvedWorkCount' => count($solvedWork)
                ));
            }

            $this->data['user'] = $userInfo;
            $this->data['worksArr'] = $worksArr;
            $this->data["subview"] = "work/index";
            $this->load->view('_layout_main_resource', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    public function publish()
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);
            $sclasses = $this->sclass_m->get_where(['teacher_id' => $user_id]);

            $term = $this->terms_m->get_single(['id' => $userInfo->term_id]);
            $terms = $this->terms_m->get_where(['subject_id' => $term->subject_id]);
            $courseTypes = $this->coursetype_m->get_where(['term_id' => $userInfo->term_id]);
            $courseType_ids = [];
//            $courseType_ids = array_column($this->obj2Array($courseTypes), 'id');


            $this->data['user'] = $userInfo;
            $this->data['sclasses'] = $sclasses;
            $this->data['terms'] = $terms;
            $this->data['courseTypes'] = $courseTypes;
            $temp = $this->get_questionsHtml($courseType_ids, []);
            $this->data['questionsHtml'] = $temp['output'];
            $this->data['paginationHtml'] = $temp['paginationHtml'];
            $this->data['questions_ids'] = $temp['questions_ids'];
            $this->data["subview"] = "work/publish";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    public function preview()
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);
            $sclasses = $this->sclass_m->get_where(['teacher_id' => $user_id]);

            $term = $this->terms_m->get_single(['id' => $userInfo->term_id]);
            $terms = $this->terms_m->get_where(['subject_id' => $term->subject_id]);
            $courseTypes = $this->coursetype_m->get_where(['term_id' => $userInfo->term_id]);
            $courseType_ids = [];
//            $courseType_ids = array_column($this->obj2Array($courseTypes), 'id');


            $this->data['user'] = $userInfo;
            $this->data['sclasses'] = $sclasses;
            $this->data['terms'] = $terms;
            $this->data['courseTypes'] = $courseTypes;
            $temp = $this->get_questionsHtml($courseType_ids, []);
            $this->data['questionsHtml'] = $temp['output'];
            $this->data['paginationHtml'] = $temp['paginationHtml'];
            $this->data['questions_ids'] = $temp['questions_ids'];
            $this->data["subview"] = "work/preview";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    public function workComplete($work_id)
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);
            $work = $this->teacherwork_m->get_single_package($work_id);
            $solvedWork = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'class_id' => $work->class_id, 'title' => $work->title, 'first_mark !=' => '0', 'first_mark !=' => '6']);
            $sclass = $this->sclass_m->get_single(['id' => $work->class_id]);
            $students = $this->users_m->get_where(['user_class' => $sclass->class_name, 'user_type' => 2]);

            $studentArr = [];
            for ($i = 0; $i < count($students); $i++) {
                $w = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'class_id' => $work->class_id, 'student_id' => $students[$i]->id, 'title' => $work->title]);
                if ($w != null) {
                    $w = $w[0];
                    if ($w->first_mark == 6) {
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '未完成',
                            'price' => '',
                            'correct' => ''
                        ));
                    } else {
                        $correct = '';
                        if ($w->first_mark == 5) $correct = '/';
                        else if ($w->student_mark == 5) $correct = '已订正';
                        else $correct = '未订正';
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '已完成',
                            'price' => (int)($w->first_mark / 5 * 100),
                            'correct' => $correct
                        ));
                    }


                } else {
                    array_push($studentArr, array(
                        'student' => $students[$i],
                        'work' => null,
                        'complete' => '未完成',
                        'price' => '',
                        'correct' => ''
                    ));
                }
            }

            $this->data['user'] = $userInfo;
            $this->data['sclass'] = $sclass;
            $this->data['work'] = $work;
            $this->data['solvedWork'] = $solvedWork;
            $this->data['students'] = $studentArr;
            $this->data["subview"] = "work/workcomplete";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    public function workdetail($work_id)
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);
            $work = $this->teacherwork_m->get_single_package($work_id);
            $sclass = $this->sclass_m->get_single(['id' => $work->class_id]);

            $students = $this->users_m->get_where(['user_class' => $sclass->class_name, 'user_type' => 2]);
            $studentArr = [];
            for ($i = 0; $i < count($students); $i++) {
                $w = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'class_id' => $work->class_id, 'student_id' => $students[$i]->id, 'title' => $work->title]);
                if ($w != null) {
                    $w = $w[0];
                    if ($w->first_mark == 6) {
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '未完成',
                            'price' => '',
                            'correct' => ''
                        ));
                    } else {
                        $correct = '';
                        if ($w->first_mark == 5) $correct = '/';
                        else if ($w->student_mark == 5) $correct = '已订正';
                        else $correct = '未订正';
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '已完成',
                            'price' => (int)($w->first_mark / 5 * 100),
                            'correct' => $correct
                        ));
                    }


                } else {
                    array_push($studentArr, array(
                        'student' => $students[$i],
                        'work' => null,
                        'complete' => '未完成',
                        'price' => '',
                        'correct' => ''
                    ));
                }
            }

            $questions_ids = json_decode($work->problem_info);
            $questions = $this->questions_m->get_where_in('id', $questions_ids);

            $this->data['user'] = $userInfo;
            $this->data['questions'] = $questions;
            $this->data['students'] = $studentArr;
            $this->data['work'] = $work;
            $this->data["subview"] = "work/workdetail";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    public function workwrong($work_id, $question_id)
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);
            $work = $this->teacherwork_m->get_single_package($work_id);
            $sclass = $this->sclass_m->get_single(['id' => $work->class_id]);

            $students = $this->users_m->get_where(['user_class' => $sclass->class_name, 'user_type' => 2]);
            $studentArr = [];
            for ($i = 0; $i < count($students); $i++) {
                $w = $this->teacherwork_m->get_where(['teacher_id' => $user_id, 'class_id' => $work->class_id, 'student_id' => $students[$i]->id, 'title' => $work->title]);
                if ($w != null) {
                    $w = $w[0];
                    if ($w->first_mark == 6) {
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '未完成',
                            'price' => '',
                            'correct' => ''
                        ));
                    } else {
                        $correct = '';
                        if ($w->first_mark == 5) $correct = '/';
                        else if ($w->student_mark == 5) $correct = '已订正';
                        else $correct = '未订正';
                        array_push($studentArr, array(
                            'student' => $students[$i],
                            'work' => $w,
                            'complete' => '已完成',
                            'price' => (int)($w->first_mark / 5 * 100),
                            'correct' => $correct
                        ));
                    }


                } else {
                    array_push($studentArr, array(
                        'student' => $students[$i],
                        'work' => null,
                        'complete' => '未完成',
                        'price' => '',
                        'correct' => ''
                    ));
                }
            }

            $studentRetArr = [];
            foreach ($studentArr as $student) {
                $work = $student['work'];
                $answer_info = json_decode($work->answer_info);
                for ($i = 0; $i < count($answer_info); $i++) {
                    if ($question_id == $answer_info[$i]->id && !$answer_info[$i]->is_right) {
                        array_push($studentRetArr, $student['student']);
                        break;
                    }
                }
            }

            $this->data['user'] = $userInfo;
            $this->data['students'] = $studentRetArr;
            $this->data["subview"] = "work/workwrong";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }
    }


    function selectTerm()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $ret['data'] = $this->get_courseTypeHtml($_POST['term_id']);
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }


        echo json_encode($ret);
    }


    function selectCoursetype()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        log_message('info', '-- selectCoursetype $_POST :' . var_export($_POST, true));
        if ($_POST) {
            if (!isset($_POST['coursetype_ids'])) $coursetype_ids = []; else $coursetype_ids = $_POST['coursetype_ids'];
            if (!isset($_POST['selected_question_ids'])) $selected_question_ids = []; else $selected_question_ids = $_POST['selected_question_ids'];
            $temp = $this->get_questionsHtml($coursetype_ids, $selected_question_ids);
            if (count($temp['questions_ids']) == count($selected_question_ids)) {
                $ret['data']['totalSelected'] = true;
            } else {
                $ret['data']['totalSelected'] = false;
            }
            $ret['data']['questionsHtml'] = $temp['output'];
            $ret['data']['paginationHtml'] = $temp['paginationHtml'];
            $ret['data']['questions_ids'] = $temp['questions_ids'];
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        } else {
            $temp = $this->get_questionsHtml([], []);
            $ret['data']['totalSelected'] = false;
            $ret['data']['questionsHtml'] = $temp['output'];
            $ret['data']['paginationHtml'] = $temp['paginationHtml'];
            $ret['data']['questions_ids'] = $temp['questions_ids'];
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }


    function get_courseTypeHtml($term_id)
    {
        $output = '';

        $courseTypes = $this->coursetype_m->get_where(['term_id' => $term_id]);

        foreach ($courseTypes as $courseType) {
            $output .= '<div class="select-option" data-id="' . $courseType->id . '">';
            $output .= '<input type="checkbox" class="coursetype-checkbox"/>';
            $title = $courseType->title;
            if (mb_strlen($title) > 9) $title = mb_substr($title, 0, 9) . '...';
            $output .= '<span>' . $title . '</span>';
            $output .= '</div>';
        }

        return $output;
    }


    function get_questionsHtml($coursetype_ids, $selected_question_ids)
    {
        $output = '';

        $questions = $this->questions_m->get_where_in('course_type_id', $coursetype_ids);
        $questions_ids = array_column($this->obj2Array($questions), 'id');

        $perPage = PERPAGE;
        $cntPage = count($questions);
        $ret = $this->paginationCompress('work/selectCoursetype/', $cntPage, $perPage);
        $curPage = $ret['pageId'];
        if (!isset($curPage) || $curPage == null || $curPage == '') $curPage = 0;
        $paginationHtml = $this->pagination->create_links();

        log_message('info', '-- pagination $curPage : ' . $curPage);

        $questions = array_slice($questions, ($curPage) * $perPage, $perPage);

        if ($questions == null) {
            $output .= '<div class="question-elem no-question">';
            $output .= '<p>没有题目。</p>';
            $output .= '</div>';
        }

        $questionTypes = ["选择", "判断", "填空"];
        $questionTitles = ["选择题", "判断题", "填空题"];
        $dataPath = ['multiselect', 'yesno', 'fillblank'];
        $difficultyTypes = ['简单', '较难', '困难'];
        foreach ($questions as $question) {
            $qinfo = array(
                'ans' => json_decode($question->question_answer),
                'desc' => $question->question_description,
                'id' => $question->id,
                'qType' => $question->question_type,
                'ques' => $question->question_content,
                'type' => $question->question_type,
            );
            $courseType = $this->coursetype_m->get_single(['id' => $question->course_type_id]);
            $output .= '<div class="question-elem">';
            $output .= '<div class="question-title-sec">';
            $output .= '<div class="info-group">';
            $output .= '<span>' . $questionTypes[$question->question_type] . '</span>';
            $output .= '<span>' . $difficultyTypes[$question->difficult_type] . '</span>';
            $output .= '<span>' . $courseType->title . '</span>';
            $output .= '</div>';
            $active = in_array($question->id, $selected_question_ids) ? 'selected' : '';
            $activeText = in_array($question->id, $selected_question_ids) ? '已选' : '选入';
            $output .= '<a class="select-action-btn ' . $active . '" data-id="' . $question->id . '" onclick="onClickSelectQuestion(this)">' . $activeText . '</a>';
            $output .= '</div>';
            $output .= '<div class="question-body-sec">';
            $output .= '<div class="question-body">';

            $output .= '<div class="section" data-type="title">';
            $output .= $questionTitles[$question->question_type] . '。';
            $output .= '</div>';

            $output .= '<div class="section" data-type="content">';
            $output .= $question->question_content;
            $output .= '</div>';

            $output .= '<div class="section" data-type="answer">';
            $output .= $this->addOptionItem($question->question_type, json_decode($question->question_answer));
            $output .= '</div>';

            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return array(
            'output' => $output,
            'paginationHtml' => $paginationHtml,
            'questions_ids' => $questions_ids
        );
    }


    function addOptionItem($type, $content)
    {
        $output = '';

        if ($type == 0) {
            $keys = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
                "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                "U", "V", "W", "X", "Y", "Z"
            ];
            for ($i = 0; $i < count($content); $i++) {
                $output .= '<div class="answer-item" style="margin-bottom: 10px; border-radius: 10px; background-color: #fff;">';
                $output .= '<div class="item-title" style="display: inline-block; vertical-align: middle; padding: 7px 10px; margin-right: 2px; border-right: 1px solid #f1f5f6">' . $keys[$i] . '</div>';
                $output .= '<div class="item-content" style="display: inline-block; vertical-align: middle; padding: 7px 10px;">' . $content[$i]->content . '</div>';
                $output .= '</div>';
            }
        } else if ($type == 1) {
            $keys = ["是", "否"];
            for ($i = 0; $i < count($content); $i++) {
                $img_filename = 'check.png';
                if ($i != 0) $img_filename = 'uncheck.png';
                $output .= '<div class="answer-item" style="margin-bottom: 5px;">';
                $output .= '<input type="radio" name="answerRadio" data-id="' . $i . '" style="display: inline-block; vertical-align: middle; margin: 0"/>';
                $output .= '<div class="item-yesno" style="display: inline-block; vertical-align: middle; margin: 0"><img src="' . base_url('assets/images/huijiao/' . $img_filename) . '" style="width: 15px; height: 15px; margin-right: 10px"/></div>';
//                $output .= '<div class="item-title" style="display: inline-block; vertical-align: middle">' . $keys[$i] . '</div>';
                $output .= '</div>';
            }
        } else {

        }

        return $output;
    }


    function publishWork()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        log_message('info', '-- selectCoursetype $_POST :' . var_export($_POST, true));
        if ($_POST) {
            $class_ids = $_POST['class_ids'];
            $work_ids = [];
            for ($i = 0; $i < count($class_ids); $i++) {
                $class_id = $class_ids[$i];
                $sclass = $this->sclass_m->get_single(['id' => $class_id]);
                $students = $this->users_m->get_where(['user_class' => $sclass->class_name, 'user_type' => 2]);
                $work = array(
                    'teacher_id' => $_POST['user_id'],
                    'class_id' => $class_ids[$i],
                    'title' => $_POST['title'],
                    'end_time' => $_POST['end_time'],
                    'status' => 1,
                    'work_status' => 0,
                    'problem_info' => json_encode($_POST['question_ids']),
                    'spent_time' => 0,
                    'period_time' => 0,
                    'answer_type' => 0,
                    'first_mark' => 6,
                    'student_mark' => 0,
                    'read_status' => 0,
                );
                $id = $this->teacherwork_m->add($work);
                array_push($work_ids, $id);

                for ($j = 0; $j < count($students); $j++) {
                    $work = array(
                        'teacher_id' => $_POST['user_id'],
                        'student_id' => $students[$j]->id,
                        'status' => 0,
                        'class_id' => $class_ids[$i],
                        'title' => $_POST['title'],
                        'end_time' => $_POST['end_time'],
                        'work_status' => 0,
                        'problem_info' => json_encode($_POST['question_ids']),
                        'spent_time' => 0,
                        'period_time' => 0,
                        'answer_type' => 0,
                        'first_mark' => 6,
                        'student_mark' => 0,
                        'read_status' => 0,
                    );
                    $id = $this->teacherwork_m->add($work);
                    array_push($work_ids, $id);
                }
            }
            $ret['data'] = json_encode($work_ids);
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }
        echo json_encode($ret);
    }


    function selectedQuestions()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        log_message('info', '-- selectCoursetype $_POST :' . var_export($_POST, true));
        if ($_POST) {
            if (!isset($_POST['selected_question_ids'])) $selected_question_ids = []; else $selected_question_ids = $_POST['selected_question_ids'];
            $temp = $this->get_prevew_questionsHtml($selected_question_ids);
            $ret['data']['questionsHtml'] = $temp['output'];
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        } else {
            $temp = $this->get_questionsHtml([]);
            $ret['data']['questionsHtml'] = $temp['output'];
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }


    function get_prevew_questionsHtml($selected_question_ids)
    {
        $output = '';

        $questions = $this->questions_m->get_where_in('id', $selected_question_ids);
        $questions_ids = array_column($this->obj2Array($questions), 'id');

        if ($questions == null) {
            $output .= '<div class="question-elem no-question">';
            $output .= '<p>没有题目。</p>';
            $output .= '</div>';
        }

        $questionTypes = ["选择", "判断", "填空"];
        $questionTitles = ["选择题", "判断题", "填空题"];
        $dataPath = ['multiselect', 'yesno', 'fillblank'];
        $difficultyTypes = ['简单', '较难', '困难'];
        foreach ($questions as $question) {
            $qinfo = array(
                'ans' => json_decode($question->question_answer),
                'desc' => $question->question_description,
                'id' => $question->id,
                'qType' => $question->question_type,
                'ques' => $question->question_content,
                'type' => $question->question_type,
            );
            $courseType = $this->coursetype_m->get_single(['id' => $question->course_type_id]);
            $output .= '<div class="question-elem">';
            $output .= '<div class="question-title-sec">';
            $output .= '<div class="info-group">';
            $output .= '<span>' . $questionTypes[$question->question_type] . '</span>';
            $output .= '<span>' . $difficultyTypes[$question->difficult_type] . '</span>';
            $output .= '<span>' . $courseType->title . '</span>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="question-body-sec">';
            $output .= '<div class="question-body">';

            $output .= '<div class="section" data-type="title">';
            $output .= $questionTitles[$question->question_type] . '。';
            $output .= '</div>';

            $output .= '<div class="section" data-type="content">';
            $output .= $question->question_content;
            $output .= '</div>';

            $output .= '<div class="section" data-type="answer">';
            $output .= $this->addOptionItem($question->question_type, json_decode($question->question_answer));
            $output .= '</div>';

            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return array(
            'output' => $output
        );
    }


    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }
}

?>