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
        <a href="<?= base_url('student/work') ?>" class="back-btn">
            <img src="<?= $imgDir . 'back.png' ?>">
        </a>
        <h1>错题本</h1>
    </div>

    <div class="main-content">
        <?php if( count($wrongs) == 0 ) : ?>
            <div class="noItem">
                <p>没有错题</p>
            </div>
        <?php endif; ?>
        <div class="elems-wrap"></div>
        <?php foreach ($wrongs as $wrong): ?>
            <div class="elems-wrap">
                <div class="content-elem" >
                    <h3 style="margin: 0; line-height: 1">
                        <a><?= $wrong->question_no; ?></a>
                    </h3>
                    <h3 style="margin: 0; line-height: 1">
                        <a><?= $wrong->course_type; ?></a>
                        <?php
                        $status = '进入学习';
                        if($wrong->status == 1) $status = '已完成';
                        ?>
                        <?php if( $wrong->status == 1 ) : ?>
                            <a class="work-status wrong-status status-<?= $wrong->status ?>"><?= $status ?></a>
                        <?php else :?>
                            <a class="work-status wrong-status status-<?= $wrong->status ?>" href="<?= base_url('student/wrongdetail/' . $wrong->id) ?>"><?= $status ?></a>
                        <?php endif;?>
                    </h3>
                    <p>截至提交时间: <?= date_format( date_create($wrong->update_time), "Y.m.d H:i") ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="footer">
        <div style="position: relative; width: 100%; height: 100%">
            <a href="<?= base_url('student'); ?>" class="footer-btn" id="footer-xuexi">
                <img src="<?= base_url('assets/images/mobile/santubiao2.png') ?>">
                <span>学习</span>
            </a>
            <a href="<?= base_url('student/work'); ?>" class="footer-btn active" id="footer-zuoye">
                <img src="<?= base_url('assets/images/mobile/santubiao3.png'); ?>">
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
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    $(window).load(function () {
        padDesignFix();
    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>