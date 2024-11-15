<?php
$sql = "
    SELECT 
        e.employee_id,
        e.name,
        ws.work_date,
        ws.day_of_week,
        ws.start_time,
        ws.end_time
    FROM 
        employees e
    LEFT JOIN 
        work_schedule ws ON e.employee_id = ws.employee_id;
";

$query = $conn->query($sql);

// Check if there's a request to update
if (isset($_POST['sbm'])) {
    // Sanitize and retrieve POST data
    $employee_id = $_POST['employee_id'];
    $work_date = $_POST['work_date'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Update the work schedule
    $sql = "UPDATE work_schedule SET work_date = ?, day_of_week = ?, start_time = ?, end_time = ? WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$work_date, $day_of_week, $start_time, $end_time, $employee_id])) {
        // Optionally, redirect after success
        header("Location: ?module=work_schedule&action=list"); // Change to your desired page
        exit;
    } else {
        echo "Cập nhật thông tin không thành công.";
    }
}
?>
<div class="container">
    <hr>
    <h2>Danh sách ca làm việc </h2>
    <a class="btn btn-primary" href="?module=work_schedule&action=add">Thêm ca làm việc</a>
    <table class="table custom-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhân viên</th>
                <th>Họ tên</th>
                <th>Ngày làm việc</th>
                <th>Thứ</th>
                <th>Xóa</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1; // Khởi tạo biến đếm
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['work_date']; ?></td>
                    <td><?php echo $row['day_of_week']; ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal Cập Nhật -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Cập nhật ca làm việc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action=""> <!-- Specify the correct action file here -->
                        <input type="hidden" id="edit_employee_id" name="employee_id">
                        <div class="form-group">
                            <label for="edit_work_date">Ngày làm việc:</label>
                            <input type="date" id="edit_work_date" name="work_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_day_of_week">Thứ:</label>
                            <select id="edit_day_of_week" name="day_of_week" class="form-control" required>
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
                            <label for="edit_start_time">Thời gian bắt đầu:</label>
                            <input type="time" id="edit_start_time" name="start_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_end_time">Thời gian kết thúc:</label>
                            <input type="time" id="edit_end_time" name="end_time" class="form-control" required>
                        </div>
                        <button type="button" class="btn-secondary" data-dismiss="modal">Hủy</button>
                        <button name="sbm" type="submit" class="btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showEditForm(employee_id, work_date, day_of_week, start_time, end_time) {
    document.getElementById('edit_employee_id').value = employee_id;
    document.getElementById('edit_work_date').value = work_date;
    document.getElementById('edit_day_of_week').value = day_of_week;
    document.getElementById('edit_start_time').value = start_time;
    document.getElementById('edit_end_time').value = end_time;
}
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
