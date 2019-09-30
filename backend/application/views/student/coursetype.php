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
        <a href="<?= base_url('student') ?>" class="back-btn">
            <img src="<?= $imgDir . 'back.png' ?>">
        </a>
        <h1><?= ($coursetype == null) ? '': $coursetype->title ?></h1>
    </div>

    <div class="main-content">
        <div class="elems-wrap"></div>
        <?php if( count($contentsArr) == 0 ) : ?>
            <div class="noItem">
                <p>没有课件</p>
            </div>
        <?php endif; ?>
        <?php foreach ($contentsArr as $content): ?>
            <div class="elems-wrap">
            <div class="content-elem" >
                <a href="<?= base_url('student/contentplayer/' . $content['content']->id) ?>">
                    <img src="<?= base_url() . $content['content']->icon_path_m; ?>">
                    <img src="<?= base_url() . $content['content']->icon_corner_m; ?>" class="icon-corner">
                </a>

                <h3><a><?= $content['content']->title; ?></a></h3>
                <div></div>

                <div class="item-infobar">
                    <div class="item-read-icon" data-sel="<?= count($content['usages_read_mine']) > 0 ? 1 : 0?>"></div>
                    <div class="item-read-value"><?= $content['read_count'] ?></div>
                    <div class="item-favor-icon <?=($content['usage_like'] > 0 ? 'active' : '') ?>" data-sel="<?= $content['usage_like'] ?>" data-content_id="<?= $content['content']->id ?>" data-usage_id="<?= $content['usage_id'] ?>"></div>
                    <div class="item-favor-value"><?= count($content['usages']) ?></div>
                </div>
            </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="footer">
        <div style="position: relative; width: 100%; height: 100%">
            <a href="<?= base_url('student'); ?>" class="footer-btn" id="footer-xuexi">
                <img src="<?= base_url('assets/images/mobile/santubiao2.png') ?>">
                <span>首页</span>
            </a>
            <a href="<?= base_url('student/coursetype'); ?>" class="footer-btn active" id="footer-zuoye">
                <img src="<?= base_url('assets/images/mobile/santubiao3.png'); ?>">
                <span>学习</span>
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
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    $('.item-favor-icon').click(function (e) {
        e.preventDefault();
        var like = $(this).attr('data-sel');
        console.log($(this).parent());
        console.log($(this).parent().children('.item-favor-value').text());
        var likeNum = parseInt($(this).parent().children('.item-favor-value').text());
        if (like == '0') {
            like = '1';
            likeNum++
        }
        else if (like == '1') {
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
    $(window).load(function () {
        padDesignFix();
    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>