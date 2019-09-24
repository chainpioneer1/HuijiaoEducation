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
    .main-content{
        padding: 0 calc(4vw);
        text-align: center;
    }
    img{
        width: calc(25vw);
        height: calc(25vw);
        margin-top: calc(13vh);
        display: none;
    }
    h3{
        color: #404040;
        font-weight: bold;
        font-size: calc(7vw);
        line-height: calc(7vw);
        margin: calc(3vh) calc(20vw);
        text-align: center;
        display: none;
    }
    p{
        color: #404040;
        font-size: calc(5vw);
        line-height: calc(5vh);
        margin: calc(6vh) calc(20vw);
        text-align: center;
        display: none;
    }

    .login-btn{
        background-color: #00cdaf;
        padding: calc(3vw);
        text-align: center;
        width: 100%;
        display: inline-block;
        margin: calc(2vh) 0;
        color: #fff;
        border-radius: 7px;
        font-size: calc(5vw);
        text-decoration: none;
        display: none;
    }
    .login-btn:hover{
        text-decoration: none;
        display: none;
    }
</style>
<div class="main-content-area-wrapper">
    <div class="main-content">
        <img src="<?= base_url('assets/images/mobile') . '/touxiang1.png' ?>"/>
        <h3>登 录</h3>
        <p>将跳转至青岛e平台<br/>登录入口登录</p>

        <form method="post" class="login_form" action="<?= base_url('student/signin') ?>">
            <input name="SAMLRequest" value="<?= base_url() ?>api/authorize" hidden style="display:none;">
            <input type="text" name="username" maxlength="18" id="username" placeholder="请输入用户名" hidden style="display:none;" disabled>
            <input type="password" name="password" maxlength="18" id="password" placeholder="请输入用密码" hidden style="display:none;"disabled>
            <input type="text" name="user_type" hidden id="user_type" value="1" disabled style="display: none;">
            <div class="auto-login" hidden style="display: none;">
                <div class="checkbox" data-sel="1" disabled></div>
                下次自动登录
                <input type="text" name="auto_login" value="0" hidden disabled>
            </div>
            <a type="image" name="submit" class="login-btn">登录</a>
        </form>
    </div>
</div>
<script>
    $('.login-btn').on('click', function (object) {
        $('.login_form').submit();
    })

    $(window).load(function () {

    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>