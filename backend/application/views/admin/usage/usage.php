<?php
$ctrlRoot = 'admin/usage';
?>

<style>
    #main_tbl th, td {
        text-align: center;
        vertical-align: middle;
    }

</style>
<script src="<?= base_url('assets/js/chart.bundle.js') ?>"></script>
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
                    <div class="usage-tab-item" data-id="6">按用户统计</div>
                    <div class="usage-tab-item" data-id="4">按科目统计</div>
                    <div class="usage-tab-item" data-id="5">按类型统计</div>
                    <div class="usage-tab-item" data-id="1">使用量统计</div>
                    <div class="usage-tab-item" data-id="2">科目比例统计</div>
                    <div class="usage-tab-item" data-id="3">年级比例统计</div>
                </div>
                <div class="portlet light bordered" data-id="4">
                    <div class="portlet-body">
                        <div class="main-frame" data-id="4">
                            <div class="row">
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u154.svg') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>浏 览 量</div>
                                    <div class="total_read"></div>
                                </div>
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u158.svg') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>收 藏 量</div>
                                    <div class="total_favorite"></div>
                                </div>
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u160.svg') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>下 载 量</div>
                                    <div class="total_download"></div>
                                </div>
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u156.svg') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>
                                        点 赞 量
                                    </div>
                                    <div class="total_like"></div>
                                </div>
                            </div>
                        </div>
                        <div class="main-frame" data-id="6">
                            <div class="row">
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u55.png') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>今日登陆用户数</div>
                                    <div class="today_login"></div>
                                </div>
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u60.png') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>今日新增用户数</div>
                                    <div class="today_new"></div>
                                </div>
                                <div class="total-info">
                                    <div style="float: right;">
                                        <img src="<?= base_url('assets/images/backend/u65.png') ?>"
                                             style="height: 40px;margin-right: 15px;"/>
                                    </div>
                                    <div>总用户数</div>
                                    <div class="total_users"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet light bordered" data-id="1">
                    <div class="portlet-body">
                        <div class="table-toolbar" data-id="1">
                            <!------Tool bar parts (add button and search function------>
                            <div class="row">
                                <form class="form-horizontal col-md-10" action="<?= base_url($ctrlRoot . '/usage') ?>"
                                      id="searchForm" role="form" method="post" enctype="multipart/form-data"
                                      accept-charset="utf-8">
                                    <input value="<?= $pageType; ?>" name="pageType" style="display: none;" hidden/>

                                    <div class="row" data-id="1">
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
                                    <div class="row" data-id="4" style="display: none;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">时间:</label>
                                                <div class="col-md-4">
                                                    <input type="text" onfocus="(this.type='date')"
                                                           onblur="this.type='text'" class="form-control"
                                                           name="search_date1">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" onfocus="(this.type='date')"
                                                           onblur="this.type='text'" class="form-control"
                                                           name="search_date2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" data-id="5" style="display: none;">
                                        <div class="col-md-4">
                                            <div style="font-size: 20px;padding-left: 30px;">按资源类型统计</div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">时间:</label>
                                                <div class="col-md-4">
                                                    <input type="text" onfocus="(this.type='date')"
                                                           onblur="this.type='text'" class="form-control"
                                                           name="search_date1">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" onfocus="(this.type='date')"
                                                           onblur="this.type='text'" class="form-control"
                                                           name="search_date2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-2">
                                    <div class="btn-group right-floated" style="margin-right: 30px;">
                                        <button class=" btn btn-default" onclick="searchItems(this)">
                                            <i class="fa fa-search"></i>&nbsp查询
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!------Tool bar parts (add button and search function------>
                        </div>
                    </div>
                </div>
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="main-frame body" data-id="4">
                            <div class="frame-title" data-type="bar"></div>
                            <div class="canvas-container" data-type="bar">
                                <div class="canvas-item">
                                    <div class="chart-title">浏览</div>
                                    <div class="chart"></div>
                                </div>
                            </div>
                            <div class="frame-title" data-type="line"></div>
                            <div class="canvas-container" data-type="line">
                                <div class="canvas-item">
                                    <div class="chart-title">浏览</div>
                                    <div class="chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="main-frame body" data-id="6">
                            <div class="frame-title">趋势图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-users"></canvas>
                            </div>
                        </div>
                        <div class="main-frame body" data-id="5">
                            <div class="frame-title">资源使用柱状图</div>
                            <div class="canvas-container"></div>
                        </div>
                        <div class="main-frame" data-id="1">
                            <div class="frame-title">资源使用柱状图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-contents"></canvas>
                            </div>
                        </div>
                        <div class="main-frame" data-id="1">
                            <div class="frame-title">课件使用柱状图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-lessons"></canvas>
                            </div>
                        </div>
                        <div class="main-frame" data-id="2">
                            <div class="frame-title">资源使用比例图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-subjects-content"></canvas>
                            </div>
                        </div>
                        <div class="main-frame" data-id="2">
                            <div class="frame-title">课件使用比例图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-subjects-lesson"></canvas>
                            </div>
                        </div>
                        <div class="main-frame" data-id="3">
                            <div class="frame-title">年级使用资源比例图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-terms-content"></canvas>
                            </div>
                        </div>
                        <div class="main-frame" data-id="3">
                            <div class="frame-title">年级使用课件比例图</div>
                            <div class="canvas-container">
                                <canvas id="chart-area-terms-lesson"></canvas>
                            </div>
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

<div class="scripts" hidden style="display: none;">
    <input hidden class="subjectList" value='<?= json_encode($subjectList) ?>'>
    <input hidden class="termList" value='<?= json_encode($termList) ?>'>
    <input hidden class="courseTypeList" value='<?= json_encode($courseTypeList) ?>'>
    <input hidden class="contentTypeList" value='<?= json_encode($contentTypeList) ?>'>
    <input hidden class="contentsInfo" value='<?= json_encode($contents_info) ?>'>
    <input hidden class="lessonsInfo" value='<?= json_encode($lessons_info) ?>'>
    <input hidden class="subjectsLessonInfo" value='<?= json_encode($subjects_lesson_info) ?>'>
    <input hidden class="subjectsContentInfo" value='<?= json_encode($subjects_content_info) ?>'>
    <input hidden class="termsLessonInfo" value='<?= json_encode($terms_lesson_info) ?>'>
    <input hidden class="termsContentInfo" value='<?= json_encode($terms_content_info) ?>'>
    <input hidden class="termContentDetail" value='<?= json_encode($term_content_detail) ?>'>
    <input hidden class="termLessonDetail" value='<?= json_encode($term_lesson_detail) ?>'>
    <input hidden class="contentTypeContentDetail" value='<?= json_encode($contentType_content_detail) ?>'>
    <input hidden class="usersInfo" value='<?= json_encode($users_info) ?>'>
    <input hidden class="filterInfo"
           value='<?= json_encode($this->session->userdata('filter') ? $this->session->userdata('filter') : array()) ?>'>
    <script>
        $(function () {
            $('a.nav-link[menu_id="55"]').addClass('menu-selected');
            searchConfig();
            menuConfig();
        });

        var subjectList = JSON.parse($('.subjectList').val());
        var termList = JSON.parse($('.termList').val());
        var courseTypeList = JSON.parse($('.courseTypeList').val());
        var contentTypeList = JSON.parse($('.contentTypeList').val());
        var filterInfo = JSON.parse($('.filterInfo').val());
        var contentsInfo = JSON.parse($('.contentsInfo').val());
        var lessonsInfo = JSON.parse($('.lessonsInfo').val());
        var subjectsLessonInfo = JSON.parse($('.subjectsLessonInfo').val());
        var subjectsContentInfo = JSON.parse($('.subjectsContentInfo').val());
        var termsLessonInfo = JSON.parse($('.termsLessonInfo').val());
        var termsContentInfo = JSON.parse($('.termsContentInfo').val());
        var usersInfo = JSON.parse($('.usersInfo').val());
        var pageType = '<?= $pageType; ?>';

        var termContentDetail = JSON.parse($('.termContentDetail').val());
        var termLessonDetail = JSON.parse($('.termLessonDetail').val());
        var contentTypeContentDetail = JSON.parse($('.contentTypeContentDetail').val());

        function menuConfig() {
            $('input[name="search_date1"]').val('<?= $search_date1; ?>');
            $('input[name="search_date2"]').val('<?= $search_date2; ?>');
            $('.usage-tab-item').on('click', function (object) {
                $('.usage-tab-item').removeAttr('data-sel');
                var menu_id = $(this).attr('data-id');
                $('input[name="pageType"]').val(menu_id);
                $(this).attr('data-sel', '1');
                $('#searchForm .row[data-id]').hide();
                $('#searchForm .row[data-id="' + menu_id + '"]').show();
                $('#searchForm .row[data-id] input').attr('disabled', 'disabled');
                $('#searchForm .row[data-id="' + menu_id + '"] input').removeAttr('disabled');
                $('.portlet[data-id="4"').hide();
                $('.portlet[data-id="1"').hide();
                switch (menu_id) {
                    case '1':
                        $('.portlet[data-id="1"').show();
                        drawContentsInfo();
                        break;
                    case '2':
                        drawSubjectsInfo();
                        break;
                    case '3':
                        drawTermsInfo();
                        break;
                    case '4':
                        $('.portlet[data-id="4"').show();
                        $('.portlet[data-id="1"').show();
                        $('.main-frame[data-id="' + menu_id + '"] .total_read').html(
                            contentsInfo[0].total_read * 1 + lessonsInfo[0].total_read * 1);
                        $('.main-frame[data-id="' + menu_id + '"] .total_favorite').html(
                            contentsInfo[0].total_favorite * 1 + lessonsInfo[0].total_favorite * 1);
                        $('.main-frame[data-id="' + menu_id + '"] .total_download').html(
                            contentsInfo[0].total_download * 1);
                        $('.main-frame[data-id="' + menu_id + '"] .total_like').html(
                            contentsInfo[0].total_like * 1 + lessonsInfo[0].total_like * 1);
                        drawTermsDetail();
                        break;
                    case '5':
                        $('.portlet[data-id="1"').show();
                        var tabID = 5;
                        $('.main-frame').hide();
                        $('.table-toolbar[data-id="' + tabID + '"]').fadeIn('fast');
                        $('.main-frame[data-id="' + tabID + '"]').fadeIn('fast');

                        var content_html = '';
                        for (var s = 0; s < subjectList.length; s++) {
                            var sItem = subjectList[s];
                            content_html += '<div class="frame-title">' + sItem.title
                            var termTmp = termList.filter(function (a) {
                                return a.subject_id == sItem.id;
                            });
                            content_html += '<select class="frame-term" data-id="' + sItem.id + '" style="float: right;font-size: 14px;">' +
                                '<option value="">全部</option>';
                            for (var t = 0; t < termTmp.length; t++) {
                                var tItem = termTmp[t];
                                content_html += '<option value="' + tItem.id + '">' + tItem.title + '</option>';
                            }
                            content_html += '</select>';
                            content_html += '</div>';
                            content_html += '<div class="canvas-container">' +
                                '<canvas id="chart-area-contenttype' + s + '"></canvas>' +
                                '</div>';
                        }
                        $('.main-frame.body[data-id="' + tabID + '"]').html(content_html);
                        $('.frame-term').off('change');
                        $('.frame-term').on('change', function () {
                            var sId = $(this).attr('data-id');
                            drawContentTypeDetail(sId);
                        });
                        drawContentTypeDetail(0);
                        break;
                    case '6':
                        $('.portlet[data-id="4"').show();
                        $('.portlet[data-id="1"').show();
                        var total_users = usersInfo.total_users.length;
                        var today = new Date();
                        today = makeDateString(today);

                        var today_login_sum = 0;
                        var today_new_sum = 0;
                        var today_login = usersInfo.total_actions.filter(function (a) {
                            return a.action_date.substr(0, 10) == today;
                        });
                        for (var k = 0; k < today_login.length; k++) {
                            today_login_sum += parseInt(today_login[k].login_count);
                            today_new_sum += parseInt(today_login[k].register_count);
                        }

                        $('.main-frame[data-id="' + menu_id + '"] .today_login').html(today_login_sum);
                        $('.main-frame[data-id="' + menu_id + '"] .today_new').html(today_new_sum);
                        $('.main-frame[data-id="' + menu_id + '"] .total_users').html(total_users);
                        drawUsersDetail();
                        break;
                }
            });

            $('.usage-tab-item[data-id="' + pageType + '"]').click();
        }

        function drawTermsDetail() {
            $('.main-frame').hide();
            var tabID = 4;
            $('.table-toolbar[data-id="' + tabID + '"]').fadeIn('fast');
            $('.main-frame[data-id="' + tabID + '"]').fadeIn('fast');

            var max = 0, maxkey = 0;
            var colorInfo = [];
            for (var i = 0; i < 10; i++) colorInfo.push('#' + generateRandomStr());
            var content_html = '<div style="text-align: left; width: 40%;">按科目统计</div>';
            for (var s = 0; s < subjectList.length; s++) {
                var sItem = subjectList[s];
                var termData = [];
                content_html += '<div data-id="' + sItem.id + '">' + sItem.title + '</div>';
                for (var t = 0; t < termList.length; t++) {
                    var tItem = termList[t];
                    if (tItem.subject_id == sItem.id) termData.push(tItem.title.substr(0, 3));
                }
                termData = removeDuplicated(termData);
            }
            $('.main-frame.body[data-id="' + tabID + '"] .frame-title[data-type="bar"]').html(content_html);
            var content_html = '<div style="text-align: left; width: 40%;">转化率</div>';
            for (var s = 0; s < subjectList.length; s++) {
                var sItem = subjectList[s];
                var termData = [];
                content_html += '<div data-id="' + sItem.id + '">' + sItem.title + '</div>';
            }
            $('.main-frame.body[data-id="' + tabID + '"] .frame-title[data-type="line"]').html(content_html);
            $('.main-frame[data-id="' + tabID + '"] .frame-title div[data-id]').off('click');
            $('.main-frame[data-id="' + tabID + '"] .frame-title div[data-id]').on('click', function () {
                var that = $(this);
                var chartType = that.parent().attr('data-type');
                var sId = that.attr('data-id');
                that.parent().find('div').removeAttr('data-sel');
                that.attr('data-sel', 1);
                var termData = termList.filter(function (a) {
                    return a.subject_id == sId;
                });
                var termContentData = termContentDetail.filter(function (a) {
                    return a.subject_id == sId;
                });
                var termLessonData = termLessonDetail.filter(function (a) {
                    return a.subject_id == sId;
                });
                var termLabels = [];
                var chartTitles = ['浏览', '收藏', '下载', '点赞'];
                if (chartType == 'line') chartTitles = ['浏览', '收藏转化率', '下载转化率', '好评转化率'];
                var keys = ['total_read', 'total_favorite', 'total_download', 'total_like'];

                for (var i = 0; i < termData.length; i++) {
                    var tItem = termData[i];
                    termLabels.push(termData[i].title.substr(0, 3));
                }
                termLabels = removeDuplicated(termLabels);
                var content_html = '';
                for (var i = 0; i < chartTitles.length; i++) {
                    var key = keys[i];
                    var chartTitle = chartTitles[i];
                    if (chartType == 'line' && i == 0) continue;
                    content_html += '<div class="canvas-item">' +
                        '<div class="chart-title">' + chartTitle + '</div>' +
                        '<div class="chart">' +
                        '<canvas id="chart-' + chartType + key + '"></canvas>' +
                        '</div>' +
                        '</div>';
                }
                $('.main-frame[data-id="' + tabID + '"] .canvas-container[data-type="' + chartType + '"]').html(content_html);
                var readTotal = [];
                for (var i = 0; i < keys.length; i++) {
                    var key = keys[i];
                    var chartContent = [];
                    var chartLesson = [];
                    for (var t = 0; t < termLabels.length; t++) {
                        var label = termLabels[t];
                        var chartContentData = termContentData.filter(function (a) {
                            return a.term.substr(0, 3) == label;
                        });
                        if (chartContentData.length == 0) chartContent.push(0);
                        else {
                            var contents = 0;
                            for (var c = 0; c < chartContentData.length; c++) {
                                contents += parseInt(chartContentData[c][key]);
                            }
                            chartContent.push(contents);
                        }
                        var chartLessonData = termLessonData.filter(function (a) {
                            return a.term.substr(0, 3) == label;
                        });
                        if (chartLessonData.length == 0) chartLesson.push(0);
                        else {
                            var contents = 0;
                            for (var c = 0; c < chartLessonData.length; c++) {
                                contents += parseInt(chartLessonData[c][key]);
                            }
                            chartLesson.push(contents);
                        }
                        if (i == 0) {
                            readTotal.push(chartLesson[t] + chartContent[t]);
                        }
                    }
                    var config = {};
                    switch (chartType) {
                        case 'bar':
                            config = {
                                type: 'bar',
                                data: {
                                    datasets: [
                                        {
                                            data: chartContent,
                                            backgroundColor: colorInfo[0],
                                            label: '资源'
                                        },
                                        {
                                            data: chartLesson,
                                            backgroundColor: colorInfo[1],
                                            label: '课件'
                                        }
                                    ],
                                    labels: termLabels
                                },
                                options: {
                                    responsive: true,
                                    tooltips: {mode: 'index', intersect: false},
                                    scales: {xAxes: [{stacked: true}], yAxes: [{stacked: true}]},
                                    barThickness: 'flex',
                                    legend: {position: 'bottom'}
                                }
                            };
                            break;
                        case 'line':
                            if (i == 0) break;
                            var chartData = [];
                            for (var t = 0; t < termLabels.length; t++) {
                                if (readTotal[t] == 0)
                                    chartData.push(0);
                                else
                                    chartData.push(parseInt((chartContent[t] + chartLesson[t]) / readTotal[t] * 1000) / 10);
                            }
                            config = {
                                type: 'line',
                                data: {
                                    datasets: [
                                        {
                                            data: chartData,
                                            borderColor: colorInfo[i],
                                            backgroundColor: colorInfo[i],
                                            label: '百分率',
                                            lineTension: 0,
                                            fill: false
                                        }
                                    ],
                                    labels: termLabels
                                },
                                options: {
                                    responsive: true,
                                    tooltips: {mode: 'index', intersect: false},
                                    scales: {xAxes: [{stacked: true}], yAxes: [{stacked: true}]},
                                    barThickness: 'flex',
                                    legend: {position: 'bottom'}
                                }
                            };
                            break;
                    }
                    if (chartType == 'line' && i == 0) continue;
                    var ctx = document.getElementById('chart-' + chartType + key).getContext('2d');
                    window.myBar1 = new Chart(ctx, config);
                }
            });
            $('.main-frame[data-id="' + tabID + '"] .frame-title[data-type="bar"] div[data-id]')[0].click();
            $('.main-frame[data-id="' + tabID + '"] .frame-title[data-type="line"] div[data-id]')[0].click();
        }

        function drawUsersDetail() {
            $('.main-frame').hide();
            $('#searchForm .row[data-id="' + 4 + '"]').show();
            $('#searchForm .row[data-id="' + 4 + '"] input').removeAttr('disabled');
            var tabID = 6;
            $('.table-toolbar[data-id="' + tabID + '"]').fadeIn('fast');
            $('.main-frame[data-id="' + tabID + '"]').fadeIn('fast');

            var toDateElem = $('input[name="search_date2"]');
            var fromDateElem = $('input[name="search_date1"');
            var now = new Date();
            var end = makeDateString(now);
            var start = makeDateString(new Date(now.setDate(now.getDate() - 9)));

            if (fromDateElem.val() == '') fromDateElem.val(start);
            if (toDateElem.val() == '') toDateElem.val(end);

            start = (new Date(fromDateElem.val() + ' 00:00:00')).getTime();
            end = (new Date(toDateElem.val() + ' 23:59:59')).getTime();
            var diff = parseInt((end - start) / 3600 / 24 / 1000);
            var colorInfo = ['#1890ff', '#2fc25b'];
            var xLabels = [];
            var yLabels = ['当日登陆', '当日新增'];
            var y1Data = [];
            var y2Data = [];
            start = new Date(fromDateElem.val());
            for (var i = 0; i <= diff; i++) {
                var dateStr = makeDateString(start);
                xLabels.push(dateStr);

                var today_action = usersInfo.total_actions.filter(function (a) {
                    return a.action_date.substr(0, 10) == dateStr;
                });
                if (today_action.length > 0) {
                    y2Data.push(today_action[0].register_count);
                    y1Data.push(today_action[0].login_count);
                } else {
                    y2Data.push(0);
                    y1Data.push(0);
                }
                start = new Date(start.setDate(start.getDate() + 1));
            }
            var config = {
                type: 'line',
                data: {
                    datasets: [
                        {
                            data: y1Data,
                            borderColor: colorInfo[0],
                            backgroundColor: colorInfo[0],
                            fill: false,
                            label: yLabels[0],
                            lineTension: 0,
                        },
                        {
                            data: y2Data,
                            borderColor: colorInfo[1],
                            backgroundColor: colorInfo[1],
                            fill: false,
                            label: yLabels[1],
                            lineTension: 0,
                        }
                    ],
                    labels: xLabels
                },
                options: {
                    responsive: true,
                    tooltips: {mode: 'index', intersect: false},
                    scales: {xAxes: [{stacked: true}], yAxes: [{stacked: false}]},
                    barThickness: 'flex',
                    legend: {position: 'bottom'}
                }
            };

            var ctx = document.getElementById('chart-area-users').getContext('2d');
            window.myBar1 = new Chart(ctx, config);
        }

        function drawContentTypeDetail(sId) {
            var colorInfo = [];
            for (var i = 0; i < 10; i++) colorInfo.push('#' + generateRandomStr());

            var chartTitles = ['浏览', '收藏', '下载', '点赞'];
            var keys = ['total_read', 'total_favorite', 'total_download', 'total_like'];

            for (var i = 0; i < subjectList.length; i++) {
                var sItem = subjectList[i];
                var tId = $('.frame-term[data-id="' + sItem.id + '"]').val();
                var contentTypeData = contentTypeContentDetail.filter(function (a) {
                    var cond = (tId == '' || tId == a.term_id);
                    return a.subject_id == sItem.id && cond;
                });
                console.log('------- contentTypeData: ',contentTypeData.length)
                var contentTypeLabels = [];
                var contentTypeIds = [];
                for (var c = 0; c < contentTypeData.length; c++) {
                    var cTypeItem = contentTypeList.filter(function (a) {
                        return a.id == contentTypeData[c].contenttype_id;
                    });
                    contentTypeLabels.push(cTypeItem[0].title);
                    contentTypeIds.push(cTypeItem[0].id);
                }
                contentTypeLabels = removeDuplicated(contentTypeLabels);
                var datasets = [];
                for (var c = 0; c < keys.length; c++) {
                    var key = keys[c];
                    var label = chartTitles[c];
                    var chartData = [];
                    for (var k = 0; k < contentTypeLabels.length; k++) {
                        var contents = 0;
                        for (var d = 0; d < contentTypeData.length; d++) {
                            if (contentTypeData[d]['contenttype_id'] == contentTypeIds[k])
                                contents += parseInt(contentTypeData[d][key]);
                        }
                        chartData.push(contents);
                    }
                    datasets.push({
                        data: chartData,
                        backgroundColor: colorInfo[c],
                        label: label
                    });
                }
                var config = {
                    type: 'bar',
                    data: {
                        datasets: datasets,
                        labels: contentTypeLabels
                    },
                    options: {
                        responsive: true,
                        tooltips: {mode: 'index', intersect: false},
                        scales: {xAxes: [{stacked: false}], yAxes: [{stacked: false}]},
                        barThickness: 'flex',
                        legend: {position: 'bottom'}
                    }
                };
                if(sId==0 || sId ==sItem.id) {
                    $('#chart-area-contenttype' + i).parent().html('<canvas id="chart-area-contenttype' + i + '"></canvas>');
                    var ctx = document.getElementById('chart-area-contenttype' + i).getContext('2d');
                    window.myBar1 = new Chart(ctx, config);
                }

            }
        }

        function drawContentsInfo() {
            $('.main-frame').hide();
            $('.table-toolbar[data-id="1"]').fadeIn('fast');
            $('.main-frame[data-id="1"]').fadeIn('fast');
            var i = 0;
            var max = 0, maxkey = 0;
            var colorInfo = {
                total_download: '#2ecdad',
                total_favorite: '#2ecdad',
                total_like: '#2ecdad',
                total_read: '#2ecdad'
            };
            for (var key in contentsInfo[0]) {
                if (typeof key !== 'function') {
                    if (contentsInfo[0][key] > max) {
                        max = contentsInfo[0][key] * 1;
                        maxkey = key;
                    }
                }
            }
            colorInfo[maxkey] = '#ff7800';
            var config = {
//                type: 'pie',
                type: 'horizontalBar',
                data: {
                    datasets: [{
                        data: [
                            contentsInfo[0].total_download,
                            contentsInfo[0].total_favorite,
                            contentsInfo[0].total_like,
                            contentsInfo[0].total_read
                        ],
                        backgroundColor: [
                            colorInfo.total_download,
                            colorInfo.total_favorite,
                            colorInfo.total_like,
                            colorInfo.total_read
                        ],
                        label: '数量'
                    }],
                    labels: ['下载', '收藏', '点赞', '浏览']
                },
                options: {
                    responsive: true,
                    tooltips: {mode: 'index', intersect: false},
                    barThickness: 'flex',
                    legend: {position: 'bottom'}
                }
            };
            var ctx = document.getElementById('chart-area-contents').getContext('2d');
            window.myBar1 = new Chart(ctx, config);

            colorInfo = {
                total_download: '#2ecdad',
                total_favorite: '#2ecdad',
                total_like: '#2ecdad',
                total_read: '#2ecdad'
            };
            max = 0;
            for (var key in lessonsInfo[0]) {
                if (typeof key !== 'function') {
                    if (lessonsInfo[0][key] > max) {
                        max = lessonsInfo[0][key] * 1;
                        maxkey = key;
                    }
                }
            }
            colorInfo[maxkey] = '#ff7800';
            var config = {
//                type: 'pie',
                type: 'horizontalBar',
                data: {
                    datasets: [{
                        data: [
                            lessonsInfo[0].total_favorite,
                            lessonsInfo[0].total_like,
                            lessonsInfo[0].total_read
                        ],
                        backgroundColor: [
                            colorInfo.total_favorite,
                            colorInfo.total_like,
                            colorInfo.total_read
                        ],
                        label: '数量'
                    }],
                    labels: ['收藏', '点赞', '浏览']
                },
                options: {
                    responsive: true,
                    tooltips: {mode: 'index', intersect: false},
                    barThickness: 'flex',
                    legend: {position: 'bottom'}
                }
            };
            var ctx = document.getElementById('chart-area-lessons').getContext('2d');
            window.myBar2 = new Chart(ctx, config);
        }

        function drawSubjectsInfo() {
            $('.main-frame').hide();
            $('.table-toolbar[data-id="1"]').fadeOut('fast');
            $('.main-frame[data-id="2"]').fadeIn('fast');
            var colorInfo = ['#ff852e', '#ffd22e', '#45ff2e', '#2effbb', '#2ee2ff',
                '#2ea8ff', '#d89aff', '#b39aff', '#e0d6ff', '#dddddd'];
            var chartInfo = [];
            var titleInfo = [];
            subjectsContentInfo.sort(function (a, b) {
                return (a.total_read < b.total_read) ? 1 : -1
            });
            for (var i = 0; i < subjectsContentInfo.length; i++) {
                chartInfo.push(subjectsContentInfo[i].total_read);
                titleInfo.push(subjectsContentInfo[i].title);
            }
            var config = {
//                type: 'pie',
                type: 'pie',
                data: {
                    datasets: [{
                        data: chartInfo,
                        backgroundColor: colorInfo,
                        label: '使用数量'
                    }],
                    labels: titleInfo
                },
                options: {
                    responsive: true,
                    legend: {position: 'bottom'}
                }
            };

            var ctx = document.getElementById('chart-area-subjects-content').getContext('2d');
            window.myPie1 = new Chart(ctx, config);

            chartInfo = [];
            titleInfo = [];
            subjectsLessonInfo.sort(function (a, b) {
                return (a.total_read < b.total_read) ? 1 : -1
            });
            for (var i = 0; i < subjectsLessonInfo.length; i++) {
                chartInfo.push(subjectsLessonInfo[i].total_read);
                titleInfo.push(subjectsLessonInfo[i].title);
            }
            var config = {
//                type: 'pie',
                type: 'pie',
                data: {
                    datasets: [{
                        data: chartInfo,
                        backgroundColor: colorInfo,
                        label: '使用数量'
                    }],
                    labels: titleInfo
                },
                options: {
                    responsive: true,
                    legend: {position: 'bottom'}
                }
            };

            var ctx = document.getElementById('chart-area-subjects-lesson').getContext('2d');
            window.myPie1 = new Chart(ctx, config);
        }

        function drawTermsInfo() {
            $('.main-frame').hide();
            $('.table-toolbar[data-id="1"]').fadeOut('fast');
            $('.main-frame[data-id="3"]').fadeIn('fast');
            var colorInfo = ['#ff852e', '#ffd22e', '#45ff2e', '#2effbb', '#2ee2ff',
                '#2ea8ff', '#d89aff', '#b39aff', '#e0d6ff', '#dddddd',
                '#bbbbbb', '#999999', '#666666', '#444444', '#111111'];
            var chartInfo = [];
            var titleInfo = [];
            termsContentInfo.sort(function (a, b) {
                return (a.title < b.title) ? 1 : -1
            });
            for (var i = 0; i < termsContentInfo.length; i++) {
                chartInfo.push(termsContentInfo[i].total_read);
                titleInfo.push(termsContentInfo[i].title.substr(0, 3));
            }
            var config = {
//                type: 'pie',
                type: 'pie',
                data: {
                    datasets: [{
                        data: chartInfo,
                        backgroundColor: colorInfo,
                        label: '使用数量'
                    }],
                    labels: titleInfo
                },
                options: {
                    responsive: true,
                    legend: {position: 'bottom'}
                }
            };

            var ctx = document.getElementById('chart-area-terms-content').getContext('2d');
            window.myPie2 = new Chart(ctx, config);

            chartInfo = [];
            titleInfo = [];
            termsLessonInfo.sort(function (a, b) {
                return (a.title < b.title) ? 1 : -1
            });
            for (var i = 0; i < termsLessonInfo.length; i++) {
                chartInfo.push(termsLessonInfo[i].total_read);
                titleInfo.push(termsLessonInfo[i].title.substr(0, 3));
            }
            var config = {
//                type: 'pie',
                type: 'pie',
                data: {
                    datasets: [{
                        data: chartInfo,
                        backgroundColor: colorInfo,
                        label: '使用数量'
                    }],
                    labels: titleInfo
                },
                options: {
                    responsive: true,
                    legend: {position: 'bottom'}
                }
            };

            var ctx = document.getElementById('chart-area-terms-lesson').getContext('2d');
            window.myPie2 = new Chart(ctx, config);
        }

        function searchConfig() {
            var content_html = '<option value="">全部</option>';
            $('select[name="search_term"]').html(content_html);
            $('select[name="search_course_type"]').html(content_html);

            // make subject List
            for (var i = 0; i < subjectList.length; i++) {
                var item = subjectList[i];
                // if (item.status == '0') continue;
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

            if (filterInfo['tbl_huijiao_terms.subject_id']) {
                $('select[name="search_subject"]').val(filterInfo['tbl_huijiao_terms.subject_id']);
                $('select[name="search_subject"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_terms.id']) {
                $('select[name="search_term"]').val(filterInfo['tbl_huijiao_terms.id']);
                $('select[name="search_term"]').trigger('change');
            }

            if (filterInfo['tbl_huijiao_contents.course_type_id'])
                $('select[name="search_course_type"]').val(filterInfo['tbl_huijiao_contents.course_type_id']);

        }

        function searchItems(self) {
            $('#searchForm').submit();
        }

        function generateRandomStr(len) {
            var strPool = '0123456789abcd';
            if (len == undefined) len = 6;
            var strLen = strPool.length;
            var ret = '';
            for (var i = 0; i < len; i++) {
                ret += strPool.substr(parseInt(Math.random() * strLen), 1);
            }
            return ret;
        }

        function removeDuplicated(arr, subKey) {
            var m = {};
            if (!subKey) subKey = '';
            var newarr = [];
            for (var i = 0; i < arr.length; i++) {
                var v = arr[i];
                if (subKey != '') v = arr[i][subKey];
                if (!m[v]) {
                    newarr.push(v);
                    m[v] = true;
                }
            }
            return newarr;
        }

        function makeDateString(date) {
            return date.getFullYear() + '-' +
                makeNDigit(date.getMonth() + 1, 2) + '-' +
                makeNDigit(date.getDate(), 2);
        }

        function makeNDigit(num, len) {
            num = num.toString();
            if (!len) len = 2;
            var ret = '';
            for (var i = 0; i < len; i++) ret += '0';
            ret += num;
            ret = ret.substr(-len);
            return ret;
        }

        $('.scripts').remove();
    </script>
</div>

