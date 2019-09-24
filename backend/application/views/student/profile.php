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
    select{
        display: inline-block;
        width: calc(35vw);
        margin: calc(7vh) calc(1vw);
    }
    .profile-favorite .item-content-page{
        min-height: calc(100vh - 330px);
    }
</style>
<div class="main-content-area-wrapper">
    <div class="header" id="stickyHeader" style="display: none">
    </div>
    <div class="main-content">
        <div class="profile-header">
            <div class="profile-photo">
                <?php
                $profile_img = $user->user_avatar;
                if( $profile_img == null ) $profile_img = 'assets/images/mobile/touxiang1.png';
                ?>
                <a onclick="profileUploadOpen()"><img src="<?= base_url( $profile_img )?>" id="profile-image"/></a>
                <input type="file" style="display: none" name="profile-image-input" id="profile-image-input" accept="image/*">
            </div>
            <div class="profile-info">
                <?php
                $classArr = explode('-', $user->user_class);
                $classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
                $classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];
                $classStr = '';
                if( isset($classArr[0]) && isset($classYearArr[$classArr[0]-1]) && isset($classArr[1]) && isset($classBanArr[$classArr[1]-1]) ){
                    $classStr = $classYearArr[$classArr[0]-1] . $classBanArr[$classArr[1]-1];
                }
                ?>
                <h3><?= $user->user_nickname ?></h3>
                <p>账号: <?= $user->user_account ?></p>
                <p>学校: <?= $user->user_school ?></p>
                <p style="display:none;">班级: <span id="classInfo"><?= $classStr ?></span><a class="profile-password-btn" onclick="onEditInfo()">修改班级信息</a></p>
            </div>
        </div>
        <div class="profile-favorite">
            <h3>我的收藏</h3>
            <div class="item-content-page">

                <?php if( count($favorite_contents) == 0 ) : ?>
                    <div class="sub-noItem">
                        <p>没有收藏</p>
                    </div>
                <?php endif; ?>

            <?php foreach ($favorite_contents as $favorite_content) : ?>
                <?php
                $title = $favorite_content['content']->title;
                ?>
                <div class="item-content profile" style="overflow: hidden">
                    <div class="swipeElem" data-id="<?= $favorite_content['content']->id ?>" data-status="0" 
					style="width: calc(150vw); position: relative; transition: all .3s;">
                        <div style="height:100%; width: calc(90vw); display: inline-block">
                            <img class="feature-img" src="<?= base_url() . $favorite_content['content']->icon_path ?>" onclick="location.href='<?= base_url('student/contentplayer/' . $favorite_content['content']->id) ?>'" style="width: calc(90vw); height: calc(50vw)">
                            <div class="item-body">
                                <div class="item-subject">
                                    <span><?= $favorite_content['subject']->title ?></span>
                                </div>

                                <div class="item-title" onclick='location.href="<?= base_url('student/contentplayer/' . $favorite_content['content']->id) ?>"'>
                                    <?= $title ?>
                                    <div class="item-infobar">
                                        <div class="item-read-icon" data-sel="<?= count($favorite_content['usages_read_mine']) > 0 ? 1 : 0?>"></div>
                                        <div class="item-read-value"><?= $favorite_content['read_count'] ?></div>
                                        <div class="item-favor-icon <?=($favorite_content['usage_like'] > 0 ? 'active' : '') ?>" data-sel="<?= $favorite_content['usage_like'] ?>" data-content_id="<?= $favorite_content['content']->id ?>" data-usage_id="<?= $favorite_content['usage_id'] ?>"></div>
                                        <div class="item-favor-value"><?= count($favorite_content['usages']) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="deleteElem" onclick="cancelFavorite(<?= $favorite_content['usage']->id ?>)" style="width: calc(28vw); margin-left: calc(5vw); height: calc(50vw); color: #fff; background-color: #ff594d; position: absolute; top: 0; left: calc(87vw); border-radius: 10px; padding: calc(24vw) 0; text-align: center">
                            删除
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
            <div class="logout-btn-wrap">
                <a class="logout-btn" href="<?= base_url('student/signout'); ?>">退出登入</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div style="position: relative; width: 100%; height: 100%">
            <a href="<?= base_url('student'); ?>" class="footer-btn" id="footer-xuexi">
                <img src="<?= base_url('assets/images/mobile/santubiao2.png') ?>">
                <span>学习</span>
            </a>
            <a href="<?= base_url('student/work'); ?>" class="footer-btn" id="footer-zuoye">
                <img src="<?= base_url('assets/images/mobile/santubiao4.png'); ?>">
                <span>作业</span>
            </a>
            <a href="<?= base_url('student/profile'); ?>" class="footer-btn active" id="footer-my">
                <img src="<?= base_url('assets/images/mobile/santubiao5.png'); ?>">
                <span>我的</span>
            </a>
        </div>
    </div>
</div>

