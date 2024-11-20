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
<body>
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
                    <li><a href=""><i class="ri-group-fill"></i> Quản lí nhân sự<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=employees&&action=list"><i class="ri-arrow-drop-right-fill"></i>Danh sách nhân viên</a></li>
                            <li><a href="?module=employees&&action=add"><i class="ri-arrow-drop-right-fill"></i>Tạo danh sách nhân viên</a></li>
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Tạo tài khoản nhân viên</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-calendar-check-fill"></i> Thiết lập lịch làm việc<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Tạo danh sách đăng kí ca làm việc</a></li>
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Danh sách ca làm việc</a></li>
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Bảng chấm công làm việc</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-wallet-3-line"></i> Quản lí lương<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Bảng tính lương</a></li>
                            <li><a href=""><i class="ri-arrow-drop-right-fill"></i>Danh sách bảng lương nhân viên</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-folder-chart-line"></i> Báo cáo & phân tích<i class="ri-arrow-left-s-fill"></i></a></li>
                    <li><a href=""><i class="ri-verified-badge-line"></i> Quản lí đơn từ<i class="ri-arrow-left-s-fill"></i></a></li>
                    <li><a href=""><i class="ri-star-line"></i> Khen thưởng & kỉ luật<i class="ri-arrow-left-s-fill"></i></a></li>
                    <li><a href=""><i class="ri-user-star-line"></i> Tài khoản<i class="ri-arrow-left-s-fill"></i></a>
                        <ul class="sub-menu">
                            <li><a href="?module=auth&&action=logout"><i class="ri-arrow-drop-right-fill"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="admin-content">
            <div class="admin-content-top">
                <div class="admin-content-top-left">
                    <ul>
                        <li><i class="ri-search-line"></i></li>
                        <li><i class="ri-drag-move-line"></i></li>
                    </ul>
                </div>
                <div class="admin-content-top-right">
                    <ul>
                        <li><i class="ri-notification-3-line" data-number="3"></i></li>
                        <li><i class="ri-chat-3-line" data-number="5"></i></li>
                    </ul>
                </div>
            </div>

                <div class="admin-content-main-content">
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
                            <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
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
    </div>
</section>
</body>



<?php
    layouts('footer');
?>
