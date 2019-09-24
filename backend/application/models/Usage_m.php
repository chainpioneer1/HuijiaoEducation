<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usage_m extends MY_Model
{
    protected $_table_name = 'tbl_usage';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "tbl_usage.id asc";

    function __construct()
    {
        parent::__construct();
    }

    public function getItemsByPage($arr = array(), $pageId, $cntPerPage, $type = 'contents')
    {
//        $this->db->select('sum(' . $this->_table_name . '.read_count) as total_read');
//        $this->db->select('sum(' . $this->_table_name . '.is_favorite) as total_favorite');
//        $this->db->select('sum(' . $this->_table_name . '.is_like) as total_like');
//        $this->db->select('sum(' . $this->_table_name . '.download_count) as total_download');
        $this->db->select('0 as total_read');
        $this->db->select('0 as total_favorite');
        $this->db->select('0 as total_like');
        $this->db->select('0 as total_download');
        $this->db->select('tbl_huijiao_course_type.coursetype_no as term_no');

        if ($type == 'contents') {
            $this->db->select('tbl_huijiao_contents.id');
            $this->db->select('tbl_huijiao_contents.title, tbl_huijiao_contents.content_no');
            $this->db->select('tbl_huijiao_course_type.title as course_type');
        } else if ($type == 'lessons') {
            $this->db->select('tbl_huijiao_lessons.id');
            $this->db->select('tbl_huijiao_lessons.title, tbl_huijiao_lessons.lesson_no');
        }
        $this->db->select('tbl_huijiao_subject.title as subject, tbl_huijiao_subject.id as subject_id');
        $this->db->select('tbl_huijiao_terms.title as term, tbl_huijiao_terms.id as term_id');
        $this->db->like($arr);

//        $this->db->where($this->_table_name . '.status', 1);
        $this->db->where('tbl_huijiao_subject.status', 1);
        $this->db->where('tbl_huijiao_terms.status', 1);
        $this->db->where('tbl_huijiao_course_type.status', 1);

        if ($type == 'contents') {
            $this->db->from('tbl_huijiao_contents');

            $this->db->where('tbl_huijiao_contents.status', 1);

//            $this->db->join($this->_table_name, $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_contents.user_id', '0')
                ->where('tbl_huijiao_contents.id is not null')
                ->order_by('tbl_huijiao_contents.content_no')
                ->group_by('tbl_huijiao_contents.id');
        } else if ($type == 'lessons') {
            $this->db->from('tbl_huijiao_lessons');

            $this->db->where('tbl_huijiao_lessons.status', 1);

//            $this->db->join($this->_table_name, $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_lessons.user_id', '0')
                ->where('tbl_huijiao_lessons.id is not null')
                ->order_by('tbl_huijiao_lessons.lesson_no asc')
                ->group_by('tbl_huijiao_lessons.id');
        }
        $this->db->limit($cntPerPage, $pageId);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count($arr = array(), $type = 'contents')
    {
        if ($type == 'lessons') unset($arr['tbl_huijiao_contents.course_type_id']);
        $this->db->like($arr);

//        $this->db->where($this->_table_name . '.status', 1);
        $this->db->where('tbl_huijiao_subject.status', 1);
        $this->db->where('tbl_huijiao_terms.status', 1);
        $this->db->where('tbl_huijiao_course_type.status', 1);

        if ($type == 'contents') {
            $this->db->from('tbl_huijiao_contents');
            $this->db->where('tbl_huijiao_contents.status', 1);
//            $this->db->join($this->_table_name, $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_contents.user_id', '0')
                ->where('tbl_huijiao_contents.id is not null')
                ->order_by('tbl_huijiao_contents.content_no asc')
                ->group_by('tbl_huijiao_contents.id');
        } else if ($type == 'lessons') {
            $this->db->from('tbl_huijiao_lessons');
            $this->db->where('tbl_huijiao_lessons.status', 1);
//            $this->db->join($this->_table_name, $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left');
            $this->db->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                ->where('tbl_huijiao_lessons.user_id', '0')
                ->where('tbl_huijiao_lessons.id is not null')
                ->order_by('tbl_huijiao_lessons.lesson_no asc')
                ->group_by('tbl_huijiao_lessons.id');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getUsageInfo($arr = array(), $type = '')
    {
        $this->db->select('sum(' . $this->_table_name . '.read_count) as total_read');
        $this->db->select('sum(' . $this->_table_name . '.is_favorite) as total_favorite');
        $this->db->select('sum(' . $this->_table_name . '.is_like) as total_like');
        $this->db->select('sum(' . $this->_table_name . '.download_count) as total_download');
        $this->db->from($this->_table_name);

//        $this->db->where($this->_table_name . '.status', 1);

        switch ($type) {
            case 'contents':
                $this->db->where($arr);
                $this->db->where($this->_table_name . '.content_id is not null');
                $this->db->where('tbl_huijiao_contents.user_id', 0);
//
//                $this->db->where('tbl_huijiao_subject.status', 1);
//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_contents.status', 1);

                $this->db->join('tbl_huijiao_contents', $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->order_by('tbl_huijiao_contents.content_no asc');

                break;
            case 'lessons':
                unset($arr['tbl_huijiao_contents.course_type_id']);
                $this->db->where($arr);
                $this->db->where($this->_table_name . '.lesson_id is not null');
                $this->db->where('tbl_huijiao_lessons.user_id', 0);
//
//                $this->db->where('tbl_huijiao_subject.status', 1);
//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_lessons.status', 1);

                $this->db->join('tbl_huijiao_lessons', $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->order_by('tbl_huijiao_terms.term_no asc');
                break;
            case 'subjects_contents':
                $this->db->select('tbl_huijiao_subject.title');
                $this->db->where($this->_table_name . '.content_id is not null');
                $this->db->where('tbl_huijiao_contents.user_id', 0);

//                $this->db->where('tbl_huijiao_subject.status', 1);
//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_contents.status', 1);

                $this->db->join('tbl_huijiao_contents', $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->where('tbl_huijiao_subject.title is not null')
                    ->order_by('tbl_huijiao_subject.subject_no asc')
                    ->group_by('tbl_huijiao_subject.title');
                break;
            case 'subjects_lessons':
                $this->db->select('tbl_huijiao_subject.title');
                $this->db->where($this->_table_name . '.lesson_id is not null');
                $this->db->where('tbl_huijiao_lessons.user_id', 0);

//                $this->db->where('tbl_huijiao_subject.status', 1);
//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_lessons.status', 1);

                $this->db->join('tbl_huijiao_lessons', $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->where('tbl_huijiao_subject.title is not null')
                    ->order_by('tbl_huijiao_subject.subject_no asc')
                    ->group_by('tbl_huijiao_subject.title');
                break;
            case 'terms_contents':
                $this->db->select('tbl_huijiao_terms.title');
                $this->db->where($this->_table_name . '.content_id is not null');
                $this->db->where('tbl_huijiao_contents.user_id', 0);

//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_contents.status', 1);

                $this->db->join('tbl_huijiao_contents', $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->where('tbl_huijiao_terms.title is not null')
                    ->order_by('tbl_huijiao_terms.term_no asc')
                    ->group_by('substr(tbl_huijiao_terms.title,1,3)');
                break;
            case 'terms_lessons':
                $this->db->select('tbl_huijiao_terms.title');
                $this->db->where($this->_table_name . '.lesson_id is not null');
                $this->db->where('tbl_huijiao_lessons.user_id', 0);

//                $this->db->where('tbl_huijiao_terms.status', 1);
//                $this->db->where('tbl_huijiao_course_type.status', 1);
//                $this->db->where('tbl_huijiao_lessons.status', 1);

                $this->db->join('tbl_huijiao_lessons', $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->where('tbl_huijiao_terms.title is not null')
                    ->order_by('tbl_huijiao_terms.term_no asc')
                    ->group_by('substr(tbl_huijiao_terms.title,1,3)');
                break;
            case '':
                return null;
                break;
            default:
                $this->db->where($arr);
                $this->db->group_by($type);
                break;
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getItems()
    {
        $this->db->select('*')
            ->from($this->_table_name);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserUsageInfo($user_id)
    {
        $this->db->select('sum(' . $this->_table_name . '.read_count) as total_read');
        $this->db->select('sum(' . $this->_table_name . '.is_favorite) as total_favorite');
        $this->db->select('sum(' . $this->_table_name . '.is_like) as total_like');
        $this->db->select('sum(' . $this->_table_name . '.download_count) as total_download')
            ->from($this->_table_name);
        $this->db->where('user_id', $user_id);
        $this->db->group_by('user_id');
        $query = $this->db->get();
        return $query->row();
    }

    public function getFilteredUsageInfo($filterStr = '', $type="term_content")
    {
        $this->db->select('sum(' . $this->_table_name . '.read_count) as total_read');
        $this->db->select('sum(' . $this->_table_name . '.is_favorite) as total_favorite');
        $this->db->select('sum(' . $this->_table_name . '.is_like) as total_like');
        $this->db->select('sum(' . $this->_table_name . '.download_count) as total_download');
        $this->db->from($this->_table_name);

        if($filterStr!='') $this->db->where($filterStr);

        switch ($type) {
            case 'term_content':
                $this->db->select('tbl_huijiao_terms.id as term_id');
                $this->db->select('tbl_huijiao_terms.title as term');
                $this->db->select('tbl_huijiao_subject.id as subject_id');
                $this->db->where($this->_table_name . '.content_id is not null');
                $this->db->where('tbl_huijiao_contents.user_id', 0);

                $this->db->join('tbl_huijiao_contents', $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->order_by('tbl_huijiao_contents.content_no asc');
                $this->db->group_by('tbl_huijiao_terms.id');

                break;
            case 'term_lesson':
                $this->db->select('tbl_huijiao_terms.id as term_id');
                $this->db->select('tbl_huijiao_terms.title as term');
                $this->db->select('tbl_huijiao_subject.id as subject_id');
                $this->db->where($this->_table_name . '.lesson_id is not null');
                $this->db->where('tbl_huijiao_lessons.user_id', 0);

                $this->db->join('tbl_huijiao_lessons', $this->_table_name . '.lesson_id = tbl_huijiao_lessons.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_lessons.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->order_by('tbl_huijiao_terms.term_no asc');
                $this->db->group_by('tbl_huijiao_terms.id');
                break;
            case 'contentType_content':
                $this->db->select('tbl_huijiao_subject.id as subject_id');
                $this->db->select('tbl_huijiao_contents.content_type_no as contenttype_id');
                $this->db->where($this->_table_name . '.content_id is not null');
                $this->db->where('tbl_huijiao_contents.user_id', 0);

                $this->db->join('tbl_huijiao_contents', $this->_table_name . '.content_id = tbl_huijiao_contents.id', 'left')
                    ->join('tbl_huijiao_course_type', 'tbl_huijiao_contents.course_type_id = tbl_huijiao_course_type.id', 'left')
                    ->join('tbl_huijiao_terms', 'tbl_huijiao_course_type.term_id = tbl_huijiao_terms.id', 'left')
                    ->join('tbl_huijiao_subject', 'tbl_huijiao_terms.subject_id = tbl_huijiao_subject.id', 'left')
                    ->where('tbl_huijiao_subject.title is not null')
                    ->order_by('tbl_huijiao_subject.subject_no asc')
                    ->group_by('tbl_huijiao_contents.content_type_no');
                break;
            case '':
                return null;
                break;
            default:
                $this->db->where($filterStr);
                $this->db->group_by($type);
                break;
        }

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
