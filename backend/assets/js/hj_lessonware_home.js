//////////////////////////
// unused variables;
var isEditFlag = false;
var selectedIndex = 0;
var processIndex = 0;
var lessonList = [];
var courseList = [];
// used variables;
var contentList = [];
var lessonInfoList = [];

$(function () {
    initConfig();
    controlConfig();
});

function initConfig() {
    // make subject list
    $('.tab-item[data-id="2"]').attr('data-sel', 1);
    var parentTag = $('.subject-select .select-list');
    var content_html = '';
    for (var i = 0; i < _subjects.length; i++) {
        var item = _subjects[i];
        content_html += '<div class="select-item" '
            + 'data-id="' + item.id + '" data-type="subject">'
            + item.title
            + '</div>';
    }
    parentTag.html(content_html);

    var itemTag = $('.subject-select .select-item');
    itemTag.off('click');
    itemTag.on('click', function (e) {
        var subjectId = $(this).attr('data-id');
        var contentType = $(this).parent().parent().attr('data-type');
        $('.subject-select[data-type="' + contentType + '"] .select-item')
            .removeAttr('data-sel');
        selectSubject(subjectId, contentType);
        $(this).attr('data-sel', '1');

    });
    itemTag.off('mouseout');

    selectSubject(1, 'contents');
    $('.subject-select[data-type="contents"] .select-item:first-child').trigger('click');
    $('.term-select[data-type="contents"] .select-item:first-child').trigger('click');
    $('.coursetype-select[data-type="contents"] .select-item:first-child').trigger('click');

    if (_lessonItem.length != 0) {
        $('.tab-item[data-id="4"]').html('编辑课件');
        var termItem = _terms.filter(function (a) {
            return a.id == _lessonItem.term_id
        })[0];
        $('input.item-select').val(_lessonItem.title);
        selectSubject(termItem.subject_id * 1, 'lesson');
        $('.subject-select[data-type="lesson"] .select-item[data-id="' + termItem.subject_id + '"]').trigger('click');
        $('.term-select[data-type="lesson"] .select-item[data-id="' + termItem.id + '"]').trigger('click');
        $('.img_preview').css({
            'background':'url('+baseURL + _lessonItem.image_icon+')'
        });

    } else {
        selectSubject(1, 'lesson');
        $('.subject-select[data-type="lesson"] .select-item:first-child').trigger('click');
        $('.term-select[data-type="lesson"] .select-item:first-child').trigger('click');
    }
    makeLessonContents();
}

function makeLessonContents() {
    var allList = _lessonContents;
    var type = 'lesson';
    var tag = $('.content-items[data-type="' + type + '"]');
    var content_html = '';
    for (var i = 0; i < allList.length; i++) {
        var contentItem = allList[i];
        content_html += '<div class="list-item" ' +
            'data-id="' + contentItem.id + '" ' +
            'data-title="' + contentItem.title + '" ' +
            'data-content-type="' + contentItem.content_type_id + '" ' +
            'data-src="' + contentItem.content_path + '" ' +
            'data-type="lesson">' +
            '<img class="item-icon" src="' + baseURL + contentItem.icon_path + '">' +
            '<img class="item-icon" src="' + baseURL + contentItem.icon_corner + '" style="position:absolute;left:2px;top:3px;width:98.5%;">' +
            '<div class="item-desc"><div>' + contentItem.title + '</div></div>' +
            '<div class="edit-btn" data-type="moveLeft" onclick="operate(this);"><i class="fa fa-arrow-left"></i></div>' +
            '<div class="edit-btn" data-type="moveRight"  onclick="operate(this);"><i class="fa fa-arrow-right"></i></div>' +
            '<div class="edit-btn" data-type="delete" onclick="operate(this);"><i class="fa fa-remove"></i></div>' +
            '</div>';
    }
    tag.append(content_html);
    refreshLessonInfo();
}

