<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workwrong.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">错误学生名单</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:0; top: 80px">
    <div class="main-info">
        <p>错误学生名单</p>
    </div>

    <div class="table-info">
        <div class="table-body">
            <?php foreach ($students as $student) :?>
            <div class="table-row">
                <div class="column name"><?= $student->user_nickname ?></div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/workwrong.js') ?>" type="text/javascript"></script>

<style>


</style>