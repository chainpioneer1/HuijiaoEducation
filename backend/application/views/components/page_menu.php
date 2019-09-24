<?php

$userType = $this->session->userdata('user_type');
$returnPrefix = '';
if ($userType == '2')
    $returnPrefix = 'student/index/';
?>
<div class="header-bar">
    <div class="top-area"></div>
    <div class="main-menu">
        <div class="top-bar">
            <a href="<?= base_url('home/index'); ?>" class="logo">慧教乐学</a>
            <a onclick="goPreviousPage(-1)" class="top-back"></a>
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

    function topBarConfig() {
        $('.top-back').hide();
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

    function signOut() {
        $.ajax({
            url: 'http://www.qdedu.net/auth/j_hh_security_logout',
            type: 'get',
            dataType: 'jsonp',
            jsonpCallback: "result",
            complete: function () {
                location.href = "<?= base_url('signin/signout');?>";
            }
        })
    }
</script>