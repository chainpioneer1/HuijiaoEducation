<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/videoplayer.css') ?>">
<script>
    var isVideo = false;
</script>
<div class="bg" id="main-background-full"></div>
<div class="title"></div>
<style>.video-js video{ object-fit: fill }</style>
<div class="videoContent">
    <embed class="pdf_content" src="<?=base_url($class_id)?>" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" style="width: 100%;height:100%;"/>
</div>
<div class="frame"></div>
<div class="tree"></div>
<script>
    var titleId = "<?=$title_id?>";
    $(function () {
        setTimeout(function () {
            if(history.length==1){
                $('.top-bar').hide();
            }
        },100);
    })
</script>
<script src="<?= base_url('assets/js/videoplayer.js') ?>" type="text/javascript"></script>