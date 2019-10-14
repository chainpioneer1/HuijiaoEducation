<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/hj_lessonware_home.css') ?>">
<style>
    .header-bar > .main-menu {
        height: 130px;
    }

    .tab-profile {
        position: absolute;
    }
</style>
<div class="base-container" style="top:160px;text-align: center;height: 650px;">
    <div class="course-container site-course-selector" style="border: 1px solid #888;">
        <div class="list-container" style="width: 100%; border: none;height: 94%;">
            <div class="list-title">平台资源选择</div>
            <div class="edit-btns" data-type="reject" style="position:absolute;color:white;font-size:28px;right: 20px;top:2px;">
                <i class="fa fa-close"></i>
            </div>
            <iframe src="<?= base_url('helper/selectContent'); ?>" width="1280" height="720"
                    style="width: 100%;height:100%;border:none;outline:none;"></iframe>
            <!--<div>
                <div class="header-item item-title">
                    <div class="title-label">科目</div>
                    <div class="item-select subject" data-type="contents">
                        <?= (($subjects != null) ? $subjects[0]->title : ''); ?>
                        <div></div>
                    </div>
                </div>
                <div class="header-item item-title">
                    <div class="title-label">册次</div>
                    <div class="item-select term" data-type="contents">
                        <?= (($terms != null) ? $terms[0]->title : ''); ?>
                        <div></div>
                    </div>
                </div>
                <div class="header-item item-title">
                    <div class="title-label">课次</div>
                    <div class="item-select coursetype" data-type="contents" style="width: 300px;">
                        <span>&nbsp;</span>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="content-items" data-type="contents" style="background:#eee;"></div>-->

<!--            <div class="content-titleinfo" data-type="contents"></div>-->
        </div>
        <div class="subject-select" data-type="contents">
            <div class="select-list"></div>
        </div>
        <div class="term-select" data-type="contents">
            <div class="select-list"></div>
        </div>
        <div class="coursetype-select" data-type="contents" style="width: 300px;">
            <div class="select-list" style="height:320px;overflow-y: auto;"></div>
        </div>
<!--        <div class="footer-item">-->
<!--            <div class="edit-btns" data-type="reject">取 消</div>-->
<!--            <div class="edit-btns" data-type="accept">确 定</div>-->
<!--        </div>-->
    </div>

    <div class="course-container">
        <div class="header-part">
            <div class="header">
                <div class="header-item">
                    <div class="item-label">新建课件名称</div>
                    <input class="item-select" placeholder="请输入新建课件名称"/>
                    <div class="notice-label">（最多不超过18个字符。）</div>
                </div>
                <div class="header-item">
                    <div class="item-label">所属科目</div>
                    <div class="item-select subject" data-type="lesson">
                        <?= ((count($subjects) > 0) ? $subjects[0]->title : ''); ?>
                        <div></div>
                    </div>
                </div>
                <div class="header-item">
                    <div class="item-label">所属册次</div>
                    <div class="item-select term" data-type="lesson">
                        <?= ((count($terms) > 0) ? $terms[0]->title : ''); ?>
                        <div></div>
                    </div>
                </div>
            </div>
			<div class="preview-upload-area">上传封面图
            <div class="edit-btns img_preview"  data-type="upload-image" item-type="4"></div>
			<div style="position: absolute; bottom:30px;width: 100%;font-size: 10px;color: #888;">(支持jpg、png或bmp格式的图片， 建议图片小于2M。)</div>
			</div>
        </div>

        <div class="list-container edit-area">
            <div class="list-title">
                <div class="edit-btns" data-type="moveLeft" style="display: none;"></div>
                <div class="edit-btns" data-type="moveRight" style="display: none;"></div>
                <div class="edit-btns" data-type="play" style="display: none;"></div>
                <div class="edit-btns" data-type="delete" style="display: none;"></div>
                <div class="edit-btns" data-type="upload">本 地 上 传</div>
                <div class="edit-btns" data-type="platform">平 台 资 源</div>
            </div>
            <div class="content-items" data-type="lesson"></div>
            <div class="content-titleinfo" data-type="lesson"></div>
        </div>

        <div class="footer-item">
            <div class="edit-btns" data-type="cancel"></div>
            <div class="edit-btns" data-type="preview"></div>
            <div class="edit-btns" data-type="save"></div>
        </div>

        <div class="subject-select" data-type="lesson">
            <div class="select-list"></div>
        </div>
        <div class="term-select" data-type="lesson">
            <div class="select-list"></div>
        </div>
    </div>
</div>

<form class="form-horizontal" enctype="multipart/form-data"
      action="" id="upload_lw_submit_form" role="form" hidden style="display: none"
      method="post" accept-charset="utf-8">
    <input type="file" id="upload_lw_courseware" class="form-control" name="add_file_name"
           accept=".zip,.png,.jpg,.bmp,.gif,.jpeg,.mp4,.mp3,.pdf,.html,.htm,.doc,.docx,.ppt,.pptx">
    <input type="file" id="upload_lw_image" class="form-control" name="add_file_name1"
           accept=".png,.jpg,.bmp,.gif,.jpeg">
    <input id="upload_lw_name" name="upload_lw_name">
    <input id="upload_userId" name="upload_userId">
    <input id="upload_lesson_id" name="upload_lesson_id">
    <input id="upload_lw_type" name="upload_lw_type">
    <input id="upload_lw_img_type" name="upload_lw_img_type">
</form>

<!--****** delete modal*****  -->
<div id="lw_delete_modal" class="modal fade">
    <div class="msg-content">取消后编辑内容将不保存，<br>是否取消？</div>
    <a id="delete_lw_item_btn" onclick="cancelEdit(this)"></a>
    <a data-dismiss="modal" id="no_lw_item_btn"></a>
</div>
<div class="scripts" style="display: none;" hidden>
    <input class="subjects" value='<?= json_encode($subjects) ?>'>
    <input class="terms" value='<?= json_encode($terms) ?>'>
    <input class="lessonContents" value='<?= json_encode($lessonContents) ?>'>
    <input class="lessonItem" value='<?= json_encode($lesson) ?>'>
    <script>
        var _subjects = JSON.parse($('input.subjects').val());
        var _terms = JSON.parse($('input.terms').val());
        var _lessonContents = JSON.parse($('input.lessonContents').val());
        var _lessonItem = JSON.parse($('input.lessonItem').val());
        var loggedUserId = "<?= $this->session->userdata('loginuserID')?>";
    </script>
    <script src="<?= base_url('assets/js/hj_lessonware_home.js') ?>" type="text/javascript"></script>
</div>
