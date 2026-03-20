<?php
session_start();

require("../config/db.php"); // Kết nối cơ sở dữ liệu

$db = new db();
$connect = $db->connect();

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$query = "SELECT * FROM products";
$stmt = $connect->prepare($query); // Chuẩn bị câu lệnh
$stmt->execute(); // Thực thi câu lệnh
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu dưới dạng mảng kết hợp

// Lấy danh sách sản phẩm trong giỏ hàng từ session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Trả về danh sách sản phẩm trong giỏ hàng dưới dạng JSON
if (isset($_GET['json']) || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
    header('Content-Type: application/json');
    echo json_encode([
        "success" => true,
        "message" => !empty($cart) ? "Danh sách sản phẩm trong giỏ hàng." : "Giỏ hàng trống.",
        "data" => $cart
    ]);
    exit();
}
if (!empty($_SESSION['cart'])) {
    $stt = 1;
    $totalPrice = 0;

    foreach ($_SESSION['cart'] as $product_id => $item) {
     
        $name = $item['name'] ?? 'Sản phẩm không tên';
        $price = $item['price'] ?? 0;
        $quantity = $item['quantity'] ?? 1;

        $subtotal = $quantity * $price;
        $totalPrice += $subtotal;
?>
    <tr>
        <td><?= $stt++; ?></td>
        <td><?= htmlspecialchars($name) ?></td>
        <td>
            <input 
                type="number" 
                name="quantity" 
                value="<?= $quantity ?>" 
                min="1" 
                onchange="updateQuantity(this.value, '<?= $product_id ?>')"
            >
        </td>
        <td><?= number_format($price, 0, ',', '.') ?> VND</td>
        <td><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
        <td>
            <form action="clear_cart.php" method="POST">
                <input type="hidden" name="itemkey" value="<?= $product_id ?>">
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
<?php   
    }
?>
    <tr>
        <td colspan="5" class="text-right font-weight-bold">Tổng Cộng:</td>
        <td colspan="2" class="font-weight-bold">
            <?= number_format($totalPrice, 0, ',', '.') ?> VND
        </td>
    </tr>
<?php
} else {
    echo '<tr><td colspan="7" class="text-center">Giỏ hàng trống.</td></tr>';
}

?>
<?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_item'])) {
                      $key = $_POST['update_item'];
                      $newQuantity = intval($_POST['quantity']);
                  
                      if (isset($_SESSION['cart'][$key]) && $newQuantity > 0) {
                          $_SESSION['cart'][$key]['quantity'] = $newQuantity; 
                          echo "Cập nhật thành công";
                      } else {
                          echo "Lỗi: Sản phẩm không tồn tại hoặc số lượng không hợp lệ";
                      }
                      exit(); 
                  }
?>
<div class="text-center mt-4">
        <?php if (!empty($_SESSION['cart'])) { ?>
                <form action="../payment.php" method="POST">
                   
                    <?php foreach ($_SESSION['cart'] as $key => $item) { ?>
                        <input type="hidden" name="products[<?php echo $key; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
                        <input type="hidden" name="products[<?php echo $key; ?>][quantity]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                        <input type="hidden" name="products[<?php echo $key; ?>][price]" value="<?php echo htmlspecialchars($item['price']); ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-success">Thanh Toán</button>
                </form>
          <?php } ?>
        </div>
<script>
function updateQuantity(quantity, key) {
    if (quantity < 1) {
        alert('Số lượng phải lớn hơn 0');
        return;
    }

    // Gửi yêu cầu AJAX
    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `update_item=${key}&quantity=${quantity}`
    })
    .then(response => response.text())
    .then(data => {
        
        location.reload(); 
    })
    .catch(error => console.error('Error:', error));
}
</script>