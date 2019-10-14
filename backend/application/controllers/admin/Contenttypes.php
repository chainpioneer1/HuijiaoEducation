<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contenttypes extends Admin_Controller
{

    protected $mainModel;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->load->model("contenttype_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->contenttype_m;
    }

    public function index()
    {
        $this->data['title'] = '资源类型分类';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $filter = array();
        if (false && $_POST) {
            $_POST['search_no'] != '' && $filter['tbl_huijiao_course_type.coursetype_no'] = $_POST['search_no'];
            $_POST['search_title'] != '' && $filter['tbl_huijiao_course_type.title'] = $_POST['search_title'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.title'] = $_POST['search_term'];
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $filter = array();
            $this->session->set_userdata('filter', $filter);
        }
        //$this->session->userdata('filter')!='' && $filter = $this->session->userdata('filter');

        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter);
        $ret = $this->paginationCompress('admin/contenttypes/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage']);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/categories/contenttypes";

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
            $iconPath_m = '';
            if ($unit->icon_path_m != null && $unit->icon_path_m != '') $iconPath_m = base_url() . $unit->icon_path_m;

            $output .= '<tr>';
            $output .= '<td>' . $unit->contenttype_no . '</td>';
            $output .= '<td>' . $unit->title . '</td>';
//            $output .= '<td>' . ($iconPath != '' ? ('<img src="' . $iconPath . '" style="height: 25px;">') : '') . '</td>';
//            $output .= '<td>' . ($iconPath_m != '' ? ('<img src="' . $iconPath_m . '" style="height: 25px;">') : '') . '</td>';
            $output .= '<td>' . $unit->create_time . '</td>';
            $output .= '<td>';
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'editItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '" '
                . ' data-icon_path_m = "' . $iconPath_m . '" '
                . ' data-icon_path = "' . $iconPath . '">'
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
            $id = $_POST['id'];
            $no = $_POST['no'];
            $title = $_POST['title'];
            $no = str_replace(' ','',$no);

            $icon_format = $this->input->post('icon_format');
            $icon_format_m = $this->input->post('icon_format_m');
            $config['upload_path'] = "./uploads/contents";
            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = $no . $tt;
            $this->load->library('upload', $config);

            $icon_path = '';
            if ($_FILES["item_icon_file4"]["name"] != '') {
                $nameSuffix = 'jb';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format;
                $this->upload->initialize($config, TRUE);
                switch ($icon_format) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file4')) {
                            $data = $this->upload->data();
                            $icon_path = 'uploads/contents/' . $filename . $nameSuffix . '.' . $icon_format;
                        } else {
                            $ret['data'] = 'PC端封面图上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                }
            }

            $icon_path_m = '';
            if ($_FILES["item_icon_file5"]["name"] != '') {
                $nameSuffix = 'jbm';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format_m;
                $this->upload->initialize($config, TRUE);
                switch ($icon_format_m) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $icon_path_m = 'uploads/contents/' . $filename . $nameSuffix . '.' . $icon_format_m;
                        } else {
                            $ret['data'] = '移动端封面图上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                }
            }


            $arr = array(
                'contenttype_no' => $no,
                'title' => $title,
                'update_time' => date('Y-m-d H:i:s')
            );
            if($icon_path!='') $arr['icon_path'] = $icon_path;
            if($icon_path_m!='') $arr['icon_path_m'] = $icon_path_m;
            if ($id == 0) {
                $arr['create_time'] = date('Y-m-d H:i:s');
                $id = $this->mainModel->add($arr);
            } else {
                $id = $this->mainModel->edit($arr, $id);
            }
            $ret['data'] = '操作成功';//$this->output_content($this->mainModel->getItems());
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
                if(isset($_POST['pageId']))$pageId =$_POST['pageId'];
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
        if (!$this->adminsignin_m->loggedin()) {
            echo json_encode($ret);
            return;
        }
        if ($_POST) {
            $id = $_POST['id'];
            $list = $this->mainModel->delete($id);
            $ret['data'] = $ret['data'] = '操作成功';//$this->output_content($list);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    function checkRole($id = '03')
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