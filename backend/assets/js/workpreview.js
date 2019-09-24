function toggleTermsSelectBox(){
    $('.select-elem.terms .select-box').toggleClass('show');
}

function toggleCoursetypesSelectBox(){
    $('.select-elem.coursetypes .select-box').toggleClass('show');
}

var questionsArr = [];
var allQuestionIds = [];
var curPage = '';
var class_ids =  [];
var title = '';
var end_time = '';



function onOpenPublishModal() {
    $('.publish-modal-wrap').fadeIn(100);
}

function onClosePublishModal() {
    $('.publish-modal-wrap').fadeOut(100);
}

function onPublishConfirm() {
    var classIdArr = [];
    for( var i=0; i<class_ids.length; i++ ){
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
            }
            else//failed
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


function clearLocalStorage(){
    localStorage.setItem('title', '');
    localStorage.setItem('end_time', '');
    localStorage.setItem('questionsArr', '');
    localStorage.setItem('class_ids', '');
}

function saveLocalStorage(){
    title = $('#work-title').val();
    end_time = $('#end-time').val();
    localStorage.setItem('title', title);
    localStorage.setItem('end_time', end_time);
    localStorage.setItem('questionsArr', JSON.stringify(questionsArr));
    localStorage.setItem('class_ids', JSON.stringify(class_ids));
}

function loadLocalStorage(){
    title = localStorage.getItem('title');
    end_time = localStorage.getItem('end_time' );
    questionsArr = JSON.parse(localStorage.getItem('questionsArr'));
    class_ids = JSON.parse(localStorage.getItem('class_ids'));

    if( class_ids.length < 1 || questionsArr.length < 1 || title == '' || end_time == '' )
        window.location = base_url + 'work/publish';
}

function initializePage() {
    for( var i=0; i<class_ids.length; i++ ){
        var span_elem = $('<span></span>').html(class_ids[i].str);
        var elem = $('<div></div>').addClass('check-elem').append(span_elem);
        $('#selected-classes').append(elem);
    }

    $('#work-title').html( title );
    $('#end-time').html( end_time );
    $('.selected-questions-num').html( questionsArr.length );

    var str = ''
    for( var i=0; i<class_ids.length; i++ ){
        str += class_ids[i].str;
        if( i != class_ids.length-1 ) str += '，';
    }
    $('#publish-class-str').html(str);
}


function loadSelectedQuestions(){

    jQuery.ajax({
        type: "post",
        url: baseURL + "work/selectedQuestions",
        dataType: "json",
        data: {
            selected_question_ids: questionsArr
        },
        success: function (res) {
            if (res.status == 'success') {
                $('.body-sec.question-sec').html(res.data.questionsHtml);
            }
            else//failed
            {
                alert("Cannot update lesson Item.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });

}

$(document).ready(function(){
    loadLocalStorage();
    initializePage();
    loadSelectedQuestions();
});