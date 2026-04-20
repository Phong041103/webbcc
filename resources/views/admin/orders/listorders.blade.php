@extends('layouts.app')

@section('content')
    <h2>Quản lý đơn hàng</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Khách</th>
                <th>SĐT</th>
                <th>Sản phẩm</th>
                <th>SL</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->ten }}</td>
                    <td>{{ $o->sdt }}</td>
                    <td>
                        {{ $o->cart }}
                    </td>
                    @php
                        preg_match_all('/x(\d+)/', $o->cart, $matches);
                        $qty = array_sum($matches[1]);
                    @endphp

                    <td>{{ $qty }}</td>

                    <td>{{ number_format($o->total) }}đ</td>
                    <td>{{ $o->payment_method }}</td>

                    <td>
                        @if ($o->status == 'pending')
                            <span class="badge bg-warning">Chờ</span>
                        @elseif($o->status == 'paid')
                            <span class="badge bg-success">Đã thanh toán</span>
                        @else
                            <span class="badge bg-danger">Lỗi</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('orders.show', $o->id) }}" class="btn btn-sm btn-primary">
                            Xem
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
