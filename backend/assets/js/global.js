function getFilenameFromURL(str) {
    if (str == '' || str == null || str == undefined) return '';
    str = str.split('/');
    if(str[str.length - 1] == '') return str[str.length - 2].toLowerCase();
    return str[str.length - 1].toLowerCase();
}

function getFiletypeFromURL(str) {
    if (str == '' || str == null || str == undefined) return '';
    str = str.split('.');
    return str[str.length - 1].toLowerCase();
}

function removeExtFromFilename(str) {
    if (str == '' || str == null || str == undefined) return '';
    str = str.split('.');
    if (str.length == 1) return str[0].toLowerCase();
    return str[str.length - 2].toLowerCase();
}

function setOptions() {
    return;
    // var dlg_school = $('select[name=school_id]');
    // var dlg_category = $('select[name=category_id]');
    var dlg_lesson = $('select[name=lesson_id]');
    var back_school = $('select#school_search');
    var back_school_id = back_school.find('option[value=\'' + back_school.val() + '\']').attr('item_id');
    var back_category = $('select#category_search');
    var back_lesson = $('select#lesson_search');

    dlg_category.find('option').hide();
    dlg_lesson.find('option').hide();
    back_category.find('option').hide();
    back_lesson.find('option').hide();

}


///////////  make custom pagination part

function appendPagination(curPage, perPage, cntRecord, urlRoot) {
    var perPage = perPage * 1;
    var totalPages = Math.floor((cntRecord*1 - 1)/ perPage + 1);
    curPage = Math.floor((curPage == '' ? 1 : curPage*1) / perPage + 1);
    var content_html = '<li><div>共' + totalPages + '页</div></li>';
    content_html += '<li><div>到第</div></li>';
    content_html += '<li><input value=""></li>';
    content_html += '<li><div>页</div></li>';
    content_html += '<li><a href="javascript:showPage(' + perPage + ',' + totalPages + ',\''+urlRoot+'\');">确定</a></li>';
    $('.pagination').append(content_html);
    $('.pagination').prepend('<li><div style="margin-right: 20px;">共'+cntRecord+'条</div></li>')
}

function showPage(perPage, totalPages, urlRoot) {
    var pageNum = $('.pagination>li>input').val();
    if (pageNum < 1 || pageNum > totalPages) return;
    pageNum = (pageNum * 1 - 1) * perPage;
    if (pageNum <= 0) pageNum = '';
    location.href = baseURL + urlRoot+'/index/' + pageNum;
}

//////////////////////////////////////////////////