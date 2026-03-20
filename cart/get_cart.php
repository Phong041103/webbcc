<?php
session_start();

// Kiểm tra xem giỏ hàng đã được khởi tạo chưa
if (isset($_SESSION['cart'])) {
    echo json_encode($_SESSION['cart']);
} else {
    echo json_encode([]);
}
?>