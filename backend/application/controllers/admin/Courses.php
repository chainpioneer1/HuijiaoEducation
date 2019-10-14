<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $language = 'chinese';
        $this->load->model("schools_m");
        $this->load->model("lessons_m");
        $this->load->model("courses_m");
        $this->load->model("package_m");
        $this->load->model("problemset_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
        $this->load->library("session");
    }

    public function index($site_id = 1)
    {
        $this->data['site_id'] = $site_id;
//        $this->data['schools'] = $this->schools_m->getItems($site_id);
//        $this->data['categories'] = $this->categories_m->getItems($site_id);
        $this->data['lessons'] = $this->lessons_m->getItems($site_id);
        $this->data['items'] = $this->courses_m->getDetailItems($site_id);
        $this->data["subview"] = "admin/contents/courses";
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $this->data["tbl_content"] = $this->output_content($this->data['items']);
        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function output_content($items)
    {
        $output = '';
        $status_str = [$this->lang->line('status_stopped'), $this->lang->line('status_normal')];

        $j = 0;
        foreach ($items as $unit):
            if ($unit->owner_type != '0') continue;
            $j++;
            $Editable = true;
            $btn_str = [
                $this->lang->line('update'),
                $this->lang->line('delete'),
                $this->lang->line('enable'),
                $this->lang->line('move2up'),
                $this->lang->line('move2down')
            ];
            if ($unit->course_status == '1') {
                $Editable = false;
                $btn_str[2] = $this->lang->line('disable');
            }
            $course_image = ($unit->image_path == null) ? '' : (base_url() . $unit->image_path);
            $course_upload_status = ($unit->course_path == null) ? '' : $this->lang->line('status_uploaded');
            $output .= '<tr>';
            $output .= '<td>' . $unit->course_id . '</td>';
            $output .= '<td>' . $unit->course_name . '</td>';
            $output .= '<td>' . $unit->lesson_name . '</td>';
            $output .= '<td>' . $unit->site_name . '</td>';
            $output .= '<td>' . $unit->information . '</td>';
            $output .= '<td><span><div class="image_icon" item_id="' . $unit->id . '"'
                . ' src="' . $course_image . '" '
                . ' style="width:25px; height:25px;display:inline-block;border-radius:5px;'
                . ' background:url(' . $course_image . ');background-size:100% 100%!important;">'
                . '</div></span></td>';
            $output .= '<td>' . $course_upload_status . '</td>';
//            $output .= '<td>' . $status_str[$unit->course_status] . '</td>';
            $output .= '<td>';
            $output .= '<button class="btn btn-sm ' . (!$Editable ? 'disabled' : 'btn-success') . '"'
                . ' onclick = "' . ($Editable ? 'update_item(this);' : '') . '"'
                . ' item_name="' . $unit->course_name . '" '
                . ' item_sortnumber="' . $unit->course_id . '" '
                . ' item_lesson="' . $unit->lesson_id . '" '
                . ' item_course="' . $unit->course_path . '" '
                . ' item_id ="' . $unit->id . '">' . $btn_str[0] . '</button>';
            $output .= '<button class="btn btn-sm ' . (!$Editable ? 'disabled' : 'btn-danger') . '"'
                . ' onclick = "' . ($Editable ? 'delete_item(this);' : '') . '"'
                . ' item_id ="' . $unit->id . '">' . $btn_str[1] . '</button>';
            $output .= '<button class="btn btn-sm ' . ($Editable ? 'btn-default' : 'btn-warning') . '"'
                . ' onclick = "publish_item(this);" '
                . ' item_status="' . $unit->course_status . '"'
                . ' item_id = ' . $unit->id . '>' . $btn_str[2] . '</button>';
            $output .= '</td>';
//            $output .= '<td>';
//            $output .= '<button class="btn btn-sm btn-success btn_order_control"'
//                . ' onclick = "update_order(this,-1);"'
//                . ' view_order="' . $j . '"'
//                . ' item_order="' . $unit->sort_order . '"'
//                . ' item_lesson="' . $unit->lesson_id . '" '
//                . ' item_id ="' . $unit->id . '">' . $btn_str[3] . '</button>';
//            $output .= '<button class="btn btn-sm btn-default"'
//                . ' onclick = "update_order(this,1);"'
//                . ' view_order="' . $j . '" '
//                . ' item_order="' . $unit->sort_order . '" '
//                . ' item_lesson="' . $unit->lesson_id . '" '
//                . ' item_id ="' . $unit->id . '">' . $btn_str[4] . '</button>';
//            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function publish_course()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $publish_st = $_POST['publish_state'];
            $site_id = $_POST['site_id'];
            $items = $this->courses_m->publish($item_id, $publish_st, $site_id);
            $ret['data'] = $this->output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_course_order()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $site_id = $_POST['site_id'];
            $arr = $_POST['data'];
            $items = $this->courses_m->edit($arr[0], $arr[0]['id'], $site_id);
            $items = $this->courses_m->edit($arr[1], $arr[1]['id'], $site_id);
            $ret['data'] = $this->output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_course()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        $upload_root = "uploads/course_work/";
        $config['upload_path'] = $upload_root;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);

        if ($_POST) {
            $site_id = $this->input->post('site_id');
            $item_id = $this->input->post('item_id');
            $item_name = $this->input->post('item_name');
            $lesson_id = $this->input->post('lesson_id');
            $course_number = $this->input->post('item_sortnumber');
            $icon_name = $course_number.'_img';
            $package_name = $course_number.'_package';
            if ($item_id == '') {
                $param = array(
                    'course_name' => $item_name,
                    'course_id' => $course_number,
                    'site_id' => $site_id,
                    'owner_type' => 0,
                    'lesson_id' => $lesson_id,
                    'course_status' => 0,
                    'create_time' => date('Y-m-d H:i:s')
                );
                $item_id = $this->courses_m->add($param);
            }
            $item_number = $this->courses_m->getLessonNumberFromId($item_id);
            if ($item_number == '-1') {
                $ret['data'] = 'Record item is not exist.';
                echo json_encode($ret);
                return;
            }

            $param = array(
                'course_name' => $item_name,
                'course_id' => $course_number,
                'lesson_id' => $lesson_id,
                'update_time' => date('Y-m-d H:i:s')
            );
            $fileType = explode(".",$_FILES["item_icon_file4"]["name"]);
            $fileType = $fileType[count($fileType)-1];
            $icon_name.='.'.$fileType;
            if ($_FILES["item_icon_file4"]["name"] != '') {
                //image uploading
                $config['upload_path'] = $upload_root;
                $config['file_name'] = $icon_name;
                $this->upload->initialize($config, TRUE);
                if (file_exists($upload_root . $icon_name))
                    unlink($upload_root . $icon_name);
                if ($this->upload->do_upload('item_icon_file4')) {
                    $data = $this->upload->data();
                    $param['image_path'] = $upload_root . $icon_name;
                } else {///show error message
                    $ret['data'] = $this->upload->display_errors();
                    $ret['status'] = 'fail';
                    echo json_encode($ret);
                    return;
                }
            }
            $old_item = $this->courses_m->get($item_id);
            $oldPath = $old_item->course_path;
            $newPath = $upload_root . $package_name;
            $uploadFile = $_FILES["item_icon_file5"]["name"];
            if ($uploadFile != '') {
//                var_dump(filetype($oldPath), filetype($newPath));
                if ($oldPath != $newPath && is_dir($oldPath))
                    $this->rrmdir($oldPath);
                else if (is_dir($newPath))
                    $this->rrmdir($newPath);

                mkdir($newPath, 0755, true);

                $config['upload_path'] = './' . $newPath;
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config, TRUE);
                if (stristr($uploadFile, '.mp4') == false) {
                    if ($this->upload->do_upload('item_icon_file5'))///this process is success then we have to move current subware to new position
                    {
                        ///---1----. At first New zip file upload and Extract
                        $zipdata = $this->upload->data();
                        $zip = new ZipArchive;
                        $file = $zipdata['full_path'];
                        chmod($file, 0755);
                        if ($zip->open($file) === TRUE) {
                            $zip->extractTo($config['upload_path']);
                            $zip->close();
                            unlink($file);
                            $param['course_path'] = $newPath;
                            $param['course_type'] = "1";
                        } else {
                            $ret['data'] = '上传失败'.$this->upload->display_errors();
                            $ret['status'] = 'fail';
                            echo json_encode($ret);
                            return;
                        }
                    } else {///show error message
                        $ret['data'] = $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                } else {
                    if ($this->upload->do_upload('item_icon_file5')) {
                        $data = $this->upload->data();
                        $param['course_path'] = $newPath . '/' . $data["file_name"];
                    } else {
                        $ret['data'] = $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                }
            }

            $items = $this->courses_m->edit($param, $item_id, $site_id);
            $ret['data'] = $this->output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function delete_course()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $site_id = $_POST['site_id'];
            $old_item = $this->courses_m->get($item_id);
            if (is_dir($old_item->course_path))
                $this->rrmdir($old_item->course_path);
            $items = $this->courses_m->delete_course($item_id, $site_id);
            $ret['data'] = $this->output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function workmanage($site_id = 1)
    {
        $this->data['packages'] = $this->package_m->get_package();
        $this->data['items'] = $this->problemset_m->getItems();
        $this->data["subview"] = "admin/contents/workmanage";
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $this->data["tbl_content"] = $this->work_output_content($this->data['items']);
        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function work_output_content($items)
    {
        $output = '';
        $type_str = [
            $this->lang->line('problem_option'),
            $this->lang->line('problem_yesno'),
            $this->lang->line('problem_norecog'),
            $this->lang->line('problem_recog')
        ];

        $j = 0;
        foreach ($items as $unit):
            $j++;
            $Editable = true;
            $btn_str = [
                $this->lang->line('update'),
                $this->lang->line('enable'),
                $this->lang->line('delete')
            ];
            if ($unit->prob_status == '1') {
                $Editable = false;
                $btn_str[1] = $this->lang->line('disable');
            }
            $output .= '<tr>';
            $output .= '<td>' . $unit->sort_num . '</td>';
            $output .= '<td>' . $unit->prob_name . '</td>';
            $output .= '<td>' . $type_str[$unit->prob_type - 1] . '</td>';
            $output .= '<td>' . $unit->name . '</td>';
            $output .= '<td>' . $unit->site_name . '</td>';
            $output .= '<td>';
            $output .= '<button class="btn btn-sm ' . (!$Editable ? 'disabled' : 'btn-success') . '"'
                . ' onclick = "' . ($Editable ? 'update_item(this);' : '') . '"'
                . ' item_info = \'' . ($Editable ? json_encode($unit) : '') . '\''
                . ' item_id ="' . $unit->id . '">' . $btn_str[0] . '</button>';
            $output .= '<button class="btn btn-sm ' . ($Editable ? 'btn-default' : 'btn-warning') . '"'
                . ' onclick = "publish_item(this);" '
                . ' item_status="' . $unit->prob_status . '"'
                . ' item_id = ' . $unit->id . '>' . $btn_str[1] . '</button>';
            $output .= '<button class="btn btn-sm ' . (!$Editable ? 'disabled' : 'btn-danger') . '"'
                . ' onclick = "' . ($Editable ? 'delete_item(this);' : '') . '"'
                . ' item_id ="' . $unit->id . '">' . $btn_str[2] . '</button>';
            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function publish_problem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $publish_st = $_POST['publish_state'];
            $site_id = $_POST['site_id'];
            $items = $this->problemset_m->publish($item_id, $publish_st, $site_id);
            $ret['data'] = $this->work_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_problem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        $upload_root = "uploads/problem_set/";
        $config['upload_path'] = $upload_root;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $param = array();
        $item_id = '0';
        $sort_num = '0';
        if ($_POST) {
            $sort_num = $this->input->post('sort_num');
            $item_id = $this->input->post('item_id');

            $param = array(
                'prob_name' => $this->input->post('prob_name'),
                'site_id' => '1',
                'package_id' => $this->input->post('package_id'),
                'sort_num' => $sort_num,
                'prob_type' => $this->input->post('prob_type'),
                'prob_answer' => $this->input->post('prob_answer'),
                'ans_txt' => $this->input->post('ans_txt')
            );
            if ($item_id == '') {
                $param['prob_status'] = '0';
                $param['create_time'] = date('Y-m-d H:i:s');
                $item_id = $this->problemset_m->add($param);
            }
            $item = $this->problemset_m->get_where(array('id' => $item_id))[0];
            if ($item == null) {
                $ret['data'] = 'Record item is not exist.';
                echo json_encode($ret);
                return;
            }
            $item_id = $item->id;
            $fields = ['prob_img', 'prob_sound', 'ans_img1', 'ans_img2', 'ans_img3', 'ans_img4'];

            for ($j = 0; $j < 6; $j++) {
                $type = explode('.', $_FILES[$fields[$j]]["name"]);
                $type = $type[count($type) - 1];
                if ($_FILES[$fields[$j]]["name"] != '') {
                    //image uploading
                    $config['upload_path'] = $upload_root;
                    $config['file_name'] = $sort_num . '_' . $fields[$j] . '.' . $type;
                    $this->upload->initialize($config, TRUE);
                    if (file_exists($upload_root . $config['file_name']))
                        unlink($upload_root . $config['file_name']);
                    if ($this->upload->do_upload($fields[$j])) {
                        $data = $this->upload->data();
                        $param[$fields[$j]] = $upload_root . $config['file_name'];
                    } else {///show error message
                        $ret['data'] = $this->upload->display_errors();
                        $ret['status'] = 'fail';
                        echo json_encode($ret);
                        return;
                    }
                }
            }
            $items = $this->problemset_m->edit($param, $item_id);
            $ret['data'] = $this->work_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function delete_problem()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $site_id = $_POST['site_id'];
            $old_item = $this->problemset_m->get($item_id);
            if (is_file($old_item->prob_img))
                unlink($old_item->prob_img);
            if (is_file($old_item->prob_sound))
                unlink($old_item->prob_sound);
            if (is_file($old_item->ans_img1))
                unlink($old_item->ans_img1);
            if (is_file($old_item->ans_img2))
                unlink($old_item->ans_img2);
            if (is_file($old_item->ans_img3))
                unlink($old_item->ans_img3);
            if (is_file($old_item->ans_img4))
                unlink($old_item->ans_img4);
            $items = $this->problemset_m->delete($item_id);
            $ret['data'] = $this->work_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function game($site_id = 1)
    {
        $this->data['site_id'] = $site_id;
        $this->data['items'] = $this->courses_m->getGameItems($site_id);
        $this->data["subview"] = "admin/contents/games";
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $this->data["tbl_content"] = $this->game_output_content($this->data['items']);
        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function game_output_content($items)
    {
        $output = '';
        $status_str = [$this->lang->line('status_stopped'), $this->lang->line('status_normal')];

        $j = 0;
        foreach ($items as $unit):
            $j++;
            $Editable = true;
            $btn_str = [
                $this->lang->line('update'),
                $this->lang->line('delete'),
                $this->lang->line('enable'),
                $this->lang->line('move2up'),
                $this->lang->line('move2down')
            ];
            if ($unit->game_status == '1') {
                $Editable = false;
                $btn_str[2] = $this->lang->line('disable');
            }
            $course_image = ($unit->image_corner == null) ? '' : (base_url() . $unit->image_corner);
            $output .= '<tr>';
            $output .= '<td>' . $j . '</td>';
            $output .= '<td>' . $unit->course_name . '</td>';
            $output .= '<td>' . $unit->school_name . '</td>';
            $output .= '<td><span><div class="image_icon" item_id="' . $unit->id . '"'
                . ' src="' . $course_image . '" '
                . ' style="width:25px; height:25px;display:inline-block;border-radius:5px;'
                . ' background:url(' . $course_image . ');background-size:100% 100%!important;">'
                . '</div></span></td>';
            $output .= '<td>' . $status_str[$unit->game_status] . '</td>';
            $output .= '<td>';
            $output .= '<button class="btn btn-sm ' . (!$Editable ? 'disabled' : 'btn-success') . '"'
                . ' onclick = "' . ($Editable ? 'update_item(this);' : '') . '"'
                . ' item_course="' . $course_image . '" '
                . ' item_name="' . $unit->course_name . '"'
                . ' item_id ="' . $unit->id . '">' . $btn_str[0] . '</button>';
            $output .= '<button class="btn btn-sm ' . ($Editable ? 'btn-default' : 'btn-warning') . '"'
                . ' onclick = "publish_item(this);" '
                . ' item_status="' . $unit->game_status . '"'
                . ' item_id = ' . $unit->id . '>' . $btn_str[2] . '</button>';
            $output .= '</td>';
            $output .= '<td>';
            $output .= '<button class="btn btn-sm btn-success btn_order_control"'
                . ' onclick = "update_order(this,-1);"'
                . ' item_order="' . $unit->game_order . '"'
                . ' item_lesson="' . $unit->lesson_id . '" '
                . ' item_id ="' . $unit->id . '">' . $btn_str[3] . '</button>';
            $output .= '<button class="btn btn-sm btn-default"'
                . ' onclick = "update_order(this,1);"'
                . ' item_order="' . $unit->game_order . '" '
                . ' item_lesson="' . $unit->lesson_id . '" '
                . ' item_id ="' . $unit->id . '">' . $btn_str[4] . '</button>';
            $output .= '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function publish_game()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $publish_st = $_POST['publish_state'];
            $site_id = $_POST['site_id'];
            $items = $this->courses_m->publish_game($item_id, $publish_st, $site_id);
            $ret['data'] = $this->game_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_game_order()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $site_id = $_POST['site_id'];
            $arr = $_POST['data'];
            $items = $this->courses_m->edit_game($arr[0], $arr[0]['id'], $site_id);
            $items = $this->courses_m->edit_game($arr[1], $arr[1]['id'], $site_id);
            $ret['data'] = $this->game_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function update_game()
    {
        $ret = array(
            'data' => 'error occured.',
            'status' => 'fail'
        );
        $upload_root = "uploads/web/mainpage/images/game/";
        $config['upload_path'] = $upload_root;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);

        if ($_POST) {
            $site_id = $this->input->post('site_id');
            $item_id = $this->input->post('item_id');
            $icon_type = $this->input->post('icon_type');
            if ($item_id == '') {
                echo json_encode($ret);
                return;
            }
            $item_number = $this->courses_m->getGameNumberFromId($item_id);
            if ($item_number == '-1') {
                $ret['data'] = 'Game item is not exist.';
                echo json_encode($ret);
                return;
            }
            $icon_name = $item_number . '.' . $icon_type;
            $param = array(
                'update_time' => date('Y-m-d H:i:s')
            );
            if ($_FILES["item_icon_file4"]["name"] != '') {
                //image uploading
                $config['upload_path'] = $upload_root;
                $config['file_name'] = $item_number . '.' . $icon_type;
                $this->upload->initialize($config, TRUE);
                if (file_exists($upload_root . $icon_name))
                    unlink($upload_root . $icon_name);
                if ($this->upload->do_upload('item_icon_file4')) {
                    $data = $this->upload->data();
                    $param['image_corner'] = $upload_root . $icon_name;
                } else {///show error message
                    $ret['data'] = $this->upload->display_errors();
                    $ret['status'] = 'fail';
                    echo json_encode($ret);
                    return;
                }
            }

            $items = $this->courses_m->edit_game($param, $item_id, $site_id);
            $ret['data'] = $this->game_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
            rmdir($dir);
        } else if (file_exists($dir)) unlink($dir);
    }

    // Function to Copy folders and files
    public function rcopy($src, $dst)
    {
        if (file_exists($dst))
            $this->rrmdir($dst);
        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file)
                if ($file != "." && $file != "..") {
                    $this->rcopy("$src/$file", "$dst/$file");

                }

        } else if (file_exists($src)) {
            copy($src, $dst);
        }
    }

    function checkRole($id = 40)
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