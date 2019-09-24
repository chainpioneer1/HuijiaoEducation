<?php
$ctrlRoot = 'admin/questions';
$category = '题目';
$mainModel = 'tbl_questions';
?>

<link href="<?= base_url('assets/admin/layouts/layout/css/lessons.css') ?>" rel="stylesheet" type="text/css">

<style>
    #main_tbl th, td {
        text-align: center;
        vertical-align: middle;
    }

    .form-horizontal .control-label {
        padding: 5px 5px;
    }

</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <h1 class="page-title"><?= $title; ?>
            <small></small>
        </h1>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="table-toolbar">
                        <!------Tool bar parts (add button and search function------>
                        <div class="row">
                            <form class="form-horizontal col-md-9" action="<?= base_url($ctrlRoot . '/index') ?>"
                                  id="searchForm" role="form" method="post" enctype="multipart/form-data"
                                  accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>编码:</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>类型:</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_question_type">
                                                    <option value="">全部</option>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($type_str as $item) {
                                                        echo '<option value="' . $i . '">' . $item . '</option>';
                                                        $i++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">关键字:</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属科目:</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_subject"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属册次:</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_term"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属课程:</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_course_type"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-3" style="margin-top: 50px;padding: 0 5px;">
                                <div class="btn-group right-floated">
                                    <button class=" btn blue" onclick="addItem(this)">
                                        <i class="fa fa-plus"></i>&nbsp;新增<?= $category; ?>
                                    </button>
                                </div>
                                <div class="btn-group right-floated" style="margin-right: 10px;">
                                    <button class=" btn btn-default" onclick="searchItems(this)">
                                        <i class="fa fa-search"></i>&nbsp;查询
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!------Tool bar parts (add button and search function------>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="main_tbl">
                            <thead>
                            <tr>
                                <th><?= $category; ?>编码</th>
                                <th><?= $category; ?>类型</th>
                                <th>难易程度</th>
                                <th>所属课程</th>
                                <th>所属科目</th>
                                <th>所属册次</th>
                                <th width="100px">创建时间</th>
                                <th width="170px"><?php echo $this->lang->line('role_operate'); ?></th>
                            </tr>
                            </thead>
                            <tbody><?= $tbl_content ?></tbody>
                        </table>

                        <div class="pagination-bar">
                            <?php echo $this->pagination->create_links(); ?>
                            <script>
                                appendPagination('<?= $curPage; ?>', '<?= $perPage; ?>', '<?= $cntPage; ?>', '<?= $ctrlRoot; ?>');
                            </script>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!-- Upload Progressing part -->
<div class="uploading_backdrop"></div>
<div class="progressing_area" style="display: none">
    <img id="wait_ajax_loader" src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>'/>
    <span style="position: absolute;top: 43%;left: 43%;font-size:18px;color: #fff;z-index: 16000"><?= $this->lang->line('uploading') ?></span>
    <span id="progress_percent">0%</span>
</div>

<!---add new modal--->
<div id="edit-modal" class="modal fade" tabindex="-1" data-width="850">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">新增<?= $category; ?></h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="" id="add-submit-form" role="form"
              method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-body">
                <div class="row" style="border-bottom: 1px solid #f0f0f0;">
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;">所属科目:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="subject_id" value="">
                                <?php
                                foreach ($subjectList as $item) {
                                    echo '<option value="' . $item->id . '">' . $item->title . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;">所属册次:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="term_id" value=""></select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;">课程名称:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="course_type_id" value=""></select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;">难易程度:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="difficult_type" value="">
                                <?php
                                $i = 0;
                                foreach ($diff_str as $item) {
                                    echo '<option value="' . $i . '">' . $item . '</option>';
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;padding: 7px 0;"><?= $category; ?>编码:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <input name="question_no" type="text" class="item-select form-control" value="">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label"
                               style="text-align:center;"><?= $category; ?>类型:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="question_type" value="">
                                <?php
                                $i = 0;
                                foreach ($type_str as $item) {
                                    echo '<option value="' . $i . '">' . $item . '</option>';
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin:0;padding:0;">
                    <iframe class="question-editor"
                            src="<?= base_url() . 'assets/admin/qeditor/multiselect/package/index.html' ?>" width="1280"
                            height="720"></iframe>
                </div>
            </div>
            <div class="modal-footer form-actions">
                <a class="btn green edit-btns" data-type="preview"><i class="fa fa-image"></i>&nbsp;预览</a>
                <button class="btn green edit-btns" data-type="save"><i class="fa fa-save"></i>&nbsp;保存</button>
                <a class="btn green edit-btns" data-type="cancel"><i class="fa fa-close"></i>&nbsp;取消</a>
            </div>
        </form>
    </div>
</div>
<div id="preview-modal" class="modal fade" tabindex="-1" data-width="500">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                onclick="$('iframe.preview-player').attr('src','')"></button>
        <h4 class="modal-title">题目阅览器</h4>
    </div>
    <div class="modal-body" style="text-align:center;height:480px;">
        <div class="preview-player">
            <iframe class="preview-player" width="600" height="400"></iframe>
            <!--            <div onclick="closePlayer();"><i class="fa fa-close"></i></div>-->
        </div>
    </div>
</div>
<!----publish modal-->
<div id="publish-modal" class="modal fade" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo $this->lang->line('message'); ?></h4>
    </div>
    <div class="modal-body" style="text-align:center;">
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" onclick="publishPerform(this);"
                data-type="yes"><?php echo $this->lang->line('ok'); ?></button>
    </div>
</div>

<!----delete modal-->
<div id="delete-modal" class="modal fade" tabindex="-1" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">确定</h4>
    </div>
    <div class="modal-body" style="text-align:center;">
        <h4 class="modal-title">是否删除？</h4>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" data-type="yes" onclick="deletePerform(this);">是</button>
        <button type="button" class="btn green" onclick="$('#delete-modal').modal('toggle');">否</button>
    </div>
</div>

<div class="scripts" hidden style="display: none;">
    <input hidden class="subjectList" value='<?= json_encode($subjectList) ?>'>
    <input hidden class="termList" value='<?= json_encode($termList) ?>'>
    <input hidden class="courseTypeList" value='<?= json_encode($courseTypeList) ?>'>
    <input hidden class="filterInfo"
           value='<?= json_encode($this->session->userdata('filter') ? $this->session->userdata('filter') : array()) ?>'>
    <input hidden class="keywordInfo"
           value='<?= $this->session->userdata('keyword') ? $this->session->userdata('keyword') : ''; ?>'>
    <script>
        $(function () {
            $('a.nav-link[menu_id="12"]').addClass('menu-selected');
            searchConfig();
            controlConfig();
        });

        var subjectList = JSON.parse($('.subjectList').val());
        var termList = JSON.parse($('.termList').val());
        var courseTypeList = JSON.parse($('.courseTypeList').val());
        var filterInfo = JSON.parse($('.filterInfo').val());
        var keywordInfo = $('.keywordInfo').val();
        var contentList = [];
        var lessonInfoList = [];
        var _lessonContents = [];
        var _mainObj = '<?=$mainModel?>';

        function searchConfig() {
            var content_html = '<option value="">全部</option>';
            $('select[name="search_term"]').html(content_html);
            $('select[name="search_course_type"]').html(content_html);
            $('select[name="search_content_type"]').html(content_html);

            // make subject List
            for (var i = 0; i < subjectList.length; i++) {
                var item = subjectList[i];
//                if (item.status == '0') continue;
                content_html += '<option value="' + item.id + '">' + item.title + '</option>';
            }
            $('select[name="search_subject"]').html(content_html);

            $('select[name="search_subject"]').off('change input')
            $('select[name="search_subject"]').on('change input', function (e) {

                // make term list
                var subjectId = $(this).val();
                content_html = '<option value="">全部</option>';
                for (var i = 0; i < termList.length; i++) {
                    var item = termList[i];
//                    if (item.status == '0') continue;
                    if (item.subject_id != subjectId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="search_term"]').html(content_html);
            });

            $('select[name="search_term"]').off('change input');
            $('select[name="search_term"]').on('change input', function (e) {

                // make courseType List
                var termId = $(this).val();
                content_html = '<option value="">全部</option>';
                for (var i = 0; i < courseTypeList.length; i++) {
                    var item = courseTypeList[i];
//                    if (item.status == '0') continue;
                    if (item.term_id != termId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="search_course_type"]').html(content_html);
            });

            if (filterInfo[_mainObj + '.question_no']) $('input[name="search_no"]').val(filterInfo[_mainObj + '.content_no']);
            if (keywordInfo) $('input[name="search_title"]').val(keywordInfo);
            if (filterInfo[_mainObj + '.content_type_no']) $('select[name="search_content_type"]').val(filterInfo[_mainObj + '.content_type_no']);

            if (filterInfo['tbl_huijiao_terms.subject_id']) {
                $('select[name="search_subject"]').val(filterInfo['tbl_huijiao_terms.subject_id']);
                $('select[name="search_subject"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_terms.id']) {
                $('select[name="search_term"]').val(filterInfo['tbl_huijiao_terms.id']);
                $('select[name="search_term"]').trigger('change');
            }

            if (filterInfo[_mainObj + '.course_type_id']) $('select[name="search_course_type"]').val(filterInfo[_mainObj + '.course_type_id']);

            console.log(filterInfo);
        }

        function searchItems(self) {
            $('#searchForm').submit();
        }

        function deleteItem(self) {
            var id = self.getAttribute("data-id");
            $('#delete-modal button[data-type="yes"]').attr("data-id", id);
            $("#delete-modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function deletePerform(self) {

            var id = self.getAttribute("data-id");

            ///ajax process for delete item
            $.ajax({
                type: "post",
                url: baseURL + "<?=$ctrlRoot?>/deleteItem",
                dataType: "json",
                data: {id: id},
                success: function (res) {
                    if (res.status == 'success') {
                        var table = document.getElementById("main_tbl");
                        var tbody = table.getElementsByTagName("tbody")[0];
//                    tbody.innerHTML = res.data;
                        $('#delete-modal').modal('toggle');
                        location.reload();
                    } else//failed{
                        alert(res.data);
                }
            });
        }

        function publishItem(self) {
            var id = self.getAttribute("data-id");
            var status = self.getAttribute("data-status");

            var msg_body = $('#publish-modal').find('.modal-body h4');
            msg_body.html('是否启用？');
            if (status == '1') msg_body.html('是否禁用？');

            $('#publish-modal button[data-type="yes"]').attr("data-id", id);
            $('#publish-modal button[data-type="yes"]').attr("data-status", status);
            $('#publish-modal button[data-type="yes"]').attr("onclick", 'publishPerform(this)');
            $("#publish-modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function publishPerform(self) {

            var id = self.getAttribute("data-id");
            var status = 1 - 1 * self.getAttribute("data-status");

            ///ajax process for publish/unpublish
            $.ajax({
                type: "post",
                url: baseURL + "<?=$ctrlRoot?>/publishItem",
                dataType: "json",
                data: {id: id, status: status},
                success: function (res) {
                    if (res.status == 'success') {
                        var table = document.getElementById("main_tbl");
                        var tbody = table.getElementsByTagName("tbody")[0];
//                    tbody.innerHTML = res.data;
                        $('#publish-modal').modal('toggle');
                        location.reload();
                    }
                    else//failed
                    {
                        alert(res.data);
                    }
                }
            });
        }

        function addItem(self) {
            var id = 0;
            $('#edit-modal button[data-type="save"]').attr("data-id", id);

            $('#edit-modal .modal-title').html('新增<?=$category;?>');
            $('#edit-modal label > span').html('新建');

            $('select[name="course_type_id"]').off('change input');
            $('select[name="course_type_id"]').on('change input', function (object) {
                var courseTypeId = $(this).val();
                makeContentList(courseTypeId, 'contents');
            });

            $('select[name="term_id"]').off('change input');
            $('select[name="term_id"]').on('change input', function (object) {
                var termId = $(this).val();
                var content_html = '';
                for (var i = 0; i < courseTypeList.length; i++) {
                    var item = courseTypeList[i];
//                    if (item.status == '0') continue;
                    if (item.term_id != termId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="course_type_id"]').html(content_html);
                $('select[name="course_type_id"]').trigger('change');
            });

            $('select[name="subject_id"]').off('change input');
            $('select[name="subject_id"]').on('change input', function (object) {
                var subjectId = $(this).val();
                var content_html = '';
                for (var i = 0; i < termList.length; i++) {
                    var item = termList[i];
//                    if (item.status == '0') continue;
                    if (item.subject_id != subjectId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="term_id"]').html(content_html);
                var value2 = '';
                if ($('#edit-modal select[name="term_id"]').find('option')[0])
                    value2 = $('#edit-modal select[name="term_id"]').find('option')[0].getAttribute('value');
                $('select[name="term_id"]').val(value2);
                $('select[name="term_id"]').trigger('change');
            });

            // var value1 = '';
            // if ($('#edit-modal select[name="subject_id"]').find('option')[0])
            //     value1 = $('#edit-modal select[name="subject_id"]').find('option')[0].getAttribute('value');
            // $('#edit-modal select[name="subject_id"]').val(value1);
            // $('select[name="subject_id"]').trigger('change');

            // var value3 = '';
            // if ($('#edit-modal select[name="course_type_id"]').find('option')[0])
            //     value3 = $('#edit-modal select[name="course_type_id"]').find('option')[0].getAttribute('value');
            // $('select[name="course_type_id"]').val(value3);

            var value6 = '';
            $('#edit-modal input[name="question_no"]').val(value6);

            var question_type = '0';
            $('#edit-modal select[name="question_type"]').off('change input');
            $('#edit-modal select[name="question_type"]').on('change input', function (object) {
                var that = $(this);
                var id = that.val() * 1;
                var editors = ['multiselect', 'yesno', 'fillblank'];
                $('iframe.question-editor').attr('src', baseURL + 'assets/admin/qeditor/' + editors[id] + '/package/index.html');
                $('iframe.question-editor').off('load');
                $('iframe.question-editor').on('load', function (e) {
                    $('iframe.question-editor')[0].contentWindow.setQuestionContent('');
                    $('iframe.question-editor')[0].contentWindow.setAnswerContentArr('[]');
                    $('iframe.question-editor')[0].contentWindow.setDescriptionContent('');
                    $('iframe.question-editor').off('load');
                });
            });
            $('#edit-modal select[name="question_type"]').val(question_type);
            $('#edit-modal select[name="question_type"]').trigger('change');

            var difficult_type = '0';
            $('#edit-modal select[name="difficult_type"]').val(difficult_type);

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function editItem(self) {
            var id = self.getAttribute('data-id');
            $('#edit-modal button[data-type="save"]').attr("data-id", id);

            var trtag = self.parentNode.parentNode;
            var value1 = self.getAttribute('data-subject');
            var value2 = self.getAttribute('data-term');
            var question_no = trtag.cells[0].innerHTML;

            $('#edit-modal .modal-title').html('编辑<?=$category;?>');
            $('#edit-modal label > span').html('');

            $('select[name="term_id"]').off('change input');
            $('select[name="term_id"]').on('change input', function (object) {
                var termId = $(this).val();
                var content_html = '';
                for (var i = 0; i < courseTypeList.length; i++) {
                    var item = courseTypeList[i];
//                    if (item.status == '0') continue;
                    if (item.term_id != termId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="course_type_id"]').html(content_html);
                $('select[name="course_type_id"]').trigger('change');
            });

            $('select[name="subject_id"]').off('change input');
            $('select[name="subject_id"]').on('change input', function (object) {
                var subjectId = $(this).val();
                var content_html = '';
                for (var i = 0; i < termList.length; i++) {
                    var item = termList[i];
//                    if (item.status == '0') continue;
                    if (item.subject_id != subjectId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="term_id"]').html(content_html);
            });

            $('#edit-modal input[name="question_no"]').val(question_no);

            $('#edit-modal select[name="subject_id"]').val(value1);
            $('select[name="subject_id"]').trigger('change');

            $('select[name="term_id"]').val(value2);
            $('select[name="term_id"]').trigger('change');

            var question_content = self.getAttribute('data-content');
            var question_answer = self.getAttribute('data-answer');
            var question_description = self.getAttribute('data-description');

            var question_type = self.getAttribute('data-type');
            $('#edit-modal select[name="question_type"]').off('change input');
            $('#edit-modal select[name="question_type"]').on('change input', function (object) {
                var that = $(this);
                var id = that.val() * 1;
                var editors = ['multiselect', 'yesno', 'fillblank'];
                $('iframe.question-editor').attr('src', baseURL + 'assets/admin/qeditor/' + editors[id] + '/package/index.html');
                $('iframe.question-editor').off('load');
                $('iframe.question-editor').on('load', function (e) {
                    $('iframe.question-editor')[0].contentWindow.setQuestionContent(question_content);
                    $('iframe.question-editor')[0].contentWindow.setAnswerContentArr(question_answer);
                    $('iframe.question-editor')[0].contentWindow.setDescriptionContent(question_description);
                    $('iframe.question-editor').off('load');
                })
            });
            $('#edit-modal select[name="question_type"]').val(question_type);
            $('#edit-modal select[name="question_type"]').trigger('change');

            var difficult_type = self.getAttribute('data-difficult');
            $('#edit-modal select[name="difficult_type"]').val(difficult_type);

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function controlConfig() {
            $('.edit-btns').on('click', function (e) {
                var type = $(this).attr('data-type');
                var parentTag = $('.content-items[data-type="lesson"]');
                switch (type) {
                    case 'cancel':
                        $('#edit-modal').modal('toggle');
                        break;
                    case 'save':

                        break;
                        preparePreview();
                        $("#add-submit-form").submit();
                        var termId = $('select-item[name="term_id"]').val();
                        var title = $('input.item-select').val();
                        if (!title) {
                            alert('请输入新建课件名称');
                            break;
                        }
                        if (lessonInfoList.length == 0) {
                            alert('请添加课件资源');
                            break;
                        }
                        var uploadData = {
                            id: 0,
                            title: title,
                            term_id: termId,
                            lesson_info: JSON.stringify(lessonInfoList),
                            user_id: 0,
                        };
                        if ($(this).attr('data-id')) uploadData.id = $(this).attr('data-id');


                        $.ajax({
                            type: "post",
                            url: baseURL + "resource/updateLessonInfo",
                            dataType: "json",
                            data: uploadData,
                            success: function (res) {
                                if (res.status == 'success') {
                                    console.log('课件保存成功!');
                                    closePlayer();
                                    $('#edit-modal').modal('toggle');
                                    location.reload();
                                } else { //failed
                                    alert("上传失败");
                                }
                            }
                        });
                        break;
                    case 'preview':
                        if (preparePreview()) showLessonPlayer(0, 1);
                        break;
                }
            })

        }

        function makeLessonContents(lessonInfo) {
            var type = 'lesson';
            var tag = $('.content-items[data-type="' + type + '"]');
            tag.hide();
            $.ajax({
                type: "post",
                url: baseURL + "admin/lessons/getContentsFromLessonInfo",
                dataType: "json",
                data: {
                    lesson_info: lessonInfo
                },
                success: function (res) {
                    if (res.status == 'success') {
                        var results = res.data;
                        _lessonContents = results;
                        var allList = _lessonContents;
                        var content_html = '';
                        for (var i = 0; i < allList.length; i++) {
                            var contentItem = allList[i];
                            content_html += '<div class="list-item" ' +
                                'data-id="' + contentItem.id + '" ' +
                                'data-title="' + contentItem.title + '" ' +
                                'data-content-type="' + contentItem.content_type_id + '" ' +
                                'data-src="' + contentItem.content_path + '" ' +
                                'data-type="lesson" style="position: relative;">' +
                                '<img class="item-icon" src="' + baseURL + contentItem.icon_path + '">' +
                                '<img class="item-icon" src="' + baseURL + contentItem.icon_corner + '" style="position: absolute;right:13%;width:76%;top:3px;">' +
                                '<div class="item-desc"><div>' + contentItem.title + '</div></div>' +
                                '</div>';
                        }
                        tag.html(content_html);
                        tag.fadeIn('fast');
                        refreshLessonInfo();
                    }
                    else//failed
                    {
                        alert("课件信息取得错误");
                    }
                }
            });
        }

        function makeContentList(coursetype_id, type) {
            if (!coursetype_id) coursetype_id = 1;
            if (!type) type = 'contents';
            $.ajax({
                type: "post",
                url: baseURL + "resource/getContents",
                dataType: "json",
                data: {
                    user_id: 0,
                    coursetype_id: coursetype_id
                },
                success: function (res) {
                    if (res.status == true) {
                        var results = res.data;
                        contentList = results;
                        var content_html = '';
                        for (var i = 0; i < results.length; i++) {
                            var item = results[i];
                            content_html += '<div class="list-item" ' +
                                'data-id="' + item.id + '" data-type="coursetype">'
                                + item.title + '</div>';
                        }
                        var tag = $('.content-items[data-type="' + type + '"]');
                        var titleInfoTag = $('.content-titleinfo[data-type="' + type + '"]');
                        tag.hide();
                        tag.html(content_html);
                        tag.fadeIn('fast');

                        tag.find('.list-item').off('click');
                        tag.find('.list-item').off('mouseover');
                        tag.find('.list-item').off('mouseout');
                        tag.find('.list-item').on('click', function (e) {
                            var status = $(this).attr('data-sel');
                            tag.find('.list-item').removeAttr('data-sel');
                            if (status != '1') {
                                $(this).attr('data-sel', 1);
                                var contentId = $(this).attr('data-id');
                                addContentToLesson(contentId);
                            }
                        }).on('mouseover', function (e) {
                            var title = $(this).html();
                            // console.log(title);
                            if (title.length < 13) return;
                            titleInfoTag.html(title);
                            titleInfoTag.show();
                            titleInfoTag.css({
                                top: this.offsetTop + this.offsetHeight,
                                left: this.offsetLeft + 2
                            })
                        }).on('mouseout', function (e) {
                            titleInfoTag.hide();
                        })
                    }
                    else//failed
                    {
                        alert("Cannot update lesson Item.");
                    }
                }
            });
        }

        function addContentToLesson(contentId, type) {
            if (!contentId) contentId = contentList[0].id;
            if (!type) type = 'lesson';

            var contentItem = contentList.filter(function (a) {
                return a.id == contentId;
            })[0];
            if (!contentItem) return;
            if (lessonInfoList.length > 0) {
                var oldId = lessonInfoList.filter(function (a) {
                    return a == contentId;
                })[0];
                if (oldId) return;
            }

            var tag = $('.content-items[data-type="' + type + '"]');
            var content_html = '';
            content_html += '<div class="list-item" ' +
                'data-id="' + contentItem.id + '" ' +
                'data-title="' + contentItem.title + '" ' +
                'data-content-type="' + contentItem.content_type_id + '" ' +
                'data-src="' + contentItem.content_path + '" ' +
                'data-type="lesson" style="position: relative;">' +
                '<img class="item-icon" src="' + baseURL + contentItem.icon_path + '">' +
                '<img class="item-icon" src="' + baseURL + contentItem.icon_corner + '" style="position: absolute;left:13%;width:76%;top:3px;">' +
                '<div class="item-desc"><div>' + contentItem.title + '</div></div>' +
                '</div>';
            tag.append(content_html);
            refreshLessonInfo();

        }

        function refreshLessonInfo() {
            var type = 'lesson';
            var tag = $('.content-items[data-type="' + type + '"]');
            var titleInfoTag = $('.content-titleinfo[data-type="' + type + '"]');
            lessonInfoList = [];
            for (var i = 0; i < tag.find('.list-item').length; i++) {
                var itemId = tag.find('.list-item')[i].getAttribute('data-id');
                lessonInfoList.push(itemId);
            }
            tag.find('.list-item').off('click');
            tag.find('.list-item').off('mouseover');
            tag.find('.list-item').off('mouseout');
            tag.find('.list-item').on('click', function (e) {
                tag.find('.list-item').removeAttr('data-sel');
                var status = $(this).attr('data-sel');
                tag.find('.list-item').removeAttr('data-last');
                $(this).attr('data-last', 1);
                if (status) {
                    $(this).removeAttr('data-sel');
                } else {
                    $(this).attr('data-sel', 1);
                    var contentId = $(this).attr('data-id');
                }
            }).on('mouseover', function (e) {
                var title = $(this).find('.item-desc > div').html();
                // console.log(title);
                if (title.length < 5) return;
                titleInfoTag.html(title);
                titleInfoTag.show();
                titleInfoTag.css({
                    top: this.offsetTop + this.offsetHeight,
                    left: this.offsetLeft + 2
                })
            }).on('mouseout', function (e) {
                titleInfoTag.hide();
            });
            // console.log(lessonInfoList);
        }

        function preparePreview() {
            var qEditor = $('iframe.question-editor')[0].contentWindow;
            var questionInfo = qEditor.getQuestionInfo();
            if (questionInfo.ques == '') {
                alert('请输入题干');
                return false;
            }
            if (questionInfo.ans.length == 0) {
                alert('请输入答案');
                return false;
            }
            var isAnswerCheckOk = false;
            var isAnswerContentOk = true;
            for (var i = 0; i < questionInfo.ans.length; i++) {
                var ansItem = questionInfo.ans[i];
                switch (questionInfo.type) {
                    case 0: // multiselect
                        if (ansItem.is_checked == true) isAnswerCheckOk = true;
                        if (ansItem.content == '') isAnswerContentOk = false;
                        break;
                    case 1: // yesno
                        if (ansItem.is_checked == true) isAnswerCheckOk = true;
                        break;
                    case 2: // fill blank
                        isAnswerCheckOk = true;
                        if (ansItem.content == '') isAnswerContentOk = false;
                        break;
                }
            }
            if (!isAnswerContentOk) {
                alert('请输入答案内容');
                return false;
            }
            if (!isAnswerCheckOk) {
                alert('请选择答案');
                return false;
            }
            save2Storage(questionInfo);
            return true;
        }

        function save2Storage(qInfo) {
            var qTypes = ["选择题", "判断题", "填空题"];
            qInfo.qType = qTypes[qInfo.type];
            localStorage.setItem('quiz', JSON.stringify(qInfo));
            localStorage.setItem('qId', qInfo.id);
        }

        function getFromStorage() {
            var quiz = localStorage.getItem('quiz');
            quiz = JSON.parse(quiz);
            quiz.id = localStorage.getItem('qId');
            return quiz;
        }

        function showContentPlayer(id, isPopup) {
            id = parseInt(id);
            $('iframe.preview-player').attr('src', baseURL + "resource/warePreviewPlayer/" + id);
            $('#preview-modal').find('.modal-header .modal-title').html('资源阅览器');
            $('#preview-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function showLessonPlayer(id, isPopup) {
            var type = getFromStorage().type;
            var dataPath = ['multiselect', 'yesno', 'fillblank'];

            $('iframe.preview-player').attr('src', baseURL + "assets/admin/qeditor/" +
                dataPath[type] + '/preview/package/index.html');
            $('#preview-modal').find('.modal-header .modal-title').html('题目阅览器');
            $('#preview-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function closePlayer() {
            $('#preview-modal').modal('hide');
            $('iframe.preview-player').attr('src', '');
        }

        $("#add-submit-form").submit(function (e) {
            e.preventDefault();
            var qEditor = $('iframe.question-editor')[0].contentWindow;
            var questionInfo = qEditor.getQuestionInfo();
            if ($('input[name="question_no"]').val() == '') {
                alert('请输入题目编码');
                return;
            }
            if ($('select[name="course_type_id"]').val() == '') {
                alert('请选择所属课程');
                return;
            }
            if (questionInfo.ques == '') {
                alert('请输入题干');
                return;
            }
            if (questionInfo.ans.length == 0) {
                alert('请输入答案');
                return;
            }
            var isAnswerCheckOk = false;
            var isAnswerContentOk = true;
            for (var i = 0; i < questionInfo.ans.length; i++) {
                var ansItem = questionInfo.ans[i];
                switch (questionInfo.type) {
                    case 0: // multiselect
                        if (ansItem.is_checked == true) isAnswerCheckOk = true;
                        if (ansItem.content == '') isAnswerContentOk = false;
                        break;
                    case 1: // yesno
                        if (ansItem.is_checked == true) isAnswerCheckOk = true;
                        break;
                    case 2: // fill blank
                        isAnswerCheckOk = true;
                        if (ansItem.content == '') isAnswerContentOk = false;
                        break;
                }
            }
            if (!isAnswerContentOk) {
                alert('请输入答案内容');
                return;
            }
            if (!isAnswerCheckOk) {
                alert('请选择答案');
                return;
            }
            var qId = '';
            if ($('#edit-modal .edit-btns[data-type="save"]').attr('data-id'))
                qId = $('.edit-btns[data-type="save"]').attr('data-id');

            var that = this;
            $(that).find('button[type="submit"]').attr('disabled', 'disabled');

            $(".uploading_backdrop").show();
            $(".progressing_area").show();

            var fdata = new FormData(this);
            fdata.append("id", qId);
            fdata.append("question_content", questionInfo.ques);
            fdata.append("question_answer", JSON.stringify(questionInfo.ans));
            fdata.append("question_description", questionInfo.desc);
            fdata.append("question_type", questionInfo.type);
            $.ajax({
                url: baseURL + "<?=$ctrlRoot?>/updateItem",
                type: "POST",
                data: fdata,
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                xhr: function () {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            $("#progress_percent").text(percent + '%');

                        }, true);
                    }
                    return xhr;
                },
                mimeType: "multipart/form-data"
            }).done(function (res) { //
                var ret;
                $(".uploading_backdrop").hide();
                $(".progressing_area").hide();
                $(that).find('button[type="submit"]').removeAttr('disabled');
                try {
                    ret = JSON.parse(res);
                } catch (e) {
                    alert('操作失败 : ' + JSON.stringify(e));
                    console.log(e);
                    return;
                }
                if (ret.status == 'success') {
                    var table = document.getElementById("main_tbl");
                    var tbody = table.getElementsByTagName("tbody")[0];
//                    tbody.innerHTML = ret.data;
                    $('#edit-modal').modal('toggle');
                    location.reload();
                }
                else//failed
                {
                    alert('操作失败 : ' + ret.data);
                    // jQuery('#ncw_edit_modal').modal('toggle');
                    // alert(ret.data);
                }
            });
        });

        $('.scripts').remove();
    </script>
</div>




