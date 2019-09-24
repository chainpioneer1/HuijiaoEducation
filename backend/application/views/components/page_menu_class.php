<?php

$userType = $this->session->userdata('user_type');
$returnPrefix = '';
if ($userType == '2')
    $returnPrefix = 'student/index/';
?>
<style>
    .top-back {
        left: -5%;
        width: 30px;
        height: 30px;
        background: url(<?= base_url('assets/images/huijiao/profile/classmanager/fanhuianniu.png') ?>);
    }
</style>
<div class="header-bar">
    <div class="top-area"></div>
    <div class="main-menu">
        <div class="top-bar">
            <a href="<?= base_url('home/index'); ?>" class="logo"></a>
<!--            <a onclick="goPreviousPage(-1)" class="top-back"></a>-->
            <?php if ($this->session->userdata("loggedin") == TRUE) { ?>
                <a href="<?= base_url('users/profile/' . $this->session->userdata('loginuserID')); ?>"
                   class="top-profile"></a>
                <a href="<?= base_url($returnPrefix . 'signin/signout'); ?>" class="top-logout">退出</a>
            <?php } else { ?>
                <a href="<?= base_url($returnPrefix . 'signin'); ?>" class="top-login"> </a>
            <?php } ?>
            <a onclick="minimizeApp()" class="top-btn-minimize"></a>
            <a onclick="$('.top-close-bg').fadeIn('fast');" class="top-btn-close"></a>
        </div>
        <div class="top-close-bg">
            <div class="top-close-modal">
                <a class="top-btn-yes" onclick="closeApp();"></a>
                <a class="top-btn-no" onclick="$('.top-close-bg').fadeOut('fast');"></a>
            </div>
        </div>
    </div>
</div>

<script>
    topBarConfig();
    function topBarConfig(){
        // $('.top-back').hide();
        try {
            var isFlag = JavaFx;
            $('.top-btn-minimize').show();
            $('.top-btn-close').show();
//        $('.top-profile').css({left:'82.45%'});
//        $('.top-logout').css({left:'82.5%'});
        } catch (e) {
            $('.top-btn-minimize').hide();
            $('.top-btn-close').hide();
//        $('.top-profile').css({left:'90.45%'});
//        $('.top-logout').css({left:'90.5%'});
        }
    }
</script>