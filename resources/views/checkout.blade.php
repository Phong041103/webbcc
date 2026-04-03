@extends('layout')

@section('content')
    <style>
        /* Container */
        .checkout-box {
            max-width: 900px;
            margin: auto;
        }

        /* Card */
        .card {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        /* Body */
        .card-body {
            padding: 35px;
        }

        /* Input */
        .form-control {
            padding: 10px;
            border-radius: 8px;
        }

        /* Spacing */
        .mb-3 {
            margin-bottom: 20px !important;
        }

        /* Product */
        .product-card {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        /* Tổng tiền */
        .total-amount {
            margin-top: 30px;
            padding: 20px;
            background: #fff3f3;
            border-radius: 10px;
            text-align: center;
        }

        /* Button */
        .btn-primary {
            margin-top: 20px;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
        }
    </style>

    <div class="container mt-5 checkout-box">
        <h2 class="text-center mb-4">Thanh toán</h2>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <!-- THÔNG TIN KHÁCH -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5>Họ Tên</h5>
                            <input type="text" name="ten" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h5>Email</h5>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h5>Số Điện Thoại</h5>
                            <input type="text" name="sdt" class="form-control" required>
                        </div>
                    </div>

                    <!-- THANH TOÁN -->
                    <div class="mb-3">
                        <h5>Hình Thức Thanh Toán</h5>
                        <input type="radio" name="option" value="cod" checked> Tiền mặt
                        &nbsp;&nbsp;
                        <input type="radio" name="option" value="qrcode"> Chuyển khoản
                    </div>

                    <!-- NHẬN HÀNG -->
                    <div class="mb-3">
                        <h5>Hình Thức Nhận Hàng</h5>
                        <input type="radio" name="shipping" value="home" id="shipHome" checked>
                        <label for="shipHome">Giao tận nhà</label>
                        &nbsp;&nbsp;
                        <input type="radio" name="shipping" value="store" id="shipStore">
                        <label for="shipStore">Lấy tại shop</label>
                    </div>

                    <div class="mb-3" id="addressBox">
                        <input type="text" name="diachi" id="inputDiaChi" class="form-control"
                            placeholder="Nhập địa chỉ" required>
                    </div>

                    <!-- SẢN PHẨM -->
                    <div class="row mt-4">
                        @php $total = 0; @endphp

                        @foreach (session('cart', []) as $item)
                            @php
                                $thanhtien = $item['gia'] * $item['quantity'];
                                $total += $thanhtien;
                            @endphp

                            <div class="col-md-3 mb-4">
                                <div class="product-card">
                                    <h6>{{ $item['tensp'] }}</h6>
                                    <p>SL: {{ $item['quantity'] }}</p>
                                    <p>{{ number_format($item['gia'], 0, ',', '.') }} VND</p>
                                    <p class="text-danger fw-bold">
                                        {{ number_format($thanhtien, 0, ',', '.') }} VND
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- TỔNG TIỀN -->
                    <div class="total-amount">
                        <h4>Tổng tiền</h4>
                        <h2 class="text-danger">
                            {{ number_format($total, 0, ',', '.') }} VND
                        </h2>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary w-100">
                        Đặt hàng ngay
                    </button>

                </form>

            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy các phần tử từ giao diện
        const shipHome = document.getElementById('shipHome');
        const shipStore = document.getElementById('shipStore');
        const addressBox = document.getElementById('addressBox');
        const inputDiaChi = document.getElementById('inputDiaChi');

        // Hàm kiểm tra và ẩn hiện
        function toggleAddress() {
            if (shipHome.checked) {
                // Nếu chọn Giao tận nhà -> Hiện ô nhập và Bắt buộc nhập (required)
                addressBox.style.display = 'block';
                inputDiaChi.setAttribute('required', 'required');
            } else {
                // Nếu chọn Lấy tại shop -> Ẩn ô nhập và Bỏ bắt buộc nhập
                addressBox.style.display = 'none';
                inputDiaChi.removeAttribute('required');
                inputDiaChi.value = ''; // Xóa trắng dữ liệu lỡ nhập trước đó
            }
        }

        // Bắt sự kiện khi người dùng click đổi tùy chọn
        shipHome.addEventListener('change', toggleAddress);
        shipStore.addEventListener('change', toggleAddress);

        // Chạy hàm 1 lần lúc trang vừa load xong để set trạng thái mặc định
        toggleAddress();
    });
</script>
