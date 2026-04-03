@extends('layout')

@section('content')

<style>
/* Reset & Container */
.product-list-container {
    padding: 40px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
    font-weight: 700;
    color: #333;
    text-transform: uppercase;
    position: relative;
}

.section-title::after {
    content: '';
    width: 60px;
    height: 3px;
    background: #ff5722;
    display: block;
    margin: 10px auto 0;
}

/* Product Card */
.product-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    margin-bottom: 30px;
    overflow: hidden;
    position: relative;
    border: 1px solid #f9f9f9;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Image */
.product-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.image-wrapper {
    overflow: hidden;
    display: block;
}

/* Info */
.product-info {
    padding: 20px;
    text-align: center;
}

.product-name {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-name a {
    color: #333;
    text-decoration: none;
    transition: color 0.2s;
}

.product-name a:hover {
    color: #ff5722;
}

.product-price {
    font-size: 18px;
    font-weight: 700;
    color: #d9534f;
    margin-bottom: 15px;
}

/* Button */
.btn-add-cart-list {
    background: #fff;
    color: #ff5722;
    border: 2px solid #ff5722;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s;
    width: 100%;
}

.btn-add-cart-list:hover {
    background: #ff5722;
    color: #fff;
}
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('trang-chu') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Trang chủ</a></li>
            <li class="active">Sản phẩm</li>
        </ol>
    </div>
</div>
<div class="product-list-container">
    <div class="container">
        <h2 class="section-title">Tất cả sản phẩm</h2>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-6">
                <div class="product-card">
                    <a href="{{ route('product.detail', $product->id) }}" class="image-wrapper">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->tensp }}" class="product-image">
                    </a>

                    <div class="product-info">
                        <h4 class="product-name">
                            <a href="{{ route('product.detail', $product->id) }}">{{ $product->tensp }}</a>
                        </h4>
                        
                        <div class="product-price">
                            {{ number_format($product->gia, 0, ',', '.') }} VNĐ
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1"> <button type="submit" class="btn-add-cart-list">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Thêm giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div> <div class="text-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection