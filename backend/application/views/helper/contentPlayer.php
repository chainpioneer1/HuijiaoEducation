<?php
$ctrlRoot = 'helper';
$category = '资源';
$mainModel = 'tbl_huijiao_contents';
?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_helper.css') ?>">
<script src="<?= base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/pdfobject.js') ?>"></script>
<body style="margin:0;padding:0;">
<div class="preview-player">
    <div class="preview-player pdf_container"></div>
    <iframe class="preview-player" width="500" height="275" frameborder="no"></iframe>
</div>
<div class="scripts" hidden style="display: none;">
    <input hidden class="contentList" value='<?= json_encode($content) ?>'>
    <script>
        var baseURL = '<?= base_url()?>';
        var contentList = JSON.parse($('.contentList').val());
        var _mainObj = '<?=$mainModel?>';
        $(function () {
            courseItemPlay();
        })
        function courseItemPlay(itemid) {
            var url = baseURL;
            var item;
            item = contentList[0];
            var isPDF = false;
            var contentPath = item.content_path;
            var contentFormat = getFiletypeFromURL(contentPath);
            switch (contentFormat) {
                case 'mp4':
                case 'mp3':
                case 'wav':
                    item.content_type_id = 2;
                    break;
                case 'png':
                case 'gif':
                case 'bmp':
                case 'jpg':
                case 'jpeg':
                    item.content_type_id = 3;
                    break;
                case 'doc':
                case 'docx':
                case 'ppt':
                case 'pptx':
                    item.content_type_id = 4;
                    break;
                case 'pdf':
                    item.content_type_id = 5;
                    break;
                case 'htm':
                case 'html':
                    item.content_type_id = 6;
                    break;
                default:
                    if (contentPath != '') item.content_type_id = 1;
                    else item.content_type_id = 0;
                    break;
            }
            switch (parseInt(item.content_type_id)) {
                case 1:
                    url += contentPath + '/package/index.html';
                    break;
                case 2:
                    url += "assets/js/toolset/video_player/vplayer.php?ncw_file=" + baseURL + contentPath + "";
                    break;
                case 3:
                    url += "assets/js/toolset/video_player/iplayer.php?ncw_file=" + baseURL + contentPath + "";
                    break;
                case 4:
                    url = "https://view.officeapps.live.com/op/embed.aspx?src=" + baseURL + contentPath + "";
                    break;
                case 5: // PDF
                    isPDF = true;
                    url += contentPath + "";
                    break;
                case 6: // Html
                    url += contentPath;
                    download_url += contentPath;
                    break;
            }
            if (isPDF) {
                PDFObject.embed(url, "#pdf_container");
                $('.pdf_container').fadeIn('fast');
                $('iframe.preview-player').fadeOut('fast');
                $('iframe.preview-player').attr("src", '');
            } else {
                // history.replaceState(null, null, '');
                $('iframe.preview-player').attr("src", '');
                if (item.content_type_id * 1 != 0)
                    $('iframe.preview-player').attr("src", url);
                $('iframe.preview-player').fadeIn('fast');
                $('.pdf_container').fadeOut("fast");
                $('.pdf_container').attr("src", "");
            }
        }

        function getFiletypeFromURL(str) {
            if (str == '' || str == null || str == undefined) return '';
            str = str.split('.');
            return str[str.length - 1].toLowerCase();
        }

        $('.scripts').remove();
    </script>
</div>
</body>