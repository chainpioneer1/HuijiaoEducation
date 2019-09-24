<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Teacherwork_m extends MY_Model
{


    protected $_table_name = 'tbl_teacher_work';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_teacher_work.id asc";

    function __construct()
    {
        parent::__construct();

        $this->db->select('id, problem_info')
            ->from($this->_table_name)
            ->where('student_id', null)
            ->where('course_type_id', null);
        $query = $this->db->get();
        $result = $query->result();
        $this->load->model("questions_m");
        foreach ($result as $item) {
            $problemInfo = json_decode($item->problem_info);
            if (count($problemInfo) > 0) $course_type_id = $this->questions_m->get_single(array('id' => $problemInfo[0]))->course_type_id;
            else $course_type_id = $this->questions_m->get_single()->course_type_id;
            $this->edit(array('course_type_id' => $course_type_id), $item->id);
        }
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage)
    {
        $this->db->select($this->_table_name . '.*');
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->select('tbl_huijiao_terms.term_no');
        $this->db->select('tbl_huijiao_course_type.coursetype_no, tbl_huijiao_course_type.title as course_type');
        $this->db->select('tbl_user.user_nickname as nickname, tbl_user.user_account');

        $this->db->like($arr);

        $this->db->where(" $this->_table_name.student_id ");

        $this->db->from($this->_table_name)
            ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = ' . $this->_table_name . '.course_type_id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->join('tbl_user', $this->_table_name . '.teacher_id = tbl_user.id', 'left');
        $this->db
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->order_by($this->_order_by.'')
            ->group_by($this->_table_name.'.title')
            ->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array())
    {
        $this->db->like($arr);

        $this->db->where(" $this->_table_name.student_id ");

        $this->db->from($this->_table_name)
            ->join('tbl_huijiao_course_type', 'tbl_huijiao_course_type.id = ' . $this->_table_name . '.course_type_id', 'left')
            ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
            ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
            ->join('tbl_user', $this->_table_name . '.teacher_id = tbl_user.id', 'left');
        $this->db
            ->where('tbl_huijiao_subject.status', 1)
            ->where('tbl_huijiao_terms.status', 1)
            ->group_by($this->_table_name.'.title')
            ->order_by($this->_order_by);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getItems()
    {
        $this->db->select('*,' . $this->_table_name . '.id as id')
            ->from($this->_table_name);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all()
    {
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_item_answer_info($id)
    {
        $this->db->select($this->_table_name . '.answer_info')
            ->from($this->_table_name)
            ->where($this->_table_name . '.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_item_problem_info($id, $teacherId)
    {
        $this->db->select($this->_table_name . '.problem_info')
            ->from($this->_table_name)
            ->where($this->_table_name . '.id', $id)
            ->where($this->_table_name . '.teacher_id', $teacherId);
        $query = $this->db->get();
        return $query->result();
    }

    function get_item_end_time($id, $teacherId)
    {
        $this->db->select($this->_table_name . '.end_time')
            ->from($this->_table_name)
            ->where($this->_table_name . '.id', $id)
            ->where($this->_table_name . '.teacher_id', $teacherId);
        $query = $this->db->get();
        return $query->result();
    }

    function getProblemSetFromInfo($questionIds)
    {
        $result = [];
        foreach ($questionIds as $item) {
            $this->db->select('*');
            $this->db->from('tbl_questions')
                ->where('tbl_questions.id', $item);
            $query = $this->db->get();
            $temp_result = $query->result();
            array_push($result, $temp_result);
        }
        return $result;
    }

    function getCheckList($teacherid)
    {
        $this->db->select('*, ' . $this->_table_name . '.id as id');
        $this->db->from($this->_table_name)
            ->join('tbl_class', 'tbl_class.id = ' . $this->_table_name . '.class_id', 'inner')
            ->where($this->_table_name . '.teacher_id', $teacherid)
            ->order_by('end_time', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $item) {
            $item->total_count = $this->getUserCountFromClassName($item->class_name);
            $item->solved_count = $this->getSolvedUserCountFromId($item->id);
        }
        return $result;
    }

    function getCheckListDetail($teacherid, $teacherwork_id)
    {
        $this->db->select('*, ' . $this->_table_name . '.id as id');
        $this->db->from($this->_table_name)
            ->join('tbl_user', 'tbl_user.id = ' . $this->_table_name . '.student_id', 'inner')
            ->where('teacher_id', $teacherwork_id)
            ->where('answer_type !=', 0)
            ->order_by('end_time', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getUserCountFromClassName($className)
    {
        $user_data = array();
        $SQL = 'SELECT  count(*) as num
                FROM tbl_user
                WHERE user_class = \'' . $className . '\' 
                ;';
        $query = $this->db->query($SQL);
        $count = $query->row()->num;
        return $count;
    }

    function getSolvedUserCountFromId($teacher_id)
    {
        $user_data = array();
        $SQL = 'SELECT  count(*) as num
                FROM ' . $this->_table_name . '
                WHERE teacher_id = \'' . $teacher_id . '\'
                AND answer_type != \'1\';';
        $query = $this->db->query($SQL);
        $count = $query->row()->num;
        return $count;
    }

    function add($arr)
    {
        $this->db->insert($this->_table_name, $arr);
        return $this->db->insert_id();
    }

    function get_single_package($item_id)
    {
        $arr = array(
            $this->_primary_key => $item_id
        );
        return parent::get_single($arr);
    }

    public function get_where($array = NULL, $subCondition = '')
    {
        $this->db->select()->from($this->_table_name);

        if ($array != NULL) {
            $this->db->where($array);
        }

        $this->db->order_by('end_time desc');
        $query = $this->db->get();
        return $query->result();
        return parent::get_where($array, $subCondition); // TODO: Change the autogenerated stub
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

    function edit($arr, $item_id)
    {
        $this->db->where($this->_primary_key, $item_id);
        $this->db->update($this->_table_name, $arr);
        return $this->getItems();
    }
}
