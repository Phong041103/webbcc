@extends('layout')
@section('content')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1">
                <li><a href="{{ route('trang-chu') }}"><span class="glyphicon glyphicon-home"
                            aria-hidden="true"></span>Home</a></li>
                <li class="active">Checkout Page</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- checkout -->
    <div class="checkout">
        <div class="container">
            <h2>
                Giỏ hàng của bạn bao gồm:
                <span>{{ count(session('cart', [])) }} Sản phẩm</span>
            </h2>
            <div class="checkout-right">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Product</th>
                            <th>Quality</th>
                            <th>Product Name</th>

                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    @php $total = 0; @endphp

                    @foreach (session('cart', []) as $id => $item)
                        <tr>
                            <td class="invert">{{ $loop->iteration }}</td>

                            <td class="invert-image">
                                <img src="{{ asset('storage/' . $item['image']) }}" width="80">
                            </td>

                            <td class="invert">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">

                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        onchange="this.form.submit()" style="width:60px">
                                </form>
                            </td>

                            <td class="invert">{{ $item['tensp'] }}</td>

                            <td class="invert">
                                {{ $item['gia'] * $item['quantity'] }}VNĐ
                            </td>

                            <td class="invert">
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>

                        @php $total += $item['gia'] * $item['quantity']; @endphp
                    @endforeach
                </table>
            </div>
            <div class="checkout-left">
                <div class="checkout-left-basket">
                    <h4>Tổng Bill</h4>
                    <ul>
                        @foreach (session('cart', []) as $item)
                            <li>
                                {{ $item['tensp'] }}
                                <i>-</i>
                                <span>{{ $item['gia'] * $item['quantity'] }}VNĐ</span>
                            </li>
                        @endforeach

                        <li>Total <i>-</i> <span>{{ $total }}VNĐ</span></li>
                    </ul>
                </div>
                <div class="checkout-right-basket"
                    style="flex-direction: column; display: flex; align-items: center; margin-top: 20px;">
                    <a href="{{ route('checkout') }}" class="btn btn-success">
                        Thanh toán <span class="glyphicon glyphicon-menu-right"></span>
                    </a>
                </div>

                <div class="checkout-right-basket">
                    <a href="{{ route('trang-chu') }}">
                        <span class="glyphicon glyphicon-menu-left"></span>
                        Continue Shopping
                    </a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //checkout -->
@endsection
