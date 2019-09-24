<script>
    var imageDir = baseURL + "assets/images/resource/";
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
    .main-content{
        padding: 0 calc(4vw);
        text-align: center;
    }
    h3{
        color: #404040;
        font-weight: bold;
        font-size: calc(7vw);
        line-height: calc(7vw);
        margin: calc(13vh) calc(20vw) calc(3vh);
        text-align: center;
    }
    p{
        color: #404040;
        font-size: calc(5vw);
        line-height: calc(5vh);
        margin: calc(6vh) calc(20vw);
        text-align: center;
    }
    select{
        display: inline-block;
        width: calc(40vw);
        margin: calc(7vh) calc(1vw);
    }

    .ok-btn{
        background-color: #00cdaf;
        padding: calc(3vw);
        text-align: center;
        width: 100%;
        display: inline-block;
        margin: calc(2vh) 0;
        color: #fff;
        border-radius: 7px;
        font-size: calc(5vw);
        text-decoration: none;
    }
    .ok-btn:hover{
        text-decoration: none;
    }
</style>
<div class="main-content-area-wrapper">
    <div class="main-content">
        <h3>加 入 班 级</h3>
        <p><?= $user->user_school ?></p>

        <div>
            <select id="class-year">
                <option value="1">一年级</option>
                <option value="2">二年级</option>
                <option value="3">三年级</option>
                <option value="4">四年级</option>
                <option value="5">五年级</option>
                <option value="6">六年级</option>
                <option value="7">初一年级</option>
                <option value="8">初二年级</option>
                <option value="9">初三年级</option>
            </select>
            <select id="class-ban">
                <option value="1">1班</option>
                <option value="2">2班</option>
                <option value="3">3班</option>
                <option value="4">4班</option>
                <option value="5">5班</option>
                <option value="6">6班</option>
                <option value="7">7班</option>
                <option value="8">8班</option>
                <option value="9">9班</option>
                <option value="11">10班</option>
                <option value="11">11班</option>
                <option value="12">12班</option>
                <option value="13">13班</option>
                <option value="14">14班</option>
                <option value="15">15班</option>
                <option value="16">16班</option>
                <option value="17">17班</option>
                <option value="18">18班</option>
                <option value="19">19班</option>
                <option value="20">20班</option>
            </select>
        </div>
        <a class="ok-btn">确定</a>
    </div>
</div>
<script>
    var isProcessing = false;
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    $('.ok-btn').on('click', function (object) {
        var classYearStr = $('#class-year').val();
        var classBanStr = $('#class-ban').val();
        var classStr = classYearStr + '-' + classBanStr;

        if (isProcessing) return;
        isProcessing = true;
        var that = this;
        jQuery.ajax({
            type: "post",
            url: baseURL + "student/updateClass",
            dataType: "json",
            data: {
                user_id: user_id,
                user_class: classStr
            },
            success: function (res) {
                if (res.status == 'success') {
                    window.location = '<?= base_url('student') ?>'
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
    })

    $(window).load(function () {

    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>