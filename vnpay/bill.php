<?php
session_start();
include 'connect.php';
include '../config/db.php';

$db = new db();
$connect = $db->connect();
ini_set('display_errors', 1);

// Nhận dữ liệu từ form
$vnp_TxnRef = $_GET['vnp_TxnRef']; 
$vnp_Amount = $_GET['vnp_Amount'];
$vnp_OrderInfo = $_GET['vnp_OrderInfo'];
$vnp_ResponseCode = $_GET['vnp_ResponseCode'];
$vnp_TransactionNo = $_GET['vnp_TransactionNo'];
$vnp_BankCode = $_GET['vnp_BankCode'];
$vnp_PayDate = $_GET['vnp_PayDate'];
$vnp_SecureHash = $_GET['vnp_SecureHash'];

// Hiển thị hóa đơn
echo '<div class="bill">';
echo '<h2>Hóa đơn</h2>';
echo "<p>Mã giao dịch: $vnp_TxnRef</p>";
echo "<p>Số tiền: " . number_format($vnp_Amount, 0, ',', '.') . " VNĐ</p>";
echo "<p>Nội dung thanh toán: $vnp_OrderInfo</p>";
echo "<p>Mã giao dịch VNPAY: $vnp_TransactionNo</p>";
echo "<p>Ngân hàng: $vnp_BankCode</p>";
echo "<p>Ngày thanh toán: $vnp_PayDate</p>";
if ($_GET['vnp_ResponseCode'] == '00') {
    echo "<span style='color:blue'>GD Thành công</span>";
} else {
    echo "<span style='color:red'>GD Không thành công</span>";
}
echo '</div>'; 

if ($_GET['vnp_ResponseCode'] == '00') {
    $status = 'success';
} else {
    $status = 'failed';
}

// Cập nhật vnp_TxnRef trong bảng `order`
$order_id = $_SESSION['order_id'];
$stmt_update = $connect->prepare("UPDATE `order` SET vnp_TxnRef = ? WHERE order_id = ?");
$stmt_update->execute([$vnp_TxnRef, $order_id]);

// Kiểm tra xem vnp_TxnRef đã tồn tại trong bảng `order`
$stmt_check = $connect->prepare("SELECT COUNT(*) FROM `order` WHERE vnp_TxnRef = ?");
$stmt_check->execute([$vnp_TxnRef]);
if ($stmt_check->fetchColumn() == 0) {
    die("Lỗi: vnp_TxnRef không tồn tại trong bảng `order`.");
}

// Chèn vào bảng `vnp_payments`
$stmt = $connect->prepare("INSERT INTO vnp_payments (vnp_TxnRef, vnp_Amount, vnp_OrderInfo, vnp_ResponseCode, vnp_TransactionNo, vnp_BankCode, vnp_PayDate, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$vnp_TxnRef, $vnp_Amount, $vnp_OrderInfo, $vnp_ResponseCode, $vnp_TransactionNo, $vnp_BankCode, $vnp_PayDate, $status]);

$stmt_update->closeCursor();
$stmt->closeCursor();
$connect = null;
?>
<a href="../cart/proccess_checkout.php" class="btn btn-primary">Chi tiết đơn hàng</a>