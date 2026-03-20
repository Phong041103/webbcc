<?php
session_start();
header('Content-Type: application/json');
echo json_encode([
    "session_id" => session_id(),
    "cart" => $_SESSION['cart']
]);

// Lấy dữ liệu sản phẩm từ yêu cầu
$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $product_id = $data->product_id;
    $name = $data->name;
    $price = $data->price;
    $quantity = $data->quantity;

    // Tạo một sản phẩm
    $product = [
        "product_id" => $product_id,
        "name" => $name,
        "price" => $price,
        "quantity" => $quantity
    ];

    // Thêm sản phẩm vào giỏ hàng
    $_SESSION['cart'][$product_id] = $product;

    // Phản hồi JSON
    echo json_encode(array("message" => "Sản phẩm đã được thêm vào giỏ hàng."));
} else {
    // Nếu không có dữ liệu
    http_response_code(400);
    echo json_encode(array("message" => "Dữ liệu không hợp lệ."));
}
?>