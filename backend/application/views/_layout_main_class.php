<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php
    $this->load->view("components/page_header");
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
    </script>

    <?php $this->load->view($subview); ?>

    <?php $this->load->view("components/page_menu_class"); ?>

    <?php $this->load->view("components/class_toolbar"); ?>

    <?php $this->load->view("components/page_footer"); ?>

</div>
<div class="sticky" style="display: block;"></div>
<div class="preview-error-modal-wrap" style="display: none">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>警告</h5>
        </div>
        <div class="edit-modal-body">
            <p style="text-align: center">请输入班级、作业名称、完成时间，然后选择题目。</p>

            <div class="info-confirm-btn" onclick="onClosePublishModal()" style="margin-top: 30px">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
