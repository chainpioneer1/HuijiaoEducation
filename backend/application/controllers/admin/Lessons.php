<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends Admin_Controller
{

    protected $mainModel;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->load->model("subject_m");
        $this->load->model("terms_m");
        $this->load->model("coursetype_m");
        $this->load->model("contenttype_m");
        $this->load->model("contents_m");
        $this->load->model("lessons_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->lessons_m;
    }

    public function index()
    {
        $this->data['title'] = '课件管理';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";

        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();
        $this->data['contentTypeList'] = $this->contenttype_m->getItems();

        $filter = array();
        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');

        if ($_POST) {
            $this->session->unset_userdata('filter');
            $_POST['search_no'] != '' && $filter['tbl_huijiao_lessons.lesson_no'] = $_POST['search_no'];
            $_POST['search_title'] != '' && $filter['tbl_huijiao_lessons.title'] = $_POST['search_title'];
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        $filter['tbl_huijiao_lessons.user_id'] = 0;
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter);
        $ret = $this->paginationCompress('admin/lessons/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage']);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/lessons";

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
        foreach ($items as $unit):
            $editable = $unit->status == 0;

            $iconPath = '';
            if ($unit->image_icon != null && $unit->image_icon != '') $iconPath = base_url() . $unit->image_icon;

            $output .= '<tr>';
            $output .= '<td>' . $unit->coursetype_no . '</td>';
            $output .= '<td>' . $unit->title . '</td>';
            $output .= '<td><div style="width: 35px;height:25px;position: relative;display: inline-block;">'
                . (($iconPath != '') ? ('<img src="' . $iconPath . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . '</div></td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->update_time . '</td>';
            $output .= '<td>';
            $icon_path = $unit->image_icon;
            if ($icon_path == null || $icon_path == '') $icon_path = '';
            else $icon_path = base_url() . $icon_path;
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'editItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '" '
                . ' data-subject = "' . $unit->subject_id . '" '
                . ' data-term = "' . $unit->term_id . '" '
                . ' data-icon_path = "' . $icon_path . '" '
                . ' data-lessons = \'' . $unit->lesson_info . '\'> '
                . $btn_str[2] . '</button>';
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-danger' : 'disabled') . '"'
                . ' onclick = "' . ($editable ? 'deleteItem(this);' : '') . '"'
                . ' data-id = "' . $unit->id . '">'
                . $btn_str[3] . '</button>';
            $output .= '<button'
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
            $id = str_replace(' ', '', $id);
            $param = array();
            $param['title'] = $this->input->post('title');
            $param['term_id'] = $this->input->post('term_id');
            $param['user_id'] = 0;
            $param['lesson_info'] = $this->input->post('lesson_info');

            $config['upload_path'] = "./uploads/lessons";
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path']);
            }
            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = 'qd' . $id . $tt;
            $this->load->library('upload', $config);

            $icon_format = $this->input->post('icon_format');

            $icon_path = '';
            if ($_FILES["item_icon_file4"]["name"] != '') {
                $config['file_name'] = $filename . '_icon' . '.' . $icon_format;
                if(file_exists(substr($config['upload_path'],2) .'/'. $config['file_name'])){
                    unlink(substr($config['upload_path'],2) .'/'. $config['file_name']);
                }
                $this->upload->initialize($config, TRUE);
                switch ($icon_format) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file4')) {
                            $data = $this->upload->data();
                            $icon_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                        } else {
                            $ret['data'] = '封面图片上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                }
            }
            //At first insert new coureware information to the database table
            $old = $this->mainModel->get_single(array('id' => $id));

            $lessonInfo = json_decode($param['lesson_info']);
            $course_type_id = $this->contents_m->get_single(array('id' => $lessonInfo[0]))->course_type_id;
            $param['course_type_id'] = $course_type_id;

            if ($old != null) {
                $param['update_time'] = date("Y-m-d H:i:s");
                if ($icon_path != '') $param['image_icon'] = $icon_path;

                $contentId = $this->mainModel->edit($param, $id);
            } else {
                $param['status'] = 0;
                $param['create_time'] = date("Y-m-d H:i:s");
                $param['update_time'] = date("Y-m-d H:i:s");

                if ($icon_path != '') $param['image_icon'] = $icon_path;

                $contentId = $this->mainModel->add($param);
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
        if (!$this->adminsignin_m->loggedin()) {
            echo json_encode($ret);
            return;
        }
        if ($_POST) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            if ($id < 0) {
                $filter = array();
                $this->session->userdata('filter') != null && $filter = $this->session->userdata('filter');
                $pageId = 0;
                if (isset($_POST['pageId'])) $pageId = $_POST['pageId'];
                $perPage = PERPAGE;
                $lists = $this->mainModel->getItemsByPage($filter, $pageId, $perPage);
                foreach ($lists as $item) $this->mainModel->publish($item->id, $status);
            } else {
                $this->mainModel->publish($id, $status);
            }
            $ret['data'] = $ret['data'] = '操作成功';//$this->output_content($items);
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

    function checkRole($id = 11)
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