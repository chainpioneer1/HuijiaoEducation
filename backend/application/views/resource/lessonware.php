<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_lessonware.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/resource/";
</script>
<div class="base-container" style="height: auto;margin-bottom:20px;">
    <div class="list-container" id="contents_section">
        <div class="list-item">
            <div>
                <div class="item-main-info" style="padding: 0; border-radius: 5px">
                    <div class="item-preview-wrapper" style="padding: 0; border-radius: 5px">
                        <div class="add-item" onclick="add_lw(this)">
                            <img src="<?= base_url('assets/images/huijiao/add-item.png') ?>" style="width: 130px;height: 130px;position: relative;left: 100px;top: 52px;">
                        </div>
                    </div>
                </div>
                <div class="additem-infobar">
                    <div class="lessonware_operation">
                        <div class="add-btn" onclick="add_lw(this)" style="font-size: 20px;">新建课件</div>
                    </div>
                </div>
            </div>
        </div>
        <?= $lessonList_content; ?>
    </div>

    <div class="pagination-bar">
        <?php echo $this->pagination->create_links(); ?>
        <script>
            function appendPagination() {
                var perPage = '<?= $perPage; ?>' * 1;
                var totalPages = Math.floor('<?=($cntPage - 1) / $perPage + 1; ?>' * 1);
                var curPage = Math.floor('<?=($curPage == '' ? 1 : $curPage) / $perPage + 1; ?>' * 1);
                var content_html = '<li><div>共' + totalPages + '页</div></li>';
                content_html += '<li><div>到第</div></li>';
                content_html += '<li><input value=""></li>';
                content_html += '<li><div>页</div></li>';
                content_html += '<li><a href="javascript:showPage(' + perPage + ',' + totalPages + ');">确定</a></li>';
                $('.pagination').append(content_html);
            }

            function showPage(perPage, totalPages) {
                var pageNum = $('.pagination>li>input').val();
                if (pageNum < 1 || pageNum > totalPages) return;
                pageNum = (pageNum * 1 - 1) * perPage;
                if (pageNum <= 0) pageNum = '';
                location.href = baseURL + 'resource/lessonware/' + pageNum;
            }

            appendPagination();
        </script>
    </div>
</div>
<!----delete modal-->
<div id="lw_delete_modal" class="modal fade">
    <div class="msg-content">确认是否删除课件？</div>
    <a id="delete_lw_item_btn"></a>
    <a data-dismiss="modal" id="no_lw_item_btn"></a>
</div>
<div class="scripts" style="display: none;" hidden>
    <input class="lessonListInput" value='<?php echo json_encode($lessonList); ?>'>
    <script>
        var lessonList = JSON.parse($('.lessonListInput').val());
        var selectedIndex = <?php echo $selectedIndex;?>;
    </script>
    <script src="<?= base_url('assets/js/hj_lessonware.js') ?>" type="text/javascript"></script>
</div>