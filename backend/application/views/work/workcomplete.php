<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workcomplete.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/circle.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">完成情况</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:0; top: 80px">
    <div class="main-info">
        <div>
            <?php
            $classArr = explode('-', $sclass->class_name);
            $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
            $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
            $classStr = '';
            if( isset($classArr[0]) && isset($classYearArr[$classArr[0]-1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1]-1]) ){
                $classStr = $classYearArr[$classArr[0]-1] . $classBanArr[$classArr[1]-1];
            }
            ?>
            <span>班级：</span>
            <span id="class-name" style="margin-right: 100px"><?= $classStr ?></span>
            <span>作业名称：</span>
            <span id="work-title"><?= $work->title ?></span>
        </div>
        <div style="margin-top: 30px">
            <div class="chart1">
                <?php
                if( count($students) == 0 ) $percent1 = 0;
                else $percent1 = (int)(count($solvedWork) / count($students) * 100);
                ?>
                <div class="c100 red p<?= $percent1 ?> ">
<!--                    <span>--><?//= $percent1 ?><!--%</span>-->
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="chart2">
                <?php
                $notCompleted = count($students) - count($solvedWork);
                ?>
                <p><span class="chart-mark"></span><span>未完成：<?= $notCompleted ?>人</span></p>
                <p><span class="chart-mark" style="background-color: #e3524d"></span><span>已完成：<?= count($solvedWork) ?>人</span></p>
            </div>
            <div class="chart3">
                <div class="c100 green p100 ">
                    <span>
                        <a style="font-size: 10px; font-weight: bold; margin-top: 30px">平均分</a>
                        <a style="font-size: 20px; font-weight: bold">85</a>
                    </span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>

    <div class="table-info">
        <div class="table-header">
            <div class="column name">姓名</div>
            <div class="column complete">完成情况</div>
            <div class="column price">作业正确率</div>
            <div class="column correct">订正情况</div>
        </div>
        <div class="table-body">
            <?php foreach ($students as $student) :?>
            <div class="table-row">
                <div class="column name"><?= $student['student']->user_nickname ?></div>
                <div class="column complete <?= $student['complete'] == '未完成' ? 'not' : '' ?>"><?= $student['complete'] ?></div>
                <div class="column price"><?= $student['price'] ?></div>
                <div class="column correct <?= $student['correct'] == '未订正' ? 'not' : '' ?>"><?= $student['correct'] ?></div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/workcomplete.js') ?>" type="text/javascript"></script>

<style>


</style>