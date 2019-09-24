$('.bg').css({background: 'url(' + imageDir + 'assets/images/resource/preview/bg.png) no-repeat'});
$('.frame').css({background: 'url(' + imageDir + 'assets/images/resource/preview/frame.png) no-repeat'});
var currentPageIndex = 0;
var totalpageCount = 0;
var countperpage = 6;

$(function () {
    if (courseList.length > 0) {
        totalpageCount = Math.ceil(courseList.length / countperpage);
        courseItemPlay(courseList[0].id, courseList);
        if (courseList.length <= countperpage) {
            $('.prev_btn').css("display", "none");
            $('.next_btn').css("display", "none");
        }
    } else {
        $('.prev_btn').css("display", "none");
        $('.next_btn').css("display", "none");
    }
});

function itemClick(self) {
    var itemId = self.getAttribute("itemid");
    $('.preview_list_item').removeClass('active');
    $(self).addClass('active');
    courseItemPlay(itemId);
}

function courseItemPlay(itemid, courseList) {
    if (courseList == undefined) courseList = this.courseList;
    var url = baseURL;
    var item;
    for (var i = 0; i < courseList.length; i++) {
        if (courseList[i].id == itemid) item = courseList[i];
    }
    var isPDF = false;
    switch (parseInt(item.content_type_id)) {
        case 1:
            url += item.content_path + '/index.html';
            break;
        case 2:
            url += "assets/js/toolset/video_player/vplayer.php?ncw_file=" + baseURL + item.content_path + "";
            break;
        case 3:
            url += "assets/js/toolset/video_player/iplayer.php?ncw_file=" + baseURL + item.content_path + "";
            break;
        case 4:
            url += "assets/js/toolset/video_player/docviewer.php?ncw_file=" + item.content_path + "&&base="+baseURL;
            break;
        case 5:
            isPDF = true;
            var elem = document.createElement('a');
            elem.href = baseURL + item.content_path;
            var filename = item.content_path.split('/');
            elem.download = filename[filename.length - 1];
            elem.innerHTML = "Click here to download the file";
            document.body.appendChild(elem);
            history.replaceState(null,null,elem.href);
            elem.click();
            setTimeout(function () {
                document.body.removeChild(elem);
                window.URL.revokeObjectURL(elem.href);
            }, 100);
            // url += "assets/js/toolset/video_player/docviewer.php?ncw_file=" + baseURL + item.content_path + "";
            break;
        //
        // case 5:
        //     isPDF = true;
        //     url += "assets/js/toolset/video_player/pdfplayer.php?ncw_file=" + baseURL + item.content_path + "";
        //     break;
        case 6:
            url += item.content_path;
            break;
    }
    console.log(url);
    if (isPDF) {
        console.log(baseURL + item.content_path);
        // history.replaceState(null,null,'');
        $('.course_content_area').attr("src", '');
        $('.course_content_area').fadeOut('fast');
        // $('.pdf_container').fadeIn('fast');
        // $('.pdf_content').attr("src", "");
        // $('.pdf_content').attr("src", baseURL + item.content_path);
        //  $('.pdf_content').fadeOut('slow');
    } else {
        // history.replaceState(null, null, '');
        // $('.pdf_container').attr("src", "");
        // $('.pdf_container').fadeOut("fast");
        $('.course_content_area').attr("src", '');
        // history.replaceState(null,null,url);
        $('.course_content_area').attr("src", url);
        $('.course_content_area').fadeIn('slow');
    }
    console.log(history.length);
}