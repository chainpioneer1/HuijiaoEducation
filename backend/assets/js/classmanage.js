function onAddClass() {
    $('.add-class-modal-wrap').fadeIn(100);
}

function onCloseAddClassModal() {
    $('.add-class-modal-wrap').fadeOut(100);
}

function onAddClassConfirmModal() {
    var year = $('#class-year').val();
    var ban = $('#class-ban').val();
    var year_str = $($('#class-year option')[year-1]).html();
    var ban_str = $($('#class-ban option')[ban-1]).html()
    $('#add_class_str').html(year_str + ban_str);
    console.log( year_str, ban_str );

    $('.alert-modal-wrap.add-class').fadeIn(100);
}

function onCloseAddClassAlertModal() {
    $('.alert-modal-wrap.add-class').fadeOut(100);
}

function onDeleteClassConfirmModal() {
    $('.alert-modal-wrap.delete-class').fadeIn(100);
}

function onCloseDeleteClassAlertModal() {
    $('.alert-modal-wrap.delete-class').fadeOut(100);
}

var isProcessing = false;

function onOkAddClassAlertModal() {
    var classYearStr = $('#class-year').val();
    var classBanStr = $('#class-ban').val();
    var classStr = classYearStr + '-' + classBanStr;

    if (isProcessing) return;
    isProcessing = true;
    var that = this;
    jQuery.ajax({
        type: "post",
        url: baseURL + "users/addClass",
        dataType: "json",
        data: {
            user_id: user_id,
            user_class: classStr
        },
        success: function (res) {
            if (res.status == 'success') {
                $('.list-container').html( res.data );
                onCloseAddClassAlertModal();
                onCloseAddClassModal();
            }
            else//failed
            {
                alert("Cannot add class.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });
}


function deleteClass(elem){
    var sclass_id = $(elem).attr('data-id');
    $('#delete-class-id').val(sclass_id);
    onDeleteClassConfirmModal();

};

function onOkDeleteClassAlertModal(){
    if (isProcessing) return;
    isProcessing = true;

    var sclass_id = $('#delete-class-id').val();
    jQuery.ajax({
        type: "post",
        url: baseURL + "users/deleteClass",
        dataType: "json",
        data: {
            user_id: user_id,
            sclass_id: sclass_id
        },
        success: function (res) {
            if (res.status == 'success') {
                $('.list-container').html( res.data );
                onCloseDeleteClassAlertModal();
            }
            else//failed
            {
                alert("Cannot delete class.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });
}