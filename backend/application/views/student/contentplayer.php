<script src="<?= base_url('assets/js/qrcode/qrcode.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/pdfobject.js') ?>"></script>
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
        overflow: hidden;
    }
    #wx-sharing-qr-wrap {
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }
</style>
<div class="main-content-area-wrapper">
    <div style="width: 100%;min-height: calc(100vh);overflow: hidden; background-color: #000;">
        <div class="header" id="stickyHeader" style="display: none;position: absolute; left: 0; top: 0; background-color: rgba(0,0,0,0.5)">
            <a onclick="goPreviousPage(-1)" class="back-btn" style="padding: 0; margin-top: calc(3vh); margin-left: calc(3vh)">
                <img src="<?= $imgDir . 'back.png' ?>" style="height: calc(3vw)">
            </a>
            <h1 style="color: #fff; text-align: left; padding-left: calc(6vw); font-size: calc(2.7vw); font-weight: normal; line-height: calc(4.4vw)"><?= $title ?></h1>
        </div>

        <div class="buttons-container" style="display: none;">
            <a class="button-elem" id="favorite_btn" data-favorite="<?= $usage->is_favorite ?>">
                <?php if ($usage->is_favorite == '0') { ?>
                    <img src="<?= base_url('assets/images/mobile/shiping1.png') ?>">
                <?php } else { ?>
                    <img src="<?= base_url('assets/images/mobile/shiping1-1.png') ?>">
                <?php } ?>
            </a>
            <a class="button-elem" id="share_btn" data-share="<?= $usage->share_count ?>">
                <img src="<?= base_url('assets/images/mobile/shiping3.png') ?>">
            </a>
            <a class="button-elem" id="like_btn" data-like="<?= $usage->is_like ?>" >
                <?php if ($usage->is_like == '0') { ?>
                    <img src="<?= base_url('assets/images/mobile/shiping5.png') ?>">
                <?php } else { ?>
                    <img src="<?= base_url('assets/images/mobile/shiping5-1.png') ?>">
                <?php } ?>
            </a>
            <span style="display: inline-block; color: #fff; font-size: calc(2.3vw); vertical-align: bottom; line-height: 1"><?= $like_num ?></span>
        </div>

        <?php
        $additional = $content->additional_info;
        if ($additional == null || $additional == '') $additional = '';
        else $additional = base_url() . $additional;
        if ($additional != '') { ?>
            <a class="title-subcontent" href="<?= base_url().'resource/additionalPreviewPlayer/'.$content->id ?>" target="_blank">附件内容</a>
        <?php } ?>

        <div class="prev_btn" onclick="goPreviousPage(-1)"></div>
        <div class="pdf_container" id="pdf_container"></div>
        <iframe class="course_content_area" style="display: none; border: none; width: calc(100vw); height: calc(100vh)"></iframe>

        <div class="share_container">
            <a class="button-elem" id="pengyouquan_btn"><img
                        src="<?= base_url('assets/images/previewPlayer/pengyouquan.png') ?>"></a>
            <a class="button-elem" id="qqkoongjian_btn"><img
                        src="<?= base_url('assets/images/previewPlayer/qqkoongjian.png') ?>"></a>
        </div>
    </div>

    <div id="wx-sharing-qr-wrap" style="display:none">
        <span class="wx-sharing-close-btn">✕</span>
        <div id="qr-code"></div>
    </div>
