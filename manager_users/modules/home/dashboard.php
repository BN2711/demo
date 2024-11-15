<?php
if(!defined('_CODE')){
    die('Access denied...');
   
}
require_once( _WEB_PATH_TEMPLATES.'/layout/header.php');
?>

<?php
require_once( _WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
<div class="grid__col-2">
    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-house sidebar__icon"></i>
                    Trang chủ
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-money-bill sidebar__icon"></i>
                    Lương
                    <i class="fa-solid fa-caret-down sidebar__icon-down"></i>
                </a>
                
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-users sidebar__icon"></i>
                    Bảng châm công
                    <i class="fa-solid fa-caret-down sidebar__icon-down"></i>
                </a>
                <ul class="subnav">
                    <li class="subnav-item">
                        <a href="?module=work_schedule&&action=list" class="subnav-link">
                            <i class="fa-solid fa-circle subnav__icon"></i>
                            Danh sách ca làm việc
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-user sidebar__icon"></i>
                    Nhân viên
                    <i class="fa-solid fa-caret-down sidebar__icon-down"></i>
                </a>
                <ul class="subnav">
                    <li class="subnav-item">
                        <a href="?module=employees&&action=list" class="subnav-link">
                            <i class="fa-solid fa-circle subnav__icon"></i>
                            Danh sách nhân viên
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-star sidebar__icon"></i>
                    Logout
                    <i class="fa-solid fa-caret-down sidebar__icon-down"></i>
                </a>
            </li>
        </ul>
    </aside>
</div>