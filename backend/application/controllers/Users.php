<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('users_m');
        $this->load->model('subject_m');
        $this->load->model('terms_m');
        $this->load->model('usage_m');
        $this->load->model('lessons_m');
        $this->load->model('contents_m');
        $this->load->model('coursetype_m');
        $this->load->model('contenttype_m');
        $this->load->model('usage_m');
        $this->load->model('signin_m');
        $this->load->model('sclass_m');
        $this->load->library("pagination");
        $this->load->library("session");
		
        $this->load->model('users_m');
        $this->users_m->update_usage_time();
    }

    public function profile($user_id)
    {
        $this->session->unset_userdata('learning_subject_id');
        $this->session->unset_userdata('learning_term_id');
        $this->session->unset_userdata('learning_coursetype_id');
        $this->session->unset_userdata('learning_curQuery');

        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $this->data['user_id'] = $user_id;
            $loggedIn_user_id = $this->session->userdata('loginuserID');
            if ($loggedIn_user_id == $user_id) {
                $userInfo = $this->users_m->get_single_user($user_id);
                log_message('info', 'profile $loggedIn_user_id : ' . $loggedIn_user_id);
                log_message('info', 'profile $user_id : ' . $user_id);
                log_message('info', 'profile $userInfo : ' . var_export($userInfo, true));

                // usage
                $usages = $this->usage_m->get_where(['user_id' => $user_id]);
                $usages_lesson = array_filter($usages, function ($elem) {
                    if ($elem->lesson_id != null) return true;
                    return false;
                });
                $usages_content = array_filter($usages, function ($elem) {
                    if ($elem->content_id != null) return true;
                    return false;
                });

                log_message('info', 'profile $usages_lesson : ' . var_export($usages_lesson, true));
                log_message('info', 'profile $usages_content : ' . var_export($usages_content, true));

                $favorite_lessons = array();
                foreach ($usages_lesson as $usage) {
                    if ($usage->is_favorite != 1) continue;
                    if ($usage->lesson_id == null) continue;
                    $lesson = $this->lessons_m->get_single(['id' => $usage->lesson_id, 'status' => 1]);
                    if ($lesson == null) continue;
                    log_message('info', 'profile $lesson : ' . var_export($lesson, true));
                    $term = $this->terms_m->get_single(['id' => $lesson->term_id, 'status' => 1]);
                    if ($term == null) continue;
                    $subject = $this->subject_m->get_single(['id' => $term->subject_id, 'status' => 1]);
                    if($subject == null) continue;
                    array_push($favorite_lessons, [
                        'usage' => $usage,
                        'term' => $term,
                        'subject' => $subject,
                        'lesson' => $lesson
                    ]);
                }

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
                    $content_type = $this->contenttype_m->get_single(['id' => $content->content_type_no, 'status' => 1]);
                    if($content_type == null) continue;
                    $subject = $this->subject_m->get_single(['id' => $term->subject_id, 'status' => 1]);
                    if($subject == null) continue;
                    array_push($favorite_contents, [
                        'usage' => $usage,
                        'coursetype' => $coursetype,
                        'content_type' => $content_type,
                        'term' => $term,
                        'subject' => $subject,
                        'content' => $content
                    ]);
                }

                // tongbu
                log_message('info', 'profile $userInfo->term_id : ' . var_export($userInfo->term_id, true));
                $term = null;
                $subject = null;
                $term = $this->terms_m->get_single(['id' => $userInfo->term_id, 'status' => 1]);
                log_message('info', 'profile $term : ' . var_export($term, true));
                if ($term != null)
                    $subject = $this->subject_m->get_single(['id' => $term->subject_id, 'status' => 1]);

                $subjects = $this->subject_m->get_where(['status' => 1]);

                $subjectTermArr = array();
                foreach ($subjects as $subj) {
                    $terms = $this->terms_m->get_where(['subject_id' => $subj->id, 'status' => 1]);
                    array_push($subjectTermArr, [
                        'subject' => $subj,
                        'terms' => $terms
                    ]);
                }

                $sclasses = $this->sclass_m->get_where(['teacher_id' => $user_id]);

                $this->data['user'] = $userInfo;
                $this->data['favorite_lessons'] = $this->get_favorite_lessons_html($favorite_lessons);
                $this->data['favorite_contents'] = $this->get_favorite_contents_html($favorite_contents);
                $this->data['subject'] = $subject;
                $this->data['term'] = $term;
                $this->data['sclasses'] = $sclasses;
                $this->data['subjectTermArr'] = $subjectTermArr;
                $this->data["subview"] = "users/profile";
                $this->load->view('_layout_main_resource', $this->data);
            } else {
                redirect(base_url('signin'));
            }
        } else {
            redirect(base_url('signin'));
        }

    }

    public function classmanage($user_id)
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $this->data['user_id'] = $user_id;
            $loggedIn_user_id = $this->session->userdata('loginuserID');
            if ($loggedIn_user_id == $user_id) {
                $userInfo = $this->users_m->get_single_user($user_id);

                $sclasses = $this->sclass_m->get_where(['teacher_id' => $user_id]);
                $sclassArr = [];
                for ($i = 0; $i < count($sclasses); $i++) {
                    $sclass = $sclasses[$i];
                    $tempClasses = $this->sclass_m->get_where(['class_name' => $sclass->class_name]);
                    $teacher_ids = array_column($this->obj2Array($tempClasses), 'teacher_id');
                    $teachers = $this->users_m->get_where_in('id', $teacher_ids);
                    $students = $this->users_m->get_where(['user_class' => $sclass->class_name]);
                    array_push($sclassArr, array(
                        'sclass' => $sclass,
                        'teachers' => $teachers,
                        'students' => $students
                    ));
                }

                $this->data['user'] = $userInfo;
                $this->data['sclassArr'] = $sclassArr;
                $this->data["subview"] = "users/classmanage";
                $this->load->view('_layout_main_class', $this->data);
            } else {
                redirect(base_url('signin'));
            }
        } else {
            redirect(base_url('signin'));
        }
    }


    public function classinfo($class_id)
    {
        $this->data['parentView'] = 'back';
        if ($this->signin_m->loggedin()) {
            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);

            $sclass = $this->sclass_m->get_single(['id' => $class_id]);
            $tempClasses = $this->sclass_m->get_where(['class_name' => $sclass->class_name]);
            $teacher_ids = array_column($this->obj2Array($tempClasses), 'teacher_id');
            $teachers = $this->users_m->get_where_in('id', $teacher_ids);
            $students = $this->users_m->get_where(['user_class' => $sclass->class_name]);
            $sclass = array(
                'sclass' => $sclass,
                'teachers' => $teachers,
                'students' => $students
            );

            $this->data['user'] = $userInfo;
            $this->data['sclass'] = $sclass;
            $this->data["subview"] = "users/classinfo";
            $this->load->view('_layout_main_class', $this->data);
        } else {
            redirect(base_url('signin'));
        }

    }


    public function add()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = array(
                'user_account' => $_POST['user_account']
            );
            $userInfo = $this->users_m->get_where($arr);
            if ($userInfo != null) {
                $ret['data'] = "This account is registered already.";
                echo json_encode($ret);
                return;
            }
            $tmp = array(
                'code' => $_POST['code']
            );
            $userInfo = $this->users_m->get_where($tmp);
            if ($userInfo == null) {
                $ret['data'] = "Activation code is not exist.";
                echo json_encode($ret);
                return;
            }
            if ($userInfo[0]->user_account != '') {
                $ret['data'] = "This activation code is used in.";
                echo json_encode($ret);
                return;
            }
            $userId = $userInfo[0]->id;
            $arr['user_name'] = $_POST['user_name'];
            $arr['password'] = $this->users_m->hash($_POST['password']);
            $arr['site_id'] = '1';
            $arr['user_email'] = $_POST['user_email'];
            $arr['user_type'] = $_POST['user_type'];
            $arr['activate_status'] = '1';
            $arr['user_status'] = '1';
            $arr['activate_time'] = date('Y-m-d H:i:s');
            $this->users_m->update_user($arr, $userId);
            $ret['data'] = $this->users_m->get_single_user($userId);
            $this->signin_m->signin($arr['user_account'], $arr['user_type'], $arr['password']);
            $ret['status'] = 'success';
        }

        echo json_encode($ret);
    }

    public function add_student()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = array(
                'user_account' => $_POST['user_account']
            );
            $userInfo = $this->users_m->get_where($arr);
            if ($userInfo!= null) {
                $ret['data'] = "This account is registered already.";
                echo json_encode($ret);
                return;
            };
            $tmp = array(
                'class_code' => $_POST['code']
            );
            $classInfo = $this->sclass_m->get_where($tmp);
            if ($classInfo == null) {
                $ret['data'] = "Class code is not exist.";
                echo json_encode($ret);
                return;
            }
            $arr['user_name'] = $_POST['user_name'];
            $arr['password'] = $this->users_m->hash($_POST['password']);
            $arr['user_class'] = $classInfo[0]->class_name;
            $arr['site_id'] = '1';
            $arr['user_type'] = $_POST['user_type'];
            $arr['activate_status'] = '0';
            $arr['user_status'] = '0';
            $arr['create_time'] = date('Y-m-d H:i:s');
            $userId = $this->users_m->insert($arr);
            $ret['data'] = $this->users_m->get_single_user($userId);
            $ret['status'] = 'success';
        }

        echo json_encode($ret);
    }

    public function update_profile()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $userInfo = $this->users_m->get_single_user($_POST['user_id']);
            $arr = array(
                'user_name' => $_POST['user_name'],
                'update_time' => date('Y-m-d H:i:s')
            );
            if (isset($_POST['user_class']))
                $arr['user_class'] = $_POST['user_class'];
            if ($userInfo->user_account != $_POST['user_account']) {
                $ret['data'] = 'User information is invalid.';
                echo json_encode($ret);
                return;
            }
            $this->users_m->update_user($arr, $_POST['user_id']);
            $ret['data'] = $this->users_m->get_single_user($_POST['user_id']);
            $ret['status'] = 'success';
            $this->session->set_userdata(array(
                'user_name' => $ret['data']->user_name,
                'user_school' => $ret['data']->user_school,
            ));
        }
        echo json_encode($ret);
    }

    public function add_class()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = [];

            $user_id = $_POST['user_id'];
            $userInfo = $this->users_m->get_where(array('id' => $user_id));
            if ($userInfo == null) {
                $ret['data'] = 'User is not exist';
                echo json_encode($ret);
                return;
            }
            $class_name = $_POST['user_class'];
            $class_code = $this->generateRandomString(8);
            $class_id = $this->sclass_m->add(array(
                'class_name' => $class_name,
                'teacher_id' => $user_id,
                'class_code' => $class_code
            ));
            $result = $this->sclass_m->get_where(array('teacher_id' => $user_id));
            $ret['data'] = $this->output_class_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_class()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = [];
            $class_id = $_POST['class_id'];
            $class_name = $_POST['class_name'];
            $user_id = $_POST['user_id'];
            $userInfo = $this->users_m->get_where(array('id' => $user_id));
