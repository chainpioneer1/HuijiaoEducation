
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!----------Course Manage Side Menu------------>
            <li class="nav-item mainmenu" data-id="0">
                <a class="nav-link menu-title">
                    <i class="icon-home"></i>
                    <span class="title">分类管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="0">
                <a href="<?= base_url('admin/subjects') ?>" class="nav-link" menu_id="00">
                    <i class="icon-picture"></i>
                    <span class="title">科目分类</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="0">
                <a href="<?= base_url('admin/terms') ?>" class="nav-link" menu_id="01">
                    <i class="icon-picture"></i>
                    <span class="title">册次分类</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="0">
                <a href="<?= base_url('admin/coursetypes') ?>" class="nav-link" menu_id="02">
                    <i class="icon-picture"></i>
                    <span class="title">课程分类</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="0">
                <a href="<?= base_url('admin/contenttypes') ?>" class="nav-link" menu_id="03">
                    <i class="icon-picture"></i>
                    <span class="title">资源类型分类</span>
                </a>
            </li>
            <li class="nav-item mainmenu" data-id="1">
                <a class="nav-link menu-title">
                    <i class="icon-home"></i>
                    <span class="title">标准内容管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="1">
                <a href="<?= base_url('admin/contents') ?>" class="nav-link" menu_id="10">
                    <i class="icon-picture"></i>
                    <span class="title">资源管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="1">
                <a href="<?= base_url('admin/lessons') ?>" class="nav-link" menu_id="11">
                    <i class="icon-picture"></i>
                    <span class="title">课件管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="1">
                <a href="<?= base_url('admin/questions') ?>" class="nav-link" menu_id="12">
                    <i class="icon-picture"></i>
                    <span class="title">题目管理</span>
                </a>
            </li>

            <li class="nav-item mainmenu" data-id="2">
                <a class="nav-link menu-title">
                    <i class="icon-home"></i>
                    <span class="title">首页管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="2">
                <a href="<?= base_url('admin/banner') ?>" class="nav-link" menu_id="13">
                    <i class="icon-picture"></i>
                    <span class="title">Banner管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="2">
                <a href="<?= base_url('admin/recommend') ?>" class="nav-link" menu_id="14">
                    <i class="icon-picture"></i>
                    <span class="title">资源精选管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="2">
                <a href="<?= base_url('admin/recommend/lessons') ?>" class="nav-link" menu_id="15">
                    <i class="icon-picture"></i>
                    <span class="title">课件精选管理</span>
                </a>
            </li>

            <li class="nav-item mainmenu" data-id="3">
                <a class="nav-link menu-title">
                    <i class="icon-home"></i>
                    <span class="title">移动端首页</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/banner/mobile') ?>" class="nav-link" menu_id="113">
                    <i class="icon-picture"></i>
                    <span class="title">Banner管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/recommend/mobile/2') ?>" class="nav-link" menu_id="114">
                    <i class="icon-picture"></i>
                    <span class="title">资源精选管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/recommend/mobile/3') ?>" class="nav-link" menu_id="115">
                    <i class="icon-picture"></i>
                    <span class="title">小学语文</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/recommend/mobile/4') ?>" class="nav-link" menu_id="116">
                    <i class="icon-picture"></i>
                    <span class="title">小学数学</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/recommend/mobile/5') ?>" class="nav-link" menu_id="117">
                    <i class="icon-picture"></i>
                    <span class="title">初中数学</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="3">
                <a href="<?= base_url('admin/recommend/mobile/6') ?>" class="nav-link" menu_id="118">
                    <i class="icon-picture"></i>
                    <span class="title">初中物理</span>
                </a>
            </li>
            <!----------New course manage-------------------->
            <li class="nav-item mainmenu" data-id="4">
                <a class="nav-link menu-title" id="newcourse_menu">
                    <i class="icon-docs"></i>
                    <span class="title">用户内容管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="4">
                <a href="<?= base_url('admin/lessons_user') ?>" class="nav-link" menu_id="20">
                    <i class="icon-layers"></i>
                    <span class="title">备课管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="4">
                <a href="<?= base_url('admin/teacherwork') ?>" class="nav-link" menu_id="21">
                    <i class="icon-layers"></i>
                    <span class="title">作业管理</span>
                </a>
            </li>
            <li class="nav-item mainmenu" data-id="5">
                <a class="nav-link menu-title">
                    <i class="icon-user"></i>
                    <span class="title">后台管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="5">
                <a href="<?= base_url('admin/admins') ?>" class="nav-link" menu_id="40">
                    <i class="icon-notebook"></i>
                    <span class="title">管理员管理</span>
                </a>
            </li>
            <li class="nav-item mainmenu" data-id="6">
                <a class="nav-link menu-title">
                    <i class="icon-user"></i>
                    <span class="title">数据统计</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/users') ?>" class="nav-link" menu_id="30">
                    <i class="icon-briefcase"></i>
                    <span class="title">用户信息管理</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/users/register_info') ?>" class="nav-link" menu_id="50">
                    <i class="icon-notebook"></i>
                    <span class="title">登录信息统计</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/usage') ?>" class="nav-link" menu_id="51">
                    <i class="icon-notebook"></i>
                    <span class="title">资源使用详情</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/usage/lessons') ?>" class="nav-link" menu_id="52">
                    <i class="icon-notebook"></i>
                    <span class="title">课件使用详情</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/questions/usage') ?>" class="nav-link" menu_id="53">
                    <i class="icon-notebook"></i>
                    <span class="title">题目使用详情</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/users/school_info') ?>" class="nav-link" menu_id="54">
                    <i class="icon-notebook"></i>
                    <span class="title">学校信息统计</span>
                </a>
            </li>
            <li class="nav-item submenu" data-id="6">
                <a href="<?= base_url('admin/usage/usage') ?>" class="nav-link" menu_id="55">
                    <i class="icon-notebook"></i>
                    <span class="title">使用情况统计</span>
                </a>
            </li>
            <li class="nav-item" style="display: none">
                <a href="<?= base_url('admin') ?>" class="nav-link" menu_id="54">
                    <i class="icon-notebook"></i>
                    <span class="title"> </span>
                </a>
            </li>
        </ul>
        <script>
            $('.nav-item.submenu').hide();
            $('.nav-item.mainmenu').on('click', function () {
                var that = $(this);
                var id = that.attr('data-id');
                $('.nav-item.submenu').slideUp(200);
                $('.nav-item.submenu[data-id="'+id+'"]').slideDown(200);
            });
            $(function () {
                setTimeout(function () {
                    var id = $('.nav-link.menu-selected').parent().attr('data-id');
                    $('.nav-item[data-id="'+id+'"]').show();
                },1)
            });
        </script>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->


