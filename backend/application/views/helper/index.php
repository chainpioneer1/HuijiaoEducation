<?php
$ctrlRoot = 'helper';
$category = '资源';
$mainModel = 'tbl_huijiao_contents';
?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_helper.css') ?>">
<script src="<?= base_url('assets/js/frontend/pdfobject.js') ?>"></script>
<script>
    var imageDir = baseURL + "assets/images/resource/";
</script>
<div class="base-container" style="height: auto; margin-bottom:20px; ">
    <form action="<?= base_url('helper/index') ?>" class="filter-wrap-container"
          id="searchForm" role="form" method="post" enctype="multipart/form-data"
          accept-charset="utf-8">
        <div class="list-title">
            <div class="filter-wrap-container">
                <div class="src-filter-wrap">
                    <div class="header-item">
                        <div class="item-label">册次：</div>
                        <select type="text" class="item-select"
                                name="search_term">
                        </select>
                        <!--                    <div class="item-select" id="term-select" data-id="">全部-->
                        <!--                        <div></div>-->
                        <!--                    </div>-->
                    </div>
                    <!--                <div class="subject-select" id="term-select-dropdown" >-->
                    <!--               --><? ////= $subjects ?>
                    <!--                </div>-->
                </div>
                <div class="src-filter-wrap">
                    <div class="header-item">
                        <div class="item-label">课程：</div>
                        <select type="text" class="item-select"
                                name="search_course_type">
                        </select>
                    </div>
                </div>
                <div class="src-filter-wrap">
                    <div class="header-item">
                        <div class="item-label">资源类型：</div>
                        <select type="text" class="item-select"
                                name="search_content_type">
                        </select>
                    </div>
                </div>
                <div class="src-filter-wrap" style="display: none;">
                    <div class="header-item">
                        <div class="item-search-btn" onclick="searchItems(this)"></div>
                    </div>
                </div>
                <div class="src-filter-wrap src-search-form">
                    <input placeholder="请输入搜索内容" value="<?= $queryStr; ?>" name="search_title">
                    <span onclick="searchItems(this)"></span>
                </div>
            </div>
        </div>
    </form>
    <div class="list-container" id="contents_section">
        <?= $tbl_content ?>
    </div>

    <div class="pagination-bar">
        <?php $paginationContent = $this->pagination->create_links();
        echo $paginationContent;
        //        if($paginationContent=='') echo '<div class="pagination"></div>';
        ?>
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
                $('.pagination').prepend('<li><div style="margin-right: 20px;">共<?=$cntPage; ?>条</div></li>')
            }

            function appendPagination_ajax(curPage, perPage, cntPage) {
                var totalPages = Math.floor(((cntPage - 1) / perPage + 1) * 1);
//                var totalPages = Math.floor('<?//=($cntPage-1) / perPage + 1; ?>//' * 1);
                var curPage = Math.floor(((curPage == '' ? 1 : curPage) / perPage + 1) * 1);
//                var curPage = Math.floor('<?//=($curPage == '' ? 1 : $curPage) / perPage + 1; ?>//' * 1);
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
                location.href = baseURL + 'resource/learning/' + pageNum;
            }

            appendPagination();
        </script>
    </div>
    <!--    <div class="syg-pagination" id="syg-pagination">-->
    <!--        --><? //= $pageNavigation ?>
    <!--    </div>-->
</div>
<div id="preview-modal" class="preview-modal" tabindex="-1" data-width="850">
    <div class="modal-bg">
        <div class="modal-header">
            <button type="button" class="close"></button>
        </div>
        <div class="modal-body">
            <div class="preview-player">
                <div class="preview-player pdf_container"></div>
                <iframe class="preview-player" width="500" height="275" frameborder="no"></iframe>
            </div>
        </div>
        <div class="btn-add-content" onclick="selectHelperContent(this);" data-id=""></div>
    </div>
    <script>
        $('.close').on('click', function () {
            $('iframe.preview-player').attr('src', '');
            $('.preview-modal').fadeOut('fast');
        })
    </script>
</div>


