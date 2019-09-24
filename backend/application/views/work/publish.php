
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workpublish.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/datetimepicker/jquery.simple-dtpicker.css') ?>">
<style>
	body> div:nth-child(2){
		top: calc(25vw)!important;
		left: calc(40vw)!important;
	}
	.datepicker *{
		position: relative;
	}
	.datepicker_header *{
		position: absolute;
	}
	.datepicker_header{
		position: unset;
	}

	.datepicker_header> a:nth-child(3),
	.datepicker_header> span,
	.datepicker_header> a:nth-child(5){
		position: relative;
		display: inline-block;
	}
	.datepicker > .datepicker_header > .icon-home,
	.datepicker > .datepicker_header > .icon-close{
		padding: 13px;
	}
    .datepicker > .datepicker_header > .icon-home div{
        width: 37% !important;
        height: 40% !important;
    }
    .datepicker > .datepicker_header > .icon-close div{
        width: 35% !important;
        height: 40% !important;
    }
</style>
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">布置作业</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="sec-wrap select-ban-wrap">
        <div class="title-sec">
            <span style="margin-right: 100px">选择班级</span>
            <?php foreach ($sclasses as $sclass) : ?>
                <?php
                $classArr = explode('-', $sclass->class_name);
                $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
                $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
                $classStr = '';
                if (isset($classArr[0]) && isset($classYearArr[$classArr[0] - 1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1] - 1])) {
                    $classStr = $classYearArr[$classArr[0] - 1] . $classBanArr[$classArr[1] - 1];
                }
                ?>
                <div class="check-elem">
                    <input type="checkbox" , class="check-elem-chk" data-id="<?= $sclass->id ?>"
                           data-str="<?= $classStr ?>"/>
                    <span><?= $classStr ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="body-sec" style="text-align: center">
            <div class="info-sec">
                <span style="margin-right: 20px">本次作业名称：</span>
                <input class="text-inputbox" id="work-title" placeholder="请输入作业名称">
            </div>
            <div>
                <span style="margin-right: 20px">截至完成时间：</span>
                <input class="text-inputbox" id="end-time" type="text" readonly="readonly" placeholder="请选择完成时间">
            </div>
        </div>
    </div>

    <div class="sec-wrap action-wrap">
<!--        <div class="action-sticky">-->
            <a class="action-btn" style="background-color: #eebc34">已选<span id="selected-questions-num">0</span>题</a>
            <a class="action-btn" onclick="onClickPreview()">作业预览</a>
            <a class="action-btn" onclick="onOpenPublishModal()">布置作业</a>
<!--        </div>-->
    </div>

    <div class="sec-wrap select-question-wrap">
        <div class="title-sec" style="">
            <span style="margin-right: 30px">选择题目</span>
            <a class="action-btn" id="select-all-questions" style="margin-right: 120px"
               onclick="onClickAllQuestionSelect();">全选</a>
            <span style="margin-right: 30px">选择范围：</span>
            <div class="select-elem terms">
                <div onclick="toggleTermsSelectBox()">
                    <span id="selected-term">册次</span>
                    <img src="<?= base_url('assets/images/huijiao/tab2/btn-select.png') ?>"/>
                </div>
                <div class="select-box">
                    <?php foreach ($terms as $term) : ?>
                        <div class="select-option" data-id="<?= $term->id ?>" data-title="<?= $term->title ?>">
                            <input type="radio" <?= $term->id == $user->term_id ? 'checked' : '' ?>/>
                            <span><?= $term->title ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="select-elem coursetypes" style="width: 170px">
                <div onclick="toggleCoursetypesSelectBox()">
                    <span>课程</span>
                    <img src="<?= base_url('assets/images/huijiao/tab2/btn-select.png') ?>"/>
                </div>
                <div class="select-box">
                    <?php foreach ($courseTypes as $courseType) : ?>
                        <div class="select-option" data-id="<?= $courseType->id ?>">
                            <input type="checkbox" class="coursetype-checkbox"/>
                            <?php $title = $courseType->title;
                            if (mb_strlen($title) > 9) $title = mb_substr($title, 0, 9) . '...'; ?>
                            <span><?= $title ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="body-sec question-sec" style="border-top: none; padding-top: 0">
            <?= $questionsHtml ?>
        </div>

        <div class="pagination-bar">
            <?= $paginationHtml ?>
        </div>
    </div>

