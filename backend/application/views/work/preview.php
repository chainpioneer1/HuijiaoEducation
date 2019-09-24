<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workpreview.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">作业预览</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="sec-wrap select-ban-wrap">
        <div class="title-sec" id="selected-classes">
            <span style="margin-right: 100px">选择班级</span>
        </div>
        <div class="body-sec" style="text-align: center">
            <div class="info-sec">
                <span style="margin-right: 20px">本次作业名称：</span>
                <span class="text-inputbox" id="work-title"></span>
            </div>
            <div>
                <span style="margin-right: 20px">截至完成时间：</span>
                <span class="text-inputbox" id="end-time"></span>
            </div>
        </div>
    </div>

    <div class="sec-wrap select-question-wrap">
        <div class="title-sec" style="">
            <span style="margin-right: 330px">所选题目(共<span id="selected-questions-num"></span>题)</span>

            <a class="action-btn" onclick="onOpenPublishModal()">布置作业</a>
        </div>
        <div class="body-sec question-sec" style="border-top: none; padding-top: 0">
            <?= $questionsHtml ?>
        </div>

        <div class="pagination-bar">
            <?= $paginationHtml ?>
        </div>
    </div>

</div>


<div class="publish-modal-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>选择班级</h5>
        </div>
        <div class="edit-modal-body">
            <p style="text-align: center">本次作业将发送至<span id="publish-class-str"></span>的</p>
            <p style="text-align: center">学生，确认布置吗？</p>

            <div class="info-confirm-btn" onclick="onPublishConfirm()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onClosePublishModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/workpreview.js') ?>" type="text/javascript"></script>

<style>


</style>