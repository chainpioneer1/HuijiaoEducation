var hoverTmr = 0;
function toggleTermsSelectBox() {
    var hoverObj = $('.select-elem.terms .select-box');
    hoverObj.toggleClass('show');
    hoverObj.off('mouseout');
    hoverObj.on('mouseout',function (e) {
        clearTimeout(hoverTmr);
        hoverTmr = setTimeout(function () {
            clearTimeout(hoverTmr);
            toggleTermsSelectBox();
        },500);
    });
    hoverObj.find('*').off('mousemove');
    hoverObj.find('*').on('mousemove',function (e) {
        $('.select-elem.coursetypes .select-box').removeClass('show');
        clearTimeout(hoverTmr);
    });
}

function toggleCoursetypesSelectBox() {
    var hoverObj = $('.select-elem.coursetypes .select-box');
    hoverObj.toggleClass('show');
    hoverObj.off('mouseout');
    hoverObj.on('mouseout',function (e) {
        clearTimeout(hoverTmr);
        hoverTmr = setTimeout(function () {
            clearTimeout(hoverTmr);
            toggleCoursetypesSelectBox();
        },500);
    });
    hoverObj.find('*').off('mousemove');
    hoverObj.find('*').on('mousemove',function (e) {
        $('.select-elem.terms .select-box').removeClass('show');
        clearTimeout(hoverTmr);
    });
}

var questionsArr = [];
var allQuestionIds = [];
var curPage = '';
var class_ids = [];
var title = '';
var end_time = '';

