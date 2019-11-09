// $('.bg').css({background: 'url(' + imageDir + 'assets/images/resource/preview/bg.png) no-repeat'});
// $('.frame').css({background: 'url(' + imageDir + 'assets/images/resource/preview/frame.png) no-repeat'});
var currentPageIndex = 0;
var totalpageCount = 0;
var countperpage = 6;

$(function () {
    if (courseList.length > 0) {
        //totalpageCount = Math.ceil(courseList.length / countperpage);
        showPreviewCourseList(courseList);
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

function showPreviewCourseList(courseList) {
    $('.preview_list_container').html('');
    var content_html = "";
    console.log(courseList);
    for (var i = 0; i < courseList.length; i++) {
        var item = courseList[i];
        if (i == 0)
            content_html += '<div class="preview_list_item active" onclick="itemClick(this)" itemid="' + item.id + '">' + item.title + '</div>';
        else if (!item.additional_info)
            content_html += '<div class="preview_list_item" onclick="itemClick(this)" itemid="' + item.id + '">' + item.title + '</div>';
        else if (item.additional_info) {
            content_html += '<div class="preview_list_item" onclick="itemClick(this)" itemid="' + item.id + '" ' +
                ' style="border-bottom: none;">' + item.title + '</div>';
            // content_html += '<div class="preview_list_item" onclick="itemClick(this, 1)" itemid="' + item.id + '" ' +
            //     ' style="text-align: right; font-size: 18px;border-top:none;"><i class="fa fa-chevron-right" style="margin: 0 15px;"></i>附件内容</div>';
        }
    }
    $('.preview_list_container').html(content_html);
}

function itemClick(self, isAdditional) {
    if (!isAdditional) isAdditional = 0;
    var itemId = self.getAttribute("itemid");
    $('.preview_list_item').removeClass('active');
    $(self).addClass('active');
    courseItemPlay(itemId, courseList, isAdditional);
}

function courseItemPlay(itemid, courseList, isAdditional) {
    if (!isAdditional) isAdditional = 0;
    if (courseList == undefined) courseList = this.courseList;
    var url = baseURL;
    var download_url = baseURL;
    var item;
    for (var i = 0; i < courseList.length; i++) {
        if (courseList[i].id == itemid) item = courseList[i];
    }
    var isPDF = false;
    var contentPath = item.content_path;
    $('.title-subcontent').attr('href','javascript:;');
    $('.title-subcontent').hide();
    if (pageType == '1' || isAdditional) contentPath = item.additional_info;
    else if (item.additional_info) {
        $('.title-subcontent').attr('href',
            baseURL + 'resource/additionalPreviewPlayer/' + item.id
        );
        $('.title-subcontent').show();
    }
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
            download_url += contentPath + '.zip';
            break;
        case 2:
            url += "assets/js/toolset/video_player/vplayer.php?ncw_file=" + baseURL + contentPath + "";
            download_url += contentPath + "";
            break;
        case 3:
            url += "assets/js/toolset/video_player/iplayer.php?ncw_file=" + baseURL + contentPath + "";
            download_url += contentPath + "";
            break;
        case 4:
            url = "https://view.officeapps.live.com/op/embed.aspx?src=" + baseURL + contentPath + "";
            download_url += contentPath + "";
            break;
        // case 5:
        //     isPDF = true;
        //     var elem = document.createElement('a');
        //     elem.href = baseURL + item.content_path;
        //     var filename = item.content_path.split('/');
        //     elem.download = filename[filename.length - 1];
        //     elem.innerHTML = "Click here to download the file";
        //     document.body.appendChild(elem);
        //     history.replaceState(null,null,elem.href);
        //     elem.click();
        //     setTimeout(function () {
        //         document.body.removeChild(elem);
        //         window.URL.revokeObjectURL(elem.href);
        //     }, 100);
        //     download_url += item.content_path + "";
        //     // url += "assets/js/toolset/video_player/docviewer.php?ncw_file=" + baseURL + item.content_path + "";
        //     break;

        case 5: // PDF
            isPDF = true;
            url += contentPath + "";
            download_url += contentPath;
            break;
        case 6: // Html
            url += contentPath;
            download_url += contentPath;
            break;
    }
    if (isPDF) {
        PDFObject.embed(url, "#pdf_container");
        $('.pdf_container').fadeIn('fast');
        $('.course_content_area').fadeOut('fast');
        $('.course_content_area').attr("src", '');
    } else {
        // history.replaceState(null, null, '');
        $('.course_content_area').attr("src", '');
        if (item.content_type_id * 1 != 0)
            $('.course_content_area').attr("src", url);
        $('.course_content_area').fadeIn('fast');
        $('.pdf_container').fadeOut("fast");
        $('.pdf_container').attr("src", "");
        // history.replaceState(null,null,url);
        $('a#download_btn').attr('href', download_url);
        var fileType = getFiletypeFromURL(download_url);
        $('a#download_btn').attr('download', item.title + '.' + fileType);
    }
    console.log(history.length);
}

function getFiletypeFromURL(str) {
    if (str == '' || str == null || str == undefined) return '';
    str = str.split('.');
    return str[str.length - 1].toLowerCase();
}