function selectSubject(id, type) {
    $('.subject-select').fadeOut('fast');
    $('div.item-select.subject').html(_subjects[id - 1].title + '<div></div>');
    var tag = $('.term-select[data-type="' + type + '"] .select-list');
    var sub_terms = _terms.filter(function (a) {
        return a.subject_id == id;
    });

    var content_html = '';
    for (var i = 0; i < sub_terms.length; i++) {
        var item = sub_terms[i];
        content_html += '<div class="select-item" '
            + 'data-id="' + item.id + '" data-type="term">'
            + item.title
            + '</div>';
    }
    tag.hide();
    tag.html(content_html);
    tag.fadeIn('fast');

    // var that = $('.subject-select[data-type="' + type + '"] .select-item');
    // $('.subject-select[data-type="' + type + '"] .select-item')
    //     .removeAttr('data-sel');
    //
    // $(that).attr('data-sel', '1');

    var itemTag = $('.term-select .select-item');
    itemTag.off('click');
    itemTag.on('click', function (e) {
        selectTerm(this);
    });
    itemTag.off('mouseout');

    $('.term-select[data-type="'+type+'"] .select-item:first-child').trigger('click');
    var overStatus = [false, false];
    var hoverEvent = 'mouseenter';
    var outEvent = 'mouseout';
    $('.select-item, .select-title').off(outEvent);
    $('.select-item, .select-title').on(outEvent, function (e) {
        var bottomElement = document.elementFromPoint(e.clientX, e.clientY);
        var bottomCls = bottomElement.getAttribute('class');
        //if (bottomCls == 'subject-select' || bottomCls == 'term-select' || bottomCls == 'coursetype-select') return;
        if (bottomCls == 'select-item' || bottomCls == 'select-title') return;

        $('.term-select, .subject-select, .coursetype-select').fadeOut('fast');
        $('.item-select div').removeAttr('data-sel');
    })

    $('.item-select.subject div').off('click');
    $('.item-select.subject div').on('click', function (e) {
        var type = $(this).parent().attr('data-type');
        $('.subject-select').fadeOut('fast');
        var status = $(this).attr('data-sel');
        if (status != '1') {
            $('.subject-select[data-type="' + type + '"]').fadeIn('fast');
            $(this).attr('data-sel', 1);
        }else{
            $('div.item-select.subject div').removeAttr('data-sel');
        }
    })

}

function selectTerm(that) {
    console.log('select-term');
    $('.term-select').fadeOut('fast');
    if (that) {
        var type = $(that).parent().parent().attr('data-type');
        $('.term-select[data-type="' + type + '"] .select-item')
            .removeAttr('data-sel');

        $(that).attr('data-sel', '1');
        var termName = $('.term-select[data-type="' + type + '"]')
            .find('.select-item[data-sel="1"]')
            .html();

        $('div.item-select.term[data-type="' + type + '"]')
            .html(termName + '<div></div>');
        $('div.item-select.term[data-type="' + type + '"]').attr('data-id', $(that).attr('data-id'));
        $('div.item-select div').removeAttr('data-sel');
        if (type == 'contents') {
            makeCourseTypeList($(that).attr('data-id'));
        }
    }
    $('.item-select.term div').off('click');
    $('.item-select.term div').on('click', function (e) {
        var type = $(this).parent().attr('data-type');
        $('.term-select').fadeOut('fast');
        var status = $(this).attr('data-sel');
        $('div.item-select.term div').removeAttr('data-sel');
        if (status != '1') {
            $('.term-select[data-type="' + type + '"]').fadeIn('fast');
            $(this).attr('data-sel', 1);
        }
    })

    $('.item-select.coursetype div').off('click');
    $('.item-select.coursetype div').on('click', function (e) {
        var type = $(this).parent().attr('data-type');
        $('.coursetype-select').fadeOut('fast');
        console.log('selected-course');
        var status = $(this).attr('data-sel');
        $('div.item-select.coursetype div').removeAttr('data-sel');
        if (status != '1') {
            $('.coursetype-select[data-type="' + type + '"]').fadeIn('fast');
            $(this).attr('data-sel', 1);
        }
    })
}

