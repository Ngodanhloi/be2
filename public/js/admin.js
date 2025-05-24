// Script để hiển thị popup khi click vào nút "Thêm sản phẩm"
// document.getElementById('openPopupButton').addEventListener('click', function () {
//     document.getElementById('popupForm').style.display = 'block';
// });

// // Script để đóng popup khi click vào nút "Đóng"
// document.getElementById('closePopupButton').addEventListener('click', function () {
//     document.getElementById('popupForm').style.display = 'none';
// });

document.addEventListener('DOMContentLoaded', function () {
    // Mở form chỉnh sửa
    document.querySelectorAll('.edit-button').forEach(function (button) {
        button.addEventListener('click', function () {
            // Ẩn tất cả form edit trước khi mở cái mới
            document.querySelectorAll('.edit-form-container').forEach(function (form) {
                form.style.display = 'none';
            });

            var productId = this.getAttribute('data-product-id');
            var editForm = document.getElementById('editFormContainer-' + productId);
            if (editForm) {
                editForm.style.display = 'block'; // Hiển thị form chỉnh sửa
            }
        });
    });

    // Đóng form chỉnh sửa
    document.querySelectorAll('.close-edit-form').forEach(function(button) {
        button.addEventListener('click', function() {
            var formContainer = this.closest('.edit-form-container');
            if (formContainer) {
                formContainer.style.display = 'none';
            }
        });
    });
});

    const openBtn = document.getElementById('openPopupButton');
    if (openBtn) {
        openBtn.addEventListener('click', function () {
            document.getElementById('popupForm').style.display = 'block';
        });
    }

    const closeBtn = document.getElementById('closePopupButton');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            document.getElementById('popupForm').style.display = 'none';
        });
    }

    // Thêm sự kiện để đóng form chỉnh sửa
    document.querySelectorAll('.btn-danger').forEach(function (button) {
        button.addEventListener('click', function () {
            var editForms = document.querySelectorAll('.edit-form-container');
            editForms.forEach(function (form) {
                form.style.display = 'none'; // Ẩn tất cả các form chỉnh sửa
            });
        });
    });