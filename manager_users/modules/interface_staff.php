<?php
// Bao gồm các tệp cần thiết
layouts('header');

// Kiểm tra nếu session đã được khởi tạo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm các file cấu hình và kết nối
require_once('config.php');
require_once('./includes/connect.php');  
require_once('./includes/functions.php');
require_once('./includes/database.php');
require_once('./includes/session.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Lấy user_id từ session

    // Truy vấn dữ liệu từ cơ sở dữ liệu
    try {
        $query = "
            SELECT e.employee_id, e.name, e.email, e.phone, e.address, e.position, e.image
            FROM employees e
            INNER JOIN users u ON e.user_id = u.user_id
            WHERE e.user_id = :user_id AND u.user_id = :user_id
        ";

        // Chuẩn bị câu truy vấn
        $stmt = $conn->prepare($query);
        $stmt->execute(['user_id' => $user_id]);

        // Lấy kết quả
        $employee = $stmt->fetch();

        // Kiểm tra và hiển thị thông tin nhân viên
        if ($employee) {
            $employee_name = htmlspecialchars($employee['name']);
            $employee_email = htmlspecialchars($employee['email']);
            $employee_phone = htmlspecialchars($employee['phone']);
            $employee_address = htmlspecialchars($employee['address']);
            $employee_position = htmlspecialchars($employee['position']);
            $employee_image = $employee['image'];
        } else {
            $error_message = "Không tìm thấy thông tin nhân viên.";
        }
    } catch (Exception $e) {
        $error_message = "Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage();
    }
} else {
    $error_message = "Bạn chưa đăng nhập.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản lý nhân sự</title>
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <!-- Sidebar -->
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
                                <li><a href="?module=staff&&action=interface_salary"><i class="ri-arrow-drop-right-fill"></i>Bảng lương</a></li>
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

            <!-- Main Content -->
            <div class="admin-content">
                <!-- Top Bar -->
                <div class="admin-content-top">
                    <div class="admin-content-top-left">
                        <ul>
                            <li><i class="ri-search-line"></i></li>
                            <li><i class="ri-drag-move-line"></i></li>
                        </ul>
                    </div>
                    <div class="admin-content-top-right">
                        <ul>
                            <li><i class="ri-notification-3-line" number="3"></i></li>
                            <li><i class="ri-chat-3-line" number="5"></i></li>
                        </ul>
                    </div>
                </div>

                <!-- Main Dashboard -->
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="admin-content-main-content">
                        <h2>Thông tin nhân viên</h2>
                        <p><strong>Tên:</strong> <?php echo $employee_name ?? 'Chưa có tên'; ?></p>
                        <p><strong>Email:</strong> <?php echo $employee_email ?? 'Chưa có email'; ?></p>
                        <p><strong>Số điện thoại:</strong> <?php echo $employee_phone ?? 'Chưa có số điện thoại'; ?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $employee_address ?? 'Chưa có địa chỉ'; ?></p>
                        <p><strong>Chức vụ:</strong> <?php echo $employee_position ?? 'Chưa có chức vụ'; ?></p>
                        <div class="employee-image">
                            <img src="<?php echo $employee_image ?? 'default-avatar.png'; ?>" alt="Ảnh đại diện" class="rounded-circle" width="100" height="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
    layouts('footer');
?>