function makeCourseTypeList(term_id, type) {
    if (!term_id) term_id = 1;
    if (!type) type = 'contents';
    $.ajax({
        type: "post",
        url: baseURL + "resource/getCourseTypes",
        dataType: "json",
        data: {
            user_id: 0,
            term_id: term_id
        },
        success: function (res) {
            if (res.status == true) {
                var results = res.data;

                var tag = $('.coursetype-select .select-list');
                var content_html = '';
                for (var i = 0; i < results.length; i++) {
                    var item = results[i];
                    content_html += '<div class="select-item" '
                        + 'data-id="' + item.id + '" data-type="coursetype">'
                        + item.title
                        + '</div>';
                }
                tag.hide();
                tag.html(content_html);
                tag.fadeIn('fast');

                var itemTag = $('.coursetype-select .select-item');
                itemTag.off('click');
                itemTag.on('click', function (e) {
                    selectCourseType(this);
                    var coursetypeId = $(this).attr('data-id');
                    var contentType = $(this).parent().parent().attr('data-type');
                    $('.subject-select[data-type="' + contentType + '"] .select-item')
                        .removeAttr('data-sel');
                    makeContentList(coursetypeId, contentType);
                    $(this).attr('data-sel', '1');
                });
                itemTag.off('mouseout');
                $('.coursetype-select[data-type="contents"] .select-item:first-child').trigger('click');


            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        }
    });
}

function selectCourseType(that) {
    $('.coursetype-select').fadeOut('fast');
    if (that) {
        var type = $(that).parent().parent().attr('data-type');
        $('.coursetype-select[data-type="' + type + '"] .select-item')
            .removeAttr('data-sel');

        $(that).attr('data-sel', '1');
        var courseType = $('.coursetype-select[data-type="' + type + '"]')
            .find('.select-item[data-sel="1"]')
            .html();

        $('div.item-select.coursetype[data-type="' + type + '"]')
            .html(courseType + '<div></div>');
        $('div.item-select div').removeAttr('data-sel');
        // if (type == 'contents') {
        //     makeCourseTypeList($(that).attr('data-id'));
        // }
    }
    $('.item-select.coursetype div').off('click');
    $('.item-select.coursetype div').on('click', function (e) {
        var type = $(this).parent().attr('data-type');
        $('.coursetype-select').fadeOut('fast');
        console.log('selected');
        var status = $(this).attr('data-sel');
        $('div.item-select.coursetype div').removeAttr('data-sel');
        if (status != '1') {
            $('.coursetype-select[data-type="' + type + '"]').fadeIn('fast');
            $(this).attr('data-sel', 1);
        }
    })


}

function makeContentList(coursetype_id, type) {
    if (!coursetype_id) coursetype_id = 1;
    if (!type) type = 'contents';
    $.ajax({
        type: "post",
        url: baseURL + "resource/getContents",
        dataType: "json",
        data: {
            user_id: 0,
            coursetype_id: coursetype_id
        },
        success: function (res) {
            if (res.status == true) {
                var results = res.data;
                contentList = results;
                var content_html = '';
                for (var i = 0; i < results.length; i++) {
                    var item = results[i];
                    content_html += '<div class="list-item" ' +
                        'data-id="' + item.id + '" data-type="coursetype">' +
                        '<img class="item-icon" src="' + baseURL + item.icon_path + '">' +
                        '<img class="item-icon" src="' + baseURL + item.icon_corner + '" style="position:absolute;left: 1px;top:3px;width: 99%;">' +
                        '<div class="item-desc"><div>' + item.title + '</div></div>' +
                        '</div>';
                }
                var tag = $('.content-items[data-type="' + type + '"]');
                var titleInfoTag = $('.content-titleinfo[data-type="' + type + '"]');
                tag.hide();
                tag.html(content_html);
                tag.fadeIn('fast');

                tag.find('.list-item').off('click');
                tag.find('.list-item').off('mouseover');
                tag.find('.list-item').off('mouseout');
                tag.find('.list-item').on('click', function (e) {
                    var status = $(this).attr('data-sel');
                    tag.find('.list-item').removeAttr('data-sel');
                    if (status != '1') {
                        $(this).attr('data-sel', 1);
                        var contentId = $(this).attr('data-id');
                        // addContentToLesson(contentId);
                    }
                }).on('mouseover', function (e) {
                    var title = $(this).find('.item-desc > div').html();
                    // console.log(title);
                    if (title.length < 5) return;
                    titleInfoTag.html(title);
                    titleInfoTag.show();
                    titleInfoTag.css({
                        top: this.offsetTop + this.offsetHeight + 4,
                        left: this.offsetLeft + 2
                    })
                }).on('mouseout', function (e) {
                    titleInfoTag.hide();
                })
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        }
    });
}

function addContentToLesson(contentId, type) {
    if (!contentId) contentId = contentList[0].id;
    if (!type) type = 'lesson';

    var contentItem = contentList.filter(function (a) {
        return a.id == contentId;
    })[0];
    if (!contentItem) return;
    if (lessonInfoList.length > 0) {
        var oldId = lessonInfoList.filter(function (a) {
            return a == contentId;
        })[0];
        if (oldId) return;
    }

    var tag = $('.content-items[data-type="' + type + '"]');
    var content_html = '';
    content_html += '<div class="list-item" ' +
        'data-id="' + contentItem.id + '" ' +
        'data-title="' + contentItem.title + '" ' +
        'data-content-type="' + contentItem.content_type_id + '" ' +
        'data-src="' + contentItem.content_path + '" ' +
        'data-type="lesson">' +
        '<img class="item-icon" src="' + baseURL + contentItem.icon_path + '">' +
        '<img class="item-icon" src="' + baseURL + contentItem.icon_corner + '" style="position:absolute;width:100%;height:150px;">' +
        '<div class="item-desc"><div>' + contentItem.title + '</div></div>' +
        '<div class="edit-btn" data-type="moveLeft" onclick="operate(this);"><i class="fa fa-arrow-left"></i></div>' +
        '<div class="edit-btn" data-type="moveRight"  onclick="operate(this);"><i class="fa fa-arrow-right"></i></div>' +
        '<div class="edit-btn" data-type="delete" onclick="operate(this);"><i class="fa fa-remove"></i></div>' +
        '</div>';
    tag.append(content_html);
    refreshLessonInfo();
}

function operate(elem){
    var that = $(elem);
    var type = that.attr('data-type');
    that.parent().parent().find('.list-item').removeAttr('data-sel');
    that.parent().attr('data-sel',1);
    switch (type) {
        case 'moveLeft':
            $('.edit-btns[data-type="moveLeft"]').trigger('click');
            break;
        case 'moveRight':
            $('.edit-btns[data-type="moveRight"]').trigger('click');
            break;
        case 'delete':
            $('.edit-btns[data-type="delete"]').trigger('click');
            break;
    }
}

function refreshLessonInfo() {
    var type = 'lesson';
    var tag = $('.content-items[data-type="' + type + '"]');
    var titleInfoTag = $('.content-titleinfo[data-type="' + type + '"]');
    lessonInfoList = [];
    for (var i = 0; i < tag.find('.list-item').length; i++) {
        var itemId = tag.find('.list-item')[i].getAttribute('data-id');
        lessonInfoList.push(itemId);
    }
    tag.find('.list-item .item-icon').off('click');
    tag.find('.list-item .item-icon').off('mouseover');
    tag.find('.list-item .item-icon').off('mouseout');
    tag.find('.list-item .item-icon').on('click', function (e) {
        tag.find('.list-item').removeAttr('data-sel');
        var status = $(this).parent().attr('data-sel');
        tag.find('.list-item').removeAttr('data-last');
        $(this).parent().attr('data-last', 1);
        if (status) {
            $(this).parent().removeAttr('data-sel');
        } else {
            $(this).parent().attr('data-sel', 1);
            var contentId = $(this).parent().attr('data-id');
        }
        var contentId = $(this).parent().attr('data-id');
        if (contentId)
            showContentPlayer(contentId, 1);
    }).on('mouseover', function (e) {
        var title = $(this).parent().find('.item-desc > div').html();
        // console.log(title);
        if (title.length < 5) return;
        titleInfoTag.html(title);
        titleInfoTag.show();
        titleInfoTag.css({
            top: this.offsetTop + this.offsetHeight + 67,
            left: this.offsetLeft + 10
        })
    }).on('mouseout', function (e) {
        titleInfoTag.hide();
    });
    // console.log(lessonInfoList);
}

function preparePreview() {
    var previewContentList = [];
    var parentTag = $('.content-items[data-type="lesson"]');
    var contents = parentTag.find('.list-item');
    for (var i = 0; i < contents.length; i++) {
        var item = $(contents[i]);
        previewContentList.push({
            id: item.attr('data-id'),
            title: item.attr('data-title'),
            content_type_id: item.attr('data-content-type'),
            content_path: item.attr('data-src')
        })
    }
    refreshLessonInfo();
    console.log(previewContentList);
    localStorage.setItem('preview-content', JSON.stringify(previewContentList));
    localStorage.setItem('__id', $('input.item-select').val());
}

function controlConfig() {
    $('.edit-btns').on('click', function (e) {
        console.log('control');
        var type = $(this).attr('data-type');
        var parentTag = $('.content-items[data-type="lesson"]');
        switch (type) {
            case 'moveLeft':
                var contents = parentTag.find('.list-item[data-sel="1"]');

                for (var i = 0; i < contents.length; i++) {
                    var contentId = contents[i].getAttribute('data-id');
                    for (var j = 1; j < lessonInfoList.length; j++) {
                        if (lessonInfoList[j] == contentId) {
                            var a = lessonInfoList[j] + '';
                            lessonInfoList[j] = lessonInfoList[j - 1] + '';
                            lessonInfoList[j - 1] = a;
                        }
                    }
                }
                var newContentTag = document.createElement('div');
                for (var i = 0; i < lessonInfoList.length; i++) {
                    var contentItem = parentTag.find('.list-item[data-id="' + lessonInfoList[i] + '"]');
                    newContentTag.appendChild(contentItem[0]);
                }
                parentTag.html(newContentTag.innerHTML);
                refreshLessonInfo();
                break;
            case 'moveRight':
                var contents = parentTag.find('.list-item[data-sel="1"]');

                for (var i = contents.length - 1; i >= 0; i--) {
                    var contentId = contents[i].getAttribute('data-id');
                    for (var j = lessonInfoList.length - 2; j >= 0; j--) {
                        if (lessonInfoList[j] == contentId) {
                            var a = lessonInfoList[j] + '';
                            lessonInfoList[j] = lessonInfoList[j + 1] + '';
                            lessonInfoList[j + 1] = a;
                        }
                    }
                }
                var newContentTag = document.createElement('div');
                for (var i = 0; i < lessonInfoList.length; i++) {
                    var contentItem = parentTag.find('.list-item[data-id="' + lessonInfoList[i] + '"]');
                    newContentTag.appendChild(contentItem[0]);
                }
                parentTag.html(newContentTag.innerHTML);
                refreshLessonInfo();
                break;
            case 'play':
                var contentId = parentTag.find('.list-item[data-last="1"]').attr('data-id');
                // launch contentItem
                if (contentId)
                    showContentPlayer(contentId, 1);
                break;
            case 'delete':
                parentTag.find('.list-item[data-sel="1"]').fadeOut();
                setTimeout(function () {
                    parentTag.find('.list-item[data-sel="1"]').remove();
                    refreshLessonInfo();
                }, 500);
                break;
            case 'upload':
                e.preventDefault();
                $('#upload_lw_courseware').val("");
                $('#upload_lw_courseware').trigger("click");
                break;
            case 'upload-image':
                e.preventDefault();
                $('#upload_lw_image').val("");
                $('#upload_lw_image').trigger("click");
                break;
            case 'cancel':
                $("#lw_delete_modal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('body').append($(".modal-backdrop"));
                $('body').append($("#lw_delete_modal"));
                $('.modal-backdrop').on("click", function (object) {
                    $("#lw_delete_modal").modal('hide');
                });
                break;
            case 'save':
                preparePreview();
                var termId = $('.term-select[data-type="lesson"] .select-item[data-sel="1"]').attr('data-id');
                var title = $('input.item-select').val();
                if (!title) {
                    alert('请输入新建课件名称');
                    break;
                }
                if (lessonInfoList.length == 0) {
                    alert('请添加课件资源');
                    break;
                }
                var uploadData = {
                    id: 0,
                    title: $('input.item-select').val(),
                    term_id: termId,
                    lesson_info: JSON.stringify(lessonInfoList),
                };
                if (_lessonItem.length != 0) uploadData.id = _lessonItem.id;

                var icon_format = $('#upload_lw_img_type').val();

                $(".uploading_backdrop").show();
                $(".progressing_area").show();
                var fdata = new FormData($('#upload_lw_submit_form')[0]);
                fdata.append("id", uploadData.id);
                fdata.append("title", uploadData.title);
                fdata.append("term_id", uploadData.term_id);
                fdata.append("lesson_info", uploadData.lesson_info);
                fdata.append("icon_format", icon_format);
                $.ajax({
                    url: baseURL + "resource/updateLessonInfo",
                    type: "POST",
                    data: fdata,
                    contentType: false,
                    cache: false,
                    processData: false,
                    async: true,
                    xhr: function () {
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function (event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                $("#progress_percent").text(percent + '%');

                            }, true);
                        }
                        return xhr;
                    },
                    mimeType: "multipart/form-data"
                }).done(function (res) { //
                    var ret;
                    $(".uploading_backdrop").hide();
                    $(".progressing_area").hide();
                    try {
                        ret = JSON.parse(res);
                    } catch (e) {
                        alert('操作失败 : ' + JSON.stringify(e));
                        console.log(e);
                        return;
                    }
                    if (ret.status == 'success') {
                        console.log('lesson updating has been successed!')
                        location.href = baseURL + "resource/lessonware";
                    }
                    else//failed
                    {
                        alert('操作失败 : ' + ret.data);
                        // jQuery('#ncw_edit_modal').modal('toggle');
                        // alert(ret.data);
                    }
                });
                break;
            case 'preview':
                preparePreview();
                showLessonPlayer(0, 1);
                break;
            case 'platform':
                $('.site-course-selector').show();
                break;
            case 'reject':
                $('.site-course-selector').hide();
                break;
            case 'accept':
                $('.site-course-selector').hide();
                var contentId = $('.list-item[data-type="coursetype"][data-sel="1"]').attr('data-id');
                addContentToLesson(contentId);
                break;
        }
    })
}

function cancelEdit(self) {
    $("body").fadeOut('fast');
    location.href = baseURL + "resource/lessonware";
}

function lessonList_OutPut(processIndex) {
    var content_html = "";
    for (var i = 0; i < lessonList.length; i++) {
        var item = lessonList[i];
        if (item.owner_type == 0) content_html += '<div class="lesson_list_item" itemid="' + item.id + '">' + item.lesson_name + '</div>';
    }
    $('.lesson_list_container').html(content_html);
    $('.lesson_list_item[itemid=' + processIndex + ']').css({background: 'url(' + baseURL + 'assets/images/resource/lessonware/lessonware2/xiaodibai_clicked.png) no-repeat'});
}

function courseList_OutPut(processIndex) {
    var content_html = "";
    for (var i = 0; i < courseList.length; i++) {
        var item = courseList[i];

        if (item.lesson_id == processIndex && item.owner_type == 0) content_html += '<div class="course_list_item" itemid="' + item.id + '">' +
            '<div class="course_list_item_label" onclick="courseItemClick(this)" itemid="' + item.id + '">' + item.course_name + '</div>' +
            '<div class="course_list_item_play_btn" onclick="courseItemPlay(this)" itemid="' + item.id + '"></div></div>';
    }

    $('.course_list_container').html(content_html);
}

function local_courseList_OutPut(courseList) {
    var content_html = "";
    for (var i = 0; i < courseList.length; i++) {
        var item = courseList[i];
        if (item.owner_type == loggedUserId) content_html += '<div class="course_list_item" itemid="' + item.id + '">' +
            '<div class="course_list_item_label" onclick="courseItemClick(this)" itemid="' + item.id + '">' + item.course_name + '</div>' +
            '<div class="course_list_item_play_btn" onclick="courseItemPlay(this)" itemid="' + item.id + '"></div></div>';
    }

    $('.added_course_list_container').html(content_html);
}

function homeList_OutPut(processIndex, lessonInfoList) {
    var content_html = "";
    for (var i = 0; i < lessonInfoList.length; i++) {
        for (var j = 0; j < courseList.length; j++) {
            if (courseList[j].id == lessonInfoList[i]) {
                var item = courseList[j];
                var courseType = item.course_type;
                if (courseType === '0') courseType = '1';
                content_html += '<div class="home_list_item" itemid="' + item.id + '">'
                    // + '<div class="home_list_item_icon" style="background: url(' + baseURL + '/assets/images/resource/lessonware/lessonware2/tubiao' + courseType + '.png);" '
                    + '<div class="home_list_item_icon" style="background: url(' + baseURL + item.image_path + ');" '
                    + 'itemid="' + item.id + '"></div>'
                    + '<div class="delete_home_item_btn" onclick="deleteHomeListItem(this)" itemid="' + item.id + '"></div>'
                    + '<div class="home_list_item_label" itemid="' + item.id + '">' + item.course_name + '</div>'
                    + '</div>';
            }
        }

    }
    $('.lessonware_home_container').html('');
    $('.lessonware_home_container').html(content_html);
    $('.lessonware_home_container .home_list_item').on('mouseover', function () {
        var itemId = $(this).attr('itemid');
        $(this).css({background: 'rgba(0,0,0,.1)', 'border-radius': '10%'});
        $(this).find('div.delete_home_item_btn').fadeIn('fast');
    }).on('mouseout', function () {
        var itemId = $(this).attr('itemid');
        $(this).css({background: 'transparent'});
        $(this).find('div.delete_home_item_btn').fadeOut('fast');
    })
}

function courseItemClick(self) {
    var itemId = self.getAttribute("itemid");
    console.log(lessonInfoList);
    if (lessonInfoList.indexOf(itemId) === -1) {
        lessonInfoList.push(itemId);
        console.log(lessonInfoList);
        homeList_OutPut(itemId, lessonInfoList);
    } else alert("已经存在");

}

function courseItemPlay(self) {
    var itemId = self.getAttribute("itemid");
    showVideoPlayer(itemId, 1);
    return;
    var url = baseURL;
    var item;
    for (var i = 0; i < courseList.length; i++) {
        if (courseList[i].id == itemId) item = courseList[i];
    }
    switch (parseInt(item.course_type)) {
        case 1:
            url += item.course_path + '/index.html';
            break;
        case 2:
            url += "assets/js/toolset/video_player/vplayer.php?ncw_file=" + baseURL + item.course_path + "";
            break;
        case 3:
            url += "assets/js/toolset/video_player/iplayer.php?ncw_file=" + baseURL + item.course_path + "";
            break;
        case 4:
            url += "assets/js/toolset/video_player/docviewer.php?ncw_file=" + baseURL + item.course_path + "";
            break;
        case 5:
            url += "assets/js/toolset/video_player/docviewer.php?ncw_file=" + baseURL + item.course_path + "";
            break;
    }
    console.log(url);
    $('.lessonware_toolset').attr("src", '');
    $('.lessonware_toolset').attr("src", url);
    $('.lessonware_toolset').fadeIn('slow');
}

function deleteHomeListItem(self) {
    var delete_id = self.getAttribute("itemid");
    console.log(lessonInfoList);
    lessonInfoList.splice(lessonInfoList.indexOf(delete_id), 1);
    console.log(lessonInfoList);
    homeList_OutPut(processIndex, lessonInfoList);
}

$('#upload_lw_courseware').on('change', function (event) {
    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening
    files = event.target.files;

    if (this.files[0].size > 60000000) {
        window.alert("课件要不超过60M.");
        return;
    }

    var fullPath = $(this).val();
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        console.log(filename);
        var name = filename.split('.');
        filename = "";
        for (var i = 0; i < name.length - 1; i++) {
            filename += name[i];
        }
        console.log(name[name.length - 1]);
        $('#upload_lw_name').val(filename);
        $('#upload_lw_type').val(name[name.length - 1]);
    }
    $('#upload_userId').val(loggedUserId);

    var tId = $('.term-select[data-type="lesson"] .select-item[data-sel="1"]').attr('data-id');
    $('#upload_lesson_id').val(makeNDigit(tId, 4));
    $('#upload_lw_submit_form').submit();
});