</div>
<script>
    var courseList = JSON.parse('<?php echo json_encode($courseList);?>');
    var pretitle = "<?= $title?>";
    var title = sessionStorage.getItem("__id");
    var content_id = "<?= $content_id ?>"
    var usage_id = "<?= $usage->usage_id ?>"
    var user_id = "<?= $this->session->userdata('loginuserID') ?>" * 1;
    var pageType = '<?= $pageType?>';

    if (!user_id) {
        $('.buttons-container').remove();
        $('.prev_btn').remove();
    }

    $(function () {
        if (pretitle == "_") $('.title').html(title);
        setTimeout(function () {
            if (history.length == 1) {
                $('.top-bar').hide();
            }
            read_content();
        }, 100);

    })
    function clickedContent(){
        console.log('------------- iframe clicked');
        try{
            if(isMobile && user_id !='' ){
                if ('ReactNativeWebView' in window) {
                    window.ReactNativeWebView.postMessage(JSON.stringify({
                        type:'header_show'
                    }));
                }
            }
        }catch(e){

        }

    }
    var isProcessing = false;

    function read_content() {
        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/content_read",
            dataType: "json",
            data: {
                user_id: user_id,
                content_id: content_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    console.log('content_read success')
                    usage_id = res.data;
                    isProcessing = false;
                }
                else//failed
                {
                    alert("Cannot update content Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    }

    $('#download_btn').click(function () {
        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/content_download",
            dataType: "json",
            data: {
                user_id: user_id,
                content_id: content_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    console.log('content_download success')
                    usage_id = res.data;
                    isProcessing = false;
                }
                else//failed
                {
                    alert("Cannot update content Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    });

    $('#favorite_btn').click(function () {
        var favorite = $(this).attr('data-favorite');
        if (favorite == '0') favorite = '1';
        else if (favorite == '1') favorite = '0';
        if (isProcessing) return;
        isProcessing = true;
        console.log('-- usage_id : ', usage_id, user_id, content_id, favorite);
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/content_favorite",
            dataType: "json",
            data: {
                usage_id: usage_id,
                user_id: user_id,
                content_id: content_id,
                favorite: favorite
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#favorite_btn').attr('data-favorite', favorite)
                    var img_src = $('#favorite_btn img').attr('src');

                    if (favorite == '1') {
                        img_src = img_src.replace('.png', '-1.png');
                        $('#favorite_btn img').attr('src', img_src);
                    } else {
                        img_src = img_src.replace('-1.png', '.png');
                        $('#favorite_btn img').attr('src', img_src);
                    }
                }
                else//failed
                {
                    alert("Cannot update content Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    });

    $('#like_btn').click(function () {
        var like = $(this).attr('data-like');
        if (like == '0') like = '1';
        else if (like == '1') like = '0';

        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/content_like",
            dataType: "json",
            data: {
                usage_id: usage_id,
                user_id: user_id,
                content_id: content_id,
                like: like,
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#like_btn').attr('data-like', like);
                    $('.buttons-container span').text(res.data.like_num);
                    var img_src = $('#like_btn img').attr('src');
                    if (like == '1') {
                        img_src = img_src.replace('.png', '-1.png');
                        $('#like_btn img').attr('src', img_src);
                    } else {
                        img_src = img_src.replace('-1.png', '.png');
                        $('#like_btn img').attr('src', img_src);
                    }
                }
                else//failed
                {
                    alert("Cannot update content Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    });

    $('#share_btn').click(function () {
        $('.share_container').toggleClass('show');
    });
    $('.wx-sharing-close-btn').click(function () {
        $('#wx-sharing-qr-wrap').css('display', 'none');
    });
    $('#qqkoongjian_btn').click(function (e) {
        $('.share_container').toggleClass('show');
        e.preventDefault();
        var _pic = baseURL + 'assets/images/logo-icon.png';
        var _title = $('.title').html();
        var _site = '慧教乐学';

        var _shareUrl = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?';
        _shareUrl += 'url=' + encodeURI(document.location);   //参数url设置分享的内容链接|默认当前页location
        _shareUrl += '&showcount=0';      //参数showcount是否显示分享总数,显示：'1'，不显示：'0'，默认不显示
        _shareUrl += '&title=' + encodeURI(_title || document.title);    //参数title设置分享标题，可选参数
        _shareUrl += '&site=' + encodeURI(_site || '');   //参数site设置分享来源，可选参数
        _shareUrl += '&pics=' + encodeURI(_pic || '');   //参数pics设置分享图片的路径，多张图片以＂|＂隔开，可选参数
        window.open(_shareUrl, '_blank');
    });
    $('#pengyouquan_btn').click(function (e) {
        $('.share_container').toggleClass('show');
        e.preventDefault();
        $('body>div>div').height(485);
        if ($('#qr-code canvas').length == 0) {
            var qrcode = new QRCode("qr-code", {
                text: window.location.href,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            $('#wx-sharing-qr-wrap').fadeIn(300);
        } else {
            if ($('#wx-sharing-qr-wrap').css('display') == 'none') {
                $('#wx-sharing-qr-wrap').fadeIn(300);
            } else {
                $('#wx-sharing-qr-wrap').fadeOut(300);
            }
        }
    });

    $(window).load(function () {
        if(osStatus==='Android'){
            console.log('android');
            Android.videoPlayerDirection('landscape');
        }else{
            window.location = 'videoPlayerDirection://landscape';
        }
    });

    $(window).unload(function () {
        if(osStatus==='Android'){
            console.log('android');
            Android.videoPlayerDirection('portrate');

        }else{
            console.log('ios');
            window.location = 'videoPlayerDirection://portrate';
        }
    });
</script>

<script src="<?= base_url('assets/js/mobile/index.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/mobile/main.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/preview.js') ?>" type="text/javascript"></script>