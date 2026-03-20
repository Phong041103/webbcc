<!-- filepath: c:\wamp64\www\demo_webcc_api\product.php -->
<?php
session_start();
require("./config/db.php"); // Kết nối cơ sở dữ liệu

$db = new db();
$connect = $db->connect();

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$query = "SELECT * FROM products";
$stmt = $connect->prepare($query); // Chuẩn bị câu lệnh
$stmt->execute(); // Thực thi câu lệnh
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu dưới dạng mảng kết hợp

// Lấy danh sách sản phẩm trong giỏ hàng từ session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>
    <h1>Danh Sách Sản Phẩm</h1>
    <div>
        <?php foreach ($result as $row): ?>
            <div>
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo htmlspecialchars($row['image_url']); ?></p>
                <p>Giá: <?php echo htmlspecialchars($row['price']); ?> VNĐ</p>
                <button onclick="addToCart(<?php echo $row['product_id']; ?>, '<?php echo htmlspecialchars($row['name']); ?>', <?php echo $row['price']; ?>)">Thêm vào giỏ hàng</button>
            </div>
        <?php endforeach; ?>
    </div>

   
    <a href="cart/cart.php">
    <button>Giỏ hàng</button>
</a>

    <script>
        function addToCart(id, name, price) {
            const product = {
                product_id: id,
                name: name,
                price: price,
                quantity: 1
            };

            fetch('cart/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Hiển thị thông báo khi thêm sản phẩm vào giỏ hàng
                location.reload(); // Tải lại trang để cập nhật giỏ hàng
            });
        }
        function checkout() {
        fetch('cart/checkout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart: <?php echo json_encode($cart); ?> })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Hiển thị thông báo khi thanh toán thành công
            if (data.success) {
                location.reload(); // Tải lại trang để làm trống giỏ hàng
            }
        });
    }
    </script>
</body>
</html>