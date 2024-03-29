<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sclass_m extends MY_Model
{

    protected $_table_name = 'tbl_class';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItems($classes = '')
    {
        $users_data = array();
        $SQL = "SELECT * FROM ".$this->_table_name;
        if ($classes != '') {
            $SQL .= ' WHERE ( ';
            $classes = explode(',', $classes);
            for ($j = 0; $j < count($classes); $j++) {
                if ($j > 0) $SQL .= ' or ';
                $SQL .= ' id = ' . $classes[$j] . ' ';
            }
            $SQL .= ' ) ';
        }
        $SQL .= " ORDER By id ASC ;";
        $query = $this->db->query($SQL);
        $users_data = $query->result();
        return $users_data;
    }

    public function getUserClass($teacherId)
    {
        $this->db->select('class_name');
        $this->db->from($this->_table_name);
        $this->db->where('teacher_id', $teacherId);
        $query = $this->db->get();
        $result = $query->result();
        $class = '';
        $j = 0;
        foreach ($result as $item) {
            if ($j > 0) $class .= ',';
            $j++;
            $class .= $item->class_name;
        }
        return $class;
    }

    public function get_single($arr = array())
    {
        return parent::get_single($arr);
    }

    function insert($array)
    {
        return parent::insert($array); // TODO: Change the autogenerated stub
    }

    public function add($param)
    {
        $result = $this->get_where($param);
        if (count($result) > 0) {
            return $result[0]->id;
        }
        $param['create_time'] = date('Y-m-d H:i:s');
        return $this->insert($param);
    }

    function update($data, $id = NULL)///for update session of login time
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update($this->_table_name);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table_name);
    }

    public function hash($string)
    {
        return parent::hash($string);
    }

    public function get_where($array = array(), $subCondition = NULL)
    {
        return parent::get_where($array, $subCondition); // TODO: Change the autogenerated stub
    }

}
