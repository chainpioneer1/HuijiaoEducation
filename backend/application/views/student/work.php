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
        <h1>作业</h1>
        <a href="<?= base_url('student/wrong') ?>" class="next-btn">
            <span>错题本</span>
            <img src="<?= $imgDir . 'next.png' ?>">
        </a>
    </div>

    <div class="main-content">
        <?php if( count($worksArr) == 0 ) : ?>
        <div class="noItem">
            <p>没有作业</p>
        </div>
        <?php endif; ?>
        <div class="elems-wrap"></div>
        <?php foreach ($worksArr as $work): ?>
            <div class="elems-wrap">
                <div class="content-elem" >
                    <h3 style="margin: 0; line-height: 1">
                        <a><?= $work['work']->title; ?></a>
                    </h3>
                    <h3 style="margin: 0; line-height: 1">
                        <a><?= $work['coursetype']; ?></a>
                        <?php
                        $status = '开始作业';
                        if($work['status'] == 1) $status = '已完成';
                        else if($work['status'] == 2) $status = '订正作业';
                        ?>
                        <?php if( $work['status'] == 1 ) : ?>
                            <a class="work-status status-<?= $work['status'] ?>"><?= $status ?></a>
                        <?php else :?>
                            <a class="work-status status-<?= $work['status'] ?>" href="<?= base_url('student/workdetail/' . $work['work']->id) ?>"><?= $status ?></a>
                        <?php endif;?>
                    </h3>
                    <p>截至提交时间: <?= date_format( date_create($work['work']->end_time), "Y.m.d H:i") ?></p>
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

    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>