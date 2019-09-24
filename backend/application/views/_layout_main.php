<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php
    $this->load->view("components/page_header");

    $userType = $this->session->userdata('user_type');
    $returnPrefix = '';
    if ($userType == '2')
        $returnPrefix = 'student/index/'
    ?>
</head>
<body>
<div>
    <script>
        var imageDir = baseURL + "";
        var loginUserType = '<?=$userType?>';
        if(isMobile) location.href=baseURL+'student';
        else $('body').show();
    </script>

    <?php $this->load->view($subview); ?>

    <?php $this->load->view("components/page_menu"); ?>

    <?php $this->load->view("components/page_footer"); ?>

    <script>
        $('.main-menu>.header-item[data-no="1"]').css({color: '#92c542'});
    </script>
</div>
</body>
</html>

