<link rel="stylesheet" href="<?= base_url('assets/css/frontend/resource_toolbar.css') ?>">
<div class="main-resource-toolbar">
    <a href="<?= base_url('/') ?>" class="tab-item" data-id="0">首页</a>
    <a href="<?= base_url('resource/learning') ?>" class="tab-item" data-id="3">资源</a>
    <a href="<?= base_url('resource/education') ?>" class="tab-item" data-id="1">课件</a>
    <?php 
	//if ($this->session->userdata('user_type') == '1') { 
	if ($this->session->userdata('loginuserID') != '') { 
	?>
        <a href="<?= base_url('resource/lessonware') ?>" class="tab-item" data-id="4" hidden>新建课件</a>
        <a href="<?= base_url('resource/lessonware') ?>" class="tab-item" data-id="2">备课</a>
    <?php } ?>
    <?php if (false) { ?>
        <a href="<?= base_url('work/index') ?>" class="tab-item" data-id="5">作业</a>
    <?php } ?>
    <div class="tab-search">
        <div class="search-type" data-value="0" style="display: none;"><span>资源</span><i class="fa fa-caret-down"
                                                                  style="margin-left: 5px;"></i></div>
        <input type="text" class="search-txt" name="search-txt" placeholder="请输入搜索关键字">
        <div class="search-btn"><i class="fa fa-search" style="margin-right: 5px;"></i>搜索</div>
    </div>
    <div class="tab-search-selector">
        <div data-id="0" data-sel="1">资源</div>
        <!--        <div data-id="1">课件</div>-->
        <!--        <div data-id="2">备课</div>-->
    </div>
    <div class="tab-profile">
        <?php if ($this->session->userdata("loggedin") == TRUE) { ?>
            <a class="profile-name" href="<?= base_url('users/profile/' . $this->session->userdata('loginuserID')); ?>">
                <?= $this->session->userdata("user_name") ?></a>
            <a class="profile-icon"></a>
        <?php } else {
            if (true) { ?>
                <a class="profile-name" href="<?= base_url('api/getAuthCode'); ?>">登录 | 注册</a>
            <?php } else { ?>
                <a class="profile-name" href="<?= base_url('signin/signin'); ?>">登录 | 注册</a>
                <?php
            }
        }
        ?>
    </div>
    <div class="tab-profile-selector">
        <a data-id="0" href="<?= base_url('users/profile/' . $this->session->userdata('loginuserID')); ?>">个人中心</a>
        <a data-id="1" href="<?= base_url('signin/signout'); ?>">退出登录</a>
    </div>
    <script>
        $('.profile-name').on('click', function () {
            sessionStorage.removeItem('profile-subpage');
        });
        $('.tab-profile-selector a').on('click', function () {
            sessionStorage.removeItem('profile-subpage');
        });
    </script>
</div>
<script>
    $('.tab-search .search-type').on('click', function () {
        var that = $(this);
        var status = that.attr('data-sel');
        $('.tab-profile-selector').hide();
        return;
        if (!status) {
            $('.tab-search-selector').show();
            that.attr('data-sel', 1)
        } else {
            $('.tab-search-selector').hide();
            that.removeAttr('data-sel');
        }
    })
    $('.tab-search-selector div').on('click', function () {
        var that = $(this);
        var id = that.attr('data-id');
        that.parent().find('div').removeAttr('data-sel');
        $('.tab-search .search-type').attr('data-value', id);
        $('.tab-search .search-type span').html(that.html());
        that.attr('data-sel', 1);
        that.parent().hide();
    })
    $('.profile-icon').on('click', function () {
        var that = $(this);
        var status = that.attr('data-sel');
        $('.tab-search-selector').hide();
        if (!status) {
            $('.tab-profile-selector').show();
            that.attr('data-sel', 1)
        } else {
            $('.tab-profile-selector').hide();
            that.removeAttr('data-sel');
        }
    })
    $('.tab-profile-selector a').on('click', function () {
        var that = $(this);
        var id = that.attr('data-id');
        that.parent().hide();
    })
</script>