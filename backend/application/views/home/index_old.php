<div class="base-container">
    <div class="home-main-content slider-bar owl-carousel">
        <?php
        foreach ($banners as $item) {
            echo '<div class="owl-item"><img src="' . base_url('uploads/' . $item->image) . '"/></div>';
        }
        ?>
    </div>

    <div class="home-bottom">
        <a class="nav" href="<?= base_url('resource') ?>" itemid="1"></a>
        <a class="nav" href="<?= base_url('classroom') ?>" itemid="2"></a>
        <a class="nav" href="<?= base_url('teacher_work') ?>" itemid="3"></a>
    </div>
</div>
<script>

    $('.home-main-content').owlCarousel({
        items: 1,
        nav: true,
        dots: true,
        autoplay: true,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1200
    });

    $(function () {
//        $('.top-bar').css({top: '1.5%'});
    })

</script>