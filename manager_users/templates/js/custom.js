document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM đã sẵn sàng!");

    const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');

    // Đảm bảo rằng các phần tử được chọn đúng
    console.log(menuLi);

    menuLi.forEach((menuItem, index) => {
        menuItem.addEventListener('click', (e) => {
            e.preventDefault();

            // Đóng tất cả submenu trước
            const allSubmenus = document.querySelectorAll('.admin-sidebar-content > ul > li > ul');
            allSubmenus.forEach(submenu => submenu.classList.remove('active'));

            // Mở submenu của mục hiện tại
            const submenu = menuItem.parentNode.querySelector('ul');
            if (submenu) {
                submenu.classList.toggle('active');
            }

            // Đảm bảo chỉ có một mục active
            const activeLi = document.querySelector('.admin-sidebar-content > ul li.active');
            if (activeLi) {
                activeLi.classList.remove('active');
            }
            menuItem.parentNode.classList.add('active');
        });
    });

    // Xử lý các phần tử có thuộc tính data-number
    const notifications = document.querySelectorAll('[data-number]');
    notifications.forEach(notification => {
        const number = notification.getAttribute('data-number');
        console.log("Notification number: ", number); // Kiểm tra giá trị data-number
    });
});
