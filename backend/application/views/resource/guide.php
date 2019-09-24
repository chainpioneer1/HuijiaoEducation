<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/preview.css') ?>">
<style>
    .header-bar {
        display: none;
    }

    .title {
        width: 75.5%;
    }

    a.title-subcontent{
        right: 450px;
    }

    iframe {
        width: 1300px;
        height: 830px;
    }

    .title-subcontent {
        right: 430px;
        font-size: 28px;
    }
    .content-selector{
        right: 0px;
        top: 6.9%;
        height: 1000px;
        width: 400px;
        text-align: center;
        padding:0;
        margin:0;
        overflow: unset;
    }
    .selector-title{
        position: relative;
        width: 100%;
        border-bottom: 1px solid #b8b8b8;
        font-size: 26px;
        padding: 3px;
        margin-bottom: 5px;
        text-align: left;
    }
    .selector-item{
        position: relative;
        width: 100%;
        height: 160px;
        padding:0;
        margin: 2px 0;
        text-align: left;
    }
    .selector-item img,
    .selector-item div{
        position: relative;
        font-size: 18px;
        display: inline-block;
        width: 190px;
        height: auto;
        margin:0;
        padding:0;
        text-align: left;
    }

    .selector-item img{
        width: 200px;
        cursor: pointer;
    }

</style>

<div class="base-container" style="top: 0;">
    <div style="width: 100%;height: 1000px;overflow: hidden">
        <div class="title"><?= $title ?></div>
        <a class="title-subcontent" href="<?= base_url() . 'assets/UserGuide.pdf'; ?>" target="_blank">操作指南</a>
        <iframe class="course_content_area" src=""></iframe>
        <div class="content-selector">
            <div class="selector-title">播放列表</div>
            <div class="selector-item" data-target="<?= base_url() . 'assets/UserGuide0.mp4'; ?>">
                <img src="<?= base_url() . 'assets/guide0.png' ?>"/>
                <div>慧教乐学应用操作演示</div>
            </div>
            <div class="selector-item" data-target="<?= base_url() . 'assets/UserGuide1.mp4'; ?>">
                <img src="<?= base_url() . 'assets/guide1.png' ?>"/>
                <div>慧教乐学-登录</div>
            </div>
            <div class="selector-item" data-target="<?= base_url() . 'assets/UserGuide2.mp4'; ?>">
                <img src="<?= base_url() . 'assets/guide2.png' ?>"/>
                <div>慧教乐学-资源</div>
            </div>
            <div class="selector-item" data-target="<?= base_url() . 'assets/UserGuide3.mp4'; ?>">
                <img src="<?= base_url() . 'assets/guide3.png' ?>"/>
                <div>慧教乐学-课件</div>
            </div>
            <div class="selector-item" data-target="<?= base_url() . 'assets/UserGuide4.mp4'; ?>">
                <img src="<?= base_url() . 'assets/guide4.png' ?>"/>
                <div>慧教乐学-备课</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.selector-item').on('click', function(){
            var target = $(this).attr('data-target');
            var title = $(this).find('div').html();
            $('div.title').html(title);
            $('iframe').attr('src', target);
        })
        $($('.selector-item')[0]).trigger('click');
    })
</script>