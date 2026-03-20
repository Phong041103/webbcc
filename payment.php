<?php
session_start();
include 'config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['products'])) {
    $products = $_POST['products'];
} else {
    echo "<p>Không có sản phẩm nào được chọn.</p>";
    exit;
}
$totalAmount = 0; // Biến để lưu tổng tiền

foreach ($products as $product) {
    $totalAmount += $product['quantity'] * $product['price']; // Tính tổng tiền cho từng sản phẩm
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web PTPC - Thanh Toán</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ec68c5d8e7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container bg-color">
        <nav class="navbar navbar-expand-lg navbar-light bg-color">
            <a class="navbar-brand" href="index.php"><img src="images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php" style=" padding-right: 30px;">Trang Chủ <span class="sr-only"></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="product.php" style=" padding-right: 30px;">Sản phẩm <span class="sr-only"></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Aboutus.php" style=" padding-right: 30px;">Giới Thiệu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="news.php" style=" padding-right: 30px;">Tin Tức</a>
                  </li>
                  </li>
                      <li class="nav-item">
                      <a class="nav-link " href="login.php" style=" padding-right: 30px;" >Đăng Nhập</a>
                  </li>
                </ul>

            </div>
        </nav>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Thanh toán</h2>
        <div class="card">
            <div class="card-body">
                <form id="myForm" method="POST" action="cart/checkout.php">
                    <div class="mb-3">
                        <label for="name"><h3>Họ Tên</h3></label>
                        <input type="text" name="name_user" class="form-control" id="name_user" placeholder="Họ Tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="email"><h3>Email</h3></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone"><h3>Số Điện Thoại</h3></label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Số Điện Thoại" required>
                    </div>

                    <div>
                        <h3>Hình Thức Thanh Toán</h3>
                        <input type="radio" id="cod" name="option" value="cod" checked>
                        <label>Tiền mặt</label>
                        &nbsp; &nbsp;
                        <input type="radio" id="qrcode" name="option" value="qrcode">
                        <label>Chuyển Khoản</label>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <h3>Hình Thức Nhận Hàng</h3>
                        <input type="radio" name="shipping" value="one" id="homeDelivery" checked> Giao hàng tận nhà
                        &nbsp; &nbsp;
                        <input type="radio" name="shipping" value="two" id="storePickup"> Lấy Tại Cửa Hàng
                    </div>
                    <div class="mt-3" id="addressInput" style="margin-bottom: 15px;">
                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" id="deliveryAddress">
                    </div>
                    <div class="product-details">
                        <h3>Thông tin sản phẩm</h3>
                        <?php foreach ($products as $product) { ?>
                            <div class="product-card">
                                <div class="product-info">
                                <input type="hidden" name="name_product" value="<?php echo $product['name']; ?>">
                                <input type="hidden" name="quantity" value="<?php echo $product['quantity']; ?>">
                                <input type="hidden" name="totalPrice" value="<?php echo $totalAmount; ?>">
                                    <h5><?php echo $product['name']; ?></h5>
                                    <p>Số lượng: <?php echo $product['quantity']; ?></p>
                                    <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VND</p>
                                    <p>Tổng: <?php echo number_format($product['quantity'] * $product['price'], 0, ',', '.'); ?> VND</p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="total-amount">
                        <h2>Tổng tiền phải thanh toán:</h2>
                        <span class="h2 text-bold d-flex font-weight-bold justify-content-end text-danger" id="totalPrice"><p><?php echo number_format($totalAmount, 0, ',', '.'); ?> VND</p></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3" style="font-size: 16px;">Đặt hàng ngay</button>
                </form>
            </div>
        </div>
    </div>

    



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homeDeliveryRadio = document.getElementById('homeDelivery');
        const storePickupRadio = document.getElementById('storePickup');
        const addressInputDiv = document.getElementById('addressInput');

        function updateAddressInputVisibility() {
            if (homeDeliveryRadio.checked) {
                addressInputDiv.style.display = 'block';
            } else {
                addressInputDiv.style.display = 'none';
            }
        }

        homeDeliveryRadio.addEventListener('change', updateAddressInputVisibility);
        storePickupRadio.addEventListener('change', updateAddressInputVisibility);
        updateAddressInputVisibility();
    });
</script>
</body>
</html>
