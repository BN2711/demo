<?php
// Chuẩn bị truy vấn để lấy thông tin nhân viên
$sql_up = "SELECT * FROM work_schedule WHERE employee_id = ?";
$stmt = $conn->prepare($sql_up);
$stmt->execute([$employee_id]);
$row_up = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['sbm'])) {
    $work_date = $_POST['work_date'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    

    // Sử dụng prepared statement để tránh SQL injection
    $sql = "UPDATE work_schedule SET work_date = ?, day_of_week = ?,  start_time= ?,  end_time= ? WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);

    // Thực thi truy vấn
    if ($stmt->execute([$work_date, $day_of_week, $start_time, $end_time, $employee_id])) {
        // Chuyển hướng về trang danh sách nhân viên
       
        exit; // Dừng lại ngay sau khi chuyển hướng
    } else {
        echo "Cập nhật thông tin không thành công.";
    }
}
