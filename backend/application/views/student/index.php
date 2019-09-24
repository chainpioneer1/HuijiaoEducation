<script>
    var imageDir = baseURL + "assets/images/resource/";
</script>

<?php
$imgDir = base_url() . 'assets/images/mobile/';
$isLogin = false;
if ($this->session->userdata("loggedin") != FALSE) {
    $isLogin = true;
}
?>
<style>
    body {
        background-color: #f5f5f5 !important;
    }
</style>
<div class="main-content-area-wrapper">
    <div class="header" id="stickyHeader">
        <h1>首页</h1>
    </div>
    <div class="slider-bar owl-carousel">
        <?php foreach ($banners as $ban_img): ?>
            <div><img src="<?= base_url() . 'uploads/' . $ban_img->icon_path; ?>" alt="NO Image"></div>
        <?php endforeach; ?>
    </div>
    <div class="main-content">
        <div class="subject-wrap">
            <?php foreach ($subjectsArr as $elem): ?>
                <?php
                $subject = $elem['subject'];
                ?>
                <a class="subject-elem" data-subject-id="<?= $subject->id ?>"
                   data-img-src="<?= $subject->image_icon ?>">
                    <img src="<?= base_url('assets/images/mobile/') . '/' . $subject->image_icon . '.png'; ?>">
                    <p><?= $subject->title; ?></p>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="profile-favorite " style="background-color: #fff; margin-bottom: 10px;padding-bottom: 5px;">
            <h3 style="border: none">精彩推荐</h3>
            <div class="item-content-page" style="padding-top: calc(2vw)">

                <?php if (count($recommandsArr) == 0) : ?>
                    <div class="sub-noItem">
                        <p>没有推荐</p>
                    </div>
                <?php endif; ?>

                <?php foreach ($recommandsArr as $recommand) : ?>
                    <?php
                    $title = $recommand['content']->title;
                    if (mb_strlen($title) > 11) $title = mb_substr($title, 0, 11) . '...';
                    ?>
                    <div class="item-content">
                        <img class="feature-img" src="<?= base_url() . $recommand['recommand']->image_icon ?>"
                             onclick="location.href='<?= base_url('student/contentplayer') . '/' . $recommand['content']->id ?>'">
                        <div class="item-body">
                            <div class="item-subject">
                                <span onclick="location.href='<?= base_url('student/contentplayer') . '/' . $recommand['content']->id ?>'">
                                    <?= $title ?></span>
                            </div>
                            <div class="item-title">
                                <span onclick="location.href='<?= base_url('student/contentplayer') . '/' . $recommand['content']->id ?>'">
                                    <?= $recommand['recommand']->subject.'&nbsp;&nbsp;&nbsp;'.$recommand['recommand']->term ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="subject-tab-section-wrap">
        </div>

        <div class="courseArrscripts" style="display:none">
            <input class="subjectsArr" style="display:none" value='<?= json_encode($subjectsArr); ?>'>
            <script>
                var subjectsArr = JSON.parse($('.subjectsArr').val());
                $(function () {
                    var parentElem = $('div.subject-tab-section-wrap');
                    parentElem.html('');
                    for (var i = 0; i < subjectsArr.length; i++) {
                        var elem = subjectsArr[i];
                        var subject = elem.subject;
                        var courseTypeArr = elem.courseTypeArr;
                        parentElem.append('<div class="subject-tab-section" id="subject-tab-section-' + subject.id + '">' +
                            '<div class="elems-wrap"></div>' +
                            '<div class="footer-empty"></div>' +
                            '</div>');
                        var subjectElem = $('#subject-tab-section-' + subject.id + ' .elems-wrap');
                        if (courseTypeArr.length == 0) {
                            subjectElem.append(' <div class="sub-noItem">' +
                                '<p>没有课件</p>' +
                                '</div>');
                            continue;
                        }
                        for (var j = 0; j < courseTypeArr.length; j++) {
                            var courseTypeElem = courseTypeArr[j];
                            subjectElem.append('<div class="elems-header">' +
                                '<h2>' + courseTypeElem.coursetype.title + '' +
                                '<a href="' + baseURL + 'student/coursetype/' + courseTypeElem.coursetype.id + '"' +
                                '> 更多 > </a>' +
                                '</h2>' +
                                '</div>');
                            for (var k = 0; k < courseTypeElem.contents.length; k++) {
                                var content = courseTypeElem.contents[k];
                                var icon_path = content.icon_path_m;
                                if (!icon_path || icon_path == '') icon_path = 'assets/images/no-img-mobile.png';
                                var icon_corner = content.icon_corner_m;
                                if (!icon_corner || icon_corner == '') icon_corner = 'assets/images/no-img-mobile.png';
                                subjectElem.append('<div class="content-elem">' +
                                    '<a><img src="' + baseURL + icon_path + '"></a>' +
                                    '<h3><a>' + content.title + '</a></h3>' +
                                    '<img src="' + baseURL + icon_corner + '" class="icon-corner">' +
                                    '</div>');
                                // if( content.icon_path_m == 'resource' )
                                //     console.log('-- content : ', content.icon_path_m, content);
                            }
                        }
                    }
                });
                // $('.courseArrscripts').remove();
            </script>
        </div>
    </div>
    <div class="footer">
        <div style="position: relative; width: 100%; height: 100%">
            <a href="<?= base_url('student'); ?>" class="footer-btn active" id="footer-xuexi">
                <img src="<?= base_url('assets/images/mobile/santubiao1.png') ?>">
                <span>学习</span>
            </a>
            <a href="<?= base_url('student/work'); ?>" class="footer-btn" id="footer-zuoye">
                <img src="<?= base_url('assets/images/mobile/santubiao4.png'); ?>">
                <span>作业</span>
            </a>
            <a href="<?= base_url('student/profile'); ?>" class="footer-btn" id="footer-my">
                <img src="<?= base_url('assets/images/mobile/santubiao6.png'); ?>">
                <span>我的</span>
            </a>
        </div>
    </div>
</div>
<script>
    var isProcessing = false;
    var user_id = '<?= $this->session->userdata('loginuserID') ?>';
    $('.item-favor-icon').click(function (e) {
        e.preventDefault();
        var like = $(this).attr('data-sel');
        console.log($(this).parent());
        console.log($(this).parent().children('.item-favor-value').text());
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
        console.log('-- content_id : ', content_id, usage_id);

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

    $(window).load(function () {

    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>