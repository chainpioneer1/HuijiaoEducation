<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php
    $this->load->view("components/page_header_mobile");

    $userType = $this->session->userdata('user_type');
    $returnPrefix = '';
    if ($userType == '2')
        $returnPrefix = 'student/index/';
    ?>
    <script src="<?= base_url('assets/js/frontend/global.js') ?>"></script>
</head>
<body>
<div>

    <script>
        var imageDir = baseURL + "";
        var loginUserType = '<?=$userType?>';
        if(!isMobile) location.href=baseURL;
        else $('body').show();
    </script>

    <?php $this->load->view($subview); ?>

    <?php $this->load->view("components/page_footer_mobile"); ?>

</div>
</body>
</html>