<div class="scripts" hidden style="display: none;">
    <input hidden class="subjectList" value='<?= json_encode($subjectList) ?>'>
    <input hidden class="termList" value='<?= json_encode($termList) ?>'>
    <input hidden class="courseTypeList" value='<?= json_encode($courseTypeList) ?>'>
    <input hidden class="contentTypeList" value='<?= json_encode($contentTypeList) ?>'>
    <input hidden class="contentList" value='<?= json_encode($contents) ?>'>
    <input hidden class="filterInfo"
           value='<?= json_encode($this->session->userdata('filter') ? $this->session->userdata('filter') : array()) ?>'>
    <script>
        var isFirstLoading = true;
        $(function () {
            // $('a.nav-link[menu_id="10"]').addClass('menu-selected');
            searchConfig();
        });

        var subjectList = JSON.parse($('.subjectList').val());
        var termList = JSON.parse($('.termList').val());
        var courseTypeList = JSON.parse($('.courseTypeList').val());
        var contentTypeList = JSON.parse($('.contentTypeList').val());
        var contentList = JSON.parse($('.contentList').val());
        var filterInfo = JSON.parse($('.filterInfo').val());
        var _mainObj = '<?=$mainModel?>';

        function searchConfig() {
            var content_html = '<option value="">全部</option>';
            $('select[name="search_course_type"]').html(content_html);
            $('select[name="search_content_type"]').html(content_html);

            var subjectId = subjectList.filter(function (a) {
                return (a.title.indexOf('语文') > -1);
            });
            subjectId = subjectId[0].id;
            console.log(subjectId);
            content_html = '<option value="">全部</option>';
            for (var i = 0; i < termList.length; i++) {
                var item = termList[i];
                if (item.status == '0') continue;
                if (item.subject_id != subjectId) continue;
                content_html += '<option value="' + item.id + '">' + item.title + '</option>';
            }
            $('select[name="search_term"]').html(content_html);

            $('select[name="search_course_type"]').off('change');
            $('select[name="search_course_type"]').on('change', function (e) {
                searchItems(this);
            });

            $('select[name="search_term"]').off('change input');
            $('select[name="search_term"]').on('change input', function (e) {
                // make courseType List
                var termId = $(this).val();
                content_html = '<option value="">全部</option>';
                for (var i = 0; i < courseTypeList.length; i++) {
                    var item = courseTypeList[i];
                    if (item.status == '0') continue;
                    if (item.term_id != termId) continue;
                    content_html += '<option value="' + item.id + '">' + item.title + '</option>';
                }
                $('select[name="search_course_type"]').html(content_html);
                $('select[name="search_course_type"]').trigger('change');

            });

            // make contentType List
            content_html = '<option value="">全部</option>';
            for (var i = 0; i < contentTypeList.length; i++) {
                var item = contentTypeList[i];
                if (item.status == '0') continue;
                content_html += '<option value="' + item.id + '">' + item.title + '</option>';
            }
            $('select[name="search_content_type"]').html(content_html);

            $('select[name="search_content_type"]').off('change');
            $('select[name="search_content_type"]').on('change', function (e) {
                searchItems(this);
            });

            if (filterInfo[_mainObj + '.content_no']) $('input[name="search_no"]').val(filterInfo[_mainObj + '.content_no']);
            if (filterInfo[_mainObj + '.title']) $('input[name="search_title"]').val(filterInfo[_mainObj + '.title']);
            if (filterInfo[_mainObj + '.content_type_no']) {
                $('select[name="search_content_type"]').val(filterInfo[_mainObj + '.content_type_no']);
                isFirstLoading = true;
                $('select[name="search_content_type"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_terms.subject_id']) {
                $('select[name="search_subject"]').val(filterInfo['tbl_huijiao_terms.subject_id']);
                // $('select[name="search_subject"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_terms.id']) {
                $('select[name="search_term"]').val(filterInfo['tbl_huijiao_terms.id']);
                isFirstLoading = true;
                $('select[name="search_term"]').trigger('change');
            }

            if (filterInfo[_mainObj + '.course_type_id']) {
                $('select[name="search_course_type"]').val(filterInfo[_mainObj + '.course_type_id']);
            }

            console.log(filterInfo);
        }

        function getContentList(){
            return contentList;
        }

        function searchItems(self) {
            if (!isFirstLoading) $('#searchForm').submit();
            isFirstLoading = false;
        }

        function courseItemPlay(itemid) {
            var url = baseURL;
            var item = contentList.filter(function (a) {
                return a.id == itemid;
            });
            item = item[0];
            console.log(item);
            var isPDF = false;
            var contentPath = item.content_path;
            var contentFormat = getFiletypeFromURL(contentPath);
            switch (contentFormat) {
                case 'mp4':
                case 'mp3':
                case 'wav':
                    item.content_type_id = 2;
                    break;
                case 'png':
                case 'gif':
                case 'bmp':
                case 'jpg':
                case 'jpeg':
                    item.content_type_id = 3;
                    break;
                case 'doc':
                case 'docx':
                case 'ppt':
                case 'pptx':
                    item.content_type_id = 4;
                    break;
                case 'pdf':
                    item.content_type_id = 5;
                    break;
                case 'htm':
                case 'html':
                    item.content_type_id = 6;
                    break;
                default:
                    if (contentPath != '') item.content_type_id = 1;
                    else item.content_type_id = 0;
                    break;
            }
            switch (parseInt(item.content_type_id)) {
                case 1:
                    url += contentPath + '/package/index.html';
                    break;
                case 2:
                    url += "assets/js/toolset/video_player/vplayer.php?ncw_file=" + baseURL + contentPath + "";
                    break;
                case 3:
                    url += "assets/js/toolset/video_player/iplayer.php?ncw_file=" + baseURL + contentPath + "";
                    break;
                case 4:
                    url = "https://view.officeapps.live.com/op/embed.aspx?src=" + baseURL + contentPath + "";
                    break;
                case 5: // PDF
                    isPDF = true;
                    url += contentPath + "";
                    break;
                case 6: // Html
                    url += contentPath;
                    download_url += contentPath;
                    break;
            }
            if (isPDF) {
                PDFObject.embed(url, "#pdf_container");
                $('.pdf_container').fadeIn('fast');
                $('iframe.preview-player').fadeOut('fast');
                $('iframe.preview-player').attr("src", '');
            } else {
                // history.replaceState(null, null, '');
                $('iframe.preview-player').attr("src", '');
                if (item.content_type_id * 1 != 0)
                    $('iframe.preview-player').attr("src", url);
                $('iframe.preview-player').fadeIn('fast');
                $('.pdf_container').fadeOut("fast");
                $('.pdf_container').attr("src", "");
            }
        }

        function showHelperContentPlayer(id, isPopup) {
            id = parseInt(id);

            courseItemPlay(id);
            $('.btn-add-content').attr('data-id', id);

            $('.preview-modal').fadeIn('fast');
        }

        function selectHelperContent(elem) {
            var that = $(elem);
            id = that.attr('data-id') * 1;
            parent.selectContent(id);
        }

        function getFiletypeFromURL(str) {
            if (str == '' || str == null || str == undefined) return '';
            str = str.split('.');
            return str[str.length - 1].toLowerCase();
        }

        $('.scripts').remove();
    </script>
</div>