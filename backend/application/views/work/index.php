<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workindex.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="list-title">
        <div>作业列表</div>
        <a class="classmanager-btn" href="<?= base_url('work/publish') ?>">布置作业</a>
    </div>
    <div class="list-container">
        <?php foreach ( $worksArr as $work ) : ?>
            <div style="margin-bottom: 20px">
                <div class="work-time">
                    <span><?= date('Y-m-d', strtotime($work['work']->end_time)) ?></span>
                </div>
                <div class="work-group">
                    <div style="margin-bottom: 8px">
                        <?php
                        $classArr = explode('-', $work['sclass']->class_name);
                        $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
                        $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
                        $classStr = '';
                        if( isset($classArr[0]) && isset($classYearArr[$classArr[0]-1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1]-1]) ){
                            $classStr = $classYearArr[$classArr[0]-1] . $classBanArr[$classArr[1]-1];
                        }
                        ?>
                        <div class="work-info-sec sec-1">
                            班级：<?= $classStr ?>
                        </div>
                        <div class="work-info-sec sec-2">

                        </div>
                        <div class="work-info-sec sec-3">

                        </div>
                        <div class="work-info-sec sec-4">
                            <span style="color: #00cdaf" onclick="window.location='<?= base_url('work/workcomplete/' . $work['work']->id) ?>'">
                                完成情况
                                <img src="<?= base_url('/assets/images/mobile/next-grey.png') ?>"
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="work-info-sec sec-1">
                            名称：<?= $work['work']->title ?>
                        </div>
                        <div class="work-info-sec sec-2">
                            完成人数：<span style="color: #00cdaf"><?= $work['solvedWorkCount'] ?></span>/<?= $work['totalWorkCount'] ?>
                        </div>
                        <div class="work-info-sec sec-3">
                            截止时间：<?= date('Y-m-d H:i', strtotime($work['work']->end_time)) ?>
                        </div>
                        <div class="work-info-sec sec-4">
                            <span style="color: #eebd32" onclick="window.location='<?= base_url('work/workdetail/' . $work['work']->id) ?>'">
                                作业详情
                                <img src="<?= base_url('/assets/images/mobile/next-grey.png') ?>"
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>
</div>




<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;

    $(function () {
        $('.tab-item[data-id="5"]').attr('data-sel', 1);
    });
</script>
<script src="<?= base_url('assets/js/workindex.js') ?>" type="text/javascript"></script>