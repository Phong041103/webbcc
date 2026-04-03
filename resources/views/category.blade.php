@extends('layout')

@section('content')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="{{ route('trang-chu') }}"><span class="glyphicon glyphicon-home"
                            aria-hidden="true"></span>Home</a></li>
                <li class="active">{{ $category->name }}</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!--- groceries --->
    <div class="products">
        <div class="container">
            <div class="col-md-12 products-right">

                <div class="agile_top_brands_grids" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    @foreach ($products as $product)
                        <div class="col-md-4 top_brand_left" style="float: none; margin-bottom: 30px;">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid">

                                    <div class="agile_top_brand_left_grid_pos">
                                        <img src="{{ asset('frontend/images/offer.png') }}" class="img-responsive">
                                    </div>

                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">

                                                    <!-- LINK SANG TRANG CHI TIẾT -->
                                                    <a href="{{ route('product.detail', $product->id) }}">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            class="img-responsive" style="height:200px; object-fit:cover;">
                                                    </a>

                                                    <p>{{ $product->tensp }}</p>

                                                    <h4>
                                                        {{ number_format($product->gia, 0, ',', '.') }} VNĐ
                                                    </h4>

                                                </div>
                                            </div>

                                            <!-- ADD TO CART -->
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">

                                                    <button type="submit" class="btn-add-cart-list">
                                                        <span class="glyphicon glyphicon-shopping-cart"></span> Thêm giỏ
                                                        hàng
                                                    </button>
                                                </form>
                                            </div>

                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="clearfix"></div>
                </div>
                <nav class="numbering">
                    <ul class="pagination paging">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!--- groceries --->
@endsection
<style>
    /* Style cho nút Add to Cart mới */
    .btn-add-cart-list {
        background: #fff;
        color: #ff5722;
        border: 2px solid #ff5722;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s;
        width: 100%;
        margin-top: 10px;
        display: inline-block;
    }

    .btn-add-cart-list:hover {
        background: #ff5722;
        color: #fff;
    }
</style>
