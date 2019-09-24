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

ST.question = 0;
ST.option = 1;
ST.answer = 2;
ST.description = 3;

var rootPrefix = 'game';
var imgData = [
    {name: 'hd1_g433', path: 'images/' + rootPrefix + '_1tp/433.gif'}
];
var startGame1 = {};
(function (game){
    var btn_arr = [];

    var question_area = $('.item-edit[data-type="question"]');
    var option_area = $('.item-edit[data-type="option"] > .option-area');
    var answer_area = $('.item-edit[data-type="answer"]');
    var description_area = $('.item-edit[data-type="description"]');

    var formUploader = $('#fileUploader');
    var inputUploader = $('#fileUploader input[name="fileUploader"]');

    var optionCnt = 3;
    var btnAddOption = $('.row-action[data-id="-1"]');
    var data_store = {
        question: [], option: [], answer: [], description: []
    };

    var isFirst = true;
    var isProcessing = false;

    game.initGame = function () {
        var btns = $('.btn-item');
        for (var i = 0; i < btns.length; i++) btn_arr[i] = $(btns[i]);

        btn_arr.forEach(function (elem, idx) {
            elem.on(upEvent, function () {
                var idx = Math.floor(elem.attr('data-id') * 1);
                switch (idx) {
                    case 0: // superscript btn
                        pasteHtmlAtCaret(getTemplateHtml(getSelectedText(), ST.superscript));
                        break;
                    case 1: // subscript btn
                        pasteHtmlAtCaret(getTemplateHtml(getSelectedText(), ST.subscript));
                        break;
                    case 2: // upload btn
                        inputUploader.val('');
                        inputUploader.trigger('click');
                        break;
                    case 3: // add option btn
                        optionCnt++;
                        game.addOptionItem(optionCnt);
                        break;
                }
            });
        });
        uploadConfig(function (ret) {
            var type = getFiletypeFromURL(ret);
            switch (type) {
                case 'bmp':
                case 'gif':
                case 'png':
                case 'jpg':
                case 'jpeg':
                    type = ST.image;
                    break;
                case 'mp3':
                    type = ST.audio;
                    break;
                case 'mp4':
                    type = ST.video;
                    break;
            }
            pasteHtmlAtCaret(getTemplateHtml(ret, type));
        });

        game.addOptionItem(optionCnt);
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
                    ' width="320" height="180" style="width:320px;height:180px;">' +
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
        }
        content_html += '</span>';
        return content_html;
    };

    game.addOptionItem = function (cnt) {
        var keys = ["A", "B", "C", "D", "E", "F",
            "G", "H", "I", "J", "K", "L", "M", "N",
            "O", "P", "Q", "R", "S", "T", "X", "Y", "Z"
        ];
        if (cnt < 2) return;
        var content_html = '';
        for (var idx = 0; idx < cnt; idx++) {
            var parentElem = $($('.option-area .item-edit-row')[idx]);
            if (parentElem.length > 0) {
                content_html += '<div class="item-edit-row" data-id="' + idx + '">';
                content_html += parentElem.html();
                content_html += '</div>';
            } else {
                content_html += '<div class="item-edit-row" data-id="' + idx + '">' +
                    '<div class="row-title" data-id="' + idx + '">' + keys[idx] + '</div>' +
                    '<div class="row-content" data-id="' + idx + '" contenteditable="true"' +
                    ' placeholder="请编辑选项内容(可添加图片，视频，音频)"></div>' +
                    '<div class="row-action" data-id="' + idx + '">删除</div>' +
                    '</div>';
            }
        }
        $('.item-edit .option-area').html(content_html);
        content_html = '';
        for (var idx = 0; idx < cnt; idx++) {
            content_html += '<div class="answer-item">' +
                '<input type="checkbox" data-id="' + idx + '">' + keys[idx] + '</div>';
        }
        $('.item-edit[data-type="answer"]').html(content_html);
        for (var idx = 0; idx < cnt; idx++) {
            var parentElem = $($('.item-edit-row')[idx]);
            parentElem.attr('data-id', idx);
            parentElem.find('div').attr('data-id', idx);
            parentElem.find('.row-title').html(keys[idx]);
        }
        $('.row-action').off(upEvent);
        $('.row-action').on(upEvent, function () {
            optionCnt = $('.option-area .item-edit-row').length;
            if (optionCnt < 3) return;
            var that = $(this);
            var idx = that.attr('data-id');
            if (idx == '-1') return;
            $('.item-edit-row[data-id="' + idx + '"]').remove();
            optionCnt--;
            startGame1.addOptionItem(optionCnt);
        });
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

    // game.initGame();
})(startGame1);

function setQuestionContent(content) {
    var parentElem = $('.item-edit[data-type="question"]');
    parentElem.html(content);
    return true;
}

function getQuestionContent() {
    var parentElem = $('.item-edit[data-type="question"]');
    return parentElem.html();
}

function setAnswerContentArr(content) {
    content = JSON.parse(content);
    startGame1.addOptionItem(content.length);
    setTimeout(function () {
        var optionArr = $('.option-area .item-edit-row');
        var answerArr = $('.item-edit[data-type="answer"] input[type="checkbox"]');
        for (var i = 0; i < content.length; i++) {
            $(optionArr[i]).find('.row-content').html(content[i].content);
            $(answerArr[i]).prop('checked', content[i].is_checked);
        }
    },100);
    return true;
}

function getAnswerContentArr() {
    var ret = [];
    var optionArr = $('.option-area .item-edit-row');
    var answerArr = $('.item-edit[data-type="answer"] input[type="checkbox"]');
    for (var i = 0; i < optionArr.length; i++) {
        if ($(optionArr[i]).find('.row-content').html() == '') continue;
        ret.push({
            id: i,
            content: $(optionArr[i]).find('.row-content').html(),
            is_checked: answerArr[i].checked
        });
    }
    return ret;
}

function setDescriptionContent(content) {
    var parentElem = $('.item-edit[data-type="description"]');
    parentElem.html(content);
    return true;
}

function getDescriptionContent() {
    var parentElem = $('.item-edit[data-type="description"]');
    return parentElem.html();
}

function getQuestionInfo() {
    return {
        id: getURLParameter('uid'),
        type: 0,// 0-multi selection, 1-yesno,  2-fill blank
        ques: getQuestionContent(),
        ans: getAnswerContentArr(),
        desc: getDescriptionContent()
    };
}