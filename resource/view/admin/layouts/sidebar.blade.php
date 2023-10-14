<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">املاک</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" navigation-header"><span>لینک ها</span></li>
            <li class=" nav-item <?= activeMenu(route("admin.index")) ?>"><a href="<?= route("admin.index") ?>"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Email">خانه</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.category.index") , "category") ?>"><a href="<?= route("admin.category.index") ?>"><i class="feather icon-message-square"></i><span class="menu-title" data-i18n="Chat">دسته بندی</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.news.show"), "news") ?>"><a href="<?= route("admin.news.show") ?>"><i class="feather icon-check-square"></i><span class="menu-title" data-i18n="Todo">اخبار</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.ads.show"), "ads") ?>"><a href="<?= route("admin.ads.show") ?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">آگهی</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.slide.index") , "slide") ?>"><a href="<?=route("admin.slide.index")?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">اسلاید شو</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.comment.index") , "comment") ?>"><a href="<?= route("admin.comment.index") ?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">نظرات</span></a></li>
            <li class=" nav-item <?= activeMenu(route("admin.user.show") , 'user') ?>"><a href="<?= route("admin.user.show") ?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">کاربران</span></a></li>

        </ul>
    </div>
</div>