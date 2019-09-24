<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/preview.css') ?>">
<script src="<?= base_url('assets/js/qrcode/qrcode.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/pdfobject.js') ?>"></script>
<style>
    .header-bar {
        display: none;
    }
</style>

<div class="base-container" style="top: 0;">
    <div style="width: 100%;height: 1035px;overflow: hidden; margin-bottom: 0px;">
        <div class="title"><?= $title ?></div>
        <div class="pdf_container" id="pdf_container"></div>
        <iframe class="course_content_area" style="display: none;"></iframe>
    </div>
    <!--    </div>-->
</div>

<div id="wx-sharing-qr-wrap" style="display:none">
    <span class="wx-sharing-close-btn">✕</span>
    <div id="qr-code"></div>
</div>

<script>

    var courseList = JSON.parse('<?php echo json_encode($courseList);?>');
    var pretitle = "<?= $title?>";
    var title = '';
    var content_id = "<?= $content_id ?>";
    var user_id = "<?= $this->session->userdata('loginuserID') ?>" * 1;
    var pageType = '<?= $pageType?>';

    if (!user_id) {
        $('.bottom_buttons_section .buttons-container').html('');
        $('.prev_btn').remove();
    }

    $(function () {
        if (pretitle == "_") $('.title').html(title);
        setTimeout(function () {
            if (history.length == 1) {
                $('.top-bar').hide();
            }
        }, 100);
    })


</script>
<script src="<?= base_url('assets/js/preview.js') ?>" type="text/javascript"></script>

