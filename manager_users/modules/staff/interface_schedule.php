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
            SELECT work_date, day_of_week, start_time, end_time
            FROM work_schedule 
            INNER JOIN employees ON  employees.employee_id	= work_schedule.employee_id
            WHERE employees.user_id = :user_id
        ";

        // Chuẩn bị câu truy vấn
        $stmt = $conn->prepare($query);
        $stmt->execute(['user_id' => $user_id]);

        // Lấy kết quả
        $schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Kiểm tra và hiển thị thông tin nhân viên
        if (!$schedule) {
            $error_message = "Không tìm thấy lịch làm việc.";
        }
    } catch (Exception $e) {
        $error_message = "Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage();
    }
} else {
    $error_message = "Bạn chưa đăng nhập.";
}
?>

<body>
    <section class="admin">
        <div class="row-grid">
            <!-- Sidebar -->
            <?php layouts('sidebar_user'); ?>

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

                <div class="admin-content-main-content">
                    <h2>Lịch làm việc</h2>
                    <?php if (!empty($schedule)) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table__header">STT</th>
                                    <th class="table__header">Thứ</th>
                                    <th class="table__header">Ngày làm việc</th>
                                    <th class="table__header">Giờ vào làm</th>
                                    <th class="table__header">Giờ tan làm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ordinalNumber = 1; // Khởi tạo biến STT
                                foreach ($schedule as $row) {
                                ?>
                                    <tr>
                                        <td class="table__data"><?php echo $ordinalNumber; ?></td>
                                        <td class="table__data"><?php echo htmlspecialchars($row['day_of_week']); ?></td>
                                        <td class="table__data"><?php echo htmlspecialchars($row['work_date']); ?></td>
                                        <td class="table__data"><?php echo htmlspecialchars($row['start_time']); ?></td>
                                        <td class="table__data"><?php echo htmlspecialchars($row['end_time']); ?></td>

                                    </tr>
                                <?php
                                    $ordinalNumber++; // Tăng số thứ tự
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p><?php echo $error_message; ?></p>
                    <?php } ?>
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