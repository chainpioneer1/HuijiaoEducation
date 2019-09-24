<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/classmanage.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">班级管理</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="list-title">
        <div>我的班级</div>
        <a class="classmanager-btn" onclick="onAddClass()">+加入班级</a>
    </div>
    <div class="list-container">
        <?php
        $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
//        $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
        $classBanArr = ['1班', '2班', '3班', '4班', '5班', '6班', '7班', '8班', '9班', '10班', '11班', '12班', '13班', '14班', '15班', '16班', '17班', '18班', '19班', '20班'];
        ?>
        <?php foreach ($sclassArr as $sclass) :?>
        <?php
            $classArr = explode('-', $sclass['sclass']->class_name);
            $classStr = '';
            if( isset($classArr[0]) && isset($classYearArr[$classArr[0]-1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1]-1]) ){
                $classStr = $classYearArr[$classArr[0]-1] . $classBanArr[$classArr[1]-1];
            }
        ?>
        <div class="sclass-group">
            <div class="sclass-name-sec">
                <p><?= $classStr ?></p>
                <p style="margin: 0"><a class="classmanage-detail-btn" href="<?= base_url() . 'users/classinfo/' . $sclass['sclass']->id ?>" target="_blank">班级详情</a></p>
            </div>
            <div class="sclass-teacher-sec">
                <?php for($i=0; $i<5; $i++) :?>
                    <?php if( isset($sclass['teachers'][$i]) ) : ?>
                        <div class="teacher-elem">
                            <?php $teacher = $sclass['teachers'][$i]?>
                            <img src="<?= base_url() . 'assets/images/huijiao/profile/touxiang4.png' ?>"/>
                            <p><?= $teacher->user_nickname ?></p>
                        </div>
                    <?php else: ?>
                        <div class="teacher-elem">
                            <img src="<?= base_url() . 'assets/images/huijiao/profile/touxiang5.png' ?>"/>
                            <p>-</p>
                        </div>
                    <?php endif;?>
                <?php endfor;?>
            </div>
            <div class="sclass-action-sec">
                <a class="classmanage-exit-btn" data-id="<?= $sclass['sclass']->id ?>" onclick="deleteClass(this);">退出班级</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="add-class-modal-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>选择班级</h5>
        </div>
        <div class="edit-modal-body">
            <h5><?= $user->user_school ?></h5>
            <div>
                <span>年级</span>
                <select id="class-year">
                    <?php for($i=0; $i<9; $i++) : ?>
                        <option value="<?= ($i+1) ?>"><?= $classYearArr[$i] ?></option>
                    <?php endfor;?>
                </select>
                <span style="margin-left: 30px">班级</span>
                <select id="class-ban">
                    <?php for($i=0; $i<20; $i++) : ?>
                        <option value="<?= ($i+1) ?>"><?= $classBanArr[$i] ?></option>
                    <?php endfor;?>
                </select>
            </div>
            <div class="info-confirm-btn" onclick="onAddClassConfirmModal()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onCloseAddClassModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<div class="alert-modal-wrap add-class">
    <div class="alert-modal">
        <div class="alert-modal-body">
            <p>确认加入<span id="add_class_str" style="color: #f00"></span>吗？</p>
            <div class="info-confirm-btn" onclick="onOkAddClassAlertModal()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onCloseAddClassAlertModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<div class="alert-modal-wrap delete-class">
    <div class="alert-modal">
        <div class="alert-modal-body">
            <p>退出班级将不能获取班级</p>
            <p>信息， 确认退出吗？</p>
            <input id="delete-class-id" type="hidden"/>
            <div class="info-confirm-btn" onclick="onOkDeleteClassAlertModal()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onCloseDeleteClassAlertModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/classmanage.js') ?>" type="text/javascript"></script>