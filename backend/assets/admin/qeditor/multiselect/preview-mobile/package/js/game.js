//////////////////////////////////////////

ST.x = 0;
ST.y = 1;
ST.w = 2;
ST.h = 3;
ST.cx = 4;
ST.cy = 5;

ST.image = 0;
ST.video = 1;
ST.audio = 2;
ST.subscript = 3;
ST.superscript = 4;
ST.blank_item = 5;

ST.question = 0;
ST.option = 1;
ST.answer = 2;
ST.description = 3;

var rootPrefix = 'game';
var imgData = [
    {name: 'hd1_g433', path: 'images/' + rootPrefix + '_1tp/433.gif'}
];
var _answerArray = [];
var startGame1 = {};
(function (game) {

    var btn_arr = [];

    var timer_area = $('.section[data-type="timer"]');
    var title_area = $('.section[data-type="title"]');
    var content_area = $('.section[data-type="content"]');
    var answer_area = $('.section[data-type="answer"]');
    var submit_area = $('.section[data-type="submit"]');

    var isFirst = true;
    var isProcessing = false;
    var qTmr = 0, tmrMax = 3600;
    game.initGame = function () {
        clearInterval(_tmr);
        _tmr = setInterval(function () {
            var min = Math.floor(qTmr / 60);
            var sec = qTmr % 60;
            timer_area.html('答题时间: ' + min + '分' + sec + '秒');
            qTmr++;
            if (qTmr > tmrMax) clearInterval(_tmr)
        }, 1000);

        $('.section[data-type="submit"]').on(upEvent, function () {
            var isSuccess = true;
            var answerItems = $('.answer-item input');
            if(_answerArray.length==0) isSuccess = false;
            for (var i = 0; i < _answerArray.length; i++) {
                var isUserChecked = answerItems[i].checked;
                if(isUserChecked != _answerArray[i].is_checked) isSuccess = false;
            }
            if(isSuccess){
                parent.answerResult(true, getQuestionInfo());
                clearInterval(_tmr);
                // alert('太棒了, 你答对了!');
            }else{
                parent.answerResult(false, getQuestionInfo());
                // alert('这道题没有答对, 下次加油哦!');
            }
        });

        setQuestionInfo();
        setTransition([]);
    };

    var getTemplateHtml = function (src, type) {
        var content_html = '<span>';
        if (src == undefined) src = '';
        switch (type) {
            case ST.image:
                content_html += '&nbsp;<img src="' + src + '">&nbsp;';
                break;
            case ST.video:
                content_html += '&nbsp;<video controls playsinline webkit-playsinline ' +
                    ' width="320" height="240">' +
                    '<source src="' + src + '" type="video/mp4">' +
                    '</video>&nbsp;';
                break;
            case ST.audio:
                content_html += '&nbsp;<audio controls playsinline webkit-playsinline>' +
                    '<source src="' + src + '" type="audio/mp3">' +
                    '</audio>&nbsp;';
                break;
            case ST.superscript:
                content_html += '<sup>' + src + '</sup>&nbsp;';
                break;
            case ST.subscript:
                content_html += '<sub>' + src + '</sub>&nbsp;';
                break;
            case ST.blank_item:
                content_html += '&nbsp;<div class="blank-item" data-id="' + src + '" contenteditable="false">' + src + '</div>&nbsp;';
                break;
        }
        content_html += '</span>';
        return content_html;
    };

    game.addOptionItem = function (content, answerInfo) {
        console.log('-- content : ', content);
        var cnt = content.length;
        console.log('-- addOptionItem / answerInfo : ', answerInfo);
        var keys = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
            "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
            "U", "V", "W", "X", "Y", "Z"
        ];
        if (cnt < 0) return;

        var content_html = '';
        // ************** multi select ****************
        for (var idx = 0; idx < cnt; idx++) {
            content_html += '<div class="answer-item ' + (!answerInfo.ans_student || !answerInfo.ans_student[idx].student_checked ? '' : 'active') + '" data-id="' + idx + '">' +
                '<input type="checkbox" data-id="' + idx + '"' + (!answerInfo.ans_student || !answerInfo.ans_student[idx].student_checked ? '' : 'checked') + '>' +
                '<div class="item-title" data-id="' + idx + '">' + keys[idx] + '</div>' +
                '<div class="item-content" data-id="' + idx + '">'+content[idx].content+'</div>' +
                '</div>';
        }
        $('.section[data-type="answer"]').html(content_html);
    };

    var initialExplain = function () {
        clearTimeout(initTmr);
        initTmr = setTimeout(function () {
            if (isAudioInitFailed) return;
            for (var i = 0; i < cbtn_pos.length; i++) {
                changeImage(cbtn_arr[i], getImgPath(gId, 'c0-'))
            }
            setTimeout(function () {
                for (var i = 0; i < cbtn_pos.length; i++) {
                    changeImage(cbtn_arr[i], getImgPath(gId, 'c0'))
                }
                setTimeout(function () {
                    for (var i = 0; i < cbtn_pos.length; i++) {
                        changeImage(cbtn_arr[i], getImgPath(gId, 'c0-'))
                    }
                    setTimeout(function () {
                        for (var i = 0; i < cbtn_pos.length; i++) {
                            changeImage(cbtn_arr[i], getImgPath(gId, 'c0'))
                        }
                    }, 1000)
                }, 1000)
            }, 1000)
        }, 8000);
    };

    var setProcessing = function () {
        var curState = !(!isProcessing);
        isProcessing = true;
        showTag(dragLayer);
        btn_arr[ST.speaker].attr('data-status', 0);
        changeImage(btn_arr[ST.speaker], getImgPath(gId, 'b' + ST.speaker + '--'));
        return curState;
    };

    var releaseProcessing = function () {
        isProcessing = false;
        hideTag(dragLayer);
        btn_arr[ST.speaker].attr('data-status', 1);
        changeImage(btn_arr[ST.speaker], getImgPath(gId, 'b' + ST.speaker));
        return isProcessing;
    };

    var addMainObj = function (idx, cnt) {
        var id = cnt + 1;

        var obj_parent = appendTag('objArr' + id);
        setPosition(obj_parent,
            // cbtn_pos[idx][ST.x],
            // cbtn_pos[idx][ST.y],
            cbtn_pos[idx][ST.x],
            cbtn_pos[idx][ST.y],
            cbtn_pos[idx][ST.w],
            cbtn_pos[idx][ST.h] + ctrl_pos[0][ST.h]
        );
        obj_parent.css({overflow: 'unset'});

        var obj_ctrl = [];
        obj_ctrl[0] = appendBackground('obj_ctrl' + idx + '0',
            getImgPath(gId, 'b' + idx), 0, 0
        );
        obj_ctrl[0].attr('data-ctrl-type', ST.move);
        obj_ctrl[0].attr('data-hot-type', 'hotarea');
        obj_ctrl[0].attr('data-id', idx);
        obj_ctrl[0].append('<img src="' + getImgPath(gId, 'b' + idx + '-') + '" style="opacity:0.01;">');


        obj_parent.append(obj_ctrl[0]);
        dragArr.push(obj_ctrl[0]);
        obj_ctrl[1] = appendBackground('obj_ctrl' + idx + '1',
            getImgPath(gId, 'c0'),
            cbtn_pos[idx][ST.w] / 2 - ctrl_pos[0][ST.w] / 2,
            cbtn_pos[idx][ST.h]
        );
        obj_ctrl[1].attr('data-ctrl-type', ST.rotate);
        obj_parent.append(obj_ctrl[1]);
        dragArr.push(obj_ctrl[1]);
        hideTag(obj_ctrl[1]);

        obj_parent.css({display: 'block'});

        obj_parent.attr({
            'data-obj-type': idx,
            'data-cx': cbtn_pos[idx][ST.w] / 2,
            'data-cy': cbtn_pos[idx][ST.h] / 2,
            'data-rotate': 0,
            'data-zoom': 1
        });
        return obj_parent;
    };

    var performCompare = function () {
        var wL = 0, wR = 0;
        var elemL = box_arr[0].find('div[data-ctrl-type="' + ST.move + '"]');
        var elemR = box_arr[1].find('div[data-ctrl-type="' + ST.move + '"]');
        var dAngle = 16, deltaY = 75, deltaX = 5;
        for (var i = 0; i < elemL.length; i++) {
            wL += elemL[i].getAttribute('data-obj-value') * 1;
        }
        for (var i = 0; i < elemR.length; i++) {
            wR += elemR[i].getAttribute('data-obj-value') * 1;
        }

        if (wL.toFixed(5) == wR.toFixed(5)) {
            deltaY = deltaX = 0;
            dAngle = 0;
        } else if (wL.toFixed(5) < wR.toFixed(5)) {
            deltaY = -deltaY;
            dAngle = -dAngle
        }
        setPosition(box_arr[0], box_pos[0][ST.x] + deltaX, box_pos[0][ST.y] + deltaY);
        setPosition(over_arr[ST.boxL], over_pos[ST.boxL][ST.x] + deltaX, over_pos[ST.boxL][ST.y] + deltaY);

        setPosition(box_arr[1], box_pos[1][ST.x] - deltaX, box_pos[1][ST.y] - deltaY);
        setPosition(over_arr[ST.boxR], over_pos[ST.boxR][ST.x] - deltaX, over_pos[ST.boxR][ST.y] - deltaY);

        setTransform(over_arr[ST.bar], 1, -dAngle, [0, 0], [over_pos[ST.bar][ST.cx] + 'px', over_pos[ST.bar][ST.cy] + 'px']);
        setTransform(over_arr[ST.pointer], 1, -dAngle * 2.15, [0, 0], [over_pos[ST.pointer][ST.cx] + 'px', over_pos[ST.pointer][ST.cy] + 'px']);
    };

    var setObjPosition = function (elem, alpha, alpha0) {
        var curRot = elem.attr('data-rotate') * 1;
        var angl = alpha + curRot;
        var angleId = -10;
        for (var i = 0; i < mark_pos.length; i++) {
            if (Math.abs(mark_pos[i] - angl) < 25) {
                //angl = mark_pos[i];
                // showTag(line_arr[i]);
            } else {
                // hideTag(line_arr[i]);
            }
        }
        // console.log(angl);
        if (angl < -360) {
            // angl = -360;
            // clearTimeout(_tmr);
            // showTag(status, 200);
            // _tmr = setTimeout(function () {
            //     hideTag(status, 200);
            // }, 2000);
        }
        if (angl > 360) {
            // angl = 360;
            // clearTimeout(_tmr);
            // _tmr = setTimeout(function () {
            //     hideTag(status, 200);
            // }, 2000);
        }
        setTransform(elem, elem.attr('data-zoom') * 1, angl,
            [0, 0], [elem.attr('data-cx') + 'px', elem.attr('data-cy') + 'px']
        );
        setTransform(elem.find('div[data-ctrl-type="' + ST.delete + '"]'), 1,
            -angl, [0, 0], [30, 30]);
        return angl;
    };
})(startGame1);