$('.select-elem.terms .select-option').click(function () {
    var term_id = $(this).attr('data-id');
    var title = $(this).attr('data-title');
    // $(this).parent().find('.select-option').find('input').prop('checked', false);
    $(this).parent().find('.select-option').find('input').each(function () {
        var elem = $(this)[0];
        if ($(this).parent().attr('data-id') == term_id) {
            elem.checked = true;
        } else {
            elem.checked = false;
        }
    })

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectTerm",
        dataType: "json",
        data: {
            term_id: term_id
        },
        success: function (res) {
            if (res.status == 'success') {
                $('.select-elem.coursetypes .select-box').html(res.data);
                $('.body-sec.question-sec').html('<div class="question-elem no-question"><p>没有题目。</p></div>');
                $('.pagination-bar').html('');
                questionsArr = [];
                allQuestionIds = [];
                clearLocalStorage();
                $('#selected-questions-num').html(0);

                $('#selected-term').html(title);
                // $('.select-elem.terms .select-box').toggleClass('show');
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

})

var isClickCheckbox = false;
// $(".select-elem.coursetypes .select-option input").on("click", function (e) {
//     isClickCheckbox = true;
// })
$(".select-elem.coursetypes").on('click', "input", function (e) {
    isClickCheckbox = true;
    console.log('1');
});
$(".select-elem.coursetypes").on('click', ".select-option", function (e) {

    var checked = $(this).find('input');
    if (checked.length > 0) checked = checked[0].checked;

    console.log('2');
    if (isClickCheckbox) {
        if (checked)
            $(this).find('input').prop('checked', true);
        else
            $(this).find('input').prop('checked', false);
        isClickCheckbox = false;
    } else {
        if (checked)
            $(this).find('input').prop('checked', false);
        else
            $(this).find('input').prop('checked', true);
    }


    var checkboxes = $(this).parent().find('.select-option').find('input');
    var checkedIds = [];
    for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];
        var checked = checkbox.checked;
        if (checked) {
            checkedIds.push($(checkbox).parent().attr('data-id'));
        }
    }

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectCoursetype/",
        dataType: "json",
        data: {
            coursetype_ids: checkedIds,
            selected_question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {
                makeQuesionPreview(res.data)
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

    console.log(checkedIds);
});

function makeQuesionPreview(questionData) {
    $('.body-sec.question-sec').html(questionData.questionsHtml);
    $('.pagination-bar').html(questionData.paginationHtml);
    allQuestionIds = questionData.questions_ids;
    console.log($('.pagination-bar li a'))
    $('.pagination-bar li a').each(function () {
        $(this).attr('href', '');
    });
    $('.pagination-bar li a').each(function () {
        $(this).attr('href', 'javascript:void(0)');
        $(this).attr('onclick', 'onClickPage(this);');
    });

    if (questionData.totalSelected) {
        $('#select-all-questions').css('background-color', '#f05c5c');
        $('#select-all-questions').html('全除');
    } else {
        $('#select-all-questions').css('background-color', '#00cdaf');
        $('#select-all-questions').html('全选');
    }
    var scale = 1 / _resize() * .9;
    var scaleStr = 'scale(' + scale.toFixed(3) + ')';
    $('.question-elem .section[data-type="content"] img').css({
        'transform': scaleStr,
        '-webkit-transform': scaleStr,
        '-moz-transform': scaleStr,
        '-ms-transform': scaleStr,
        '-o-transform': scaleStr
    });
}


function onClickPage(elem) {

    curPage = $(elem).attr('data-ci-pagination-page');
    if (!curPage) curPage = '';
    else curPage = 2*(parseInt(curPage) - 1);

    var checkboxes = $('.select-elem.coursetypes').find('.select-option').find('input');
    var checkedIds = [];
    for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];
        var checked = checkbox.checked;
        if (checked) {
            checkedIds.push($(checkbox).parent().attr('data-id'));
        }
    }

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectCoursetype/" + curPage,
        dataType: "json",
        data: {
            coursetype_ids: checkedIds,
            selected_question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {
                makeQuesionPreview(res.data);
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

    console.log(checkedIds);
}


function onClickSelectQuestion(elem) {

    var question_id = $(elem).attr('data-id');

    var isExist = false;
    for (var i = 0; i < questionsArr.length; i++) {
        if (questionsArr[i] == question_id) {
            questionsArr.splice(i, 1);
            isExist = true;
            break;
        }
    }

    if (!isExist) {
        questionsArr.push(question_id);
    }

    var checkboxes = $('.select-elem.coursetypes').find('.select-option').find('input');
    var checkedIds = [];
    for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];
        var checked = checkbox.checked;
        if (checked) {
            checkedIds.push($(checkbox).parent().attr('data-id'));
        }
    }

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectCoursetype/" + curPage,
        dataType: "json",
        data: {
            coursetype_ids: checkedIds,
            selected_question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {
                $('#selected-questions-num').html(questionsArr.length);
                makeQuesionPreview(res.data)
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

    console.log(checkedIds);
}

function onClickAllQuestionSelect() {

    if (questionsArr.length == allQuestionIds.length) {
        questionsArr = [];
    } else {
        questionsArr = allQuestionIds.slice(0);
    }

    localStorage.setItem('questionsArr', JSON.stringify(questionsArr));

    var checkboxes = $('.select-elem.coursetypes').find('.select-option').find('input');
    var checkedIds = [];
    for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];
        var checked = checkbox.checked;
        if (checked) {
            checkedIds.push($(checkbox).parent().attr('data-id'));
        }
    }

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectCoursetype/" + curPage,
        dataType: "json",
        data: {
            coursetype_ids: checkedIds,
            selected_question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {

                $('#selected-questions-num').html(questionsArr.length);
                makeQuesionPreview(res.data);

            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

    console.log(checkedIds);
}


$('.check-elem-chk').click(function () {
    var class_id = $(this).attr('data-id');
    var class_str = $(this).attr('data-str');
    var checked = $(this)[0]
    checked = checked.checked;

    var isExist = false;
    for (var i = 0; i < class_ids.length; i++) {
        if (class_ids[i].id == class_id) {
            isExist = true;
            if (!checked) class_ids.splice(i, 1);
            break;
        }
    }

    if (!isExist) {
        if (checked) class_ids.push({
            id: class_id,
            str: class_str
        });
    }

    console.log(class_ids);

    var str = ''
    for (var i = 0; i < class_ids.length; i++) {
        str += class_ids[i].str;
        if (i != class_ids.length - 1) str += '，';
    }

    console.log(str);

    $('#publish-class-str').html(str);
})


function onOpenPublishModal() {
    title = $('#work-title').val();
    end_time = $('#end-time').val();
    console.log(title);
    console.log(end_time);
    if (class_ids.length < 1) {
        alert('请选择班级。')
    } else if (title == '') {
        alert('请输入作业名称。')
    } else if (end_time == '') {
        alert('请输入作业完成时间。')
    } else if (questionsArr.length < 1) {
        alert('请选择题目。')
    } else {
        $('.publish-modal-wrap').fadeIn(100);
    }

}

function onClosePublishModal() {
    $('.publish-modal-wrap').fadeOut(100);
}

function onPublishConfirm() {
    title = $('#work-title').val();
    end_time = $('#end-time').val();
    var classIdArr = [];
    for (var i = 0; i < class_ids.length; i++) {
        classIdArr.push(class_ids[i].id);
    }

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/publishWork",
        dataType: "json",
        data: {
            user_id: user_id,
            title: title,
            end_time: end_time,
            class_ids: classIdArr,
            question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {
                window.location = base_url + 'work';
            } else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });
    $('.publish-modal-wrap').fadeOut(100);
}

function onClickPreview() {
    title = $('#work-title').val();
    end_time = $('#end-time').val();

    if( class_ids.length < 1 || questionsArr.length < 1 || title == '' || end_time == '' ){
        onOpenPreviewErrorModal();
    } else {
        saveLocalStorage();
        window.location = base_url + 'work/preview';
    }
}


function onOpenPreviewErrorModal() {
    $('.preview-error-modal-wrap').fadeIn(100);

}

function onClosePublishModal() {
    $('.preview-error-modal-wrap').fadeOut(100);
}


function clearLocalStorage() {
    localStorage.setItem('title', '');
    localStorage.setItem('end_time', '');
    localStorage.setItem('questionsArr', '');
    localStorage.setItem('class_ids', '');
}

function saveLocalStorage() {
    title = $('#work-title').val();
    end_time = $('#end-time').val();
    localStorage.setItem('title', title);
    localStorage.setItem('end_time', end_time);
    localStorage.setItem('questionsArr', JSON.stringify(questionsArr));
    localStorage.setItem('class_ids', JSON.stringify(class_ids));
}

function loadLocalStorage() {
    title = localStorage.getItem('title');
    end_time = localStorage.getItem('end_time');
    questionsArr = JSON.parse(localStorage.getItem('questionsArr'));
    class_ids = JSON.parse(localStorage.getItem('class_ids'));
}

$(document).ready(function () {
    clearLocalStorage();
});

// $('body').on( "scroll", function() {
// //     $( ".base-container" ).each(function() {
// //         console.log('------ $(body).scrollTop : ', $('body').scrollTop());
// //         console.log('------ $(this).offset().top : ', $(this).offset().top);
// //         if ( $(this).offset().top < -145 ) {
// //             var top =  -$(this).offset().top;
// //             console.log('------ top : ', top);
// //             $('.sec-wrap.action-wrap').css('top', top+'px');
// //         }else{
// //             $('.sec-wrap.action-wrap').css('top', '145px');
// //         }
// //     });
// // });