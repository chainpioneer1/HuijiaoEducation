window.addEventListener('load',function(){
    $('#footer-xuexi').mouseenter( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/mobile/santubiao1.png');
    } );
    $('#footer-xuexi').mouseleave( function () {
        $(this).find('img').attr('src',  baseURL+'assets/images/mobile/santubiao2.png');
    } );
    $('#footer-mengxue').mouseenter( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/mobile/santubiao3.png');
    } );
    $('#footer-mengxue').mouseleave( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/mobile/santubiao4.png');
    } );
    $('#footer-my').mouseenter( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/mobile/santubiao5.png');
    } );
    $('#footer-my').mouseleave( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/mobile/santubiao6.png');
    } );
    $('.download-btn').mouseenter( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/frontend/src/my-favo-gushi/icon-download-hover.png');
    } );
    $('.download-btn').mouseleave( function () {
        $(this).find('img').attr('src', baseURL+'assets/images/frontend/src/my-favo-gushi/icon-download.png');

    } );

    $('#gushi-list-tab').click(function (e) {
        e.preventDefault();
        $('.category-elem').removeClass('sel');
        $('.category-elem img').css('display','none');
        $(this).addClass('sel');
        $(this).find('img').css('display','block');
        $('#diangu-list-wrapper').hide();
        $('#gushi-list-wrapper').show();
        $('#mengxue-list-wrapper').hide();
    });
    $('#mengxue-list-tab').click(function (e) {
        e.preventDefault();
        $('.category-elem').removeClass('sel');
        $('.category-elem img').css('display','none');
        $(this).addClass('sel');
        $(this).find('img').css('display','block');
        $('#diangu-list-wrapper').hide();
        $('#gushi-list-wrapper').hide();
        $('#mengxue-list-wrapper').show();
    });
    $('#diangu-list-tab').click(function (e) {
        e.preventDefault();
        $('.category-elem').removeClass('sel');
        $('.category-elem img').css('display','none');
        $(this).addClass('sel');
        $(this).find('img').css('display','block');
        $('#diangu-list-wrapper').show();
        $('#gushi-list-wrapper').hide();
        $('#mengxue-list-wrapper').hide();
    })


});

function padDesignFix(){
    var width = $(window).width();
    var height = $(window).height();
    if( width/height > 0.65 ){
        $('.back-btn').css('paddingTop', 'calc(2.5vh)')
    } else {
        $('.back-btn').css('paddingTop', 'calc(2vh)')
    }
}