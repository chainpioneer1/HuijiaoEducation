<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_learning.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/resource/";
</script>
<div class="base-container" style="height: auto; margin-bottom:20px; ">
    <div class="list-title">
        <!--        <div class="list-title-label">同步资源</div>-->
        <div class="filter-wrap-container">
            <div class="src-filter-wrap">
                <div class="header-item" id="subject-select" data-id="<?= $subject_id ?>">
                    <div class="item-label">科目</div>
<!--                    <div class="select-item <?//= $subject_id == '' ? 'active' : '' ?>" onclick="onSelFilter(this)"-->
<!--                         data-id="" data-type="subject">全部-->
<!--                    </div>-->
                    <div class="select-item <?= $subject_id == '' ? 'active' : '' ?>"
                         data-id="" data-type="subject">
                    </div>
                    <div class="item-selector"><?= $subjects ?></div>
                </div>
            </div>
            <div class="src-filter-wrap">
                <div class="header-item" id="term-select" data-id="<?= $term_id ?>">
                    <div class="item-label" id="">册次</div>
                    <div class="select-item <?= $term_id == '' ? 'active' : '' ?>" onclick="onSelFilter(this)"
                         data-id="" data-type="term">全部
                    </div>
                    <div class="term-selector" style="height: <?= ($terms==''?'50px':'100px')?>"><?= $terms ?></div>
                </div>
            </div>
            <div class="src-filter-wrap">
                <div class="header-item" id="coursetype-select" data-id="<?= $coursetype_id ?>">
                    <div class="item-label">类型</div>
                    <div class="select-item <?= $coursetype_id == '' ? 'active' : '' ?>" onclick="onSelFilter(this)"
                         data-id="" data-type="coursetype">全部
                    </div>
                    <div class="item-selector"><?= $coursetypes ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-container" id="contents_section">
        <?= $contents ?>
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
//                var totalPages = Math.floor('<?//=($cntPage-1) / perPage + 1; ?>//' * 1);
                var curPage = Math.floor(((curPage == '' ? 1 : curPage) / perPage + 1) * 1);
//                var curPage = Math.floor('<?//=($curPage == '' ? 1 : $curPage) / perPage + 1; ?>//' * 1);
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
                location.href = baseURL + 'resource/learning/' + pageNum;
            }

            appendPagination();
        </script>
    </div>
</div>
<div class="modal fade" id="modal-register-alert">
    <div class="modal-header"><a data-dismiss="modal"><i class="fa fa-close"></i></a></div>
    <div class="msg-content">该资源需要登录后才能使用哦!</div>
    <a id="modal-btn-register" href="<?= base_url('api/getAuthCode'); ?>">跳转登录</a>
    <a data-dismiss="modal">取消</a>
