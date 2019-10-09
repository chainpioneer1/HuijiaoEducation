<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recommend_m extends MY_Model
{
    protected $_table_name = 'tbl_huijiao_recommend';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "abs(tbl_huijiao_recommend.recommend_no) asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage, $keyword = '')
    {
        $this->db->select($this->_table_name . '.*');
        $query = null;
        if ($arr['tbl_huijiao_recommend.type'] == 0 ||
            $arr['tbl_huijiao_recommend.type'] == 2 ||
            $arr['tbl_huijiao_recommend.type'] == 3 ||
            $arr['tbl_huijiao_recommend.type'] == 4 ||
            $arr['tbl_huijiao_recommend.type'] == 5 ||
            $arr['tbl_huijiao_recommend.type'] == 6) { // recommended contents
//            $this->db->select('concat( tbl_huijiao_content_type.title, \' - \', tbl_huijiao_contents.title) as content');
            $this->db->select('tbl_huijiao_contents.title as content');
            $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
            $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
            $this->db->select('tbl_huijiao_terms.term_no, tbl_huijiao_course_type.id as course_type_id');
            $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type');
            $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_recommend.image_icon as icon_path');
//            $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner');
//            $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
            $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner');
            $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');

            if ($keyword != '') $this->db->where($keyword);

            $this->db->like($arr);
            $this->db->from($this->_table_name)
                ->join('tbl_huijiao_contents', 'tbl_huijiao_contents.id = ' . $this->_table_name . '.content_id', 'left')
                ->join('tbl_huijiao_content_type', 'tbl_huijiao_content_type.id = tbl_huijiao_contents.content_type_no', 'left')
                ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_contents.course_type_id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_subject.status', 1)
                ->where('tbl_huijiao_terms.status', 1)
                ->where('tbl_huijiao_course_type.status', 1)
                ->where('tbl_huijiao_contents.status', 1)
                ->where('tbl_huijiao_content_type.status', 1)
                ->order_by($this->_order_by)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc')
                ->limit($cntPerPage, $pageId);
            $query = $this->db->get();
        } else if ($arr['tbl_huijiao_recommend.type'] == 1) { // recommended lessons
            $this->db->select($this->_table_name . '.*');
            $this->db->select('tbl_huijiao_lessons.id as lesson_id');
            $this->db->select('tbl_huijiao_lessons.title as lesson, tbl_huijiao_recommend.image_icon as icon_path');
            $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
            $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
            $this->db->select('tbl_huijiao_terms.term_no, tbl_huijiao_course_type.id as course_type_id');
            $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type');
            $this->db->like($arr);

            if ($keyword != '') $this->db->where($keyword);
            $this->db->from($this->_table_name)
                ->join('tbl_huijiao_lessons', 'tbl_huijiao_lessons.id = ' . $this->_table_name . '.content_id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_lessons.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_lessons.course_type_id', 'left')
                ->where('tbl_huijiao_course_type.status', 1)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc');
            $this->db->where('tbl_huijiao_subject.status', 1)
                ->where('tbl_huijiao_terms.status', 1)
                ->order_by($this->_order_by)
                ->limit($cntPerPage, $pageId);
            $query = $this->db->get();
        }
        return $query->result();
    }

    public function get_count($arr = array(), $keyword = '')
    {
        if ($keyword != '') $this->db->where($keyword);

        if ($arr['tbl_huijiao_recommend.type'] == 0 ||
            $arr['tbl_huijiao_recommend.type'] == 2 ||
            $arr['tbl_huijiao_recommend.type'] == 3 ||
            $arr['tbl_huijiao_recommend.type'] == 4 ||
            $arr['tbl_huijiao_recommend.type'] == 5 ||
            $arr['tbl_huijiao_recommend.type'] == 6) { // recommended contents
            $this->db->select('tbl_huijiao_contents.title as content');
            $this->db->like($arr);
            $this->db->from($this->_table_name)
                ->join('tbl_huijiao_contents', 'tbl_huijiao_contents.id = ' . $this->_table_name . '.content_id', 'left')
                ->join('tbl_huijiao_content_type', 'tbl_huijiao_content_type.id = tbl_huijiao_contents.content_type_no', 'left')
                ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_contents.course_type_id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_subject.status', 1)
                ->where('tbl_huijiao_terms.status', 1)
                ->where('tbl_huijiao_course_type.status', 1)
                ->where('tbl_huijiao_contents.status', 1)
                ->where('tbl_huijiao_content_type.status', 1)
                ->order_by($this->_order_by)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc');
            $query = $this->db->get();
        } else if ($arr['tbl_huijiao_recommend.type'] == 1) {
            $this->db->select('tbl_huijiao_lessons.title as lesson');
            $this->db->like($arr);
            if ($keyword != '') $this->db->where($keyword);
            $this->db->from($this->_table_name)
                ->join('tbl_huijiao_lessons', 'tbl_huijiao_lessons.id = ' . $this->_table_name . '.content_id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_lessons.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_lessons.course_type_id', 'left')
                ->where('tbl_huijiao_course_type.status', 1)
                ->order_by('tbl_huijiao_course_type.coursetype_no', 'asc');
            $this->db->where('tbl_huijiao_subject.status', 1)
                ->where('tbl_huijiao_terms.status', 1)
                ->order_by($this->_order_by);
            $query = $this->db->get();
        }
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_contents.title as title');
        $this->db->select($this->_table_name . '.content_id as id');
        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_contents.title as content');
        $this->db->select('tbl_huijiao_recommend.image_icon as icon_path');
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select('tbl_huijiao_terms.term_no, tbl_huijiao_course_type.id as course_type_id');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type');

        $this->db->from($this->_table_name)
            ->join('tbl_huijiao_contents', 'tbl_huijiao_contents.id = ' . $this->_table_name . '.content_id', 'left')
            ->join('tbl_huijiao_content_type', 'tbl_huijiao_content_type.id = tbl_huijiao_contents.content_type_no', 'left')
            ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_contents.course_type_id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_recommend.status', 1)
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where('tbl_huijiao_course_type.status', 1)
            ->where('tbl_huijiao_contents.status', 1)
            ->where('tbl_huijiao_content_type.status', 1)
            ->order_by('tbl_huijiao_recommend.type')
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
        $this->db->select('tbl_huijiao_contents.title as content');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type')
            ->from($this->_table_name)
            ->join('tbl_huijiao_contents', 'tbl_huijiao_contents.id = ' . $this->_table_name . '.content_id', 'left')
            ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_contents.course_type_id', 'left')
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
        $this->db->select('tbl_huijiao_contents.title as content');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type')
            ->from($this->_table_name)
            ->join('tbl_huijiao_contents', 'tbl_huijiao_contents.id = ' . $this->_table_name . '.content_id', 'left')
            ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = tbl_huijiao_contents.course_type_id', 'left');
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