function setQuestionTitle(content) {
    $('.section[data-type="title"]').html(content);
    return true;
}
function getQuestionTitle(content) {
    $('.section[data-type="title"]').html(content);
    return $('.section[data-type="title"]').html();
}

function setQuestionContent(content) {
    $('.section[data-type="content"]').html(content);
}
function getQuestionContent(content) {
    return $('.section[data-type="content"]').html();
}

function setQuestionAnswerArr(content, answerInfo) {
    console.log( '-- setQuestionAnswerArr / answerInfo : ', answerInfo );
    content = JSON.parse(content);

    startGame1.addOptionItem(content, answerInfo);

    _answerArray = content;
    var answerArr = $('.section[data-type="answer"] .item-content');
    for (var i = 0; i < content.length; i++) {
        answerArr[i].innerHTML = content[i].content;
    }
    $('.section[data-type="answer"] .answer-item').off(upEvent);
    $('.section[data-type="answer"] .answer-item').on(upEvent, function (object) {
        var that = $(this);
        var div = that.children('div')[0]
        var idx = $(div).attr('data-id');
        var curStatus = $('.answer-item input[data-id="'+idx+'"]')[0].checked;
        $('.answer-item input[data-id="'+idx+'"]')[0].checked = !curStatus;
        that.toggleClass('active');
    });
}
function getQuestionTeacherAnswerArr() {
    return _answerArray;
}
function getQuestionStudentAnswerArr() {
    var isSuccess = true;
    var answerItems = $('.answer-item input');
    if(_answerArray.length==0) isSuccess = false;
    var studentAnswer = [];
    for (var i = 0; i < _answerArray.length; i++) {
        var isUserChecked = answerItems[i].checked;
        if(isUserChecked != _answerArray[i].is_checked) isSuccess = false;
        studentAnswer.push({
            student_checked: isUserChecked
        })
    }

    return {
        check_status: studentAnswer,
        is_right: isSuccess
    };
}

function setQuestionInfo() {
    var qInfo = localStorage.getItem('quiz');
    var answerInfo = localStorage.getItem('answerInfo');
    console.log( '-- setQuestionInfo / answerInfo 0 : ', answerInfo );
    if(!qInfo) return false;
    qInfo = JSON.parse(qInfo);
    if( !answerInfo || answerInfo == 'undefined' || answerInfo == 'null'){

    } else {
        answerInfo = JSON.parse(answerInfo);
    }
    setQuestionTitle(qInfo.qType);
    setQuestionContent(qInfo.ques);
    console.log( '-- setQuestionInfo / answerInfo : ', answerInfo );
    setQuestionAnswerArr(JSON.stringify(qInfo.ans), answerInfo);
    return true;
}

function getQuestionInfo() {
    return {
        id: getURLParameter('uid'),
        type: 0,// 0-multi selection, 1-yesno,  2-fill blank
        ques: getQuestionContent(),
        ans: getQuestionTeacherAnswerArr(),
        ans_student: getQuestionStudentAnswerArr().check_status,
        is_right: getQuestionStudentAnswerArr().is_right
    };
}