</div>
<script>

    $(function () {
        $('.tab-item[data-id="3"]').attr('data-sel', 1);

        $('.tab-search .search-btn').on('click', function () {
            onClickSrcFilter();
        });
        $('.tab-search .search-txt').on('keypress', function(e){
            if(e.which == 13 || e.keyCode == 13){
                onClickSrcFilter();
            }
        });
        $('body').append($('#modal-register-alert'));
        refreshEvent();
    });
    $('.header-item').click(function () {
        $('.subject-select').removeClass('active');
        $(this).parent().find('.subject-select').toggleClass('active');
    });

    $('.subject-select').mouseleave(function () {
        console.log('--------  -----');
        $(this).removeClass('active');
    });

    function pageNavTo() {
        var to = $('#navto-value').val();
        window.location.href = '<?= base_url('resource/learning') ?>' + '/' + to
    }

    var isProcessing = false;
    var user_id = '<?= $this->session->userdata('loginuserID') ?>';

    function refreshEvent() {
        $('.item-favor-icon').off('click');
        $('.item-favor-icon').css('cursor','default');
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
            var content_id = $(this).attr('data-content_id');
            var usage_id = $(this).attr('data-usage_id');

            if (isProcessing) return;
            isProcessing = true;
            var that = this;
            jQuery.ajax({
                type: "post",
                url: baseURL + "resource/content_like",
                dataType: "json",
                data: {
                    usage_id: usage_id,
                    user_id: user_id,
                    content_id: content_id,
                    like: like,
                },
                success: function (res) {
                    if (res.status == 'success') {
                        $(that).attr('data-sel', like);
                        $(that).parent().children('.item-favor-value').text(likeNum)
                    }
                    else//failed
                    {
                        alert("Cannot update lesson Item.");
                    }
                },
                complete: function () {
                    isProcessing = false;
                }
            });
        });
    }

    function onSelFilter(self) {
        var type = $(self).data('type');
        if (type == 'subject') {
            $('#term-select').attr('data-id', '');
            $('#term-select .term-selector').html('');
            $('#coursetype-select').attr('data-id', '');
            $('#coursetype-select .item-selector').html('');
        } else if (type == 'term') {
            $('#coursetype-select').attr('data-id', '');
        }

        var selItem = $(self).text();
        $(self).parent().removeClass('active');
        if ($(self).data('id') == '')
            $(self).parent().attr('data-id', $(self).data('id'));
        else
            $(self).parent().parent().attr('data-id', $(self).data('id'));
        $(self).parent().find('.select-item').removeClass('active');
        $(self).addClass('active');

        var subject_id = $('#subject-select').attr('data-id');
        var term_id = $('#term-select').attr('data-id');
        var coursetype_id = $('#coursetype-select').attr('data-id');
        var curQuery = $('input[name="search-txt"]').val();
        // console.log(subject_id, term_id, coursetype_id, curQuery);

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
                    $('#contents_section').html(res.data.contents);
                    $('#term-select .term-selector').html(res.data.terms);
					if(res.data.terms==''){
						$('#term-select .term-selector').css('height','50px');
					}else
						$('#term-select .term-selector').css('height','100px');

                    if (res.data.term_id == '')
                        $('#term-select > .select-item').addClass('active');
                    else
                        $('#term-select > .select-item').removeClass('active');

                    $('#subject-select').attr('data-id', res.data.subject_id);
                    if (res.data.subject_id == '')
                        $('#subject-select > .select-item').addClass('active');
                    else
                        $('#subject-select > .select-item').removeClass('active');
                    $('#coursetype-select .item-selector').html(res.data.coursetypes);

                    if (res.data.coursetype_id == '')
                        $('#coursetype-select > .select-item').addClass('active');
                    else
                        $('#coursetype-select > .select-item').removeClass('active');

                    $('#syg-pagination').html(res.data.pageNavigation);

                    var curPage = res.data.curPage;
                    var perPage = res.data.perPage;
                    var cntPage = res.data.cntPage;
                    $('.pagination-bar').html(res.data.pagination);
                    appendPagination_ajax(curPage, perPage, cntPage);

                    var curPId = window.location.toString().split('/');
                    curPId = curPId[curPId.length - 1] * 1;
                    if (curPId > 0)
                        refreshEvent();
                }
                else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    }

    $('.src-search-form input').keyup(function (e) {
        if (e.keyCode == 13) {
            onClickSrcFilter();
        }
    });

    function onClickSrcFilter() {
        var subject_id = $('#subject-select').attr('data-id');
        var term_id = $('#term-select').attr('data-id');
        var coursetype_id = $('#coursetype-select').attr('data-id');
        var curQuery = $('input[name="search-txt"]').val();
        console.log(subject_id, term_id, coursetype_id, curQuery);

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

                    console.log('-- subjects : ', res.data.subjects);
                    $('#contents_section').html(res.data.contents);
                    $('#term-select .term-selector').html(res.data.terms);
                    if(res.data.terms==''){
                        $('#term-select .term-selector').css('height','50px');
                    }else
                        $('#term-select .term-selector').css('height','100px');
                    if (res.data.term_id == '')
                        $('#term-select > .select-item').addClass('active');
                    else
                        $('#term-select > .select-item').removeClass('active');

                    $('#subject-select').attr('data-id', res.data.subject_id);
                    if (res.data.subject_id == '')
                        $('#subject-select > .select-item').addClass('active');
                    else
                        $('#subject-select > .select-item').removeClass('active');
                    $('#coursetype-select .item-selector').html(res.data.coursetypes);

                    if (res.data.coursetype_id == '')
                        $('#coursetype-select > .select-item').addClass('active');
                    else
                        $('#coursetype-select > .select-item').removeClass('active');

                    $('#syg-pagination').html(res.data.pageNavigation);

                    var curPage = res.data.curPage;
                    var perPage = res.data.perPage;
                    var cntPage = res.data.cntPage;
                    $('.pagination-bar').html(res.data.pagination);
                    appendPagination_ajax(curPage, perPage, cntPage);

                    var curPId = window.location.toString().split('/');
                    curPId = curPId[curPId.length - 1] * 1;
                    if (curPId > 0)
                        refreshEvent();
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
<!--<script src="--><? //= base_url('assets/js/hj_learning.js') ?><!--" type="text/javascript"></script>-->
