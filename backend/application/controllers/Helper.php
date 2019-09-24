<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Helper extends CI_Controller
{
    protected $mainModel;
    protected $perpage = 15;

    function __construct()
    {
        parent::__construct();

        $language = 'chinese';
        $this->lang->load('courses', $language);
        $this->load->model('adminsignin_m');
        $this->load->model('signin_m');
        $this->load->model('subject_m');
        $this->load->model('terms_m');
        $this->load->model('coursetype_m');
        $this->load->model('contents_m');
        $this->load->model('contenttype_m');
        $this->load->model('lessons_m');
        $this->load->model('usage_m');
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library("pagination");

        $this->mainModel = $this->contents_m;
		
        $this->load->model('users_m');
        $this->users_m->update_usage_time();
    }

    public function index()
    {
        $this->learning();
    }

    public function contentPlayer(){
        $this->data['parentView'] = 'helper/contentPlayer';

        $this->data["content"] = $this->mainModel->get_where(array('id'=>$_GET['id']));

        $this->data["subview"] = "helper/contentPlayer";
        $this->load->view('helper/contentPlayer', $this->data);
    }

    public function learning()
    {
//        $this->signin_m->loggedin() == TRUE || redirect(base_url('home/index'));
        $this->data['parentView'] = 'helper';


        $this->data['subjectList'] = $this->subject_m->getItems();
        $this->data['termList'] = $this->terms_m->getItems();
        $this->data['courseTypeList'] = $this->coursetype_m->getItems();

        $filter = array();
        $filter['tbl_huijiao_terms.subject_id'] = 1;
        $this->data['contentTypeList'] = $this->contenttype_m->getFilteredContentTypes($filter);

        if ($this->uri->segment(SEGMENT) == '') $this->session->unset_userdata('filter');

        $queryStr = '';
        if ($_POST) {
            $this->session->unset_userdata('filter');
//            $_POST['search_no'] != '' && $filter['tbl_huijiao_contents.content_no'] = $_POST['search_no'];
            $_POST['search_title'] != '' && $queryStr = $_POST['search_title'];
            $_POST['search_content_type'] != '' && $filter['tbl_huijiao_contents.content_type_no'] = $_POST['search_content_type'];
//            $_POST['search_subject'] != '' && $filter['tbl_huijiao_terms.subject_id'] = $_POST['search_subject'];
            $_POST['search_term'] != '' && $filter['tbl_huijiao_terms.id'] = $_POST['search_term'];
            $_POST['search_course_type'] != '' && $filter['tbl_huijiao_contents.course_type_id'] = $_POST['search_course_type'];
            $this->session->set_userdata('filter', $filter);
        }
        $this->session->userdata('filter') != '' && $filter = $this->session->userdata('filter');
        $filter['tbl_huijiao_contents.status']=1;

        $this->data['perPage'] = $perPage = $this->perpage;
        $this->data['cntPage'] = $cntPage = $this->mainModel->get_count($filter, $queryStr);
        $ret = $this->paginationCompress('helper/index', $cntPage, $perPage, 3);
        $this->data['curPage'] = $curPage = $ret['pageId'];
        $this->data["contents"] = $this->mainModel->getItemsByPage($filter, $ret['pageId'], $ret['cntPerPage'], $queryStr);

        $this->data["tbl_content"] = $this->get_contents_html($this->data['contents']);
        $this->data["queryStr"] = $queryStr;

        $this->data["subview"] = "helper/index";
        $this->load->view('_layout_main_helper', $this->data);
    }

    function obj2Array($arr)
    {
        return json_decode(json_encode($arr), true);
    }
    public function get_contents_html($contents)
    {
        $output = '';
        foreach($contents as $content) {
            $iconPath = '';
            $iconCorner = '';
            if ($content->icon_path != null && $content->icon_path != '') $iconPath = base_url() . $content->icon_path;
            if ($content->icon_corner != null && $content->icon_corner != '') $iconCorner = base_url() . $content->icon_corner;
            $bgStr = '';
            if ($iconCorner != '') $bgStr = 'url(' . $iconCorner . ')';

            if ($iconPath != '') {
                if ($bgStr != '') $bgStr .= ',';
                $bgStr .= 'url(' . $iconPath . ')';
            }
            $contentTitle = $content->fulltitle;
//            if (strlen($contentTitle) > 12) $contentTitle = substr($contentTitle, 0, 12);
            $usages_read_mine = $this->usage_m->get_where(['user_id' => $this->session->userdata('loginuserID'), 'content_id' => $content->id]);
            $output .= '<div class="list-item"><div>';
            $output .= '<div class="item-main-info" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview-wrapper" style="padding: 0; border-radius: 5px">';
            $output .= '<div class="item-preview" style="background:' . $bgStr . ';"></div>';
            $output .= '</div>';
            $output .= '<div class="item-coursename">' . $contentTitle . '</div>';
            $output .= '</div>';
            $output .= '<div class="item-infobar">';
            $output .= '<div class="item-read-value" onclick="showHelperContentPlayer(\'' . $content->id . '\')">预览</div>';
            $output .= '<div class="item-favor-value" onclick="selectHelperContent(this)" data-id="' . $content->id . '">添加</div>';
            $output .= '</div>';
            $output .= '</div></div>';
        }

        return $output;
    }

}

?>