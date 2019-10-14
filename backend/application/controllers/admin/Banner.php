<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends Admin_Controller
{

    protected $mainModel;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->load->model("banner_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->banner_m;
    }

    public function index()
    {
        $this->data['title'] = 'Banner管理';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $filter = array();
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $_POST['search_no'] != '' && $filter['banner.banner_no'] = $_POST['search_no'];
//            $_POST['search_title'] != '' && $filter['tbl_huijiao_course_type.title'] = $_POST['search_title'];
//            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.title'] = $_POST['search_term'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
//            $filter = array();
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter')!='' && $filter = $this->session->userdata('filter');
        if(!isset($filter['tbl_huijiao_banner.banner_no'])) $this->session->unset_userdata('filter');
        $filter['banner.type']=0;
        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter);
        $ret = $this->paginationCompress('admin/banners/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage']);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/banner/banners";

        if (!$this->checkRole(20)) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function mobile()
    {
        $this->data['title'] = 'Banner管理';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $filter = array();
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $_POST['search_no'] != '' && $filter['banner.banner_no'] = $_POST['search_no'];
//            $_POST['search_title'] != '' && $filter['tbl_huijiao_course_type.title'] = $_POST['search_title'];
//            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.title'] = $_POST['search_term'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
//            $filter = array();
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter')!='' && $filter = $this->session->userdata('filter');
        if(!isset($filter['tbl_huijiao_banner.banner_no'])) $this->session->unset_userdata('filter');
        $filter['banner.type']=1;

        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter);
        $ret = $this->paginationCompress('admin/banners/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage']);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/banner/mobile";

        if (!$this->checkRole(30)) {
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
            if ($unit->icon_path != null && $unit->icon_path != '') $iconPath = base_url() . 'uploads/'.$unit->icon_path;
            $iconPath_m = '';
            if ($unit->icon_path_m != null && $unit->icon_path_m != '') $iconPath_m = base_url() . 'uploads/'.$unit->icon_path_m;

            $output .= '<tr>';
            $output .= '<td>' . $unit->banner_no . '</td>';
            $output .= '<td>' . ($iconPath != '' ? ('<img src="' . $iconPath . '" style="height: 60px;">') : '') . '</td>';
            $output .= '<td>' . $unit->sort_order . '</td>';
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
            $sort_order = $_POST['sort_order'];
            $type = 0;
            if($_POST['type']) $type = $_POST['type'];

            $icon_format = $this->input->post('icon_format');
            $icon_format_m = $this->input->post('icon_format_m');
            $config['upload_path'] = "./uploads";
            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = $no;
            $this->load->library('upload', $config);

            $icon_path = '';
            if ($_FILES["item_icon_file4"]["name"] != '') {
                $nameSuffix = 'bnr';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format;
                if(file_exists(substr($config['upload_path'],2) .'/'. $config['file_name'])){
                    unlink(substr($config['upload_path'],2) .'/'. $config['file_name']);
                }

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
                            $icon_path = $config['file_name'];
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
            if (false && $_FILES["item_icon_file5"]["name"] != '') {
                $nameSuffix = 'bnrm';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format_m;
                if(file_exists(substr($config['upload_path'],2) .'/'. $config['file_name'])){
                    unlink(substr($config['upload_path'],2) .'/'. $config['file_name']);
                }
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
                            $icon_path_m = $config['file_name'];
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
                'banner_no' => $no,
                'type'=>$type,
                'sort_order' => $sort_order,
                'update_time' => date('Y-m-d H:i:s')
            );
            if($icon_path!='') $arr['icon_path'] = $icon_path;
            if($icon_path_m!='') $arr['icon_path_m'] = $icon_path_m;
            if ($id == 0) {
                $arr['status'] = 0;
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
            $items = $this->mainModel->publish($id, $status);
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

    function checkRole($id = 20)
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