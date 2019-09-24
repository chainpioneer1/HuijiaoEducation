
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/classroom.css') ?>">

<script>
    var imageDir = baseURL + "assets/images/classroom/";
</script>

<div class="bg" id="main-background-full"></div>
<div class="classroom_list_container">
    <div class="list_item"></div>
</div>

<div id="custom-scroll" container_class="classroom_list_container">
    <div class="scroll-read"></div>
    <div class="scroll-thumb"></div>
    <div class="scroll-up-btn"></div>
    <div class="scroll-down-btn"></div>
</div>

<script>
    var packageList = JSON.parse('<?php echo json_encode($packageList);?>');
    var loginUserType = '<?= $this->session->userdata('user_type')?>';
    var loginUserId = '<?= $this->session->userdata('loginuserID')?>';
</script>

<script src="<?= base_url('assets/js/classroom.js') ?>" type="text/javascript"></script>
