<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/home.css') ?>">
<?php
if(!isset($form_validation))$form_validation = 'No';
if ($form_validation != 'No') $form_validation = 'Information error';
?>
<script>
    var isErr = '<?=$form_validation?>';
    var term = '<?=$this->session->userdata('user_account')?>';
</script>
<div class="base-container">
    <div class="home-bg">
        <div class="profile-info-edit-wrap">
            <div class="edit-info-modal" style="width: 55%; height: 54%">
                <div class="edit-modal-header">
                    <h5>修改同步教材</h5>
                    <span onclick="onCloseInfoModal()"></span>
                </div>
                <div class="edit-modal-body">
                    <div class="info-subject">
                        <span>科目：</span>
                        <div class="subject-list">
                            <?php foreach ($subjectTermArr as $arr) { ?>
                                <div class="subject-item item-<?= $arr['subject']->id ?>" data-id="<?= $arr['subject']->id ?>" onclick="onSelSubject(this, <?=$arr['subject']->id?>)"><?= $arr['subject']->title ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sep-line"></div>
                    <div class="info-content">
                        <span style="height: 100px;">册次：</span>
                        <?php foreach ($subjectTermArr as $arr) { ?>
                            <div class="subject-list list-<?= $arr['subject']->id ?>">
                                <?php foreach ($arr['terms'] as $arr) { ?>
                                    <div class="content-item item-<?= $arr->id ?>" data-id="<?= $arr->id ?>" onclick="onSelContent(this, <?= $arr->id ?>)"><?= $arr->title?></div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="info-confirm-btn">
                        <span onclick="onConfirmInfo()"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    $(function () {
        $('.top-back').remove();
        if (isErr != 'No') {
            $('.login-err').fadeIn('fast');
        }
        $('.login-btn').on('click', function (object) {
            $('.login_form').submit();
        })
    })

</script>



<script>

    var active_term_id = null;
    var active_subject_id = null;

    $(document).ready(function(){
        active_term();
        onEditInfo();
    })

    var isProcessing = false;
    function onConfirmInfo() {
        jQuery.ajax({
            type: "post",
            url: baseURL + "users/setTerm",
            dataType: "json",
            data: {
                term_id: active_term_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    $('.profile-info-edit-wrap').fadeOut(100);
                    window.location.href = '<?= base_url('resource/index') ?>'
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

    function onEditInfo() {
        $('.profile-info-edit-wrap').fadeIn(100);
    }

    function onCloseInfoModal() {
        $('.profile-info-edit-wrap').fadeOut(100);
    }

    function  onSelSubject(self, id) {
        active_subject_id = id;

        var terms = $('.subject-list.list-' + active_subject_id + ' .content-item');
        if( !terms.length ) active_term_id = null;
        else active_term_id = $(terms[0]).attr('data-id');
        active_term();
    }

    function onSelContent(self, id){
        active_term_id = id;
        active_term();
    }

    function active_term(){
        $('.subject-item').removeClass('active');
        $('.content-item').removeClass('active');
        $('.info-content .subject-list').removeClass('active');

        if( !active_subject_id ){
            var subjects = $('.subject-item');
            if( !subjects.length ) return;
            else active_subject_id = $(subjects[0]).attr('data-id');
        }

        if( !active_term_id ){
            var terms = $('.subject-list.list-' + active_subject_id + ' .content-item');
            if( !terms.length ) return;
            else active_term_id = $(terms[0]).attr('data-id');
        }

        $('.subject-item.item-' + active_subject_id).addClass('active');
        $('.info-content .subject-list.list-' + active_subject_id).addClass('active');
        $('.content-item.item-' + active_term_id).addClass('active');

    }

</script>


<script src="<?= base_url('assets/js/frontend/hj_login.js') ?>"></script>
