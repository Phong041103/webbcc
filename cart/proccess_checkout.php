<?php
session_start();
include '../config/db.php';


$db = new db();
$connect = $db->connect();
if (!isset($_SESSION['order_id'])) {
    header("Location: payment.php");
    exit();
}

$order_id = $_SESSION['order_id'];

try {
    $stmt = $connect->prepare("SELECT * FROM `order` WHERE order_id = :order_id");
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "Không tìm thấy đơn hàng.";
        exit();
    }
} catch (PDOException $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
    exit();
}

$cart = json_decode($order['name_product'], true);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Chi tiết đơn hàng</h1>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Đơn hàng: <?php echo htmlspecialchars($order['order_id']); ?></h5>
            <p><strong>Tên Sản Phẩm:</strong> <?php echo htmlspecialchars($order['name_product']); ?></p>
            <span class="badge bg-secondary text-white">Xác Nhận Thanh Toán Thành Công</span>
        </div>
        <div class="card-body">
            <h5 class="card-subtitle mb-2">Thông tin khách hàng</h5>
            <p><strong>Tên:</strong> <?php echo htmlspecialchars($order['name_user']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
            <hr />
            <h5 class="card-subtitle mb-2">Địa chỉ nhận hàng</h5>
            <p><?php echo htmlspecialchars($order['address']); ?></p>
        </div>
        <div class="card-footer text-end">
            <button type="button" class="btn btn-primary" id="printButton">
                <i class="fas fa-print"></i> In hoá đơn
            </button>
            <button type="button" class="btn btn-primary" id="backButton">
                <i class="fas fa-backward"></i>
                <a href="../product.php" style="color: white;">Quay về trang chủ</a>
            </button>
        </div>
    </div>
</div>
<script src="../js/print.js"></script>
</body>
</html>
