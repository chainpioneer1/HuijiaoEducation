//////////


$(function () {
    $('.tab-item[data-id="2"]').attr('data-sel', 1);
    $('.tab-search').hide();

    $('#resource-nav-item' + (selectedIndex + 1)).css({background: 'url(' + baseURL + '/assets/images/resource/education/menu' + (selectedIndex + 1) + '_clicked.png)'});

    $('#resource-nav-item' + (selectedIndex + 1)).on('mouseout', function (object) {
        var id = $(this).attr('itemid');
        $(this).css({background: 'url(' + baseURL + 'assets/images/resource/education/menu' + (selectedIndex + 1) + '_clicked.png)'});
    });

    $('#resource-nav-item' + (selectedIndex + 1)).on('mouseover', function (object) {
        var id = $(this).attr('itemid');
        $(this).css({background: 'url(' + baseURL + 'assets/images/resource/education/menu' + (selectedIndex + 1) + '_clicked.png)'});
    });

    $('#delete_lw_item_btn').on("click", function (object) {
        var delete_id = $("#delete_lw_item_btn").attr("delete_lw_id");
        deleteItem(delete_id);
    });

    $('.lessonware_add_btn').on("click", function (object) {
        // $('.lessonware_container').fadeOut('middle');
        add_lw(this);
    });

    $('.lw_next_btn').on("click", function (object) {
        if ($("#uname").val() !== '') {
            showLessonWare(0, $("#uname").val());
        }
    });

    $('.name_remove_btn').on("click", function () {
        $('#uname').val("");
    });

});

function showVideo(self) {
    var item_id = self.getAttribute("item_id");
    var win = window.open(baseURL + "resource/previewPlayer/" + item_id, '_blank');
    win.focus();
}

function delete_lw(self) {
    var lw_id = self.getAttribute("item_id");
    $("#lw_info_id").val(lw_id);
    $("#delete_lw_item_btn").attr("delete_lw_id", lw_id);
    console.log($("#delete_lw_item_btn").attr("delete_lw_id"));
    var scale = _resize();

    $("#lw_delete_modal").modal({
        backdrop: 'false',
        keyboard: false
    });

    $('body').append($('.modal-backdrop'));
    $('body').append($('#lw_delete_modal'));
    // $("#lw_delete_modal").css({
    //     top: ($('body').scrollTop() + window.innerHeight / 2) / scale
    // })
}

function edit_lw(self) {
    var lw_id = self.getAttribute("item_id");
    var title = $(self).parent().parent().find('.lesson_td').html();
    showLessonWare(lw_id, title, false);
}

function deleteItem(delete_lw_id) {
    jQuery.ajax({
        type: "post",
        url: baseURL + "resource/delete",
        dataType: "json",
        data: {delete_lw_id: delete_lw_id},
        success: function (res) {
            if (res.status == 'success') {
                // $(".lessonware_table table tbody").html(res.data);
                console.log('courseware publish has been successed!')
                location.reload();
            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });
    jQuery('#lw_delete_modal').modal('toggle');
}

function publish_lw(self) {
    var publish_lw_id = self.getAttribute("item_id");
    var pub_st = 1 - parseInt(self.getAttribute("publish_status"));
    ///ajax process for publish/unpublish
    $.ajax({
        type: "post",
        url: baseURL + "resource/publish",
        dataType: "json",
        data: {publish_lw_id: publish_lw_id, publish_state: pub_st},
        success: function (res) {
            if (res.status == 'success') {
                console.log(res.data);
                // $(".lessonware_table table tbody").html(res.data);
                console.log('courseware publish has been successed!')
                location.reload();
            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });
}

function add_lw(self) {
    showLessonWare(0, "", false);
    return;
    _resize();
    $("#lw_modify_modal").modal({
        backdrop: 'static',
        keyboard: false
    });

    $('.click-event-sensor').on("click", function (object) {
        console.log('hide request')
        $("#lw_modify_modal").modal('hide');
        $('.lessonware_container').fadeIn('middle');
    })
}