<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/classinfo.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">班级详情</a>
</div>
<div class="main-resource-toolbar sub-title" style="background-color: #e9e9e9; border: none; top: 82px; height: 40px">
    <div style="width: 55%; margin: 0 auto; text-align: left">
        <div style="width: 100%; margin: 0 auto">
            <?php
            $classArr = explode('-', $sclass['sclass']->class_name);
            $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
            $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
            $classStr = '';
            if( isset($classArr[0]) && isset($classYearArr[$classArr[0]-1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1]-1]) ){
                $classStr = $classYearArr[$classArr[0]-1] . $classBanArr[$classArr[1]-1];
            }
            ?>
            <a style="margin-left: 40px; font-size: 11px; font-weight: bold; height: 40px; line-height: 40px; color: #404040 !important; text-align: left" class="tab-item1">班级: <?= $classStr; ?></a>
            <a style="margin-left: 50%; font-size: 11px; font-weight: bold; height: 40px; line-height: 40px; color: #404040 !important; text-align: left" class="tab-item1">人数: <span id="students-count"><?= count($sclass['students']) ?></span>人</a>
        </div>
    </div>
</div>

<div class="base-container" style="height: auto;margin-bottom:20px;">
    <div class="inner-container">
        <div class="list-title">
            <div>班级: <?= $classStr ?></div>
            <div></div>
        </div>
        <div class="list-container">
            <div class="student-group header">
                <div class="student-account-sec">
                    学生账号
                </div>
                <div class="student-name-sec">
                    姓名
                </div>
                <div class="student-description-sec">
                    备注
                </div>
                <div class="student-action-sec">
                    操作
                </div>
            </div>
            <div class="student-list">
                <?php foreach ( $sclass['students'] as $student ) : ?>
                    <div class="student-group">
                        <div class="student-account-sec">
                            <?= $student->user_account ?>
                        </div>
                        <div class="student-name-sec">
                            <?= $student->user_name ?>
                        </div>
                        <div class="student-description-sec">
                            <input class="student-description" data-id="<?= $student->id ?>" placeholder="备注">
                            <a>保存</a>
                        </div>
                        <div class="student-action-sec">
                            <a class="student-delete-btn" data-student-id="<?= $student->id ?>" data-sclass-id="<?= $sclass['sclass']->id ?>" onclick="deleteStudent(this);">删除</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>
    </div>
</div>

<div class="alert-modal-wrap delete-student">
    <div class="alert-modal">
        <div class="alert-modal-body">
            <p>账号删除后不可恢复， 是否删除？</p>
            <input id="delete-student-id" type="hidden"/>
            <input id="delete-sclass-id" type="hidden"/>
            <div class="info-confirm-btn" onclick="onOkDeleteStudentAlertModal()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onCloseDeleteStudentAlertModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>

<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/classinfo.js') ?>" type="text/javascript"></script>