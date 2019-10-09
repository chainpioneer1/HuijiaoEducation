<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recommend extends Admin_Controller
{

    protected $mainModel;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->load->model("subject_m");
        $this->load->model("terms_m");
        $this->load->model("coursetype_m");
        $this->load->model("contents_m");
        $this->load->model("recommend_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->recommend_m;
    }

    public function index()
    {
        $this->data['title'] = '资源精选管理';
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
            $_POST['search_no'] != '' && $filter['tbl_huijiao_recommend.recommend_no'] = $_POST['search_no'];
            if ($_POST['search_title'] != '') {
                $search_keyword = "(tbl_huijiao_subject.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_terms.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_content_type.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_contents.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_course_type.title like '%" . $_POST["search_title"] . "%' )";
                $this->session->set_userdata('keyword', $_POST["search_title"]);
            }
//            $_POST['search_title'] != '' && $filter['tbl_huijiao_contents.title'] = $_POST['search_title'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
//            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        if (!isset($filter['tbl_huijiao_recommend.recommend_no']) && $search_keyword == '')
            $this->session->unset_userdata('filter');
        $filter['tbl_huijiao_recommend.type'] = 0;
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $search_keyword);
        $ret = $this->paginationCompress('admin/recommend/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $search_keyword);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/recommend";

        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function lessons()
    {
        $this->data['title'] = '课件精选管理';
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
            $_POST['search_no'] != '' && $filter['tbl_huijiao_recommend.recommend_no'] = $_POST['search_no'];
            if ($_POST['search_title'] != '') {
                $search_keyword = "(tbl_huijiao_subject.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_terms.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_course_type.title like '%" . $_POST["search_title"] . "%' )";
                $this->session->set_userdata('keyword', $_POST["search_title"]);
            }
//            $_POST['search_title'] != '' && $filter['tbl_huijiao_contents.title'] = $_POST['search_title'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
//            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        if (!isset($filter['tbl_huijiao_recommend.recommend_no']) && $search_keyword == '')
            $this->session->unset_userdata('filter');
        $filter['tbl_huijiao_recommend.type'] = 1;
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $search_keyword);
        $ret = $this->paginationCompress('admin/recommend/lessons', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $search_keyword);

        $this->data["tbl_content"] = $this->output_content_lesson($this->data['list']);

        $this->data["subview"] = "admin/contents/recommend_lesson";

        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function mobile($type)
    {
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";

        if (!$type) $type = 2;
        $titleArr = ['资源精选管理', '小学语文', '小学数学', '初中数学', '初中物理'];
        $this->data['title'] = $titleArr[$type - 2];
        $this->data['recommendType'] = '11'.($type+2);


        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();

        $filter = array();
        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');
        $search_keyword = '';
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $this->session->unset_userdata('keyword');
            $_POST['search_no'] != '' && $filter['tbl_huijiao_recommend.recommend_no'] = $_POST['search_no'];
            if ($_POST['search_title'] != '') {
                $search_keyword = "(tbl_huijiao_subject.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_terms.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_content_type.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_contents.title like '%" . $_POST["search_title"] . "%' ";
                $search_keyword .= "or tbl_huijiao_course_type.title like '%" . $_POST["search_title"] . "%' )";
                $this->session->set_userdata('keyword', $_POST["search_title"]);
            }
//            $_POST['search_title'] != '' && $filter['tbl_huijiao_contents.title'] = $_POST['search_title'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
//            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        if (!isset($filter['tbl_huijiao_recommend.recommend_no']) && $search_keyword == '')
            $this->session->unset_userdata('filter');
        $filter['tbl_huijiao_recommend.type'] = $type;
        $this->data['perPage'] = $perPage = 20;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $search_keyword);
        $ret = $this->paginationCompress('admin/recommend/mobile/'.$type, $cntPage, $perPage, 5);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $search_keyword);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/recommend_mobile";

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
            if ($unit->icon_path != null && $unit->icon_path != '') $iconPath = base_url() . $unit->icon_path;
            $iconCorner = '';
            if ($unit->icon_corner != null && $unit->icon_corner != '') $iconCorner = base_url() . $unit->icon_corner;

            $output .= '<tr>';
            $output .= '<td>' . $unit->recommend_no . '</td>';
            $output .= '<td><div style="width: 35px;height:25px;position: relative;display: inline-block;">'
                . (($iconPath != '') ? ('<img src="' . $iconPath . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . (($iconCorner != '') ? ('<img src="' . $iconCorner . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . '</div></td>';
            $output .= '<td>' . $unit->content . '</td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->update_time . '</td>';
            $output .= '<td>';
            $icon_path = $unit->icon_path;
            if ($icon_path == null || $icon_path == '') $icon_path = '';
            else $icon_path = $icon_path;
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'editItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '" '
                . ' data-content = "' . $unit->content_id . '" '
                . ' data-subject = "' . $unit->subject_id . '" '
                . ' data-course-type = "' . $unit->course_type_id . '" '
                . ' data-term = "' . $unit->term_id . '" '
                . ' data-icon_path = "' . $icon_path . '" '
                . '> '
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

    public function output_content_lesson($items)
    {
        $admin_id = $this->session->userdata("admin_loginuserID");
        $output = '';
        $btn_str = ['启用', '禁用', '修改', '删除'];
        foreach ($items as $unit):
            $editable = $unit->status == 0;

            $iconPath = '';
            if ($unit->icon_path != null && $unit->icon_path != '') $iconPath = base_url() . $unit->icon_path;

            $output .= '<tr>';
            $output .= '<td>' . $unit->recommend_no . '</td>';
            $output .= '<td><div style="width: 35px;height:25px;position: relative;display: inline-block;">'
                . (($iconPath != '') ? ('<img src="' . $iconPath . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . '</div></td>';
            $output .= '<td>' . $unit->lesson . '</td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->update_time . '</td>';
            $output .= '<td>';
            $icon_path = $unit->icon_path;
            if ($icon_path == null || $icon_path == '') $icon_path = '';
            else $icon_path = base_url() . $icon_path;
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'editItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '" '
                . ' data-content = "' . $unit->content_id . '" '
                . ' data-subject = "' . $unit->subject_id . '" '
                . ' data-course-type = "' . $unit->course_type_id . '" '
                . ' data-term = "' . $unit->term_id . '" '
                . ' data-icon_path = "' . $icon_path . '" '
                . '> '
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
            $param = array();
            $param['recommend_no'] = $this->input->post('recommend_no');
            $param['content_id'] = $this->input->post('content_id');
            $param['type'] = $this->input->post('recommend_type');
            $param['user_id'] = 0;

            $config['upload_path'] = "./uploads/contents";
            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = 'qd' . $id . $tt;
            $this->load->library('upload', $config);

            $icon_format = $this->input->post('icon_format');

            $icon_path = '';

            if ($_FILES["item_icon_file4"]["name"] != '') {
                $config['file_name'] = $filename . '_rcm' . '.' . $icon_format;
                $this->upload->initialize($config, TRUE);
                switch ($icon_format) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file4')) {
                            $data = $this->upload->data();
                            $icon_path = 'uploads/contents/' . $filename . '_rcm' . '.' . $icon_format;
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

    function checkRole()
    {
        $permission = $this->session->userdata('admin_user_type');
        if ($permission != NULL) {
            $permissionData = json_decode($permission);
            $accessInfo = $permissionData->menu_11;
            if ($accessInfo == '1') return true;
            else return false;
        }
        return false;
    }
}

?>