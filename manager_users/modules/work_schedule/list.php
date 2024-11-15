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
        header("Location: index.php?page_layout=list"); // Change to your desired page
        exit;
    } else {
        echo "Cập nhật thông tin không thành công.";
    }
}

?>
<?php 
    layouts('header');
?>

    <div class="grid__row">
        <!-- Sidebar -->
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
                        </a>
                    </li>
                </ul>
            </aside>
        </div>

<div class="grid__col-9">
    <hr>
    <h2>Danh sách ca làm việc </h2>
    <a class="btn btn-primary" href="?module=work_schedule&&action=add">Thêm ca làm việc</a>
    <table class="table custom-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhân viên</th>
                <th>Họ tên</th>
                <!-- <th>Ngày làm việc</th>
                <th>Thứ</th> -->
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
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
                    <!-- <td><?php echo $row['work_date']; ?></td>
                    <td><?php echo $row['day_of_week']; ?></td> -->
                    <td><?php echo $row['start_time']; ?></td>
                    <td><?php echo $row['end_time']; ?></td>
                    <td>
                        <a href="?module=work_schedule&action=list&schedule_id=<?php echo $row['employee_id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ca làm việc của nhân viên này?');">Delete</a>
                    </td>
                    <td>
                        <a href="?module=work_schedule&action=list&schedule_id=" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="showEditForm(<?php echo $row['employee_id']; ?>, '<?php echo $row['work_date']; ?>', '<?php echo $row['day_of_week']; ?>', '<?php echo $row['start_time']; ?>', '<?php echo $row['end_time']; ?>')">Edit</a>
                    </td>
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
