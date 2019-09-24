<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Questions_m extends MY_Model
{
    protected $_table_name = 'tbl_questions';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_questions.question_no asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage, $keyword = '')
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m');
        if ($keyword != '') $this->db->where($keyword);
        $this->db->like($arr)
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where('tbl_huijiao_course_type.status', 1)
            ->order_by($this->_order_by)
            ->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array(), $keyword = '')
    {
        $this->db->select($this->_table_name . '.id');
        if ($keyword != '') $this->db->where($keyword);
        $this->db->like($arr)
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where('tbl_huijiao_course_type.status', 1)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuestionsFromQuizId($ids)
    {
        $ids = json_decode($ids);
        if (count($ids) == 0) return array();
        if (!$this->adminsignin_m->loggedin())
            $this->db->where($this->_table_name . '.status', 1);
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->where_in($this->_table_name . '.id', $ids)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        $contents = $query->result();
        $result = array();
        foreach ($ids as $id) {
            foreach ($contents as $item) {
                if ($item->id != $id || $item->status == 0) continue;
                array_push($result, $item);
                break;
            }
        }
        return $result;
    }

    public function add($arr)
    {
        $this->db->insert($this->_table_name, $arr);
        return $this->db->insert_id();
    }

    public function get_single($arr = array())
    {
        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left');
        $this->db->where($array);
        $query = $this->db->get();
        $contents = $query->row();
        return $query->row();
    }

    public function get_where($arr = array(), $subCondition = NULL)
    {
        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left');
        $this->db->where($array)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_where_in($key, $arr = array())
    {
        $ids = $arr;
        if (count($ids) == 0) return array();
        if (!$this->adminsignin_m->loggedin())
            $this->db->where($this->_table_name . '.status', 1);
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_course_type.icon_path as icon_path');
        $this->db->select('tbl_huijiao_course_type.icon_path_m as icon_path_m')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->where_in($this->_table_name . '.' . $key, $ids)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        $contents = $query->result();
//        $result = array();
//        foreach ($ids as $id) {
//            foreach ($contents as $item) {
//                if ($item-> != $id || $item->status == 0) continue;
//                array_push($result, $item);
//                break;
//            }
//        }
        return $contents;
        //return parent::get_where_in($key, $array);
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
        return $item_id;
    }

    public function getQuestionsFromQuiz($contentLists)
    {
        return $this->getQuestionsFromQuizId(json_encode($contentLists));
    }

    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }
}
