<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends Admin_Controller
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
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");

        $this->mainModel = $this->contents_m;
    }

    public function index()
    {
        $this->data['title'] = '资源管理';
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";

        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();
        $this->data['contentTypeList'] = $this->contenttype_m->getItems();

        $filter = array();
        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');
        $queryStr = '';
        if ($_POST) {
            $this->session->unset_userdata('filter');
            $_POST['search_no'] != '' && $filter['tbl_huijiao_contents.content_no'] = $_POST['search_no'];
            $_POST['search_title'] != '' && $queryStr = $_POST['search_title'];
            $_POST['search_content_type'] != '' && $filter['tbl_huijiao_contents.content_type_no'] = $_POST['search_content_type'];
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $_POST['search_course_type'] != '' && $filter['tbl_huijiao_contents.course_type_id'] = $_POST['search_course_type'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');

        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $queryStr);
        $ret = $this->paginationCompress('admin/contents/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $queryStr);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/contents";

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
            $no = $unit->content_no;
            if ($no == null || $no == '') $no = '(用户上传)';
            $iconPath = '';
            $iconCorner = '';
            if ($unit->icon_path != null && $unit->icon_path != '') $iconPath = base_url() . $unit->icon_path;
            if ($unit->icon_corner != null && $unit->icon_corner != '') $iconCorner = base_url() . $unit->icon_corner;

            $iconPath_m = '';
            $iconCorner_m = '';
            if ($unit->icon_path_m != null && $unit->icon_path_m != '') $iconPath_m = base_url() . $unit->icon_path_m;
            if ($unit->icon_corner_m != null && $unit->icon_corner_m != '') $iconCorner_m = base_url() . $unit->icon_corner_m;

            $contentPath = '';
            if ($unit->content_path != null && $unit->content_path != '') $contentPath = base_url() . $unit->content_path;
            $output .= '<tr>';
            $output .= '<td>' . $no . '</td>';
            $output .= '<td>' . $unit->title . '</td>';
            $output .= '<td><div style="width: 35px;height:25px;position: relative;display: inline-block;">'
                . (($iconPath != '') ? ('<img src="' . $iconPath . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . (($iconCorner != '') ? ('<img src="' . $iconCorner . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . '</div></td>';
            $output .= '<td><div style="width: 35px;height:25px;position: relative;display: inline-block;">'
                . (($iconPath_m != '') ? ('<img src="' . $iconPath_m . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . (($iconCorner_m != '') ? ('<img src="' . $iconCorner_m . '" style="position:absolute;height:100%;width:100%;left:0;top:0;">') : '')
                . '</div></td>';
            $output .= '<td>' . $unit->course_type . '</td>';
            $output .= '<td>' . $unit->subject . '</td>';
            $output .= '<td>' . $unit->term . '</td>';
            $output .= '<td>' . $unit->content_type . '</td>';
            $output .= '<td>' . $unit->update_time . '</td>';
            $output .= '<td>';
            $output .= '<button'
                . ' class="btn btn-sm ' . ($editable ? 'btn-success' : 'disabled') . '" '
                . ' onclick = "' . ($editable ? 'editItem(this);' : '') . '" '
                . ' data-id = "' . $unit->id . '" '
                . ' data-subject = "' . $unit->subject_id . '" '
                . ' data-additional = "' . $unit->additional_info . '" '
                . ' data-course_type = "' . $unit->course_type_id . '" '
                . ' data-content_type = "' . $unit->content_type_no . '" '
                . ' data-icon_path = "' . $iconPath . '" '
                . ' data-icon_corner = "' . $iconCorner . '" '
                . ' data-icon_path_m = "' . $iconPath_m . '" '
                . ' data-icon_corner_m = "' . $iconCorner_m . '" '
                . ' data-content_path = "' . $contentPath . '" '
                . ' data-is_download = "' . $unit->is_download . '" '
                . ' data-is_mobile = "' . $unit->is_mobile . '" '
                . ' data-term = "' . $unit->term_id . '">'
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

    public function selectFrontContent()
    {
        $this->data['title'] = '资源管理';
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
            $_POST['search_no'] != '' && $filter['tbl_huijiao_contents.content_no'] = $_POST['search_no'];
            $_POST['search_title'] != '' && $filter['tbl_huijiao_contents.title'] = $_POST['search_title'];
            $_POST['search_content_type'] != '' && $filter['tbl_huijiao_contents.content_type_no'] = $_POST['search_content_type'];
            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $_POST['search_course_type'] != '' && $filter['tbl_huijiao_contents.course_type_id'] = $_POST['search_course_type'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');

        $this->data['perPage'] = $perPage = PERPAGE;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter);
        $ret = $this->paginationCompress('admin/contents/index', $cntPage, $perPage, 4);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["list"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage']);

        $this->data["tbl_content"] = $this->output_content($this->data['list']);

        $this->data["subview"] = "admin/contents/contents";

        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
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
            $content_no = $this->input->post('no');
            $content_no = str_replace(' ','',$content_no);
            $title = $this->input->post('title');
            $additional_info = $this->input->post('additional_info');
            $user_id = 0;
            $course_type_id = $this->input->post('course_type_id');
            $content_type_no = $this->input->post('content_type_no');
            $icon_format = $this->input->post('icon_format');
            $icon_m_format = $this->input->post('icon_m_format');
            $content_format = $this->input->post('content_format');
            $additional_format = $this->input->post('additional_format');
            $is_download = ($this->input->post('is_download') != 'on') ? 0 : 1;
            $is_mobile = ($this->input->post('is_mobile') != 'on') ? 0 : 1;
            $config['upload_path'] = "./uploads/content_icons";
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path']);
            }
            $config['allowed_types'] = '*';
            $tt = date('0ymdHis0') . rand(1000, 9999);
            $filename = $id . $tt;
            $this->load->library('upload', $config);

            $icon_path = '';
//            $icon_path = $this->input->post('icon_path');
            if ($_FILES["item_icon_file4"]["name"] != '') {
                $nameSuffix = 'fm';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format;
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
                            $icon_path =substr($config['upload_path'],2) .'/'. $config['file_name'];
                        } else {
                            $ret['data'] = '封面图片上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                }
            }

            $icon_path_m = '';
//            $icon_path = $this->input->post('icon_path');
            if ($_FILES["item_icon_file7"]["name"] != '') {
                $nameSuffix = 'fm_m';
                $config['file_name'] = $filename . $nameSuffix . '.' . $icon_format;
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
                        if ($this->upload->do_upload('item_icon_file7')) {
                            $data = $this->upload->data();
                            $icon_path_m = substr($config['upload_path'],2) .'/'. $config['file_name'];
                        } else {
                            $ret['data'] = '封面图片上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                }
            }

            $content_path = '';
            $content_type_id = 0;
            $config['upload_path'] = "./uploads/content_packages";
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path']);
            }
            if ($_FILES["item_icon_file5"]["name"] != '') {
                $nameSuffix = 'nr';
                $config['file_name'] = $filename . $nameSuffix . '.' . $content_format;
                if(file_exists(substr($config['upload_path'],2) .'/'. $config['file_name'])){
                    unlink(substr($config['upload_path'],2) .'/'. $config['file_name']);
                }

                $this->upload->initialize($config, TRUE);
                //.zip,.png,.jpg,.bmp,.gif,.jpeg,.mp4,.mp3,.pdf,.html,.htm,.doc,.docx,.ppt,.pptx
                switch ($content_format) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $content_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                            $content_type_id = '3';
                        } else {
                            $ret['data'] = '内容图片上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    case 'mp3':
                    case 'wav':
                    case 'mp4':
                        ///Video file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $content_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                            $content_type_id = '2';
                        } else {
                            $ret['data'] = '音频或视频上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    case 'doc':
                    case 'docx':
                    case 'ppt':
                    case 'pptx':
                        ///Video file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $content_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                            $content_type_id = '4';
                        } else {
                            $ret['data'] = 'OFFICE文档上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    case 'pdf':
                        ///Video file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $content_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                            $content_type_id = '5';
                        } else {
                            $ret['data'] = 'PDF文档上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    case 'html':
                    case 'htm':
                        ///Video file uploading........
                        if ($this->upload->do_upload('item_icon_file5')) {
                            $data = $this->upload->data();
                            $content_path = substr($config['upload_path'],2) .'/'. $config['file_name'];
                            $content_type_id = '6';
                        } else {
                            $ret['data'] = 'HTML文档上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    case 'zip':
                        ///Package file uploading.......
                        if ($this->upload->do_upload('item_icon_file5')) {

                            $uploadPath = substr($config['upload_path'],2) .'/'. $filename . $nameSuffix;
                            if (is_dir($uploadPath)) {
                                $this->rrmdir($uploadPath);
                            }
                            mkdir($uploadPath, 0755, true);
                            $configPackage['upload_path'] = './' . $uploadPath;
                            $configPackage['allowed_types'] = '*';
                            $configPackage['file_name'] = $filename . $nameSuffix . '.' . $content_format;
                            $this->load->library('upload', $configPackage);
                            $this->upload->initialize($configPackage, TRUE);
                            if ($this->upload->do_upload('item_icon_file5')) {
                                $zipData = $this->upload->data();
                                $zip = new ZipArchive;
                                $file = $zipData['full_path'];
                                chmod($file, 0777);
                                if ($zip->open($file) === TRUE) {
                                    $zip->extractTo($configPackage['upload_path']);
                                    $zip->close();
//                                unlink($file);
                                } else {
                                    $ret['data'] = 'H5包解压错误' . $this->upload->display_errors();
                                    echo json_encode($ret); // failed
                                }
                                $content_path = $uploadPath;
                                $content_type_id = '1';
                            } else {
                                $ret['data'] = $this->upload->display_errors();
                                echo json_encode($ret);
                                return;
                            }
                        }else {
                            $ret['data'] = 'H5包上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    default:
                        $ret['data'] = '内容格式错误';
                        echo json_encode($ret);
                        return;
                        break;
                }
            }

            $additional_info = '';
            if ($_FILES["item_icon_file6"]["name"] != '') {
                $nameSuffix = 'fj';
                $config['file_name'] = $filename . $nameSuffix . '.' . $additional_format;
                if(file_exists(substr($config['upload_path'],2) .'/'. $config['file_name'])){
                    unlink(substr($config['upload_path'],2) .'/'. $config['file_name']);
                }

                $this->upload->initialize($config, TRUE);
                //.zip,.png,.jpg,.bmp,.gif,.jpeg,.mp4,.mp3,.pdf,.html,.htm,.doc,.docx,.ppt,.pptx
                switch ($additional_format) {
                    case 'gif':
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                    case 'mp3':
                    case 'wav':
                    case 'mp4':
                    case 'doc':
                    case 'docx':
                    case 'ppt':
                    case 'pptx':
                    case 'pdf':
                    case 'html':
                    case 'htm':
                    case 'zip':
                        ///Image file uploading........
                        if ($this->upload->do_upload('item_icon_file6')) {
                            $data = $this->upload->data();
                            $additional_info = substr($config['upload_path'],2) .'/'. $config['file_name'];
                        } else {
                            $ret['data'] = '附件内容上传错误' . $this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                        break;
                    default:
                        $ret['data'] = '附件内容格式错误';
                        echo json_encode($ret);
                        return;
                        break;
                }
            }
            //At first insert new coureware information to the database table
            $old = $this->contents_m->get_single(array('id' => $id));
            if ($old != null) {
                $param = array(
                    'content_no' => $content_no . '',
                    'title' => $title . '',
                    'user_id' => $user_id . '',
                    'is_download' => $is_download,
                    'is_mobile' => $is_mobile,
                    'course_type_id' => $course_type_id . '',
                    'content_type_id' => $content_type_id . '',
                    'content_type_no' => $content_type_no . '',
                    'update_time' => date("Y-m-d H:i:s"),
                );
                if ($icon_path != '') $param['icon_path'] = $icon_path;
                if ($icon_path_m != '') $param['icon_path_m'] = $icon_path_m;
                if ($content_path != '') $param['content_path'] = $content_path;
                if ($additional_info != '') $param['additional_info'] = $additional_info;

                $contentId = $this->contents_m->edit($param, $id);
            } else {
                $param = array(
                    'content_no' => $content_no . '',
                    'title' => $title . '',
                    'status' => 0,
                    'is_download' => $is_download,
                    'is_mobile' => $is_mobile,
                    'user_id' => $user_id . '',
                    'course_type_id' => $course_type_id . '',
                    'content_type_id' => $content_type_id . '',
                    'content_type_no' => $content_type_no . '',
                    'create_time' => date("Y-m-d H:i:s"),
                    'update_time' => date("Y-m-d H:i:s"),
                );
                if ($icon_path != '') $param['icon_path'] = $icon_path;
                if ($icon_path_m != '') $param['icon_path_m'] = $icon_path_m;
                if ($content_path != '') $param['content_path'] = $content_path;
                if ($additional_info != '') $param['additional_info'] = $additional_info;

                $contentId = $this->contents_m->add($param);
            }

            $ret['data'] = '上传成功';
            $ret['contentItem'] = $this->contents_m->get_single(array('id' => $contentId));
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

    function checkRole($id = 10)
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