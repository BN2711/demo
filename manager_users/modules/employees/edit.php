<?php
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<?php
$employee_id = $_GET['employee_id'];

// Chuẩn bị truy vấn để lấy thông tin nhân viên
$sql_up = "SELECT * FROM employees WHERE employee_id = ?";
$stmt = $conn->prepare($sql_up);
$stmt->execute([$employee_id]);
$row_up = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['sbm'])) {
    $name = $_POST['name'];

    // Giữ lại ảnh cũ nếu không có ảnh mới được tải lên
    if (!empty($_FILES['image']['name'])) {
        // Nếu có ảnh mới, lấy tên ảnh
        $image_name = $_FILES['image']['name'];
        $image_path = $image_name; // Cập nhật đường dẫn mới nếu cần
        // Không di chuyển tệp ảnh
    } else {
        // Nếu không có ảnh mới, giữ lại ảnh cũ
        $image_path = $row_up['image'];
    }

    // Lấy các thông tin khác
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    

    // Sử dụng prepared statement để tránh SQL injection
    $sql = "UPDATE employees SET name = ?, image = ?, email = ?, phone = ?, address = ? WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);

    // Thực thi truy vấn
    if ($stmt->execute([$name, $image_path, $email, $phone, $address, $employee_id])) {
        // Chuyển hướng về trang danh sách nhân viên
        header('Location: ?module=employees&action=list');
        exit; // Dừng lại ngay sau khi chuyển hướng
    } else {
        echo "Cập nhật thông tin không thành công.";
    }
}
?>

<div class="modal-overlay">
    <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5>Sửa Danh sách nhân viên</h5>
                <button type="button" onclick="closeModal()" style="font-size: 1.2em; border: none; background: none;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="employeeName">Tên nhân viên</label>
                    <input type="text" name="name" id="employeeName" required value="<?php echo $row_up['name']; ?>">
                </div>
                <div class="form-group">
                   
                    <label for="employeePhoto">Ảnh</label>
    <input type="file" name="image" id="employeePhoto"> <!-- Không sử dụng value ở đây -->
    
    <!-- Hiển thị ảnh hiện tại nếu có -->
    <?php if (!empty($row_up['image'])): ?>
        <div>
            <img src="<?php echo htmlspecialchars($row_up['image']); ?>" width="100" alt="Current Photo" />
        </div>
    <?php else: ?>
        <p>Chưa có ảnh hiện tại.</p>
    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="employeeEmail">Email</label>
                    <input type="email" name="email" id="employeeEmail" required value="<?php echo htmlspecialchars($row_up['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="employeePhone">Số điện thoại</label>
                    <input type="text" name="phone" id="employeePhone" required value="<?php echo htmlspecialchars($row_up['phone']); ?>">
                </div>
                <div class="form-group">
                    <label for="employeeAddress">Địa chỉ</label>
                    <input type="text" name="address" id="employeeAddress" required value="<?php echo htmlspecialchars($row_up['address']); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <a href="?module=employees&&action=list" class="btn-primary">Hủy</a>
                <button name="sbm" type="submit" class="btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
