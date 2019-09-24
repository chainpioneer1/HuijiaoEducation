<?php
$ctrlRoot = 'admin/terms';
$category = '册次';
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
                            <form class="form-horizontal col-md-8" action="<?= base_url($ctrlRoot . '/index') ?>"
                                  id="searchForm" role="form" method="post" enctype="multipart/form-data"
                                  accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>编码
                                                :</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="search_no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">所属科目
                                                :</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control" name="search_subject"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><?= $category ?>
                                                :</label>
                                            <div class="col-md-7">
                                                <select type="text" class="form-control" name="search_term"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-4">
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
                                    <div class="btn-group right-floated" style="margin-top: 10px;">
                                        <button class=" btn blue" onclick="addItem(this)">
                                            <i class="fa fa-plus"></i>&nbsp新增<?= $category; ?>
                                        </button>
                                    </div>
                                    <div class="btn-group right-floated" style="margin-right: 30px;margin-top: 10px;">
                                        <button class=" btn btn-default" onclick="searchItems(this)">
                                            <i class="fa fa-search"></i>&nbsp查询
                                        </button>
                                    </div>
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
                                <th>所属科目</th>
                                <th><?= $category; ?>名称</th>
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
    <input hidden class="filterInfo"
           value='<?= json_encode($this->session->userdata('filter') ? $this->session->userdata('filter') : array()) ?>'>
    <script>
        $(function () {
            $('a.nav-link[menu_id="01"]').addClass('menu-selected');
            searchConfig();
        })

        var termList = JSON.parse($('.termList').val());
        var subjectList = JSON.parse($('.subjectList').val());
        var filterInfo = JSON.parse($('.filterInfo').val());

        function searchConfig() {
            var content_html = '<option value="">全部</option>';
            $('select[name="search_term"]').html(content_html);

            for (var i = 0; i < subjectList.length; i++) {
                var item = subjectList[i];
                // if (item.status == '0') continue;
                content_html += '<option value="' + item.id + '">' + item.title + '</option>';
            }
            $('select[name="search_subject"]').html(content_html);

            $('select[name="search_subject"]').on('change input', function (object) {
                var subjectId = $(this).val();
                var content_html = '<option value="">全部</option>';
                for (var i = 0; i < termList.length; i++) {
                    var item = termList[i];
//                    if (item.status == '0') continue;
                    if (item.subject_id != subjectId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="search_term"]').html(content_html);

            });
            if (filterInfo['tbl_huijiao_terms.term_no']) $('input[name="search_no"]').val(filterInfo['tbl_huijiao_terms.term_no']);
            if (filterInfo['tbl_huijiao_terms.subject_id']) {
                $('select[name="search_subject"]').val(filterInfo['tbl_huijiao_terms.subject_id']);
                $('select[name="search_subject"]').trigger('change');
            }
            if (filterInfo['tbl_huijiao_terms.id']) $('select[name="search_term"]').val(filterInfo['tbl_huijiao_terms.id']);
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
                data: {id: id, status: status, pageId: "<?= $curPage ?>"},
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
            var value1 = $('#edit-modal select[name="subject_id"]').find('option')[0].getAttribute('value');
            var value2 = '';
            var value3 = '';

            $('#edit-modal select[name="subject_id"]').val(value1);
            $('#edit-modal input[name="no"]').val(value2);
            $('#edit-modal input[name="title"]').val(value3);

            $('#edit-modal .modal-title').html('新增<?=$category;?>');

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
            var value2 = trtag.cells[0].innerHTML;
            var value3 = trtag.cells[2].innerHTML;

            $('#edit-modal select[name="subject_id"]').val(value1);
            $('#edit-modal input[name="no"]').val(value2);
            $('#edit-modal input[name="title"]').val(value3);

            $('#edit-modal .modal-title').html('编辑<?=$category;?>');

            $('#edit-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        $("#add-submit-form").submit(function (e) {
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

        $('.scripts').remove();
    </script>
</div>




