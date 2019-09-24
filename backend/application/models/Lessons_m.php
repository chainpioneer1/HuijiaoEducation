<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lessons_m extends MY_Model
{
    protected $_table_name = 'tbl_huijiao_lessons';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_huijiao_lessons.update_time desc";

    function __construct()
    {
        parent::__construct();
        $this->db->select('id, lesson_info')
            ->from($this->_table_name)
//            ->where('user_id',0)
            ->where('course_type_id', null);
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $item) {
            $lessonInfo = json_decode($item->lesson_info);
            if (count($lessonInfo) > 0) $course_type_id = $this->contents_m->get_single(array('id' => $lessonInfo[0]))->course_type_id;
            else $course_type_id = $this->contents_m->get_single()->course_type_id;
            $this->edit(array('course_type_id' => $course_type_id), $item->id);
        }
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage, $type = 'admin')
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select('tbl_huijiao_terms.term_no');
        if ($type != 'teacher' && $type!='admin_user') $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type');
        $this->db->select('tbl_user.user_nickname as nickname');

        if ($type == 'user') {
            $this->db->where('(' . $this->_table_name . '.user_id = 0)');
            $this->db->where($arr);
        } else if ($type == 'admin_user') {
            $this->db->where('(' . $this->_table_name . '.user_id != 0)');
        } else if($type=='admin'){
            $this->db->where('(' . $this->_table_name . '.user_id = 0)');
            $this->db->like($arr);
        }else {
            $this->db->like($arr);
        }
        $this->db->from($this->_table_name)
            ->join('tbl_user', $this->_table_name . '.user_id = tbl_user.id', 'left')
            ->join('tbl_huijiao_terms', $this->_table_name . '.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left');
        if ($type != 'teacher' && $type!='admin_user')
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = ' . $this->_table_name . '.course_type_id', 'left')
                ->where('tbl_huijiao_course_type.status', 1)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc');
        $this->db->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->order_by($this->_order_by)
            ->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array(), $type = 'admin')
    {
        if ($type == 'user') {
            $this->db->where('(' . $this->_table_name . '.user_id = 0)');
            $this->db->where($arr);
        } else if ($type == 'admin_user') {
            $this->db->where('(' . $this->_table_name . '.user_id != 0)');
        } else if($type=='admin'){
            $this->db->where('(' . $this->_table_name . '.user_id = 0)');
            $this->db->like($arr);
        } else {
            $this->db->like($arr);
        }
        $this->db->from($this->_table_name)
            ->join('tbl_user', $this->_table_name . '.user_id = tbl_user.id', 'left')
            ->join('tbl_huijiao_terms', $this->_table_name . '.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left');
        if ($type != 'teacher' && $type!='admin_user')
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = ' . $this->_table_name . '.course_type_id', 'left')
                ->where('tbl_huijiao_course_type.status', 1)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc');
        $this->db->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_single($arr = array())
    {

        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc')
            ->order_by($this->_order_by);
        $this->db->where($array);
        $query = $this->db->get();
//        $contents = $query->row();
        return $query->row();
    }

    public function get_where($arr = array(), $subCondition = NULL)
    {
        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left');
        $this->db->where($array)
            ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function add($arr)
    {
        $this->db->insert($this->_table_name, $arr);
        return $this->db->insert_id();
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
