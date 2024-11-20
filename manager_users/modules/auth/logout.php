<?php
if(!defined('_CODE')){
    die('Access denied...');
}
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Tiến hành xử lý đăng xuất ở đây
session_unset(); // Hủy các biến session
session_destroy(); // Hủy session

// Chuyển hướng về trang đăng nhập hoặc trang khác
redirect('?module=auth&&action=login');
?>
