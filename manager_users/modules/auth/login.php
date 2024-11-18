<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
layouts('header');

if (isPost()) {
    $filterAll = filter();
    if (!empty(trim($filterAll['user'])) && !empty(trim($filterAll['pass']))) {
        $user = $filterAll['user'];
        $pass = $filterAll['pass'];

        // Truy vấn thông tin user từ cơ sở dữ liệu
        $userQuery = oneRaw("SELECT pass FROM users WHERE user ='$user'");

        if ($userQuery) {
            // So sánh mật khẩu nhập vào với mật khẩu từ cơ sở dữ liệu
            if ($pass === $userQuery['pass']) {
                // Kiểm tra quyền truy cập
                if ($user === 'admin') {
                    // Nếu là admin, chuyển hướng đến trang dashboard_admin
                    redirect('?module=home&&action=dashboard');
                } else {
                    // Nếu không phải admin, chuyển hướng đến trang dashboard_user
                    redirect('?module=home&&action=dashboard_user');
                }
            } else {
                // Nếu mật khẩu sai, hiển thị thông báo lỗi
                setFlashData('msg', 'Mật khẩu không chính xác');
                setFlashData('msg_type', 'danger');
                redirect('?module=auth&&action=login');
            }
        } else {
            // Nếu không tìm thấy tài khoản
            setFlashData('msg', 'Tài khoản không tồn tại');
            setFlashData('msg_type', 'danger');
            redirect('?module=auth&&action=login');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập tài khoản và mật khẩu');
        setFlashData('msg_type', 'danger');
        redirect('?module=auth&&action=login');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Quản lý nhân viên</h2>
        <?php
        if (!empty($msg)) {
            getMsg($msg, $msg_type);
        }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">User</label>
                <input name="user" type="user" class="form-control" placeholder="Tài khoản">
            </div>
            <div class="form-group mg-fomt">
                <label for="">Password</label>
                <input name="pass" type="pass" class="form-control" placeholder="Mật khẩu">
            </div>
            <button type="submit" class="mg-btm btn btn-primary btn-block">Đăng Nhập</button>
        </form>
    </div>
</div>
<?php
layouts('footer');
?>