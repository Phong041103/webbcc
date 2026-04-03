@extends('layout')

@section('content')

<style>
/* Reset khoảng cách một chút */
.product-detail-container {
    max-width: 1100px;
    margin: 40px auto;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.06);
    padding: 30px;
}

/* Ảnh sản phẩm */
.product-image-wrapper img {
    width: 100%;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #f0f0f0;
}

/* Khung thông tin */
.product-info-wrapper {
    padding: 10px 20px;
}

/* Tên sản phẩm */
.product-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    line-height: 1.3;
}

/* Giá tiền */
.product-price {
    font-size: 26px;
    font-weight: bold;
    color: #d9534f; /* Màu đỏ nổi bật */
    background: #fdf0ed;
    padding: 12px 25px;
    border-radius: 8px;
    display: inline-block;
    margin-bottom: 25px;
}

/* Mô tả sản phẩm */
.product-desc {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
    border-top: 1px solid #eee;
    padding-top: 25px;
}

/* Khu vực chọn số lượng */
.quantity-box {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.quantity-box label {
    margin-right: 15px;
    font-weight: 600;
    color: #333;
    font-size: 16px;
}

.quantity-input {
    width: 90px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    text-align: center;
    font-size: 16px;
}

.quantity-input:focus {
    outline: none;
    border-color: #27ae60;
}

/* Nút thêm vào giỏ hàng */
.btn-add-cart {
    background: #ff5722;
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
}

.btn-add-cart:hover {
    background: #e64a19;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
    color: #fff;
}
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('trang-chu') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Trang chủ</a></li>
            <li class="active">Chi tiết sản phẩm</li>
        </ol>
    </div>
</div>
<div class="container">
    <div class="product-detail-container">
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="product-image-wrapper">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->tensp }}">
                </div>
            </div>

            <div class="col-md-7">
                <div class="product-info-wrapper">
                    
                    <h2 class="product-title">{{ $product->tensp }}</h2>

                    <div class="product-price">
                        {{ number_format($product->gia, 0, ',', '.') }} VNĐ
                    </div>

                    <div class="product-desc">
                        {!! nl2br(e($product->mota)) !!}
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="quantity-box">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="quantity-input">
                        </div>

                        <button type="submit" class="btn-add-cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection