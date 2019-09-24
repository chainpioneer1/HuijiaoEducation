<?php
$ctrlRoot = 'admin/users';
$category = '用户';
$mainModel = 'tbl_user';
?>

<style>
    #main_tbl th, td {
        text-align: center;
        vertical-align: middle;
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
                            <form class="form-horizontal col-md-10" action="<?= base_url($ctrlRoot . '/register_info') ?>"
                                  id="searchForm" role="form" method="post" enctype="multipart/form-data"
                                  accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>ID:</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>名:</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">用户类型:</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_type"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-2" style="">
                                <div class="btn-group right-floated" style="margin-right: 30px;">
                                    <button class=" btn btn-default" onclick="searchItems(this)">
                                        <i class="fa fa-search"></i>&nbsp查询
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
                                <th>账号</th>
                                <th><?= $category; ?>名</th>
                                <th><?= $category; ?>类型</th>
                                <th>最后一次登录时间</th>
                                <th>IP</th>
                                <th width="100px">登录次数</th>
                                <th width="100px">最后在线时长</th>
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
<div id="edit-modal" class="modal fade" tabindex="-1" data-width="700">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">新增<?= $category; ?></h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="" id="add-submit-form" role="form"
              method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;">所属科目:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="subject_id" value="">
                                <?php
                                foreach ($subjectList as $item) {
                                    //                                    if ($item->status == '0') continue;
                                    echo '<option value="' . $item->id . '">' . $item->title . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;">所属册次:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="term_id" value=""></select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;">所属课程:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="course_type_id" value=""></select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;">资源类型:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <select class="form-control" name="content_type_no" value="">
                                <?php
                                foreach ($contentTypeList as $item) {
                                    //                                    if ($item->status == '0') continue;
                                    echo '<option value="' . $item->id . '">' . $item->title . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;"><?= $category; ?>名称:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <input type="text" class="form-control" name="title" value="">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label"
                               style="text-align:center;"><?= $category; ?>编码:</label>
                        <div class="col-md-7" style="padding-left: 0">
                            <input type="text" class="form-control" name="no" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2 right-aligned">
                            <label for="cwImageUpload" class="control-label">封面图:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput"
                                 style="background-color: #e0e1e1;width: 270px;position: relative">
                                <span class="btn btn-default btn-file">
                                    <span class="btn_browse_item"
                                          item_type="4"><?php echo $this->lang->line('Browse'); ?></span>
                                    <input type="file"
                                           class="form-control"
                                           name="item_icon_file4"
                                           item_type="4"
                                           accept=".png,.jpg,.bmp,.gif,.jpeg"/>
                                </span>
                                <div class="fileinput-new" item_name="nameview4">
                                    <?php echo $this->lang->line('NoFileSelected'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <div class="img_preview" item_type="4"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 right-aligned">
                            <label for="cwImageUpload" class="control-label">内容包:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput"
                                 style="background-color: #e0e1e1;width: 270px;position: relative">
                                <span class="btn btn-default btn-file">
                                    <span class="btn_browse_item"
                                          item_type="5"><?php echo $this->lang->line('Browse'); ?></span>
                                    <input type="file"
                                           class="form-control"
                                           name="item_icon_file5"
                                           item_type="5"
                                           accept=".png,.jpg,.bmp,.gif,.jpeg,.docx,.pdf,.mp4,.html,.zip"/>
                                </span>
                                <div class="fileinput-new" item_name="nameview5">
                                    <?php echo $this->lang->line('NoFileSelected'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer form-actions">
                <button type="submit" class="btn green" data-type="save">保存</button>
            </div>
        </form>
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
    <input hidden class="userTypeList" value='<?= json_encode($userTypeList) ?>'>
    <input hidden class="filterInfo"
           value='<?= json_encode($this->session->userdata('filter') ? $this->session->userdata('filter') : array()) ?>'>
    <script>
        $(function () {
            $('a.nav-link[menu_id="50"]').addClass('menu-selected');
            searchConfig();
        });

        var subjectList = JSON.parse($('.subjectList').val());
        var termList = JSON.parse($('.termList').val());
        var userTypeList = JSON.parse($('.userTypeList').val());
        var filterInfo = JSON.parse($('.filterInfo').val());
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

            // make contentType List
            content_html = '<option value="">全部</option>';
            for (var i = 0; i < userTypeList.length; i++) {
                var item = userTypeList[i];
//                if (item.status == '0') continue;
                content_html += '<option value="' + item.id + '">' + item.title + '</option>';
            }
            $('select[name="search_type"]').html(content_html);

            if (filterInfo[_mainObj + '.user_account']) $('input[name="search_no"]').val(filterInfo[_mainObj + '.user_account']);
            if (filterInfo[_mainObj + '.user_nickname']) $('input[name="search_title"]').val(filterInfo[_mainObj + '.user_nickname']);
            if (filterInfo[_mainObj + '.user_type']) $('select[name="search_type"]').val(filterInfo[_mainObj + '.user_type']);

            if (filterInfo['tbl_huijiao_terms.subject_id']) {
                $('select[name="search_subject"]').val(filterInfo['tbl_huijiao_terms.subject_id']);
                $('select[name="search_subject"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_terms.id']) {
                $('select[name="search_term"]').val(filterInfo['tbl_huijiao_terms.id']);
            }
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
                var value2 = $('#edit-modal select[name="term_id"]').find('option')[0].getAttribute('value');
                $('select[name="term_id"]').val(value2);
                $('select[name="term_id"]').trigger('change');
            });


            var value1 = $('#edit-modal select[name="subject_id"]').find('option')[0].getAttribute('value');
            $('#edit-modal select[name="subject_id"]').val(value1);
            $('select[name="subject_id"]').trigger('change');


            var value3 = $('#edit-modal select[name="course_type_id"]').find('option')[0].getAttribute('value');
            $('select[name="course_type_id"]').val(value3);

            var value4 = $('#edit-modal select[name="content_type_no"]').find('option')[0].getAttribute('value');
            $('select[name="content_type_no"]').val(value4);

            var value5 = '', value6 = '';
            $('#edit-modal input[name="no"]').val(value5);
            $('#edit-modal input[name="title"]').val(value6);
            var image_icon = '';
            var course_path = '';
            $('input[type="file"]').val('');

            $('div .img_preview[item_type="4"]').css({background: '#f0f0f0'});

            if (image_icon == '') image_icon = '<?=$this->lang->line('NoFileSelected')?>';
            if (course_path == '') course_path = '<?=$this->lang->line('NoFileSelected')?>';

            $('div[item_name="nameview4"]').html(getFilenameFromURL(image_icon));
            $('div[item_name="nameview5"]').html(getFilenameFromURL(course_path));

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
            var value3 = self.getAttribute('data-course_type');
            var value4 = self.getAttribute('data-content_type');
            var value5 = trtag.cells[0].innerHTML;
            var value6 = trtag.cells[1].innerHTML;
            var image_icon = self.getAttribute('data-icon_path');
            var content_path = self.getAttribute('data-content_path');

            $('#edit-modal .modal-title').html('新增<?=$category;?>');

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

            $('#edit-modal input[name="no"]').val(value5);
            $('#edit-modal input[name="title"]').val(value6);

            $('#edit-modal select[name="subject_id"]').val(value1);
            $('select[name="subject_id"]').trigger('change');

            $('select[name="term_id"]').val(value2);
            $('select[name="term_id"]').trigger('change');

            $('select[name="course_type_id"]').val(value3);
            $('select[name="content_type_no"]').val(value4);

            $('input[type="file"]').val('');

            $('div .img_preview[item_type=4]').css({background: 'url(' + image_icon + ')'});

            if (image_icon == '') image_icon = '<?=$this->lang->line('NoFileSelected')?>';
            if (content_path == '') content_path = '<?=$this->lang->line('NoFileSelected')?>';
            var name4 = getFilenameFromURL(image_icon);
            var name5 = getFilenameFromURL(content_path);
            if (name4.length > 23) name4 = name4.substr(0, 8) + '...' + name4.substr(-14);
            if (name5.length > 23) name5 = name5.substr(0, 8) + '...' + name5.substr(-14);
            $('div[item_name="nameview4"]').html(name4);
            $('div[item_name="nameview5"]').html(name5);

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        $("#add-submit-form").submit(function (e) {
            e.preventDefault();
            var that = this;
            $(that).find('button[type="submit"]').attr('disabled', 'disabled');

            var icon_format = getFiletypeFromURL($('div[item_name="nameview4"]').html());
            if (icon_format == '<?=$this->lang->line('NoFileSelected')?>') icon_format = '';
            var content_format = $('div[item_name="nameview5"]').html();
            if (content_format == '<?=$this->lang->line('NoFileSelected')?>') content_format = '';

            icon_format = getFiletypeFromURL(icon_format);
            content_format = getFiletypeFromURL(content_format);

            $(".uploading_backdrop").show();
            $(".progressing_area").show();
            var submit_form = document.getElementById('item_edit_submit_form');

            var fdata = new FormData(this);
            fdata.append("id", $('#edit-modal button[data-type="save"]').attr('data-id'));
            fdata.append("icon_format", icon_format);
            fdata.append("content_format", content_format);
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

        $('.btn_browse_item').on('click', function () {
            var item_type = $(this).attr('item_type');
            $('input[name="item_icon_file' + item_type + '"]').val('');
            $('input[name="item_icon_file' + item_type + '"]').trigger('click');
        });

        $('input[type="file"]').on('click', function (object) {
            $(this).val('');
        });
        $('input[type="file"]').on('change', function () {
            var item_type = $(this).attr('item_type');
            var totalStr = this.files[0].name;
            var realNameStr = getFilenameFromURL(totalStr);
            var type = getFiletypeFromURL(realNameStr);
            if (item_type == '4') {
                if (type != 'jpg' && type != 'jpeg'
                    && type != 'png' && type != 'bmp' && type != 'gif') {
                    alert('图片格式不正确..');
                    return;
                }
            } else {
                if (type != 'jpg' && type != 'jpeg'
                    && type != 'png' && type != 'bmp' && type != 'gif'
                    && type != 'docx' && type != 'pdf' && type != 'html'
                    && type != 'mp4'
                    && type != 'zip') {
                    alert('课程内容格式不正确..');
                    return;
                }
            }
            $('div[item_name="nameview' + item_type + '"]').html(realNameStr);
            preview_image(item_type, this.files[0]);
        });

        function preview_image(item_type, file) {
            if(item_type=='5') return;
            var previewer = $('div .img_preview[item_type="' + item_type + '"]');
            var reader = new FileReader();
            reader.onloadend = function () {
                previewer.css({
                    background: 'url(' + reader.result + ')'
                })
            };
            if (file) {
                reader.readAsDataURL(file);//reads the data as a URL
            } else {
                previewer.css({
                    background: '#f0f0f0'
                })
            }
        }

        $('.scripts').remove();
    </script>
</div>




