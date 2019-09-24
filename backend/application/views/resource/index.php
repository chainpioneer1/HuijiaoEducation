<?php
?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_education.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/resource/";
</script>

<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="list-title">
        <div class="src-filter-wrap" style="display: none;border:none;">
            <div class="header-item" style="display: none;">
                <div class="item-label">默认同步教材</div>
                <div class="txt-subject"><?= $subject->title ?></div>
                <div class="txt-term"><?= $term->title ?></div>
                <div class="collapse" onclick="onCollapse(this)" data-value="0">
                    <span>展开</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="list-container">
        <?= $lessons ?>
    </div>

    <div class="pagination-bar">
        <?php echo $this->pagination->create_links(); ?>
        <script>
            function appendPagination() {
                var perPage = '<?= $perPage; ?>' * 1;
                var totalPages = Math.floor('<?=($cntPage - 1) / $perPage + 1; ?>' * 1);
                var curPage = Math.floor('<?=($curPage == '' ? 1 : $curPage) / $perPage + 1; ?>' * 1);
                var content_html = '<div class="pagination" style="position:relative;float:right;"><li><div>共' + totalPages + '页</div></li>';
                content_html += '<li><div>到第</div></li>';
                content_html += '<li><input value=""></li>';
                content_html += '<li><div>页</div></li>';
                content_html += '<li><a href="javascript:showPage(' + perPage + ',' + totalPages + ');">确定</a></li></div>';
                $('.pagination').parent().append(content_html);
            }

            function appendPagination_ajax(curPage, perPage, cntPage) {
                var totalPages = Math.floor(((cntPage - 1) / perPage + 1) * 1);
                var curPage = Math.floor(((curPage == '' ? 1 : curPage) / perPage + 1) * 1);
                var content_html = '<div class="pagination" style="position:relative;float:right;"><li><div>共' + totalPages + '页</div></li>';
                content_html += '<li><div>到第</div></li>';
                content_html += '<li><input value=""></li>';
                content_html += '<li><div>页</div></li>';
                content_html += '<li><a href="javascript:showPage(' + perPage + ',' + totalPages + ');">确定</a></li></div>';
                $('.pagination').parent().append(content_html);
            }

            function showPage(perPage, totalPages) {
                var pageNum = $('.pagination>li>input').val();
                if (pageNum < 1 || pageNum > totalPages) return;
                pageNum = (pageNum * 1 - 1) * perPage;
                if (pageNum <= 0) pageNum = '';
                location.href = baseURL + 'resource/index/' + pageNum;
            }

            appendPagination();
        </script>
    </div>

    <input class="all-subjects" value='<?= json_encode($all_subjects); ?>' style="display: none;">
    <input class="all-terms" value='<?= json_encode($all_terms); ?>' style="display: none;">
</div>
<div class="modal fade" id="modal-register-alert">
    <div class="modal-header"><a data-dismiss="modal"><i class="fa fa-close"></i></a></div>
    <div class="msg-content">该资源需要登录后才能使用哦!</div>
    <a id="modal-btn-register" href="<?= base_url('api/getAuthCode'); ?>">跳转登录</a>
    <a data-dismiss="modal">取消</a>