//            $oldClass = $this->sclass_m->get_where(array('teacher_id'=>$user_id));

            if ($class_name == '') {
                $this->sclass_m->delete($class_id);
            } else {
                $this->users_m->update_class($class_name, $class_id);
                $this->sclass_m->update(array('class_name' => $class_name), $class_id);
            }
            $result = $this->sclass_m->get_where(array('teacher_id' => $user_id));
//            if ($result != null) $result = [];
            $ret['data'] = $this->output_class_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function get_class()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $userInfo = $this->users_m->get_where(array('id' => $user_id));
            if ($userInfo == null) {
                $ret['data'] = 'User is not exist';
                echo json_encode($ret);
                return;
            }

            $result = $this->sclass_m->get_where(array('teacher_id' => $user_id));
            $ret['data'] = $this->output_class_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function output_class_content($lists)
    {
        $content_html = '';
        foreach ($lists as $item) {
            $content_html .= '<tr>'
                . '<td width="22%" style="text-align: left;">'
                . '<input class="classitem-title" '
                . ' value="' . $item->class_name . '" '
                . ' item_code="' . $item->class_code . '" '
                . ' disabled="disabled" itemid="' . $item->id . '">'
                . '<div class="classitem-btn" '
                . ' itemid="' . $item->id . '">'
                . '</td>'
                . '<td style="text-align: left;">'
                . '<div class="editclass-btn"></div>'
                . '</td>'
                . '<td width="25%"><a class="view-detail"></a></td>'
                . '<td width="35%" style="text-align: right;padding-right: 5%;">' . $item->create_time . '</td>'
                . '</tr>';
        }
        return $content_html;
    }

    public function get_students()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $class_id = $_POST['class_id'];
            $result = $this->users_m->get_where(array('user_class' => $class_id, 'user_type' => '2'));

            $ret['data'] = $this->output_students_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_student()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = [];
            $user_id = $_POST['user_id'];
            $user_name = $_POST['user_name'];
            $userInfo = $this->users_m->update_user(array('user_name' => $user_name), $user_id);
            $result = $this->users_m->get_where(array('user_class' => $userInfo->user_class, 'user_type' => '2'));

            $ret['data'] = $this->output_students_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function publish_student()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = [];
            $user_id = $_POST['user_id'];
            $user_status = $_POST['user_status'];
            $userInfo = $this->users_m->update_user(array(
                'user_status' => $user_status,
                'activate_status' => $user_status,
                'activate_time' => date('Y-m-d H:i:s')
            ), $user_id);
            $result = $this->users_m->get_where(array('user_class' => $userInfo->user_class, 'user_type' => '2'));

            $ret['data'] = $this->output_students_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function delete_student()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = [];
            $user_id = $_POST['user_id'];
            $userInfo = $this->users_m->get_single_user($user_id);
            $this->users_m->delete($user_id);
            $result = $this->users_m->get_where(array('user_class' => $userInfo->user_class, 'user_type' => '2'));

            $ret['data'] = $this->output_students_content($result);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function output_students_content($lists)
    {
        $content_html = '';

        foreach ($lists as $item) {
            $content_html .= '<tr>'
                . '<td width="20%" style="text-align: center;">'
                . $item->user_account
                . '</td>'
                . '<td width="15%">'
                . '<input class="classitem-title" style="text-align:center;"'
                . ' value="' . $item->user_name . '" '
                . ' disabled="disabled" itemid="' . $item->id . '">'
                . '</td>'
                . '<td style="text-align: left;">'
                . '<div class="editclass-btn" style="width:42%;"></div>'
                . '</td>'
                . '<td width="32%" style="text-align: left;" >' . $item->create_time . '</td>'
                . '<td width="27%">'
                . '<div class="publish-txt" itemid="' . $item->id . '" '
                . ' item_status="' . $item->user_status . '"></div>'
                . '<div class="delete-txt" itemid="' . $item->id . '"></div>'
                . '</td>'
                . '</tr>';
        }
        return $content_html;
    }

    public function update_teacher_class()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = array(
                'class' => ''
            );
            if (isset($_POST['class_arr'])) {
                $arr['class'] = json_encode($_POST['class_arr']);
            }
            $ret['data'] = $this->users_m->update_user($arr, $_POST['user_id']);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_password()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $realOldPass = $this->users_m->hash($_POST['opassword']);
            $realNewPass = $this->users_m->hash($_POST['npassword']);

            $arr = array(
                'id' => $_POST['user_id'],
                'password' => $realOldPass
            );
            ///at first check of fair(user_id,password)
            $retRecord = $this->users_m->get_where($arr);
            if ($retRecord == null) {
                $ret['data'] = 'Old password is incorrect.';
            } else {
                $new_arr = array(
                    'password' => $realNewPass
                );
                $ret['data'] = $this->users_m->update_user($new_arr, $_POST['user_id']);
                $ret['status'] = 'success';
            }
        }
        echo json_encode($ret);
    }

    public function update_student_password()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $realNewPass = $this->users_m->hash($_POST['npassword']);

            $arr = array(
                'user_account' => $_POST['user_account']
            );
            ///at first check of fair(user_id,password)
            $retRecord = $this->users_m->get_where($arr);
            if ($retRecord == null) {
                $ret['data'] = 'User is not exist.';
            } else {
                $new_arr = array(
                    'password' => $realNewPass
                );
                $ret['data'] = $this->users_m->update_user($new_arr, $retRecord[0]->id);
                $this->signin_m->signin($arr['user_account'], '2', $new_arr['password']);
                $ret['status'] = 'success';
            }
        }
        echo json_encode($ret);
    }

    public function update_student_person()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {

            $arr = array(
                'fullname' => $_POST['fullname'],
                'sex' => $_POST['sex'],
                'class' => $_POST['class'],
                'nickname' => $_POST['nickname'],
                'serial_no' => $_POST['serialno']
            );
            $ret['data'] = $this->users_m->update_user($arr, $_POST['user_id']);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function getTeacherList($schoolID, $className)
    {
        $ret = array();
        $candidateRecs = $this->users_m->get_where(array('school_id' => $schoolID, 'user_type_id' => '1'));
        foreach ($candidateRecs as $crec):
            //class string to class label list
            if ($crec->class != '') {
                $classLabelList = $this->convertClassArrToLabel($crec->class);
                if (in_array($className, $classLabelList)) array_push($ret, $crec->user_id);
            }
        endforeach;
        return $ret;
    }

    /**
     * @param $userList : student list
     * @param $user_id : teacher id
     * @return array: contents list
     */
    public function getCheckedContents($userList, $user_id, $isTeacher = TRUE)
    {
        $retArr = array();

        if ($isTeacher) {
            //Get Teacher's contents from user id of teacher
            $teacherCheckedList = $this->contents_m->get_contents(array('content_user_id' => $user_id, 'contents.content_type_id' => '2', 'contents.publish' => '1', 'isDeleted_teacher' => '0'));
            foreach ($teacherCheckedList as $tcItem):
                array_push($retArr, $tcItem);
            endforeach;
            //Get Student Contents
            foreach ($userList as $userID):
                $contentsRecs = $this->contents_m->get_contents(array('content_user_id' => $userID, 'contents.content_type_id' => '3', 'contents.publish' => '1', 'isDeleted_teacher' => '0'));
                foreach ($contentsRecs as $contentRec):
                    array_push($retArr, $contentRec);
                endforeach;
            endforeach;
        } else {
            //Get Student's contents from user id of student
            $studentCheckedList = $this->contents_m->get_contents(array('content_user_id' => $user_id, 'contents.content_type_id' => '3', 'contents.publish' => '1', 'isDeleted_student' => '0'));
            foreach ($studentCheckedList as $stdItem):
                array_push($retArr, $stdItem);
            endforeach;
            //Get Teacher Contents
            foreach ($userList as $userID):
                $contentsRecs = $this->contents_m->get_contents(array('content_user_id' => $userID, 'contents.content_type_id' => '2', 'contents.publish' => '1', 'isDeleted_student' => '0'));
                foreach ($contentsRecs as $contentRec):
                    array_push($retArr, $contentRec);
                endforeach;
            endforeach;
        }

        return $retArr;

    }

    /**
     * @param $classLabelList
     * @param $schoolId
     * @return array
     */
    public function getUserListFromClassArr($classLabelList, $schoolId)
    {
        $userList = array();
        foreach ($classLabelList as $classLabel):
            $tmpUserInfos = $this->users_m->get_where(array('school_id' => $schoolId, 'class' => $classLabel, 'user_type_id' => '2'));
            foreach ($tmpUserInfos as $tmpInfo):
                array_push($userList, $tmpInfo->user_id);
            endforeach;
        endforeach;
        return $userList;

    }

    public function convertClassArrToLabel($class_jsonStr)
    {
        $output = array();
        $classStr = $this->lang->line('Class');
        $gradeStr = $this->lang->line('Grade');
        $classArr = json_decode($class_jsonStr);
        foreach ($classArr as $class_info):
            $gradeNo = $class_info->grade;
            $classNo = $class_info->class;
            $realStr = $this->lang->line($gradeNo - 1);
            $realClassStr = $this->lang->line($classNo - 1);
            $tmpClassName = $realStr . $gradeStr . $realClassStr . $classStr;
            array_push($output, $tmpClassName);
        endforeach;
        return $output;
    }

    ///this function is used in teachers profile page
    public function convertClassArrToHtml($class_jsonStr)
    {
        $output = '';
        $classStr = $this->lang->line('Class');
        $gradeStr = $this->lang->line('Grade');
        $classArr = json_decode($class_jsonStr);
        $classCount = 1;
        foreach ($classArr as $class_info):
            $gradeNo = $class_info->grade;
            $realStr = $this->lang->line($gradeNo - 1);
            for ($i = 1; $i <= $class_info->class; $i++) {

                if ($classCount % 2 == 0) {
                    $output .= '<div class="col-md-12" style="text-align:right">';
                    $realClassStr = $this->lang->line($i - 1);
                    $output .= '<div class="custom-checkbox">';
                    $output .= '<input type="checkbox" class="grade-class-list-chk" id = "' . $gradeNo . '-' . $i . '" >';
                    $output .= '<label for="' . $gradeNo . '-' . $i . '" style="color:#fff">';
                    $output .= $realStr . $gradeStr . $realClassStr . $classStr;
                    $output .= '</label>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';

                } else {
                    $output .= '<div class="row" style="width:140px;">';
                    $output .= '<div class="col-md-12" style="text-align:right">';
                    $realClassStr = $this->lang->line($i - 1);
                    $output .= '<div class="custom-checkbox">';
                    $output .= '<input type="checkbox" class="grade-class-list-chk" id = "' . $gradeNo . '-' . $i . '" >';
                    $output .= '<label for="' . $gradeNo . '-' . $i . '" style="color:#fff">';
                    $output .= $realStr . $gradeStr . $realClassStr . $classStr;
                    $output .= '</label>';
                    $output .= '</div>';
                    $output .= '</div>';

                }
                $classCount++;
            }
        endforeach;
        return $output;
    }

    public function output_shared_contents($sharedLists)
    {

        $delStr = $this->lang->line('Delete');
        $output = '';
        foreach ($sharedLists as $content):
            $output .= '<tr>';
            $output .= '<td style="width:60%;text-align: center;">';
            $output .= '<a href="' . base_url() . '/' . $content->file_name . '">';
            $output .= $content->content_title;
            $output .= '</a>';
            $output .= '</td>';
            $output .= '<td style="width:40%;text-align: center;">';
            $output .= '<a href="#" content_id = ' . $content->content_id . ' onclick ="deleteSharedContentShow(this);"' . '>';
            $output .= $delStr . '</a>';
            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function get_favorite_lessons_html($favorite_lessons)
    {
        $output = '';
		$perPage = 1000;
        $i = 0;
        foreach ($favorite_lessons as $favorite_lesson) {
            if ($i % $perPage == 0) {
                $output .= '<div class="item-content-page lesson-page-' . ((int)($i / $perPage) + 1) . '" >';
            }
            $title = $favorite_lesson['lesson']->title;
            //if (mb_strlen($title) > 15) $title = mb_substr($title, 0, 15) . '...';
            $output .= '<div class="item-content">';
            $output .= '<img onclick="location.href=\''
                . base_url('resource/previewPlayer') . '/' . $favorite_lesson['lesson']->id
                . '\'" src="' . base_url($favorite_lesson['lesson']->image_icon) . '"/>';
            $output .= '<div class="item-body">';
            $output .= '<h5 onclick="cancelFavorite(' . $favorite_lesson['usage']->id . ')"> <i class="fa fa-remove"></i> </h5>';
            $output .= '<div class="item-title" onclick="location.href=\''
                . base_url('resource/previewPlayer') . '/' . $favorite_lesson['lesson']->id . '\'">'
                . $title . '</div>';
            $output .= '<div class="item-subject">';
            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_lesson['subject']->title . '</span>';
            $output .= '<span style="padding-left:15px;">册次：</span>';
            $output .= '<span>' . $favorite_lesson['term']->title . '</span>';
            $output .= '</div>';
            $output .= '<div class="item-date">收藏时间：' . $favorite_lesson['usage']->update_time;
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            if ($i % $perPage == $perPage-1) {
                $output .= '</div>';
            }
            $i++;
        }
        if ($i%$perPage > 0) {
            $output .= '</div>';
        }
        return $output;
    }

    public function get_favorite_contents_html($favorite_contents)
    {
        $output = '';
		$perPage = 1000;
        $i = 0;
        foreach ($favorite_contents as $favorite_content) {
            if ($i % $perPage == 0) {
                $output .= '<div class="item-content-page content-page-' . ((int)($i / $perPage) + 1) . '" >';
            }
            $title = $favorite_content['content']->title;
            //if (mb_strlen($title) > 15) $title = mb_substr($title, 0, 15) . '...';
            $output .= '<div class="item-content">';
            $output .= '<img src="' . base_url($favorite_content['content']->icon_path) . '" onclick="location.href=\''
                . base_url('resource/warePreviewPlayer') . '/' . $favorite_content['content']->id . '\'">';
            $output .= '<div class="item-body">';

            $output .= '<h5 onclick="cancelFavorite(' . $favorite_content['usage']->id . ')"> <i class="fa fa-remove"></i> </h5>';

            $output .= '<div class="item-title" onclick="location.href=\''
                . base_url('resource/warePreviewPlayer') . '/' . $favorite_content['content']->id . '\'">'
                . $title . '</div>';

            $output .= '<div class="item-subject">';
//            $output .= '<span>科目：</span>';
            $output .= '<span>' . $favorite_content['subject']->title . '</span> &nbsp;';
//            $output .= '<span style="padding-left: 15px;">册次：</span>';
            $output .= '<span>' . $favorite_content['term']->title . '</span>  &nbsp;';
//            $output .= '<span style="padding-left: 15px;">资源类型：</span>';
            $output .= '<span>' . $favorite_content['content_type']->title . '</span> ';
            $output .= '</div>';

            $output .= '<div class="item-date">收藏时间：' . substr($favorite_content['usage']->update_time,0,16);
            $output .= '</div>';

            $output .= '</div>';
            $output .= '</div>';
            if ($i % $perPage == $perPage-1) {
                $output .= '</div>';
            }
            $i++;
        }
        if ($i%$perPage > 0) {
            $output .= '</div>';
        }

        return $output;
    }

    public function cancelFavorite()
    {
        log_message('info', '-- cancelFavorite start : ' . var_export($_POST, true));
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );

        if ($_POST) {
            $usage_id = $_POST['usage_id'];
            log_message('info', '-- cancelFavorite $usage_id : ' . $usage_id);

            $usage = $this->usage_m->get_single(['id' => $usage_id]);
            log_message('info', '-- cancelFavorite $usage : ' . var_export($usage, true));

            $usage_id = null;
            if ($usage != null) {
                log_message('info', '-- cancelFavorite cancel');
                $usageItem = [
                    'is_favorite' => 0,
                    'update_time' => date('Y-m-d H:i:s'),
                ];
                $ret = $this->usage_m->edit($usageItem, $usage->id);
                log_message('info', '-- cancelFavorite $ret : ' . var_export($ret, true));
            }

            $user_id = $this->session->userdata('loginuserID');
            $userInfo = $this->users_m->get_single_user($user_id);

            // usage
            $usages = $this->usage_m->get_where(['user_id' => $user_id]);
            $usages_lesson = array_filter($usages, function ($elem) {
                if ($elem->lesson_id != null) return true;
                return false;
            });
            $usages_content = array_filter($usages, function ($elem) {
                if ($elem->content_id != null) return true;
                return false;
            });

            log_message('info', 'profile cancelFavorite : ' . var_export($usages_lesson, true));
            log_message('info', 'profile cancelFavorite : ' . var_export($usages_content, true));

            $favorite_lessons = array();
            foreach ($usages_lesson as $usage) {
                if ($usage->is_favorite != 1) continue;
                $lesson = $this->lessons_m->get_single(['id' => $usage->lesson_id]);
                $term = $this->terms_m->get_single(['id' => $lesson->term_id]);
                $subject = $this->subject_m->get_single(['id' => $term->subject_id]);
                array_push($favorite_lessons, [
                    'usage' => $usage,
                    'term' => $term,
                    'subject' => $subject,
                    'lesson' => $lesson
                ]);
            }

            $favorite_contents = array();
            foreach ($usages_content as $usage) {
                if ($usage->is_favorite != 1) continue;
                $content = $this->contents_m->get_single(['id' => $usage->content_id, 'status' => 1]);
                $coursetype = $this->coursetype_m->get_single(['id' => $content->course_type_id, 'status' => 1]);
                $term = $this->terms_m->get_single(['id' => $coursetype->term_id, 'status' => 1]);
                $subject = $this->subject_m->get_single(['id' => $term->subject_id, 'status' => 1]);
                array_push($favorite_contents, [
                    'usage' => $usage,
                    'coursetype' => $coursetype,
                    'term' => $term,
                    'subject' => $subject,
                    'content' => $content
                ]);
            }

            $ret['status'] = 'success';
            $ret['data']['favorite_lessons'] = $this->get_favorite_lessons_html($favorite_lessons);
            $ret['data']['favorite_contents'] = $this->get_favorite_contents_html($favorite_contents);
        }
        echo json_encode($ret);
    }

    public function setTerm()
    {
        log_message('info', '-- setTerm start : ' . var_export($_POST, true));
        $ret = array(
            'data' => array(
                'subject'=>null,
                'term'=>null
            ),
            'status' => 'fail'
        );

        if ($_POST) {
            $term_id = $_POST['term_id'];
            $user_id = $this->session->userdata('loginuserID');

            $userItem = [
                'term_id' => $term_id,
                'update_time' => date('Y-m-d H:i:s'),
            ];
//            $this->users_m->update_user($userItem, $user_id);
            $this->session->set_userdata('term_id', $term_id);

            $term = $this->terms_m->get_single(['id' => $term_id]);
            $subject = $this->subject_m->get_single(['id' => $term->subject_id]);

            $ret['status'] = 'success';
            $ret['data']['subject'] = $subject;
            $ret['data']['term'] = $term;
        }
        echo json_encode($ret);
    }


    public function classAdd()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $arr = array(
                'user_account' => $_POST['user_account']
            );
            $userInfo = $this->users_m->get_where($arr);
            if ($userInfo != null) {
                $ret['data'] = "This account is registered already.";
                echo json_encode($ret);
                return;
            }
            $tmp = array(
                'code' => $_POST['code']
            );
            $userInfo = $this->users_m->get_where($tmp);
            if ($userInfo == null) {
                $ret['data'] = "Activation code is not exist.";
                echo json_encode($ret);
                return;
            }
            if ($userInfo[0]->user_account != '') {
                $ret['data'] = "This activation code is used in.";
                echo json_encode($ret);
                return;
            }
            $userId = $userInfo[0]->id;
            $arr['user_name'] = $_POST['user_name'];
            $arr['password'] = $this->users_m->hash($_POST['password']);
            $arr['site_id'] = '1';
            $arr['user_email'] = $_POST['user_email'];
            $arr['user_type'] = $_POST['user_type'];
            $arr['activate_status'] = '1';
            $arr['user_status'] = '1';
            $arr['activate_time'] = date('Y-m-d H:i:s');
            $this->users_m->update_user($arr, $userId);
            $ret['data'] = $this->users_m->get_single_user($userId);
            $this->signin_m->signin($arr['user_account'], $arr['user_type'], $arr['password']);
            $ret['status'] = 'success';
        }

        echo json_encode($ret);
    }


    function addClass()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            log_message('info', '-- $_POST[\'user_id\'] : ' . $_POST['user_id']);
            log_message('info', '-- $_POST[\'user_class\'] : ' . $_POST['user_class']);

            $sclass = $this->sclass_m->get_where(['teacher_id' => $_POST['user_id'], 'class_name' => $_POST['user_class']]);
            if ($sclass != null) {
                $ret['data'] = 'exist';
                $ret['status'] = 'fail';
                echo json_encode($ret);
                return;
            }

            $this->sclass_m->add(array(
                'class_name' => $_POST['user_class'],
                'teacher_id' => $_POST['user_id'],
                'create_time' => date('Y-m-d H:i:s')
            ));

            $ret['data'] = $this->get_classHtml($_POST['user_id']);
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }


        echo json_encode($ret);
    }


    function deleteClass()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {

            $this->sclass_m->delete($_POST['sclass_id']);

            $ret['data'] = $this->get_classHtml($_POST['user_id']);
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }


    function deleteStudent()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $ret = $this->users_m->edit(['user_class' => null], $_POST['student_id']);

            $ret['data']['html'] = $this->get_studentHtml($_POST['student_id'], $_POST['sclass_id']);
            $sclass = $this->sclass_m->get_single(['id' => $_POST['sclass_id']]);
            $students = $this->users_m->get_where(['user_class' => $sclass->class_name]);
            $ret['data']['count'] = count($students);
            $ret['status'] = 'success';
            log_message('info', '-- $ret : ' . var_export($ret, true));
        }

        echo json_encode($ret);
    }


    function get_classHtml($user_id)
    {
        $output = '';

        $sclasses = $this->sclass_m->get_where(['teacher_id' => $user_id]);
        $sclassArr = [];
        for ($i = 0; $i < count($sclasses); $i++) {
            $sclass = $sclasses[$i];
            $tempClasses = $this->sclass_m->get_where(['class_name' => $sclass->class_name]);
            $teacher_ids = array_column($this->obj2Array($tempClasses), 'teacher_id');
            $teachers = $this->users_m->get_where_in('id', $teacher_ids);
            $students = $this->users_m->get_where(['user_class' => $sclass->class_name]);
            array_push($sclassArr, array(
                'sclass' => $sclass,
                'teachers' => $teachers,
                'students' => $students
            ));
        }

        foreach ($sclassArr as $sclass) {
            $classArr = explode('-', $sclass['sclass']->class_name);
            $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
            $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
            $classStr = '';
            if (isset($classArr[0]) && isset($classYearArr[$classArr[0] - 1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1] - 1])) {
                $classStr = $classYearArr[$classArr[0] - 1] . $classBanArr[$classArr[1] - 1];
            }

            $output .= '<div class="sclass-group">';
            $output .= '<div class="sclass-name-sec">';
            $output .= '<p>' . $classStr . '</p>';
            $output .= '<p style="margin: 0"><a class="classmanage-detail-btn" href="' . base_url() . 'users/classinfo/' . $sclass['sclass']->id . '">班级详情</a></p>';
            $output .= '</div>';
            $output .= '<div class="sclass-teacher-sec">';
            for ($i = 0; $i < 5; $i++) {
                if (isset($sclass['teachers'][$i])) {
                    $teacher = $sclass['teachers'][$i];
                    $output .= '<div class="teacher-elem">';
                    $output .= '<img src="' . base_url() . 'assets/images/huijiao/profile/touxiang4.png' . '"/>';
                    $output .= '<p>' . $teacher->user_name . '</p>';
                    $output .= '</div>';
                } else {
                    $output .= '<div class="teacher-elem">';
                    $output .= '<img src="' . base_url() . 'assets/images/huijiao/profile/touxiang5.png' . '"/>';
                    $output .= '<p>-</p>';
                    $output .= '</div>';
                }
            }

            $output .= '</div>';
            $output .= '<div class="sclass-action-sec">';
            $output .= '<a class="classmanage-exit-btn" data-id="' . $sclass['sclass']->id . '" onclick="deleteClass(this);">退出班级</a>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }


    function get_studentHtml($student_id, $class_id)
    {
        $output = '';

        $userInfo = $this->users_m->get_single_user($student_id);

        $sclass = $this->sclass_m->get_single(['id' => $class_id]);
        $tempClasses = $this->sclass_m->get_where(['class_name' => $sclass->class_name]);
        $teacher_ids = array_column($this->obj2Array($tempClasses), 'teacher_id');
        $teachers = $this->users_m->get_where_in('id', $teacher_ids);
        $students = $this->users_m->get_where(['user_class' => $sclass->class_name]);
        $sclass = array(
            'sclass' => $sclass,
            'teachers' => $teachers,
            'students' => $students
        );


        foreach ($sclass['students'] as $student) {
            $output .= '<div class="student-group">';
            $output .= '<div class="student-account-sec">';
            $output .= $student->user_account;
            $output .= '</div>';
            $output .= '<div class="student-name-sec">';
            $output .= $student->user_name;
            $output .= '</div>';
            $output .= '<div class="student-description-sec">';
            $output .= '<input class="student-description" data-id="' . $student->id . '" placeholder="备注">';
            $output .= '<a>保存</a>';
            $output .= '</div>';
            $output .= '<div class="student-action-sec">';
            $output .= '<a class="student-delete-btn" data-student-id="' . $student->id . '" data-sclass-id="' . $sclass['sclass']->id . '" onclick="deleteStudent(this);">删除</a>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }


    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }
}

?>