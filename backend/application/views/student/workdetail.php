<script>
    var imageDir = baseURL + "assets/images/mobile/";
</script>

<?php
$imgDir = base_url() . 'assets/images/mobile/';
$isLogin = false;
if ($this->session->userdata("loggedin") != FALSE) {
    $isLogin = true;
}
?>
<style>
    body {
        background-color: #f5f5f5 !important;
    }
</style>
<div class="main-content-area-wrapper">
    <div class="header" id="stickyHeader">
        <a href="<?= base_url('student/work') ?>" class="back-btn">
            <img src="<?= $imgDir . 'back.png' ?>">
        </a>
        <h1><?= $course_type ?> (<span id="cur_question"></span>/<?= count($questionsArr) ?>)</h1>
    </div>

    <div class="main-content">
        <?php
        $question_types = ['fillblank', 'yesno', 'multiselect'];
        ?>
        <iframe class="question-player" ></iframe>
    </div>
</div>


<div class="profile-info-edit-wrap work-modal-wrap wrong-alert">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5 class="title">回答错误</h5>
        </div>
        <div class="edit-modal-body">
            <p>
                <span>正确答案: </span>
                <span class="question-answer"></span>
            </p>
            <p>
                <span>本题解析： </span>
                <span class="question-description"></span>
            </p>
            <div class="info-confirm-btn" onclick="onNextProblem()">
                <span>下一题</span>
            </div>
        </div>
    </div>
</div>

<div class="profile-info-edit-wrap work-modal-wrap right-alert">
    <div class="edit-info-modal">
        <div class="edit-modal-body">
            <img src="<?= base_url('assets/images/mobile/zhengque.png') ?>">
            <p>回答正确</p>
            <div class="info-confirm-btn" onclick="onNextProblem()">
                <span>下一题</span>
            </div>
        </div>
    </div>
</div>

<div class="profile-info-edit-wrap finish-alert">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5 class="title">本次作业成绩</h5>
        </div>
        <div class="edit-modal-body" style="padding: 0 calc(10vw) calc(3vw);">
            <p class="first-mark">
                <img src="<?= base_url('assets/images/mobile/wujiaoxing.png') ?>" class="star-1" />
                <img src="<?= base_url('assets/images/mobile/wujiaoxing.png') ?>" class="star-2" />
                <img src="<?= base_url('assets/images/mobile/wujiaoxing.png') ?>" class="star-3" />
                <img src="<?= base_url('assets/images/mobile/wujiaoxing.png') ?>" class="star-4" />
                <img src="<?= base_url('assets/images/mobile/wujiaoxing.png') ?>" class="star-5" />
            </p>

            <div class="info-confirm-btn" onclick="finishWork()" style="width: calc(72vw); margin: calc(2vw) 0; padding: calc(3vw) calc(2vw);">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn restart-btn" onclick="restartWork()" style="width: calc(72vw); margin: calc(2vw) 0; padding: calc(3vw) calc(2vw); background-color: #9dc952">
                <span>去订正</span>
            </div>
        </div>
    </div>
</div>

