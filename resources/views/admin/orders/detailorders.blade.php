@extends('layouts.app')

@section('content')
<h2>Đơn hàng #{{ $order->id }}</h2>

<div class="card p-3 mb-3">
    <p><b>Tên:</b> {{ $order->ten }}</p>
    <p><b>SĐT:</b> {{ $order->sdt }}</p>
    <p><b>Email:</b> {{ $order->email }}</p>
    <p><b>Địa chỉ:</b> {{ $order->diachi }}</p>
</div>

<h4>Sản phẩm</h4>

<table class="table table-bordered">
    <tr>
        <th>Tên cây</th>
        {{-- <th>Giá</th> --}}
        <th>Số lượng</th>
    </tr>

    @foreach($cart as $item)
    <tr>
        <td>{{ $item['tensp'] }}</td>
        {{-- <td>{{ number_format($item['total']) }}đ</td> --}}
        <td>{{ $item['quantity'] }}</td>
    </tr>
    @endforeach
</table>

<h4 class="text-end">Tổng: {{ number_format($order->total) }}đ</h4>
@endsection