@extends('layout')

@section('content')
    <!--banner-bottom-->
    <div class="ban-bottom-w3l">
        <div class="container">
            <div class="col-md-6 ban-bottom3">
                <div class="ban-top">
                    <img src="{{ asset('frontend/images/3.jpg') }}" class="img-responsive" alt="" />
                </div>
                <div class="ban-img">
                    <div class=" ban-bottom1">
                        <div class="ban-top">
                            <img src="{{ asset('frontend/images/1.jpg') }}" class="img-responsive" alt="" />

                        </div>
                    </div>
                    <div class="ban-bottom2">
                        <div class="ban-top">
                            <img src="{{ asset('frontend/images/2.jpg') }}" class="img-responsive" alt="" />

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 ban-bottom">
                <div class="ban-top">
                    <img src="{{ asset('frontend/images/4.jpg') }}" class="img-responsive" alt="" />


                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- top-brands -->
    <div class="top-brands">
        <div class="container">
            <h2>Top selling offers</h2>
            <div class="grid_3 grid_5">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist" style="display: flex; justify-content: center;">
                        <li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab"
                                data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Advertised offers</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="expeditions"
                            aria-labelledby="expeditions-tab">
                            <div class="agile-tp">
                                <h5>Được quảng cáo trong tuần</h5>
                                <p class="w3l-ad">Chúng tôi đã tổng hợp tất cả các ưu đãi đã quảng cáo vào một nơi, vì vậy
                                    bạn sẽ không bỏ lỡ bất kỳ ưu đãi tuyệt vời nào.</p>
                            </div>
                            <div class="agile_top_brands_grids">
                                @foreach ($products as $product)
                                    <div class="col-md-4 top_brand_left">
                                        <div class="hover14 column">
                                            <div class="agile_top_brand_left_grid">

                                                <div class="agile_top_brand_left_grid_pos">
                                                    <img src="{{ asset('frontend/images/offer.png') }}"
                                                        class="img-responsive" />
                                                </div>

                                                <div class="agile_top_brand_left_grid1">
                                                    <figure>
                                                        <div class="snipcart-item block">
                                                            <div class="snipcart-thumb">

                                                                <a href="{{ route('product.detail', $product->id) }}">
                                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                                        class="img-responsive product-img"
                                                                        style="width: 100%;height: 200px;object-fit: cover;" />
                                                                </a>

                                                                <p>{{ $product->tensp }}</p>

                                                                <h4>
                                                                    {{ number_format($product->gia, 0, ',', '.') }}VNĐ
                                                                </h4>

                                                            </div>
                                                        </div>
                                                        {{-- <div class="snipcart-details top_brand_home_details">
                                                            <form action="{{ route('cart.add') }}" method="POST">
                                                                @csrf
                                                                <fieldset>
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    <input type="submit" value="Add to cart"
                                                                        class="button">
                                                                </fieldset>
                                                            </form>
                                                        </div> --}}
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="{{ route('cart.add') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <input type="hidden" name="quantity" value="1">

                                                                <button type="submit" class="btn-add-cart-list">
                                                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                                                    Thêm giỏ hàng
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
                        </div>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- new -->
    <div class="newproducts-w3agile">
    <div class="container">
        <h3>New offers</h3>
        <div class="agile_top_brands_grids">
            
            @foreach($newOffers as $offer)
            <div class="col-md-3 top_brand_left-1">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
                        <div class="agile_top_brand_left_grid_pos">
                            <img src="{{ asset('frontend/images/offer.png') }}" alt=" " class="img-responsive">
                        </div>
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block">
                                    <div class="snipcart-thumb">
                                        <a href="{{ route('product.detail', $offer->id) }}">
                                            <img src="{{ asset('storage/' . $offer->image) }}" alt=" " class="img-responsive product-img" style="width: 100%;height: 200px;object-fit: cover;">
                                        </a>
                                        
                                        <p>{{ $offer->tensp }}</p>
                                        
                                        <div class="stars">
                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                        </div>
                                        
                                        <h4>{{ number_format($offer->gia, 0, ',', '.') }} VNĐ</h4>
                                    </div>
                                    
                                    <div class="snipcart-details top_brand_home_details">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $offer->id }}">
                                            <input type="hidden" name="quantity" value="1"> 
                                            <button type="submit" class="btn-add-cart-list">
                                                <span class="glyphicon glyphicon-shopping-cart"></span> Thêm giỏ hàng
                                            </button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
    <!-- //new -->
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
    .ban-top img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Ảnh lớn bên trái */
    .ban-bottom3 > .ban-top {
        height: 250px;
        margin-bottom: 15px;
    }

    /* 2 ảnh nhỏ bên dưới */
    .ban-bottom1 .ban-top,
    .ban-bottom2 .ban-top {
        height: 150px;
    }

    /* Khoảng cách giữa 2 ảnh nhỏ */
    .ban-bottom1 {
        padding-right: 7px;
    }

    .ban-bottom2 {
        padding-left: 7px;
    }

    /* Ảnh bên phải */
    .ban-bottom .ban-top {
        height: 385px;
    }
    
</style>
