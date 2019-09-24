<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/global.js') ?>"></script>
<script src="<?= base_url('assets/admin/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"
        type="text/javascript"></script>

<script>
    var _backSteps = history.length;
    $(function () {
        $('.datetime_text').datetimepicker();
    })
    var parentView = '<?=(isset($parentView) ? $parentView : '')?>';

    var userId = '<?= $this->session->userdata('loginuserID')?>';

    function goPreviousPage(id) {
        _backSteps = -history.length + _backSteps - 1;
        console.log(_backSteps);
        if (parentView == 'back') history.go(_backSteps);
        else location.href = baseURL + parentView;
    }

    // $(function () {
    //     if (parentView == '')
    //         $('.top-back').hide();
    // });


    $(window).load(function () {

        $('.page-loading-status').hide();
    });
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            autoplay:true,
            loop:true,
            autoplayTimeout:3000,
            slideSpeed:10,
            autoplayHoverPause:false,
            responsiveClass:true,
            items:1}
        );
        $('.header-logo').width($('.header-logo').height());
        $('#input-search').focus(function () {
            $('.footer').hide();
        });
        $('#input-search').blur(function () {
            $('.footer').show();
        })
    });

</script>