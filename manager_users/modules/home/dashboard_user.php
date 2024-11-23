<?php
if(!defined('_CODE')){
    die('Access denied...');
   
}
require_once( _WEB_PATH_TEMPLATES.'/layout/header.php');
?>

<?php
require_once( _WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
<body>
<section class="admin">
    <div class="row-grid">
        <div class="admin-sidebar">
            <div class="admin-sidebar-top">
                <img src="https://cdn.vietnambiz.vn/2019/10/3/color-silhouette-cartoon-facade-shop-store-vector-14711058-1570007843495391141359-1570076859193969194096-15700769046292030065819-1570076927728377843390.png" width="50%" height="70" alt="Profile">
            </div>
            <div class="admin-sidebar-content">
                <ul>

                    <li><a href=""><i class="ri-dashboard-line"></i> Dashboard</a></li>
                    <li><a href="http://localhost/qlinv/?act=product"><i class="ri-group-fill"></i>Thông tin cá nhân<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=staff&&action=interface_staff"><i class="ri-arrow-drop-right-fill"></i>Danh sách nhân viên</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-calendar-check-fill"></i>Lịch làm việc<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=staff&&action=interface_schedule"><i class="ri-arrow-drop-right-fill"></i>Danh sách ca làm việc</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-wallet-3-line"></i> Bảng lương<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=staff&&action=interface_slary"><i class="ri-arrow-drop-right-fill"></i>Bảng lương </a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-user-star-line"></i> Tài khoản<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=auth&&action=logout"><i class="ri-arrow-drop-right-fill"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="admin-content">
<div class="admin-content-top">
    <div class="admin-content-top-left">
        <ul>
            <li>
                <i class="ri-search-line"></i>
            </li>
            <li>  <i class="ri-drag-move-line"></i></li>
        </ul>
        </div>
    <div class="admin-content-top-right">
        <ul>
            <li>
                <i class="ri-notification-3-line"number="3"> </i > </li>
            <li><i class="ri-chat-3-line " number="5"></i></li>
        </ul>
    </div>
    </div>
    <div class="admin-content-main">
        <div class="admin-content-main-title">
            <h1>Dashboard</h1>
        </div>
        <div class="admin-content-main-content">
            //
        </div>

</div>

        </div>
    </div>

<?php
require_once( _WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
