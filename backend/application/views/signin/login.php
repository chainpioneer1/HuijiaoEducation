<?php
if (!isset($form_validation)) $form_validation = 'No';
if ($form_validation != 'No') $form_validation = 'Information error';
?>
<style>
    html, body {
        background: white;
    }
</style>
<script>
    var isErr = '<?=$form_validation?>';
</script>
<div class="base-container" style="top:130px;width:100%;">
    <div class="home-bg" style="height: 1080px;">
        <div class="login-bg">
            <?php
            if (true) {
                echo '<form method="post" class="login_form" action="' . base_url('api/getAuthCode') . '">';
            } else if (false) {
                echo '<form method="post" class="login_form" action="http://www.qdedu.net/uc/login/login.do?method=samlsso">';
            } else {
                echo '<form method="post" class="login_form" action="' . base_url('signin/signin') . '">';
            }
            ?>
            <input name="SAMLRequest" value="<?= base_url() ?>api/authorize" hidden disabled style="display:none;">
            <input type="text" name="username" maxlength="18" id="username" placeholder="请输入用户名" hidden
                   style="display:none;" disabled>
            <input type="password" name="password" maxlength="18" id="password" placeholder="请输入用密码" hidden
                   style="display:none;" disabled>
            <input type="text" name="user_type" hidden id="user_type" value="1" disabled style="display: none;">
            <div class="auto-login" hidden style="display: none;">
                <div class="checkbox" data-sel="1" disabled></div>
                下次自动登录
                <input type="text" name="auto_login" value="0" hidden disabled>
            </div>
            <a type="image" name="submit" class="login-btn"></a>
            <button type="submit" hidden></button>
            </form>
            <div class="login-err"><?= $this->lang->line('login_error') ?></div>
        </div>
    </div>
</div>
<script>
    var _isLoginPage = 1;
    $(function () {
        $('.top-back').remove();
        if (isErr != 'No') {
            $('.login-err').fadeIn('fast');
        }
        $('.login-btn').on('click', function (object) {
            $('.login_form').submit();
        })
        $('.checkbox').on('click', function (object) {
            var sel = $(this).attr('data-sel');
            if (sel == 1) sel = 0;
            else sel = 1

            $(this).attr('data-sel', sel);
        })
    })

</script>

<script src="<?= base_url('assets/js/frontend/hj_login.js') ?>"></script>
