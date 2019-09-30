<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/preview.css') ?>">
<script src="<?= base_url('assets/js/qrcode/qrcode.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/pdfobject.js') ?>"></script>
<style>
    .header-bar {
        display: none;
    }
</style>
<div class="base-container" style="top: 0">
    <div style="width: 100%;height: 1035px;overflow: hidden;margin-bottom:0;">
        <div class="frame"></div>
        <div class="title"><?= $title ?></div>
        <a class="title-subcontent" href="javascript:;" target="_blank" style="display: none;">附件内容</a>
        <div class="preview_list_container"></div>
        <div class="preview_list_container_tap">目录</div>

<!--        <div class="prev_btn" onclick="goPreviousPage(-1)"></div>-->
        <div class="pdf_container" id="pdf_container"></div>
        <iframe class="course_content_area" style="display: none;height: <?= ($lessonItem->user_id=='0')?'86':'93'?>%"></iframe>
        <div class="bottom_buttons_section" style="display: <?= ($lessonItem->user_id=='0')?'block':'none'?>">
            <div class="buttons-container">
                <a class="button-elem" style="opacity:0;cursor:default;pointer-events:none;" id="download_btn"></a>
                <a class="button-elem" id="favorite_btn" data-favorite="<?= $usage->is_favorite ?>">
                    <?php if ($usage->is_favorite == '0') { ?>
                        <img src="<?= base_url('assets/images/previewPlayer/shoucang.png') ?>">
                    <?php } else { ?>
                        <img src="<?= base_url('assets/images/previewPlayer/shoucang1.png') ?>">
                    <?php } ?>
                </a>
                <span class="favorite-count"><?= $usage->favorite_count; ?></span>
                <a class="button-elem" id="share_btn" data-share="<?= $usage->share_count ?>" style="display: none"><img
                            src="<?= base_url('assets/images/previewPlayer/fenxiang.png') ?>"></a>
                <a class="button-elem" id="like_btn" data-like="<?= $usage->is_like ?>">
                    <?php if ($usage->is_like == '0') { ?>
                        <img src="<?= base_url('assets/images/previewPlayer/dianzan.png') ?>">
                    <?php } else { ?>
                        <img src="<?= base_url('assets/images/previewPlayer/dianzan1.png') ?>">
                    <?php } ?>
                </a>
                <span class="like-count"><?= $usage->like_count; ?></span>
            </div>
        </div>
        <div class="share_container">
            <a class="button-elem" id="pengyouquan_btn"><img
                        src="<?= base_url('assets/images/previewPlayer/pengyouquan.png') ?>"></a>
            <a class="button-elem" id="qqkoongjian_btn"><img
                        src="<?= base_url('assets/images/previewPlayer/qqkoongjian.png') ?>"></a>
        </div>
    </div>
</div>


<div id="wx-sharing-qr-wrap" style="display:none">
    <span class="wx-sharing-close-btn">✕</span>
    <div id="qr-code"></div>
</div>

<script>
    var courseList = JSON.parse('<?php echo json_encode($courseList);?>');
    var pretitle = "<?= $title?>";
    var title = localStorage.getItem("__id");
    var lesson_id = "<?= $lesson_id ?>";
    var usage_id = "<?= $usage->usage_id ?>";
    if (!("<?= $this->session->userdata('loginuserID') ?>" * 1)) {
        $('.bottom_buttons_section .buttons-container').html('');
    }
    var pageType = '<?= $pageType?>';

    $(function () {
        if (pretitle == "_") {
            courseList = JSON.parse(localStorage.getItem('preview-content'));
            $('.title').html(title);
            $('.buttons-container a, .buttons-container span').remove();
        }
        $('.prev-btn').remove();
        setTimeout(function () {
            if (history.length == 1) {
                $('.top-bar').hide();
            }
            if (pretitle != '_') read_lesson();
        }, 100);
    });
    var isProcessing = false;

    function read_lesson() {
        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/lesson_read",
            dataType: "json",
            data: {
                lesson_id: lesson_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    console.log('lesson_read success')
                    usage_id = res.data;
                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    }

    $('#favorite_btn').click(function () {
        var favorite = $(this).attr('data-favorite');
        if (favorite == '0') favorite = '1';
        else if (favorite == '1') favorite = '0';
        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/lesson_favorite",
            dataType: "json",
            data: {
                usage_id: usage_id,
                lesson_id: lesson_id,
                favorite: favorite,
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#favorite_btn').attr('data-favorite', favorite);
                    $('.buttons-container span.favorite-count').text(res.fav_count);
                    var img_src = $('#favorite_btn img').attr('src');

                    if (favorite == '1') {
                        img_src = img_src.replace('.png', '1.png');
                        $('#favorite_btn img').attr('src', img_src);
                    } else {
                        img_src = img_src.replace('1.png', '.png');
                        $('#favorite_btn img').attr('src', img_src);
                    }

                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    })

    $('#like_btn').click(function () {
        var like = $(this).attr('data-like');
        if (like == '0') like = '1';
        else if (like == '1') like = '0';

        if (isProcessing) return;
        isProcessing = true;
        jQuery.ajax({
            type: "post",
            url: baseURL + "resource/lesson_like",
            dataType: "json",
            data: {
                usage_id: usage_id,
                lesson_id: lesson_id,
                like: like,
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('#like_btn').attr('data-like', like);
                    $('.buttons-container span.like-count').text(res.data.like_num);
                    var img_src = $('#like_btn img').attr('src');
                    if (like == '1') {
                        img_src = img_src.replace('.png', '1.png');
                        $('#like_btn img').attr('src', img_src);
                    } else {
                        img_src = img_src.replace('1.png', '.png');
                        $('#like_btn img').attr('src', img_src);
                    }
                } else//failed
                {
                    alert("Cannot update lesson Item.");
                }
            },
            complete: function () {
                isProcessing = false;
            }
        });
    });

    $('.preview_list_container_tap').click(function () {
        if ($('.preview_list_container_tap')[0].style.left != '80.5%') {
            $('.preview_list_container_tap').css('left', '80.5%');
            $('.preview_list_container_tap').addClass('showed');
            $('.preview_list_container').css('left', '83.5%');
            $('iframe').css({width: 1437})
            $('.pdf_container').css({width: 1437});
        } else {
            $('.preview_list_container_tap').css('left', '96.8%');
            $('.preview_list_container').css('left', '100%');
            $('.preview_list_container_tap').removeClass('showed');
            $('iframe').css({width: 1720})
            $('.pdf_container').css({width: 1720});
        }
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
</script>
<script src="<?= base_url('assets/js/preview.js') ?>" type="text/javascript"></script>

