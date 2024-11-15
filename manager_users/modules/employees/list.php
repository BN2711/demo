<?php
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<?php
$sql = "SELECT * FROM employees";
$query = $conn->query($sql); 
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

        <!-- Content -->
        <div class="grid__col-9">
            <h2>Quản lý nhân viên</h2>
            <a class="btn btn-primary" href="?module=employees&&action=add">Thêm nhân viên</a>
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Mã nhân viên</th>
                        <th>Họ tên</th>
                        <th>Hình ảnh</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
         
         while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
             <tr>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><img src="<?php echo $row['image']; ?>" alt="Image" class="rounded-circle" width="50" height="50"></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><a href="?module=employees&action=delete&employee_id=<?php echo $row['employee_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?');">Delete</a></td>
                <td><a href="?module=employees&action=edit&employee_id=<?php echo $row['employee_id'];?>">Edit</a></td>
             </tr>
         <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    layouts('footer');
?>