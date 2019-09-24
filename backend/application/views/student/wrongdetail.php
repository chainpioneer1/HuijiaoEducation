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
        <a href="<?= base_url('student/wrong') ?>" class="back-btn">
            <img src="<?= $imgDir . 'back.png' ?>">
        </a>
        <h1><?= $wrong->course_type ?></h1>
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
            <div class="info-confirm-btn">
                <span onclick="closeWrongAnswerModal()">完成</span>
            </div>
        </div>
    </div>
</div>

<div class="profile-info-edit-wrap work-modal-wrap right-alert">
    <div class="edit-info-modal">
        <div class="edit-modal-body">
            <img src="<?= base_url('assets/images/mobile/zhengque.png') ?>">
            <p>回答正确</p>
            <div class="info-confirm-btn">
                <span onclick="closeRightAnswerModal()">完成</span>
            </div>
        </div>
    </div>
</div>

<input class="wrong" type="hidden" value='<?= json_encode($wrong); ?>'>
<input class="question" type="hidden" value='<?= json_encode($question); ?>'>
<script>
    var isProcessing = false;
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    var wrong = JSON.parse($('.wrong').val());
    var question = JSON.parse($('.question').val());
    var questionInfo = null;

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
        initializeWrong();
    });

    function initializeWrong(){
        save2Storage(question, JSON.parse(wrong.student_answer));
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
        console.log('-- questionInfo : ', questionInfo, questionInfo.ans_student);

        isProcessing = true;
        var that = this;
        jQuery.ajax({
            type: "post",
            url: baseURL + "student/answerWrongQuestion",
            dataType: "json",
            data: {
                wrongId: wrong.id,
                questionInfo: JSON.stringify(questionInfo),
                student_mark: questionInfo.is_right
            },
            success: function (res) {
                if (res.status == 'success') {
                    finishWrong();
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

        $('.profile-info-edit-wrap.wrong-alert').fadeIn(100);

    }

    function closeWrongAnswerModal() {
        answerQuestion()
        $('.profile-info-edit-wrap.wrong-alert').fadeOut(100);
    }

    function openRightAnswerModal() {
        $('.profile-info-edit-wrap.right-alert').fadeIn(100);
    }

    function closeRightAnswerModal() {
        answerQuestion();
        $('.profile-info-edit-wrap.right-alert').fadeOut(100);
    }

    function finishWrong(){
        window.location = "<?= base_url() . 'student/wrong' ?>";
    }

    $(window).load(function () {
        padDesignFix();
    });
</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>