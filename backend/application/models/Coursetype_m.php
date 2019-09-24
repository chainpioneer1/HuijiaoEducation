<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coursetype_m extends MY_Model
{
    protected $_table_name = 'tbl_huijiao_course_type';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_huijiao_course_type.coursetype_no asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage)
    {
        $this->db->select($this->_table_name . '.*, 
              tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id, tbl_huijiao_terms.title as term');
        $this->db->like($arr)
            ->from($this->_table_name)
            ->join('tbl_huijiao_terms', $this->_table_name . '.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->order_by($this->_order_by)
            ->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array())
    {
        $this->db->like($arr)
            ->from($this->_table_name)
            ->join('tbl_huijiao_terms', $this->_table_name . '.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select('*')
            ->from($this->_table_name)
            ->where($this->_table_name . '.status', 1)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function add($arr)
    {
        $this->db->insert($this->_table_name, $arr);
        return $this->db->insert_id();
    }

    public function get_single($arr = array())
    {
        return parent::get_single($arr);
    }

    public function get_where($array = array(), $subCondition = NULL)
    {
        return parent::get_where($array, $subCondition); // TODO: Change the autogenerated stub
    }

    public function get_where_in($key, $array = array())
    {
        return parent::get_where_in($key, $array);
    }

    public function get_where_join($array = array())
    {
        $this->db->select($this->_table_name . '.*, 
              tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id, tbl_huijiao_terms.title as term');
        $this->db->like($array)
            ->from($this->_table_name)
            ->join('tbl_huijiao_terms', $this->_table_name . '.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where($array)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
        return parent::get_where($array); // TODO: Change the autogenerated stub
    }

    public function delete($item_id)
    {
        $this->db->where($this->_primary_key, $item_id);
        $this->db->delete($this->_table_name);
        return $this->getItems();
    }

    public function publish($item_id, $publish_st, $site_id = 1)
    {
        $this->db->set('status', $publish_st);
        $this->db->where($this->_primary_key, $item_id);
        $this->db->update($this->_table_name);
        return $this->getItems();
    }

    public function edit($arr, $item_id)
    {
        $this->db->where($this->_primary_key, $item_id);
        $this->db->update($this->_table_name, $arr);
        return $this->getItems();
    }
}