$('#upload_lw_image').on('change', function (event) {
    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening
    files = event.target.files;

    if (this.files[0].size > 60000000) {
        window.alert("课件要不超过60M.");
        return;
    }

    var fullPath = $(this).val();
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        console.log(filename);
        var name = filename.split('.');
        filename = "";
        for (var i = 0; i < name.length - 1; i++) {
            filename += name[i];
        }
        console.log(name[name.length - 1]);
        $('#upload_lw_name').val(filename);
        $('#upload_lw_img_type').val(name[name.length - 1]);
    }
    $('#upload_userId').val(loggedUserId);
    preview_image('4', this.files[0]);
});

jQuery("#upload_lw_submit_form").submit(function (e) {

    e.preventDefault();
    var content_html = '<div class="uploading_backdrop"></div>' +
        '<div class="progressing_area">' +
        '<img id="wait_ajax_loader" src="' + baseURL + 'assets/images/ajax-loader.gif' + '"/>' +
        '<span style="position: absolute;top: 43%;left: 43%;font-size:18px;color: #fff;z-index: 16000">上传中</span>' +
        '<span id="progress_percent">0%</span>' +
        '</div>'
    $('body').append(content_html);
    $(".uploading_backdrop").show();
    $(".progressing_area").show();

    var fdata = new FormData(this);
    $.ajax({
        url: baseURL + "resource/add_content",
        type: "POST",
        data: fdata,
        contentType: false,
        cache: false,
        processData: false,
        async: true,
        xhr: function () {
            //upload Progress
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', function (event) {
                    var percent = 0;
                    var position = event.loaded || event.position;
                    var total = event.total;
                    if (event.lengthComputable) {
                        percent = Math.ceil(position / total * 100);
                    }
                    $("#progress_percent").text(percent + '%');

                }, true);
            }
            return xhr;
        },
        mimeType: "multipart/form-data"
    }).done(function (res) { //
        var ret;
        console.log(res);
        try {
            ret = JSON.parse(res);
        } catch (e) {
            $(".uploading_backdrop").remove();
            $(".progressing_area").remove();
            alert('Operation failed : ' + JSON.stringify(e));
            console.log(e);
            return;
        }
        if (ret.status == 'success') {
            $(".uploading_backdrop").remove();
            $(".progressing_area").remove();
            var contentItem = ret.contentItem;
            var type = 'lesson'
            var tag = $('.content-items[data-type="' + type + '"]');
            var content_html = '';
            content_html += '<div class="list-item" ' +
                'data-id="' + contentItem.id + '" ' +
                'data-title="' + contentItem.title + '" ' +
                'data-content-type="' + contentItem.content_type_id + '" ' +
                'data-src="' + contentItem.content_path + '" ' +
                'data-type="lesson">' +
                '<img class="item-icon" src="' + baseURL + contentItem.icon_path + '">' +
                '<div class="item-desc"><div>' + contentItem.title + '</div></div>' +
                '<div class="edit-btn" data-type="moveLeft" onclick="operate(this);"><i class="fa fa-arrow-left"></i></div>' +
                '<div class="edit-btn" data-type="moveRight"  onclick="operate(this);"><i class="fa fa-arrow-right"></i></div>' +
                '<div class="edit-btn" data-type="delete" onclick="operate(this);"><i class="fa fa-remove"></i></div>' +
                '</div>';
            tag.append(content_html);
            refreshLessonInfo();
            // controlConfig1();
        } else//failed
        {
            alert('Operation failed : ' + ret.data);
            $(".uploading_backdrop").remove();
            $(".progressing_area").remove();
            // jQuery('#ncw_edit_modal').modal('toggle');
            // alert(ret.data);
        }
    });

});

function preview_image(item_type, file) {
    if (item_type == '5') return;
    var previewer = $('.img_preview[item-type="' + item_type + '"]');
    var reader = new FileReader();
    reader.onloadend = function () {
        previewer.css({
            background: 'url(' + reader.result + ')'
        })
    };
    if (file) {
        reader.readAsDataURL(file);//reads the data as a URL
    } else {
        previewer.css({
            background: 'url(' + baseURL + 'assets/images/huijiao/tab2/upload.png)'
        })
    }
}

$('.scripts').remove();