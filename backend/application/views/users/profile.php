<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/user_profile.css') ?>">

<div class="base-container" style="height: 450px; top: 140px;width: 80%;">
    <div style="height: 900px;width: 100%;">
        <div class="frame"></div>
        <!--        <div class="prev_btn" onclick="goPreviousPage(-1)"></div>-->
        <div class="profile-container">
            <div class="profile-header">
                <img src="<?= base_url('assets/images/huijiao/touxiang.png') ?>">
                <div class="profile-header-content">
                    <?php if (false) { ?>
                        <div class="profile-header-item">
                            <div class="profile-header-subject" style="width: 400px">
                                <span>我的班级：</span>
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
                                    <span class="class-btn"
                                          onclick="window.location='<?= base_url('users/classinfo/' . $sclass->id) ?>'"><?= $classStr ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="profile-header-subject edit-info"
                                 onclick="window.location='<?= base_url('users/classmanage/' . $user->id) ?>'">
                                <div style="margin-left:24%">班级管理</div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="prev-btn" onclick="onPrevBtn()">
                上一页
            </div>
            <div class="next-btn" onclick="onNextBtn()">
                下一页
            </div>
            <div class="profile-main-info active" id="profile-main-info">
                <div class="profile-info-item" style="left: 38%; top:30%;">
                    <div class="profile-info-name">姓名</div>
                    <div class="profile-info-content"><?= $user->user_nickname ?></div>
                </div>
                <div class="profile-info-item" style="left: 38%; top:40%;">
                    <div class="profile-info-name">账号</div>
                    <div class="profile-info-content"><?= $user->user_account ?></div>
                </div>
                <div class="profile-info-item" style="left: 38%; top:50%;">
                    <div class="profile-info-name">学校</div>
                    <div class="profile-info-content"><?= $user->user_school ?></div>
                </div>
            </div>
            <div class="profile-content-list" id="profile-content-list">
                <?= $favorite_contents ?>
            </div>
            <div class="profile-lesson-list" id="profile-lesson-list">
                <?= $favorite_lessons ?>
            </div>

            <div class="info-sel-btn active" onclick="onSelInfoSrc(this)">
                基本信息
            </div>
            <div class="content-sel-btn" onclick="onSelContentSrc(this)">
                资源收藏
            </div>
            <div class="lesson-sel-btn" onclick="onSelLessonSrc(this)">
                课件收藏
            </div>

        </div>
    </div>
</div>
<div class="profile-info-edit-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>修改同步教材</h5>
            <span onclick="onCloseInfoModal()"></span>
        </div>
        <div class="edit-modal-body">
            <div class="info-subject">
                <span style="width: 12%">科目：</span>
                <div class="subject-list">
                    <?php foreach ($subjectTermArr as $arr) { ?>
                        <div class="subject-item item-<?= $arr['subject']->id ?>"
                             onclick="onSelSubject(this, <?= $arr['subject']->id ?>)"><?= $arr['subject']->title ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="sep-line"></div>
            <div class="info-content">
                <span style="display: inline-block; width: 12%; height: 100px">册次：</span>
                <?php foreach ($subjectTermArr as $arr) { ?>
                    <div class="subject-list list-<?= $arr['subject']->id ?>">
                        <?php foreach ($arr['terms'] as $arr) { ?>
                            <div class="content-item item-<?= $arr->id ?>" data-id="<?= $arr->id ?>"
                                 onclick="onSelContent(this, <?= $arr->id ?>)"><?= $arr->title ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
            <div class="info-confirm-btn">
                <span onclick="onConfirmInfo()">确&nbsp;&nbsp;&nbsp;定</span>
            </div>
        </div>
    </div>
</div>
<!---->
<script>
    var lesson_page = 1;
    var content_page = 1;
    var tab = 'lesson';

    var active_term_id = <?= (isset($term)) ? $term->id : 0; ?>;
    var active_subject_id = <?= (isset($subject)) ? $subject->id : 0; ?>;

    $(document).ready(function () {
        display_lesson_page();
        active_term();
		if(sessionStorage.getItem('profile-subpage')=='0'){
			$('.content-sel-btn').click();
		}else if(sessionStorage.getItem('profile-subpage')=='1'){
			$('.lesson-sel-btn').click();
		}
    })

    var isProcessing = false;

    function onConfirmInfo() {
        jQuery.ajax({
            type: "post",
            url: baseURL + "users/setTerm",
            dataType: "json",
            data: {
                term_id: active_term_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('.profile-info-edit-wrap').fadeOut(100);
                    $('#profile-header_subject').text(res.data.subject.title);
                    $('#profile-header_term').text(res.data.term.title);
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

    function onEditInfo() {
        $('.profile-info-edit-wrap').fadeIn(100);
    }

    function onCloseInfoModal() {
        $('.profile-info-edit-wrap').fadeOut(100);
    }

    function aa(self, id) {
        active_subject_id = id;
    }

    function onSelSubject(self, id) {
        active_subject_id = id;

        var terms = $('.subject-list.list-' + active_subject_id + ' .content-item');
        if (!terms.length) active_term_id = null;
        else active_term_id = $(terms[0]).attr('data-id');
        active_term();
    }

    function onSelContent(self, id) {
        active_term_id = id;
        active_term();
    }


    function onSelInfoSrc(self) {
		sessionStorage.removeItem('profile-subpage');
        $('.prev-btn').hide();
        $('.next-btn').hide();
        $('.content-sel-btn').removeClass('active');
        $('.lesson-sel-btn').removeClass('active');
        $('.profile-main-info').addClass('active');
        $('.profile-content-list').removeClass('active');
        $('.profile-lesson-list').removeClass('active');
        $(self).addClass('active');
        tab = 'lesson';
        display_lesson_page();
    }

    function onSelContentSrc(self) {
		sessionStorage.setItem('profile-subpage', 0);
        $('.prev-btn').show();
        $('.next-btn').show();
        $('.info-sel-btn').removeClass('active');
        $('.lesson-sel-btn').removeClass('active');
        $('.profile-main-info').removeClass('active');
        $('.profile-content-list').addClass('active');
        $('.profile-lesson-list').removeClass('active');
        $(self).addClass('active');
        tab = 'content';
        display_lesson_page();
    }

    function onSelLessonSrc(self) {
		sessionStorage.setItem('profile-subpage', 1);
        $('.prev-btn').show();
        $('.next-btn').show();
        $('.info-sel-btn').removeClass('active');
        $('.content-sel-btn').removeClass('active');
        $('.profile-main-info').removeClass('active');
        $('.profile-content-list').removeClass('active');
        $('.profile-lesson-list').addClass('active');
        $(self).addClass('active');
        tab = 'lesson';
        display_lesson_page();
    }

    function onNextBtn() {
        if (tab == 'lesson') {
            lesson_page++;
        } else if (tab == 'content') {
            content_page++;
        }
        checkPageNum();
        display_lesson_page();
    }

    function onPrevBtn() {
        if (tab == 'lesson') {
            lesson_page--;
        } else if (tab == 'content') {
            content_page--;
        }
        checkPageNum();
        display_lesson_page();
    }

    function checkPageNum() {
        var perPage = 5;
        var lessonsNum = $('.profile-lesson-list .item-content').length;
        if (lesson_page > Math.ceil(lessonsNum / perPage))
            lesson_page = Math.ceil(lessonsNum / perPage)

        var contentsNum = $('.profile-content-list .item-content').length;
        if (content_page > Math.ceil(contentsNum / perPage))
            content_page = Math.ceil(contentsNum / perPage)

        if (lesson_page < 1) lesson_page = 1;
        if (content_page < 1) content_page = 1;
    }

    function display_lesson_page() {
        $('.item-content-page').removeClass('active');
        if (tab == 'lesson') {
            $('.item-content-page.lesson-page-' + lesson_page).addClass('active');
        } else if (tab == 'content') {
            $('.item-content-page.content-page-' + content_page).addClass('active');
        }
    }

    function active_term() {
        $('.subject-item').removeClass('active');
        $('.content-item').removeClass('active');
        $('.info-content .subject-list').removeClass('active');
        $('.subject-item.item-' + active_subject_id).addClass('active');
        $('.info-content .subject-list.list-' + active_subject_id).addClass('active');
        $('.content-item.item-' + active_term_id).addClass('active');
    }

    var isProcessing = false;

    function cancelFavorite(usage_id) {
        jQuery.ajax({
            type: "post",
            url: baseURL + "users/cancelFavorite",
            dataType: "json",
            data: {
                usage_id: usage_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#profile-lesson-list').html(res.data.favorite_lessons);
                    $('#profile-content-list').html(res.data.favorite_contents);
                    checkPageNum();
                    display_lesson_page();
                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
                location.reload();
            }
        });
    }
</script>
<!--<script src="--><? //= base_url('assets/js/preview.js') ?><!--" type="text/javascript"></script>-->

