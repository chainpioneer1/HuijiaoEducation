<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contents_m extends MY_Model
{
    protected $_table_name = 'tbl_huijiao_contents';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_huijiao_contents.content_no asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage, $queryStr = '', $isTeacher = '')
    {
        $this->db->select($this->_table_name . '.*');
        if ($isTeacher == 'teacher') {
            $this->db->select("concat( '', '', $this->_table_name.title) as title");
            $this->db->where($arr);
        } else {
            $this->db->like($arr);
        }
        $this->db->select("concat( '', '', $this->_table_name.title) as fulltitle");
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_contents.icon_path as icon_path');
        $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner');
        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');
//        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner');
//        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
        if ($queryStr != '') {
            $this->db->where(
                '( tbl_huijiao_subject.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_terms.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_content_type.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_contents.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_course_type.title like \'%' . $queryStr . '%\' )'
            );
        }
        $this->db->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where('tbl_huijiao_content_type.status', 1)
            ->where('tbl_huijiao_course_type.status', 1);
        if ($isTeacher == 'teacher') {
            $this->db->order_by('tbl_huijiao_content_type.contenttype_no');
            $this->db->order_by($this->_order_by);
        } else {
            $this->db->order_by($this->_order_by);
        }
        $this->db->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array(), $queryStr = '', $isTeacher = '')
    {
        $this->db->select($this->_table_name . '.id');
        if ($queryStr != '') {
            $this->db->where(
                '( tbl_huijiao_subject.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_terms.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_content_type.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_contents.title like \'%' . $queryStr . '%\' '
                . 'or tbl_huijiao_course_type.title like \'%' . $queryStr . '%\' )'
            );
        }
        if ($isTeacher == 'teacher') {
            $this->db->where($arr);
        } else {
            $this->db->like($arr);
        }
        $this->db->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where('tbl_huijiao_content_type.status', 1)
            ->where('tbl_huijiao_course_type.status', 1)
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_contents.icon_path as icon_path');
        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');
        $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner')
//        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
//        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
    }

    public function getContentsFromLessonId($ids)
    {
        $ids = json_decode($ids);
        if (count($ids) == 0) return array();
        if (!$this->adminsignin_m->loggedin())
            $this->db->where($this->_table_name . '.status', 1);
        $this->db->select($this->_table_name . '.*');
        $this->db->select("concat( ifnull(tbl_huijiao_content_type.title,'用户'), '-', $this->_table_name.title) as title");
        $this->db->select("tbl_huijiao_course_type.title as course_type, ifnull(tbl_huijiao_contents.icon_path,$this->_table_name.icon_path) as icon_path");
        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, \"assets/images/none.png\" as icon_corner_m");
        $this->db->select("tbl_huijiao_content_type.title as content_type, \"assets/images/none.png\" as icon_corner")
//        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m");
//        $this->db->select("tbl_huijiao_content_type.title as content_type, ifnull(tbl_huijiao_content_type.icon_path, $this->_table_name.icon_path) as icon_corner")
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->where_in($this->_table_name . '.id', $ids)
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
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
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select("tbl_huijiao_course_type.title as course_type, ifnull(tbl_huijiao_contents.icon_path,$this->_table_name.icon_path) as icon_path");
//        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m");
//        $this->db->select("tbl_huijiao_content_type.title as content_type, ifnull(tbl_huijiao_content_type.icon_path, $this->_table_name.icon_path) as icon_corner")
        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, \"assets/images/none.png\" as icon_corner_m");
        $this->db->select("tbl_huijiao_content_type.title as content_type, \"assets/images/none.png\" as icon_corner")
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left');
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
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_contents.icon_path as icon_path');
//        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
//        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner')
        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');
        $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left');
        $this->db->where($array)
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
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
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select("tbl_huijiao_course_type.title as course_type, ifnull(tbl_huijiao_contents.icon_path,$this->_table_name.icon_path) as icon_path");
//        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m");
//        $this->db->select("tbl_huijiao_content_type.title as content_type, ifnull(tbl_huijiao_content_type.icon_path, $this->_table_name.icon_path) as icon_corner")
        $this->db->select("tbl_huijiao_contents.icon_path_m as icon_path_m, \"assets/images/none.png\" as icon_corner_m");
        $this->db->select("tbl_huijiao_content_type.title as content_type, \"assets/images/none.png\" as icon_corner")
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->where_in($this->_table_name . '.' . $key, $ids)
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
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

    public function get_where_limit($arr = array(), $limit_number, $limit_offset = 0)
    {
        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_contents.icon_path as icon_path');
//        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
//        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner')
        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');
        $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left');
        $this->db->where($array)
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
            ->order_by($this->_order_by)
            ->limit($limit_number, $limit_offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_where_join($arr = array())
    {
        $array = array();
        foreach ($arr as $key => $value) {
            $array[$this->_table_name . '.' . $key] = $value;
        }
        $this->db->select($this->_table_name . '.*');
        $this->db->select("concat( '', '', $this->_table_name.title) as title");
        $this->db->select('tbl_huijiao_course_type.title as course_type, tbl_huijiao_contents.icon_path as icon_path');
//        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, tbl_huijiao_content_type.icon_path_m as icon_corner_m');
//        $this->db->select('tbl_huijiao_content_type.title as content_type, tbl_huijiao_content_type.icon_path as icon_corner');
        $this->db->select('tbl_huijiao_contents.icon_path_m as icon_path_m, "assets/images/none.png" as icon_corner_m');
        $this->db->select('tbl_huijiao_content_type.title as content_type, "assets/images/none.png" as icon_corner');
        $this->db->select('tbl_usage.user_id as user_id, tbl_usage.is_favorite as is_favorite, tbl_usage.is_like as is_like, tbl_usage.read_count as read_count, tbl_usage.download_count as download_count')
            ->from($this->_table_name)
            ->join('tbl_huijiao_course_type', $this->_table_name . '.course_type_id = tbl_huijiao_course_type.id', 'left')
            ->join('tbl_huijiao_content_type', $this->_table_name . '.content_type_no = tbl_huijiao_content_type.id', 'left')
            ->join('tbl_usage', $this->_table_name . '.id = tbl_usage.content_id', 'left');
        $this->db->where($array)
            ->order_by('tbl_huijiao_content_type.contenttype_no asc')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->result();
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

    public function getContentsFromLesson($contentLists)
    {
        return $this->getContentsFromLessonId(json_encode($contentLists));

//        $this->db->select('*')
//            ->from($this->_table_name);
//        if (count($contentLists) == 0) {
//            return array();
//        } else {
//            foreach ($contentLists as $item) {
//                $this->db->or_where('id', $item);
//            }
//        }
//        $query = $this->db->get();
//        $contents = $query->result();
//        $result = array();
//        foreach ($contentLists as $id) {
//            foreach ($contents as $item) {
//                if ($item->id != $id || $item->status == 0) continue;
//                array_push($result, $item);
//                break;
//            }
//        }
//        return $result;
    }

    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }
}
