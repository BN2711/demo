<?php
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<?php
if (isset($_POST['sbm'])) {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $image_tmp =$_FILES['image']['tmp_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    
    // Sử dụng prepared statement để tránh SQL injection
    $sql = "INSERT INTO employees (name, image, email, phone, address) VALUES ('$name','$image','$email','$phone','$address')";
    $query = $conn->query($sql); 
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
    
        // Chuyển hướng về trang danh sách nhân viên
        header('Location: ?module=employees&action=list');
    
}
?>
<div class="modal-overlay">
    <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5>Thêm nhân viên mới</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="employeeName">Tên nhân viên</label>
                    <input type="text" name="name" id="employeeName" required>
                </div>
                <div class="form-group">
                    <label for="employeePhoto">Ảnh</label>
                    <input type="file" name="image" id="employeePhoto"required >
                </div>
                <div class="form-group">
                    <label for="employeeEmail">Email</label>
                    <input type="email" name="email" id="employeeEmail" required>
                </div>
                <div class="form-group">
                    <label for="employeePhone">Số điện thoại</label>
                    <input type="text" name="phone" id="employeePhone" required>
                </div>
                <div class="form-group">
                    <label for="employeeAddress">Địa chỉ</label>
                    <input type="text" name="address" id="employeeAddress" required>
                </div>
            </div>
            <div>
                <a href="?module=employees&&action=list" class="btn-primary">Hủy</a>
                <button name="sbm" type="submit" class="btn-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>