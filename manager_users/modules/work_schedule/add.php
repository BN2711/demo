<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
$sql_su = "SELECT * FROM employees";
$query = $conn->query($sql_su); // Use PDO's query method to execute SQL

if (isset($_POST['sbm'])) {
    $employee_id = $_POST['employee_id'];
    $work_date = $_POST['work_date'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];



    // Sử dụng prepared statement để tránh SQL injection
    $sql = "INSERT INTO work_schedule (employee_id,work_date , day_of_week, start_time,end_time ) VALUES ('$employee_id','$work_date','$day_of_week','$start_time','$end_time')";
    $query = $conn->query($sql);

    // Chuyển hướng về trang danh sách nhân viên
    redirect('?module=work_schedule&&action=list');
}
?>
<div class="container">
    <hr>
    <h2>Thêm Ca Làm Việc</h2>
    <form class="form-body" method="POST">
        <div class="form-group">
            <label for="employee_id" class="form-label">Mã nhân viên</label>
            <select class="form-control" id="employee_id" name="employee_id" required>
                <option value="">Chọn nhân viên</option> <!-- Thêm tùy chọn để người dùng có thể chọn -->
                <?php
                while ($row_s = $query->fetch(PDO::FETCH_ASSOC)) {
                    // Cấu trúc lại thẻ option để hiển thị tên nhân viên
                    echo '<option value="' . $row_s["employee_id"] . '">' . $row_s["employee_id"] . ' - ' . $row_s["name"] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="work_date">Ngày làm việc:</label>
            <input type="date" class="form-control" id="work_date" name="work_date" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="day_of_week">Thứ:</label>
            <select class="form-control" id="day_of_week" name="day_of_week" required>
                <option value="">Chọn thứ</option>
                <option value="Monday">Thứ Hai</option>
                <option value="Tuesday">Thứ Ba</option>
                <option value="Wednesday">Thứ Tư</option>
                <option value="Thursday">Thứ Năm</option>
                <option value="Friday">Thứ Sáu</option>
                <option value="Saturday">Thứ Bảy</option>
                <option value="Sunday">Chủ Nhật</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="start_time">Thời gian bắt đầu:</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="end_time">Thời gian kết thúc:</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>
        <button name="sbm" type="submit" class="btn-primary">Thêm ca làm việc</button>
        <a href="?module=work_schedule&&action=list" class="btn btn-secondary">Quay lại</a>
    </form>
</div>