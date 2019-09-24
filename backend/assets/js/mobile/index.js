window.addEventListener('load',function(){
    console.log( $('.subject-elem') );
    var subjectElem = $('.subject-elem');
    var subjectTabSections = $('.subject-tab-section');

    if( !subjectElem[0] ){

    } else {
        var img_src =  $(subjectElem[0]).find('img').attr('src');
        var img_src1 =  $(subjectElem[0]).attr('data-img-src');
        img_src = img_src.replace(img_src1 + '1', img_src1)
        $(subjectElem[0]).addClass('active');
        $(subjectElem[0]).find('img').attr('src', img_src);

        $(subjectTabSections[0]).addClass('active');
    }


    $('.subject-elem').click(function(){
        var img_src = $('.subject-elem.active').find('img').attr('src');
        var img_src1 = $('.subject-elem.active').attr('data-img-src');
        img_src = img_src.replace(img_src1, img_src1 + '1')
        $('.subject-elem.active').find('img').attr('src', img_src);
        $('.subject-elem').removeClass('active');

        var id = $(this).attr('data-subject-id');
        img_src = $(this).find('img').attr('src');
        img_src1 = $(this).attr('data-img-src');
        img_src = img_src.replace(img_src1 + '1', img_src1)

        $('.subject-tab-section').removeClass('active');
        $(this).addClass("active");
        $(this).find('img').attr('src', img_src);

        var subjectTabSections = $('#subject-tab-section-' + id);
        $(subjectTabSections).addClass('active');

    })
});


window.onscroll = function() {headerSticky()};

var header = document.getElementById("stickyHeader");

var sticky = header.offsetTop;

function headerSticky() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}