<!-- filepath: c:\wamp64\www\demo_webcc_api\cart\checkout.php -->
<?php
session_start();
require("../config/db.php"); // Kết nối cơ sở dữ liệu

$db = new db();
$connect = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_user = $_POST['name_user'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $httt = $_POST['option'];
    $htnh = $_POST['shipping'];
    $address = $_POST['address'];
    $name_product = $_POST['name_product'];
    $quantity = (int)$_POST['quantity'];
    $totalPrice = $_POST['totalPrice'];
    $date = date('Y-m-d H:i:s');

    $sql = "UPDATE order SET status = 'Thành công' WHERE order_id  = ?";

    $vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : null;

    try {
        $connect->beginTransaction();
        $name_product = json_encode($_SESSION['cart'], JSON_UNESCAPED_UNICODE);

        $stmt = $connect->prepare("INSERT INTO `order` (name_product, name_user, email, phone, date, HTTT, HTNH, address, vnp_TxnRef, quantity, total, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $status = 'Thành công';
        $stmt->execute([$name_product, $name_user, $email, $phone, $date, $httt, $htnh, $address, $vnp_TxnRef, $quantity, $totalPrice, $status]);
        $order_id = $connect->lastInsertId(); 
        $_SESSION['order_id'] = $connect->lastInsertId();
        
        $connect->commit();
        
        if ($httt == "cod") {
            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            header("Location: proccess_checkout.php");
            exit();
        } elseif ($httt == "qrcode") {
            header("Location: ../vnpay");
            exit();
        }
        
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Lỗi khi đặt hàng: " . $e->getMessage();
    }
}
?>