<?php
$ctrlRoot = 'admin/contenttypes';
$category = '类型';
$mainModel = 'tbl_huijiao_content_type';
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
                            <form style="display:none;" class="form-horizontal col-md-8"
                                  action="<?= base_url($ctrlRoot . '/index') ?>"
                                  id="searchForm" role="form" method="post" enctype="multipart/form-data"
                                  accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>编码 :</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>名称 :</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属科目 :</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_subject"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属册次 :</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control"
                                                        name="search_term"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="btn-group right-floated">
                                        <button class=" btn btn-default" onclick="publishItem(this)" data-id="-1"
                                                data-status="0">
                                            <i class="fa fa-save"></i>&nbsp全部启用
                                        </button>
                                    </div>
                                    <div class="btn-group right-floated" style="margin-right: 30px;">
                                        <button class=" btn btn-warning" onclick="publishItem(this)" data-id="-2"
                                                data-status="1">
                                            <i class="fa fa-save"></i>&nbsp全部禁用
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-group right-floated" style="margin-right: 30px;">
                                        <button class=" btn blue" onclick="addItem(this)">
                                            <i class="fa fa-plus"></i>&nbsp新增<?= $category; ?>
                                        </button>
                                    </div>
                                    <!--                                <div class="btn-group right-floated" style="margin-right: 30px;margin-top: 10px;">-->
                                    <!--                                    <button class=" btn btn-default" onclick="searchItems(this)">-->
                                    <!--                                        <i class="fa fa-search"></i>&nbsp查询-->
                                    <!--                                    </button>-->
                                    <!--                                </div>-->
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
                                <th><?= $category; ?>名称</th>
                                <!--                                <th>PC端角标</th>-->
                                <!--                                <th>移动端角标</th>-->
                                <th>新增时间</th>
                                <th width="250px;"><?php echo $this->lang->line('role_operate'); ?></th>
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
<div id="edit-modal" class="modal fade" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">新增<?= $category; ?></h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="" id="add-submit-form" role="form"
              method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-4 control-label"
                           style="text-align:center;"><?= $category; ?>编码:</label>
                    <div class="col-md-7" style="padding-left: 0">
                        <input type="text" class="form-control" name="no" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label"
                           style="text-align:center;"><?= $category; ?>名称:</label>
                    <div class="col-md-7" style="padding-left: 0">
                        <input type="text" class="form-control" name="title" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cwImageUpload" class=" col-md-4 control-label"
                           style="text-align: center;">PC端角标:</label>
                    <div class="col-md-7" style="padding-left: 0;">
                        <div class="fileinput fileinput-new" data-provides="fileinput"
                             style="background-color: #e0e1e1;position: relative">
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
                    <div class="col-md-12" style="text-align: center;" hidden>
                        <div class="img_preview" item_type="4"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cwImageUpload" class=" col-md-4 control-label"
                           style="text-align: center;">移动端角标:</label>
                    <div class="col-md-7" style="padding-left: 0;">
                        <div class="fileinput fileinput-new" data-provides="fileinput"
                             style="background-color: #e0e1e1;position: relative">
                                <span class="btn btn-default btn-file">
                                    <span class="btn_browse_item"
                                          item_type="5"><?php echo $this->lang->line('Browse'); ?></span>
                                    <input type="file"
                                           class="form-control"
                                           name="item_icon_file5"
                                           item_type="5"
                                           accept=".png,.jpg,.bmp,.gif,.jpeg"/>
                                </span>
                            <div class="fileinput-new" item_name="nameview5">
                                <?php echo $this->lang->line('NoFileSelected'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center;" hidden>
                        <div class="img_preview" item_type="5"></div>
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
    <script>
        $(function () {
            $('a.nav-link[menu_id="03"]').addClass('menu-selected');
        })

        var _mainObj = '<?=$mainModel?>';

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
                data: {id: id, status: status, pageId: '<?=$curPage;?>'},
                success: function (res) {
                    if (res.status == 'success') {
                        var table = document.getElementById("main_tbl");
                        var tbody = table.getElementsByTagName("tbody")[0];
//                    tbody.innerHTML = res.data;
                        $('#publish-modal').modal('toggle');
                        location.reload();
                    } else//failed
                    {
                        alert(res.data);
                    }
                }
            });
        }

        function addItem(self) {
            var id = 0;
            $('#edit-modal button[data-type="save"]').attr("data-id", id);
            var value1 = '';
            var value2 = '';

            $('#edit-modal input[name="no"]').val(value1);
            $('#edit-modal input[name="title"]').val(value2);

            $('#edit-modal .modal-title').html('新增资源<?=$category;?>');

            var image_icon = '';
            var image_icon_m = '';
            $('input[type="file"]').val('');

//            $('div .img_preview[item_type="4"]').css({background: '#f0f0f0'});

            if (image_icon == '') image_icon = '<?=$this->lang->line('NoFileSelected')?>';
            if (image_icon_m == '') image_icon_m = '<?=$this->lang->line('NoFileSelected')?>';

            $('div[item_name="nameview4"]').html(getFilenameFromURL(image_icon));
            $('div[item_name="nameview5"]').html(getFilenameFromURL(image_icon_m));

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function editItem(self) {

            var id = self.getAttribute('data-id');
            $('#edit-modal button[data-type="save"]').attr("data-id", id);
            var trtag = self.parentNode.parentNode;
            var value1 = trtag.cells[0].innerHTML;
            var value2 = trtag.cells[1].innerHTML;
            var image_icon = self.getAttribute('data-icon_path');
            var image_icon_m = self.getAttribute('data-icon_path_m');

            $('#edit-modal input[name="no"]').val(value1);
            $('#edit-modal input[name="title"]').val(value2);

            $('#edit-modal .modal-title').html('编辑资源<?=$category;?>');

            $('div .img_preview[item_type=4]').css({background: 'url(' + image_icon + ')'});

            if (image_icon == '') image_icon = '<?=$this->lang->line('NoFileSelected')?>';
            var name4 = getFilenameFromURL(image_icon);
            if (name4.length > 18) name4 = name4.substr(0, 2) + '...' + name4.substr(-15);
            $('div[item_name="nameview4"]').html(name4);

            if (image_icon_m == '') image_icon_m = '<?=$this->lang->line('NoFileSelected')?>';
            var name5 = getFilenameFromURL(image_icon_m);
            if (name5.length > 18) name5 = name5.substr(0, 2) + '...' + name5.substr(-15);
            $('div[item_name="nameview5"]').html(name5);

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        $("#add-submit-form111").submit(function (e) {
            e.preventDefault();
            var fdata = new FormData(this);
            fdata.append("id", $('#edit-modal button[data-type="save"]').attr('data-id'));
            $.ajax({
                url: baseURL + "<?=$ctrlRoot?>/updateItem",
                type: "post",
                data: fdata,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (res) {
                    var ret = JSON.parse(res);
                    if (ret.status == 'success') {
                        var table = document.getElementById("main_tbl");
                        var tbody = table.getElementsByTagName("tbody")[0];
//                    tbody.innerHTML = ret.data;
                        $('#edit-modal').modal('toggle');
                        location.reload();
                    } else//failed
                    {
                        alert(ret.data);
                    }
                }
            });
        });

        $("#add-submit-form").submit(function (e) {
            e.preventDefault();
            var that = this;
            $(that).find('button[type="submit"]').attr('disabled', 'disabled');

            var icon_format = getFiletypeFromURL($('div[item_name="nameview4"]').html());
            if (icon_format == '<?=$this->lang->line('NoFileSelected')?>') icon_format = '';
            icon_format = getFiletypeFromURL(icon_format);

            var icon_format_m = getFiletypeFromURL($('div[item_name="nameview5"]').html());
            if (icon_format_m == '<?=$this->lang->line('NoFileSelected')?>') icon_format_m = '';
            icon_format_m = getFiletypeFromURL(icon_format_m);

            $(".uploading_backdrop").show();
            $(".progressing_area").show();

            var fdata = new FormData(this);
            fdata.append("id", $('#edit-modal button[data-type="save"]').attr('data-id'));
            fdata.append("icon_format", icon_format);
            fdata.append("icon_format_m", icon_format_m);

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
                } else//failed
                {
                    alert('操作失败 : ' + ret.data);
                    // jQuery('#ncw_edit_modal').modal('toggle');
                    // alert(ret.data);
                }
            });
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
                if (type != 'jpg' && type != 'jpeg' && type != 'png' && type != 'bmp' && type != 'gif'
                    && type != 'docx' && type != 'doc'
                    && type != 'ppt' && type != 'pptx'
                    && type != 'pdf'
                    && type != 'html' && type != 'htm'
                    && type != 'mp4' && type != 'mp3'
                    && type != 'zip') {
                    alert('课程内容格式不正确..');
                    return;
                }
            }
            $('div[item_name="nameview' + item_type + '"]').html(realNameStr);
            preview_image(item_type, this.files[0]);
        });

        function preview_image(item_type, file) {
            if (item_type == '5') return;
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




