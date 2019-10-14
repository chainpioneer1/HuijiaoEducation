<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends Admin_Controller
{

    protected $mainModel;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->load->model("subject_m");
        $this->load->model("terms_m");
        $this->load->model("coursetype_m");
        $this->load->model("questions_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->questions_m;
    }

    public function index()
    {
        $this->data['title'] = '题目管理';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";

        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();

        $filter = array();
        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');
        $search_keyword = '';
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $this->session->unset_userdata('keyword');

            $_POST['search_no'] != '' && $filter['tbl_questions.question_no'] = $_POST['search_no'];
            $_POST['search_question_type'] != '' && $filter['tbl_questions.question_type'] = $_POST['search_question_type'];
            if ($_POST['search_title'] != '') {
                $search_keyword = "(tbl_huijiao_subject.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_terms.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_course_type.title like '%" . $_POST["search_title"] . "%' )";
                $this->session->set_userdata('keyword', $_POST["search_title"]);
            }
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $_POST['search_course_type'] != '' && $filter['tbl_huijiao_course_type.id'] = $_POST['search_course_type'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $search_keyword);
        $ret = $this->paginationCompress('admin/questions/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $search_keyword);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/questions";

        $this->data["type_str"] = ['选择', '判断', '填空'];
        $this->data["diff_str"] = ['简单', '较难', '困难'];

        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function output_content($items)
    {
        $admin_id = $this->session->userdata("admin_loginuserID");
        $output = '';
        $btn_str = ['启用', '禁用', '修改', '删除'];
        $type_str = ['选择', '判断', '填空', '连线'];
        $diff_str = ['简单', '较难', '困难'];
        foreach ($items as $unit):
            $editable = ($unit->status == 0);

            $output .= '<tr>';
            $output .= '<td>' . $unit->question_no . '</td>';
            $output .= '<td>' . $type_str[$unit->question_type] . '</td>';
            $output .= '<td>' . $diff_str[$unit->difficult_type] . '</td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->update_time . '</td>';
            $output .= '<td>';
            $output .= '<button '
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . (!$editable ? '' : 'editItem(this);') . '" '
                . ' data-id = "' . (!$editable ? '' : $unit->id) . '" '
                . ' data-subject = "' . (!$editable ? '' : $unit->subject_id) . '" '
                . ' data-term = "' . (!$editable ? '' : $unit->term_id) . '" '
                . ' data-course-type = "' . (!$editable ? '' : $unit->course_type_id) . '" '
                . ' data-type = "' . (!$editable ? '' : $unit->question_type) . '" '
                . ' data-difficult = "' . (!$editable ? '' : $unit->difficult_type) . '" '
                . ' data-content = \'' . (!$editable ? '' : str_replace("'", "", $unit->question_content)) . '\' '
                . ' data-answer = \'' . (!$editable ? '' : str_replace("'", "", $unit->question_answer)) . '\' '
                . ' data-description = \'' . (!$editable ? '' : str_replace("'", "", $unit->question_description)) . '\' '
                . '> '
                . $btn_str[2] . '</button>';
            $output .= '<button '
                . ' class="btn btn-sm ' . ($editable ? 'btn-danger' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'deleteItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '">'
                . $btn_str[3] . '</button>';
            $output .= '<button '
                . ' class="btn btn-sm ' . ($editable ? 'btn-default' : 'btn-warning') . '"'
                . ' onclick = "publishItem(this);"'
                . ' data-status = "' . $unit->status . '"'
                . ' data-id = "' . $unit->id . '">'
                . $btn_str[$unit->status] . '</button>';
            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function usage()
    {
        $this->data['title'] = '题目使用详情';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";

        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();

        $filter = array();
        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');
        $search_keyword = '';
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $this->session->unset_userdata('keyword');

            $_POST['search_no'] != '' && $filter['tbl_questions.question_no'] = $_POST['search_no'];
            $_POST['search_question_type'] != '' && $filter['tbl_questions.question_type'] = $_POST['search_question_type'];
            if ($_POST['search_title'] != '') {
                $search_keyword = "(tbl_huijiao_subject.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_terms.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_course_type.title like '%" . $_POST["search_title"] . "%' )";
                $this->session->set_userdata('keyword', $_POST["search_title"]);
            }
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $_POST['search_course_type'] != '' && $filter['tbl_huijiao_course_type.id'] = $_POST['search_course_type'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $search_keyword);
        $ret = $this->paginationCompress('admin/questions/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $search_keyword);

        $this->data["tbl_content"] = $this->output_usage_content($this->data['list']);

        $this->data["subview"] = "admin/usage/questions";

        $this->data["type_str"] = ['选择', '判断', '填空'];
        $this->data["diff_str"] = ['简单', '较难', '困难'];

        if (!$this->checkRole(64)) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function output_usage_content($items)
    {
        $admin_id = $this->session->userdata("admin_loginuserID");
        $output = '';
        $btn_str = ['启用', '禁用', '修改', '删除'];
        $type_str = ['选择', '判断', '填空', '连线'];
        $diff_str = ['简单', '较难', '困难'];
        foreach ($items as $unit):
            $editable = ($unit->status == 0);

            $output .= '<tr>';
            $output .= '<td>' . $unit->question_no . '</td>';
            $output .= '<td>' . $type_str[$unit->question_type] . '</td>';
            $output .= '<td>' . $diff_str[$unit->difficult_type] . '</td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->read_count . '</td>';
            $output .= '<td>' . $unit->right_count . '</td>';
            $output .= '<td>' . $unit->wrong_count . '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function getContentsFromLessonInfo()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            if (!$this->adminsignin_m->loggedin()) {
                echo json_encode($ret);
                return;
            }
            $lesson_info = $_POST['lesson_info'];
            $result = $this->contents_m->getContentsFromLessonId($lesson_info);
            $ret['data'] = $result;
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function updateItem()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if (!$this->adminsignin_m->loggedin()) {
            echo json_encode($ret);
            return;
        }
        if ($_POST) {
            $id = $this->input->post('id');
            $param = array();
            $param['user_id'] = 0;
            $param['question_no'] = $this->input->post('question_no');
            $param['question_no'] = str_replace(' ', '', $param['question_no']);
            $param['question_type'] = $this->input->post('question_type');
            $param['course_type_id'] = $this->input->post('course_type_id');
            $param['difficult_type'] = $this->input->post('difficult_type');
            $param['question_content'] = $this->input->post('question_content');
            $param['question_answer'] = $this->input->post('question_answer');
            $param['question_description'] = $this->input->post('question_description');

            $old = $this->mainModel->get_single(array('question_no' => $param['question_no']));

            if ($old != null) {
                $id = $old->id;
                $param['update_time'] = date("Y-m-d H:i:s");

                $questionId = $this->mainModel->edit($param, $id);
            } else {
                $param['status'] = 0;
                $param['create_time'] = date("Y-m-d H:i:s");
                $param['update_time'] = date("Y-m-d H:i:s");

                $questionId = $this->mainModel->add($param);
            }

            $ret['data'] = '上传成功';
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function publishItem()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            if (!$this->adminsignin_m->loggedin()) {
                echo json_encode($ret);
                return;
            }
            $id = $_POST['id'];
            $status = $_POST['status'];
            $items = $this->mainModel->publish($id, $status);
            $ret['data'] = '操作成功';//$this->output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function deleteItem()
    {
        $ret = array(
            'data' => '操作失败',
            'status' => 'fail'
        );
        if ($_POST) {
            if (!$this->adminsignin_m->loggedin()) {
                echo json_encode($ret);
                return;
            }
            $id = $_POST['id'];
            $list = $this->mainModel->delete($id);
            $ret['data'] = '操作成功';//$this->output_content($list);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    function checkRole($id = 12)
    {
        $permission = $this->session->userdata('admin_user_type');
        if ($permission != NULL) {
            $permissionData = (array)(json_decode($permission));
            $accessInfo = $permissionData['menu_' . $id];
            if ($accessInfo == '1') return true;
            else return false;
        }
        return false;
    }
}

?>