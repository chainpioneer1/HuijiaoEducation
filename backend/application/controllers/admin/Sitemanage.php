<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sitemanage extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $language = 'chinese';
        $this->load->model("sites_m");
        $this->load->model("activationcodes_m");
        $this->lang->load('courses', $language);
        $this->load->library("pagination");
    }

    public function index()
    {
        $this->data['items'] = $this->sites_m->getItems();
        $this->data["subview"] = "admin/activation/site_manage";
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $this->data["tbl_content"] = $this->output_content($this->data['items']);
        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    function output_content($items)
    {
        $output = '';
        $j = 0;
        $status_str = [$this->lang->line('status_disabled'), $this->lang->line('status_normal')];
        foreach ($items as $unit):
            $j++;

            $output .= '<tr>';
            $output .= '<td item_id="' . $unit->id . '">' . $j . '</td>';
            $output .= '<td item_id="' . $unit->id . '">' . $unit->site_name . '</td>';
            $output .= '<td item_id="' . $unit->id . '">' . $status_str[$unit->site_status] . '</td>';
            $output .= '</tr>';
        endforeach;
        return $output;
    }

    public function activation()
    {
        $this->data['items'] = $this->activationcodes_m->getCodeItems();
        $this->data['sites'] = $this->sites_m->getItems();
        $this->data['status_act'] = [$this->lang->line('status_activated'), $this->lang->line('status_unactivated')];
        $this->data['status_use'] = [$this->lang->line('status_using'), $this->lang->line('status_disabled')];
        $this->data["subview"] = "admin/users/activation";
        $this->data["subscript"] = "admin/settings/script";
        $this->data["subcss"] = "admin/settings/css";
        $this->data["tbl_content"] = $this->activation_output_content($this->data['items']);
        if (!$this->checkRole()) {
            $this->load->view('admin/_layout_error', $this->data);
        } else {
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    function activation_output_content($items)
    {
        $output_html = '';
        $j = 0;
        $status_activation = [$this->lang->line('status_unactivated'), $this->lang->line('status_activated')];
        $status_user = [$this->lang->line('status_disabled'), $this->lang->line('status_using')];
//        for ($i = 0; $i < 10; $i++)
        foreach ($items as $unit):
            $j++;
            $isDisabled = true;
            $btn_str = $this->lang->line('enable');
            if ($unit->user_status == '1') {
                $isDisabled = false;
                $btn_str = $this->lang->line('disable');
            }
            if($unit->code=='') continue;
            $userInfo = json_decode($unit->user_info);

            $output_html .= '<tr>';
            $output_html .= '<td>' . $j . '</td>';
            $output_html .= '<td>' . $unit->code . '</td>';
            $output_html .= '<td>' . $unit->site_name . '</td>';
            $output_html .= '<td>' . $unit->create_time . '</td>';
            $output_html .= '<td>' . $status_activation[$unit->activate_status] . '</td>';
            $output_html .= '<td>' . $unit->user_account . '</td>';
            $output_html .= '<td>' . $unit->activate_time . '</td>';
            $output_html .= '<td>';
            $output_html .= '<button class="btn btn-sm ' . ($isDisabled ? 'btn-default' : 'btn-warning') . '"'
                . ' onclick = "publish_item(this);" '
                . ' item_status="' . $unit->user_status . '"'
                . ' item_site="' . $unit->site_id . '"'
                . ' item_id = ' . $unit->id . '>' . $btn_str . '</button>';
            $output_html .= '<button class="btn btn-sm btn-danger" '.(!$isDisabled ? 'disabled="disabled"' : '')
                . ' onclick = "' . (!$isDisabled ? '' : 'delete_item(this);') . '" '
                . ' item_id = "' . (!$isDisabled ? '' : $unit->id) . '">' . $this->lang->line('delete') . '</button>';
            $output_html .= '</td>';
            $output_html .= '</tr>';
        endforeach;
        return $output_html;
    }

    public function delete_code()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $items = $this->activationcodes_m->deleteItem($item_id);
            $ret['data'] = $this->activation_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function publish()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_id = $_POST['item_id'];
            $publish_st = $_POST['publish_state'];
            $site_id = $_POST['site_id'];
            $items = $this->activationcodes_m->publish($item_id, $publish_st, $site_id);
            $ret['data'] = $this->activation_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    public function create_activation_codes()
    {
        $ret = array(
            'data' => '',
            'status' => 'fail'
        );
        if ($_POST) {
            $item_amount = intval($_POST['item_amount']);
            $param = null;
            for ($i = 0; $i < $item_amount; $i++) {
                $param[$i] = array(
                    'code' => $this->generateRandomString(8),
                    'activate_status' => 0,
                    'user_status' => 0,
                    'create_time' => date('Y-m-d H:i:s'),
                    'register_count' => 0
                );
            }
            $items = $this->activationcodes_m->addItems($param);
            $ret['data'] = $this->activation_output_content($items);
            $ret['status'] = 'success';
        }
        echo json_encode($ret);
    }

    function generateRandomString($length = 10)
    {
        $characters = '23456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