</div>


<div class="publish-modal-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>选择班级</h5>
        </div>
        <div class="edit-modal-body">
            <p style="text-align: center">本次作业将发送至<span id="publish-class-str"></span>的</p>
            <p style="text-align: center">学生，确认布置吗？</p>

            <div class="info-confirm-btn" onclick="onPublishConfirm()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onClosePublishModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<div class="preview-error-modal-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>警告</h5>
        </div>
        <div class="edit-modal-body">
            <p style="text-align: center">请输入班级、作业名称、完成时间，然后选择题目。</p>

            <div class="info-confirm-btn" onclick="onClosePublishModal()" style="margin-top: 30px">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/datetimepicker/jquery.simple-dtpicker.js') ?>"></script>
<script src="<?= base_url('assets/js/workpublish.js') ?>" type="text/javascript"></script>

<script>

    $(function () {
        var scale = 1/_resize();
        var scaleStr = 'scale(' + scale.toFixed(3) + ')';
        $('.question-elem .section[data-type="content"] img').css({
            'transform': scaleStr,
            '-webkit-transform': scaleStr,
            '-moz-transform': scaleStr,
            '-ms-transform': scaleStr,
            '-o-transform': scaleStr
        });
			
		var date = new Date();
//		date = date.setDate(date.getDate() + 1);
		$('#end-time').appendDtpicker({
			"closeOnSelected": true,
			"dateOnly": false,
			"locale": "cn"
		});
		$('#end-time').handleDtpicker('setDate', date);

    })
    function onClickCourseType(elem) {
        var checked = $(elem).find('input');
        if (checked.length > 0) checked = checked[0].checked;

        if (isClickCheckbox) {
            if (checked)
                $(elem).find('input').prop('checked', true);
            else
                $(elem).find('input').prop('checked', false);
            isClickCheckbox = false;
        } else {
            if (checked)
                $(elem).find('input').prop('checked', false);
            else
                $(elem).find('input').prop('checked', true);
        }


        var checkboxes = $(elem).parent().find('.select-option').find('input');
        var checkedIds = [];
        for (var i = 0; i < checkboxes.length; i++) {
            var checkbox = checkboxes[i];
            var checked = checkbox.checked;
            if (checked) {
                checkedIds.push($(checkbox).parent().attr('data-id'));
            }
        }

        jQuery.ajax({
            type: "post",
            url: baseURL + "work/selectCoursetype/",
            dataType: "json",
            data: {
                coursetype_ids: checkedIds,
                selected_question_ids: questionsArr
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('.body-sec.question-sec').html(res.data.questionsHtml);
                    $('.pagination-bar').html(res.data.paginationHtml);
                    allQuestionIds = res.data.questions_ids;
                    console.log($('.pagination-bar li a'));
                    $('.pagination-bar li a').each(function () {
                        $(elem).attr('href', 'javascript:void(0)');
                        $(elem).attr('onclick', 'onClickPage(elem);');
                    });
                    var scale = 1/_resize();
                    var scaleStr = 'scale(' + scale.toFixed(3) + ')';
                    $('.question-elem .section[data-type="content"] img').css({
                        'transform': scaleStr,
                        '-webkit-transform': scaleStr,
                        '-moz-transform': scaleStr,
                        '-ms-transform': scaleStr,
                        '-o-transform': scaleStr
                    });
                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });

        console.log(checkedIds);
    }

</script>