<div class="profile-info-edit-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>修改班级信息</h5>
        </div>
        <div class="edit-modal-body">
            <p style="margin: calc(1vh) 0 0; font-size: calc(4vw); font-weight: bold"><?= $user->user_school ?></p>
            <div>
                <style>
                    .select-control{
                        display: inline-block;
                        position: relative;
                        width: calc(35vw);
                        margin: calc(7vh) calc(1vw);
                        text-align: left;
                    }
                    .select-control .select-box{
                        background-color: #f0f0f0;
                        width: 100%;
                        padding: 2px;
                        border-radius: 3px;
                        border: 1px solid #969696;
                    }
                    .select-control .select-box .highlight-text{
                        display: inline-block;
                        vertical-align: middle;
                        width: 85%;
                        height: calc(4.5vw);
                        line-height: calc(4.5vw);
                        font-size: calc(3.5vw);
                    }
                    .select-control .select-box .dropdown-btn{
                        display: inline-block;
                        height: calc(4.5vw);
                    }
                    .select-control .select-box .dropdown-btn img{
                        width: calc(2vw);
                    }
                    .select-control .select-options{
                        width: 100%;
                        background-color: #f0f0f0;
                        border: 1px solid #969696;
                        border-radius: 2px;
                        position: absolute;
                        left: 0;
                        top: calc(6.9vw);
                        display: none;
                    }
                    .select-control .select-options.show{
                        display: block;
                    }
                    .select-control .select-options .option-elem{
                        padding: 2px 0 2px 5px;
                        font-size: calc(3.5vw);
                    }
                    .select-control .select-options .option-elem:hover,
                    .select-control .select-options .option-elem[data-selected="true"]{
                        background-color: #00c9ff;
                        color: #fff;
                    }
                </style>
                <div id="class-year" class="select-control" data-value="<?= $classArr[0]; ?>">
                    <div class="select-box">
                        <span class="highlight-text"><?= $classYearArr[$classArr[0]-1] ?></span>
                        <span class="dropdown-btn">
                            <img src="<?= base_url('assets/images/huijiao/education/btn-select.png') ?>"/>
                        </span>
                    </div>
                    <div class="select-options">
                        <?php for($i=0; $i<9; $i++) : ?>
                            <div class="option-elem" data-value="<?= ($i+1) ?>" data-selected="<?= $i == $classArr[0]-1 ? 'true' : 'false' ?>"><?= $classYearArr[$i] ?></div>
                        <?php endfor;?>
                    </div>
                </div>
                <div id="class-ban" class="select-control" data-value="<?= $classArr[1]; ?>">
                    <div class="select-box">
                        <span class="highlight-text"><?= $classBanArr[$classArr[1]-1] ?></span>
                        <span class="dropdown-btn">
                            <img src="<?= base_url('assets/images/huijiao/education/btn-select.png') ?>"/>
                        </span>
                    </div>
                    <div class="select-options">
                        <?php for($i=0; $i<20; $i++) : ?>
                            <div class="option-elem" data-value="<?= ($i+1) ?>" data-selected="<?= $i == $classArr[1]-1 ? 'true' : 'false' ?>"><?= $classBanArr[$i] ?></div>
                        <?php endfor;?>
                    </div>
                </div>

                <script>
                    var classYearArr = ['一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三'];
                    var classBanArr = ['一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班', '十三班', '十四班', '十五班', '十六班', '十七班', '十八班', '十九班', '二十班'];

                    $('#class-year.select-control .select-options .option-elem').click(function(e){
                        e.preventDefault();
                        var value = $(this).attr('data-value')*1;
                        $(this).parent().find('.option-elem').attr('data-selected', 'false');
                        $(this).attr('data-selected', 'true');
                        $(this).parent().toggleClass('show');
                        $(this).parent().parent().find('.select-box .highlight-text').html(classYearArr[value-1]);
                        $(this).parent().parent().attr('data-value', value);
                    })
                    $('#class-ban.select-control .select-options .option-elem').click(function(e){
                        e.preventDefault();
                        var value = $(this).attr('data-value')*1;
                        $(this).parent().find('.option-elem').attr('data-selected', 'false');
                        $(this).attr('data-selected', 'true');
                        $(this).parent().toggleClass('show');
                        $(this).parent().parent().find('.select-box .highlight-text').html(classBanArr[value-1]);
                        $(this).parent().parent().attr('data-value', value);
                    })
                    $(window).click(function(e){
                        console.log('****', e.target);
                        if( $(e.target).hasClass('select-box') ){
                            $('.select-control .select-options').removeClass('show');
                            $(e.target).parent().find('.select-options').addClass('show');
                        } else if( $(e.target).hasClass('highlight-text') || $(e.target).hasClass('dropdown-btn') ) {
                            $('.select-control .select-options').removeClass('show');
                            $(e.target).parent().parent().find('.select-options').addClass('show');
                        } else {
                            $('.select-control .select-options').removeClass('show');
                        }

                    })
                </script>
            </div>
            <div class="info-confirm-btn">
                <span onclick="onConfirmInfo()">确定</span>
            </div>
            <div class="info-confirm-btn">
                <span onclick="onCloseInfoModal()">取消</span>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessageToMobile(msgType, msgTxt, user_id) {
        if (osStatus === 'Android') {
            switch (msgType) {
                case 'showContent':
                    Android.showContent(msgTxt);
                    break;
                case 'startPlayer':
                    Android.startPlayer(msgTxt);
                    break;
                case 'stopPlayer':
                    Android.stopPlayer(msgTxt);
                    break;
                case 'showBack':
                    Android.showBack(msgTxt);
                    break;
                case 'comImgUpload':
                    Android.comImgUpload(msgTxt, user_id);
                    break;
                case 'downLoadContent':
                    Android.downLoadContent(msgTxt);
                    break;
                case 'weixinShare':
                    Android.weixinShare(msgTxt);
                    break;
            }
        }
        if (osStatus === 'iOS') {
            if (msgType === 'showContent') {
                msgTxt = msgTxt.replace(baseURL, '');
            } else if( msgType === "comImgUpload" ) {
                window.location = msgType + '://' + msgTxt + "/" + user_id;
            }
        }
    }

    var isProcessing = false;
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
    function cancelFavorite(usage_id) {
        jQuery.ajax({
            type: "post",
            url: baseURL + "users/cancelFavorite",
            dataType: "json",
            data: {
                usage_id: usage_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#profile-lesson-list').html(res.data.favorite_lessons);
                    $('#profile-content-list').html(res.data.favorite_contents);
                }
                else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
                location.reload();
            }
        });
    }

    function onEditInfo() {
        $('.profile-info-edit-wrap').fadeIn(100);
    }

    function onCloseInfoModal() {
        $('.profile-info-edit-wrap').fadeOut(100);
    }

    function onConfirmInfo() {
        var classYearStr = $('#class-year').attr('data-value');
        var classBanStr = $('#class-ban').attr('data-value');
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
                    $('#classInfo').html( res.data );
                    onCloseInfoModal();
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



    function profileUploadOpen() {
        // $('#profile-image-input').trigger('click');
        sendMessageToMobile('comImgUpload', 'profile-image', user_id);
        return;
    }

    $('#profile-image-input').on('change', function (event) {
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        profileImageUpload();
    });

    function profileImageUpload()
    {
        $('#stickyHeader').show();
        // Android.showAlert('ddd');
        var file_data = $('#profile-image-input').prop("files")[0];
        var form_data = new FormData();                  // Creating object of FormData class
        form_data.append("profile_imgfile", file_data) ;             // Appending parameter named file with propert
        // Android.showAlert('aaa');
        $.ajax({
            url: baseURL+'student/profileImgUpload',
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            data: form_data,                         // Setting the data attribute of ajax with file_data
            type: 'post',
            success:function(res){
                // Android.showAlert('bbb');
                var ret = JSON.parse(res);
                if(ret['status']=='success'){
                    var imgicon = baseURL+ret.data;
                    $('#profile-image').attr('src', imgicon);
                }else{
                    alert("Please upload image file again!");
                }
            }
        });
    }


    function swipeButton1(elementIdentifier) {
        console.log( '-- swipeButton : ', elementIdentifier );
        var startX, startY;
        $(elementIdentifier).on('touchstart', function (e) {
            console.log( '-- touchstart : ', e );
            var that = $(this);
            var id = that.attr('data-id')*1;
            startX = e.originalEvent.changedTouches[0].pageX;
            startY = e.originalEvent.changedTouches[0].pageY;

        }).on('touchmove', function (e) {
            var that = $(this);
            console.log( '-- touchmove : ', e );
            var id = that.attr('data-id')*1;
            var moveEndX = e.originalEvent.changedTouches[0].pageX;
            var moveEndY = e.originalEvent.changedTouches[0].pageY;
            var X = moveEndX - startX;
            var Y = moveEndY - startY;
            if (Math.abs(X) > 0 && X < 0) {  //从右侧向左滑动
                that.attr('data-status', 1);
                that.css({'margin-left': 'calc(-30vw)'});
            } else if (Math.abs(X) > 0 && X > 0) {
                that.attr('data-status', 0);
                that.css({'margin-left': '0px'})
            }
        })
    }


    function showDeleteItem(id) {
        if (data.anim_status == 0) {
            $('#failedItem' + id).css({'animation-name': 'item_hide'});
            $('#btn_delete' + id).css({'animation-name': 'btn_show'});
            $('#failedItem' + id).css({'margin-left': '-20%'});
            $('#btn_delete' + id).css({'right': '0'});
            $('#status_notice' + id).hide();
            data.anim_status = 1;
        }
    }

    function performDeleteItem(id) {
        showMessage('是否删除该商品？', 1)
        data['cur_deleting_index'] = id;
    }

    function cancelDeleteItem(id, status) {
        if (data.anim_status == 1) {
            $('#failedItem' + id).css({'animation-name': 'item_show'});
            $('#btn_delete' + id).css({'animation-name': 'btn_hide'});
            $('#failedItem' + id).css({'margin-left': '0px'});
            $('#btn_delete' + id).css({'right': '-20%'});
            $('#status_notice' + id).show();
        }
    }

    $(window).load(function () {
        // var elem = $('.profile-favorite .item-content-page .item-content.profile .swipeElem')
        swipeButton1( '.swipeElem' );
    });

</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>