<input class="questionArr" type="hidden" value='<?= json_encode($questionsArr); ?>'>
<input class="work" type="hidden" value='<?= json_encode($work); ?>'>
<script>
    var isProcessing = false;
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    var questions = JSON.parse($('.questionArr').val());
    var work = JSON.parse($('.work').val());
    var cur_question = 0;
    var questionInfo = null;
    var is_first = false;
    var first_mark = 0;
    var student_mark = 0;

    function save2Storage(qInfo, answerInfo) {
        console.log('-- save2Storage / answerInfo : ', answerInfo);
        var qTypes = ["选择题", "判断题", "填空题"];
        qInfo.qType = qTypes[qInfo.type];
        localStorage.setItem('quiz', JSON.stringify(qInfo));
        localStorage.setItem('qId', qInfo.id);
        localStorage.setItem('answerInfo', JSON.stringify(answerInfo));
    }

    function getFromStorage() {
        var quiz = localStorage.getItem('quiz');
        quiz = JSON.parse(quiz);
        quiz.id = localStorage.getItem('qId');
        return quiz;
    }

    function showQuestionPlayer() {
        var type = getFromStorage().type;
        var id=getFromStorage().id
        var dataPath = ['multiselect', 'yesno', 'fillblank'];

        $('iframe.question-player').attr('src', baseURL + "assets/admin/qeditor/" +
            dataPath[type] + '/preview-mobile/package/index.html?uid='+id);
    }

    $(document).ready(function () {
        initializeWork();
    });

    function initializeWork(){
        if( typeof work.answer_info == 'string'){
            work.answer_info = JSON.parse(work.answer_info);
        }
        var answerInfos = work.answer_info;
        var problemInfos = JSON.parse(work.problem_info);
        console.log( '-- work : ', work );
        console.log( '-- answerInfos : ', answerInfos );
        console.log( '-- problemInfos : ', problemInfos );
        console.log( '-- questions : ', questions );
        if( !answerInfos || answerInfos.length == 0 ) {
            cur_question = 0;
            is_first = true;
        } else {
            student_mark = 0;
            for( var i=0; i<answerInfos.length; i++ ){
                if( answerInfos[i].is_right == true ) student_mark = student_mark + 5
            }
            for( var i=0; i<problemInfos.length; i++ ){
                console.log( '-- problemInfos : ', problemInfos[i] );
                for( var j=0; j<answerInfos.length; j++ ){
                    console.log( '-- answerInfos : ', answerInfos[j] );
                    if( answerInfos[j].id == problemInfos[i] && answerInfos[j].is_right == false ){
                        cur_question = i;
                        $('#cur_question').html(cur_question+1);
                        save2Storage(questions[cur_question], answerInfos[j]);
                        showQuestionPlayer();
                        return;
                    }
                }
            }
            cur_question = 0;
        }

        $('#cur_question').html(cur_question+1);
        save2Storage(questions[cur_question], null);
        showQuestionPlayer();
    }

    function answerResult( ansResult, quesInfo ){
        questionInfo = quesInfo;
        if( ansResult ){
            openRightAnswerModal();
        } else {
            openWrongAnswerModal();
        }
    }

    function answerQuestion(){
        console.log('-- work->answer_info : ', work.answer_info);
        console.log('-- questionInfo : ', questionInfo, questionInfo.ans_student);

        if( !work.answer_info || work.answer_info.length == 0 ){
            work.answer_info = [];
            work.answer_info.push( questionInfo );
        } else {
            if( typeof work.answer_info == 'string'){
                work.answer_info = JSON.parse(work.answer_info);
            }
            var is_exist = false;
            for( var i=0; i<work.answer_info.length; i++ ){
                if( work.answer_info[i].id == questionInfo.id ){
                    work.answer_info[i] = questionInfo;
                    is_exist = true;
                    break;
                }
            }
            if( !is_exist ){
                work.answer_info.push( questionInfo );
            }
        }
        console.log('-- work->answer_info1 : ', work.answer_info);

        console.log('-- is_first : ', is_first, questionInfo.is_right);
        if( questionInfo.is_right ){
            if(is_first){
                first_mark = first_mark + 5;
            }
            student_mark = student_mark + 5;
        }
        console.log('-- first_mark : ', first_mark);
        console.log('-- student_mark : ', student_mark);

        var is_all_right = false;
        if( isAllRight() ){
            is_all_right = true;
            $('.restart-btn').hide();
        }

        isProcessing = true;
        var that = this;
        jQuery.ajax({
            type: "post",
            url: baseURL + "student/answerQuestion",
            dataType: "json",
            data: {
                workId: work.id,
                answerInfo: JSON.stringify(work.answer_info),
                first_mark: parseInt(first_mark),
                student_mark: parseInt(student_mark),
                is_first: is_first,
                is_all_right: is_all_right
            },
            success: function (res) {
                if (res.status == 'success') {
                    cur_question++;
                    console.log('-- work : ', work);
                    for( var i=cur_question; i<questions.length; i++ ){
                        if( work.answer_info[i] != undefined && work.answer_info[i] != null && work.answer_info[i].is_right ) continue;
                        cur_question = i;
                        is_find = true;
                        break;
                    }
                    if( cur_question > questions.length-1 || i > questions.length-1 ){
                        is_first = false;
                        first_mark = Math.round(res.data);
                        work.first_mark = parseInt(first_mark)
                        console.log('-- first_mark : ', first_mark);
                        displayFirstMarks( first_mark );
                        openFinishWorkModal();
                    } else {
                        var answer_info = null;
                        if( !work.answer_info[cur_question] ){

                        } else {
                            answer_info = work.answer_info[cur_question]
                        }
                        console.log('-- answerQuestion API : ', questions[cur_question], answer_info);
                        $('#cur_question').html(cur_question+1);
                        save2Storage(questions[cur_question], answer_info);
                        showQuestionPlayer();
                    }
                }
                else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });


    }

    function openWrongAnswerModal() {
        var quiz = localStorage.getItem('quiz');
        quiz = JSON.parse(quiz);
        console.log('-- work->answer_info : ', work.answer_info);
        console.log('-- questionInfo : ', questionInfo);
        console.log('-- quiz : ', quiz);

        var ans = questionInfo.ans;
        var ansStr = []
        if( questionInfo.type == 0 ){
            var numEng = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
                "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                "U", "V", "W", "X", "Y", "Z"
            ];
            for( var i=0; i<ans.length; i++ ){
                if( ans[i].is_checked == true ) ansStr.push(numEng[i])
            }
            $('.work-modal-wrap .question-answer').html(ansStr.join(', '))
            $('.work-modal-wrap .question-description').html(quiz.desc)
        } else if( questionInfo.type == 1 ) {
            var numEng = ["是", "否", "C", "D", "E", "F", "G", "H", "I", "J",
                "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                "U", "V", "W", "X", "Y", "Z"
            ];
            for( var i=0; i<ans.length; i++ ){
                if( ans[i].is_checked == true ) {ansStr = numEng[i]; break;}
            }
            $('.work-modal-wrap .question-answer').html(ansStr)
            $('.work-modal-wrap .question-description').html(quiz.desc)
        } else if( questionInfo.type == 2 ) {
            var numEng = ["是", "否", "C", "D", "E", "F", "G", "H", "I", "J",
                "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                "U", "V", "W", "X", "Y", "Z"
            ];
            for( var i=0; i<ans.length; i++ ){
                ansStr.push( ans[i].content )
            }
            $('.work-modal-wrap .question-answer').html(ansStr.join(', '))
            $('.work-modal-wrap .question-description').html(quiz.desc)
        }

        if( cur_question == questions.length-1 ){
            $('.profile-info-edit-wrap.work-modal-wrap.wrong-alert .info-confirm-btn span').html('完成');
            $('.profile-info-edit-wrap.work-modal-wrap.right-alert .info-confirm-btn span').html('完成');
        }
        $('.profile-info-edit-wrap.wrong-alert').fadeIn(100);

    }

    function closeWrongAnswerModal() {
        $('.profile-info-edit-wrap.wrong-alert').fadeOut(100);
    }

    function openRightAnswerModal() {
        $('.profile-info-edit-wrap.right-alert').fadeIn(100);
    }

    function closeRightAnswerModal() {
        $('.profile-info-edit-wrap.right-alert').fadeOut(100);
    }

    function openFinishWorkModal() {
        $('.profile-info-edit-wrap.finish-alert').fadeIn(100);
    }

    function closeFinishWorkModal() {
        $('.profile-info-edit-wrap.finish-alert').fadeOut(100);
    }

    function onNextProblem(){
        closeWrongAnswerModal();
        closeRightAnswerModal();

        answerQuestion();
    }

    function finishWork(){
        window.location = "<?= base_url() . 'student/work' ?>";
    }

    function restartWork(){
        closeWrongAnswerModal();
        closeRightAnswerModal();
        closeFinishWorkModal();

        initializeWork();
    }

    function isAllRight(){
        if( typeof work.answer_info == 'string'){
            work.answer_info = JSON.parse(work.answer_info);
        }
        var answerInfos = work.answer_info;
        var problemInfos = JSON.parse(work.problem_info);
        if( !answerInfos || answerInfos.length == 0 || answerInfos.length != problemInfos.length ) {
            return false;
        } else {
            for( var i=0; i<answerInfos.length; i++ ){
                console.log( '-- answerInfos : ', answerInfos[i] );
                if( answerInfos[i].is_right == false ){
                    return false;
                }
            }
        }

        return true;
    }

    function displayFirstMarks( mark ){
        for( var i=0; i<5; i++ ){
            if( i<mark )
                $('.first-mark img.star-' + (i+1)).attr('src', imageDir + 'wujiaoxing.png');
            else
                $('.first-mark img.star-' + (i+1)).attr('src', imageDir + 'wujiaoxing1.png');
        }
    }

    $(window).load(function () {
        padDesignFix();
    });
</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>