</div>
<script>
    var packageList = [];
    var selectedIndex = '';
    var allSubjects = JSON.parse($('.all-subjects').val());
    var allTerms = JSON.parse($('.all-terms').val());

    function pageNavTo() {
        var to = $('#navto-value').val();
        window.location.href = '<?= base_url('resource/education') ?>' + '/' + to
    }

    $(function () {
        $('.tab-item[data-id="1"]').attr('data-sel', 1);
        $('body').append($('#modal-register-alert'));
        onCollapse($('div.collapse')[0]);

    });

    var isProcessing = false;
    var user_id = '<?= $this->session->userdata('loginuserID') ?>';

    $('.item-favor-icon').css('cursor','default');
    $('.item-favor-icon').off('click');
    $('.item-favor-icon').on('click', function (e) {
        return;
        e.preventDefault();
        var like = $(this).attr('data-sel');
        // console.log($(this).parent());
        // console.log($(this).parent().children('.item-favor-value').text());
        var likeNum = parseInt($(this).parent().children('.item-favor-value').text());
        if (like == '0') {
            like = '1';
            likeNum++
        } else if (like == '1') {
            like = '0';
            likeNum--
        }
        var lesson_id = $(this).attr('data-lesson_id');
        var usage_id = $(this).attr('data-usage_id');

        if (isProcessing) return;
        isProcessing = true;
        var that = this;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/lesson_like",
            dataType: "json",
            data: {
                usage_id: usage_id,
                user_id: user_id,
                lesson_id: lesson_id,
                like: like,
            },
            success: function (res) {
                if (res.status == 'success') {
                    $(that).attr('data-sel', like);
                    $(that).parent().children('.item-favor-value').text(likeNum)
                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    });

    function onCollapse(self) {
        var type = 1 - $(self).attr('data-value') * 1;
        if (type == 1) {
            $(self).find('span').html('收起');
            var content_html = '<div class="src-filter-wrap">';
            content_html += '<div class="header-item" id="subject-select" data-id="<?= $subject->id ?>" data-type="subject">';
            content_html += '<div class="item-label">科目</div>';
            content_html += '<div class="item-selector"></div>';
            content_html += '</div>';
            content_html += '</div>';
            content_html += '<div class="src-filter-wrap">';
            content_html += '<div class="header-item" id="term-select" data-id="<?= $term->id ?>" data-type="term">';
            content_html += '<div class="item-label">册次</div>';
            content_html += '<div class="term-selector"></div>';
            content_html += '</div>';
            content_html += '</div>';
            $('.list-title').append(content_html);
            for (var i = 0; i < allSubjects.length; i++) {
                var item = allSubjects[i];
                var curTitle = $('.txt-subject').text();
                $('#subject-select').find('.item-selector').append('<div  class="select-item ' + (item.title == curTitle ? 'active' : '')
                    + '" onclick="onSelFilter(this)" data-id="' + item.id + '" data-type="subject">' + item.title + '</div>');
            }
            for (var i = 0; i < allTerms.length; i++) {
                var item = allTerms[i];
                var curTitle = $('.txt-term').text();
                if (item.subject_id != "<?= $subject->id ?>") continue;
                $('#term-select').find('.term-selector').append('<div  class="select-item ' + (item.title == curTitle ? 'active' : '')
                    + '" onclick="onSelFilter(this)" data-id="' + item.id + '" data-type="term">' + item.title + '</div>');
            }
            $('.list-title .collapse > i').removeClass('fa fa-chevron-down');
            $('.list-title .collapse > i').addClass('fa fa-chevron-up');
        } else {
            $(self).find('span').html('展开');
            $('.list-title .collapse > i').removeClass('fa fa-chevron-up');
            $('.list-title .collapse > i').addClass('fa fa-chevron-down')
            $('#subject-select').parent().remove();
            $('#term-select').parent().remove();

        }
        $(self).attr({'data-value': type});
    }

    function onSelFilter(self) {
        var type = $(self).data('type');
        if (type == 'subject') {
            $('#term-select').attr('data-id', '');
            $('#term-select .term-selector').html('');
        }

        var selItem = $(self).text();
        if (type == 'subject') {
            $('.txt-subject').text(selItem);
        } else {
            $('.txt-term').text(selItem);
        }

        $(self).parent().removeClass('active');
        if ($(self).data('id') == '')
            $(self).parent().attr('data-id', $(self).data('id'));
        else
            $(self).parent().parent().attr('data-id', $(self).data('id'));
        $(self).parent().find('.select-item').removeClass('active');
        $(self).addClass('active');

        var subject_id = $('#subject-select').attr('data-id');
        var term_id = $('#term-select').attr('data-id');
        var coursetype_id = 1;
        var curQuery = $('input[name="search-txt"]').val();
        // console.log(subject_id, term_id, curQuery);

        if (type == 'subject') {

            jQuery.ajax({
                type: "post",
                url: baseURL + "resource/selectCourseType",
                dataType: "json",
                data: {
                    subject_id: subject_id,
                    term_id: term_id,
                    coursetype_id: coursetype_id,
                    curQuery: curQuery
                },
                success: function (res) {
                    if (res.status == 'success') {

                        // console.log('-- subjects : ', res.data.subjects);
                        // console.log('-- terms : ', res.data.terms);
                        $('#contents_section').html(res.data.contents);
                        $('#term-select .term-selector').html(res.data.terms);
                        $('#subject-select').attr('data-id', res.data.subject_id);

                        var curPage = res.data.curPage;
                        var perPage = res.data.perPage;
                        var cntPage = res.data.cntPage;
                        $('.pagination-bar').html(res.data.pagination);
                        appendPagination_ajax(curPage, perPage, cntPage);

                        $('#syg-pagination').html(res.data.pageNavigation);

                        var curPId = window.location.toString().split('/');
                        curPId = curPId[curPId.length - 1] * 1;
                        if (curPId > 0)
                            refreshEvent();
                        $($('#term-select .term-selector .select-item')[0]).trigger('click');
                    } else//failed
                    {
                        alert("Cannot update lesson Item.");
                    }
                },
                complete: function () {
                    isProcessing = false;
                }
            });
        } else {

            jQuery.ajax({
                type: "post",
                url: baseURL + "users/setTerm",
                dataType: "json",
                data: {
                    term_id: term_id
                },
                success: function (res) {
                    if (res.status == 'success') {
                        location.reload();
                    } else//failed
                    {
                        alert("Cannot update lesson Item.");
                    }
                },
                complete: function () {
                    isProcessing = false;
                }
            });
        }
    }

    function openContents(url, mode){
        if(user_id!=''){
            window.open(url, mode);
        } else{
            $('#modal-register-alert').modal();
            $('body').append($('.modal-backdrop'));
            $('body').append($('#modal-register-alert'));
        }
    }

</script>
<script src="<?= base_url('assets/js/hj_education.js') ?>" type="text/javascript"></script>