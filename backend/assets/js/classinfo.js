function onDeleteStudentConfirmModal() {
    $('.alert-modal-wrap.delete-student').fadeIn(100);
}

function onCloseDeleteStudentAlertModal() {
    $('.alert-modal-wrap.delete-student').fadeOut(100);
}

function deleteStudent(elem){
    var student_id = $(elem).attr('data-student-id');
    var sclass_id = $(elem).attr('data-sclass-id');
    $('#delete-student-id').val(student_id);
    $('#delete-sclass-id').val(sclass_id);
    onDeleteStudentConfirmModal();
};

var isProcessing = false;

function onOkDeleteStudentAlertModal(){
    if (isProcessing) return;
    isProcessing = true;

    var student_id = $('#delete-student-id').val();
    var sclass_id = $('#delete-sclass-id').val();
    jQuery.ajax({
        type: "post",
        url: baseURL + "users/deleteStudent",
        dataType: "json",
        data: {
            student_id: student_id,
            sclass_id: sclass_id
        },
        success: function (res) {
            if (res.status == 'success') {
                $('.student-list').html( res.data.html );
                $('#students-count').html( res.data.count );
                onCloseDeleteStudentAlertModal();
            }
            else
            {
                alert("Cannot delete class.");
            }
        },
        complete: function () {
            isProcessing = false;
        }
    });
}