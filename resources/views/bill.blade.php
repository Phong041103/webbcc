@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(session('success'))
                <div class="alert alert-success text-center fs-5 fw-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm" style="border-radius: 12px; border: none;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="text-success fw-bold">CẢM ƠN BẠN ĐÃ ĐẶT HÀNG!</h2>
                        <p class="text-muted mb-0">Mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
                        <p class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3 mt-4">Thông tin nhận hàng</h5>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Khách hàng:</div>
                        <div class="col-sm-8 fw-bold">{{ $order->ten }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Số điện thoại:</div>
                        <div class="col-sm-8">{{ $order->sdt }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Địa chỉ:</div>
                        <div class="col-sm-8">{{ $order->diachi }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Phương thức TT:</div>
                        <div class="col-sm-8">
                            @if($order->payment_method == 'qrcode')
                                <span class="badge bg-primary">Chuyển khoản (VNPay)</span>
                            @else
                                <span class="badge bg-secondary">Tiền mặt (COD)</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Trạng thái:</div>
                        <div class="col-sm-8">
                            @if($order->status == 'paid')
                                <span class="text-success fw-bold">Đã thanh toán</span>
                            @else
                                <span class="text-warning fw-bold">Chờ thanh toán</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3 mt-4">Chi tiết sản phẩm</h5>
                    <div class="bg-light p-3 rounded mb-4">
                        <p class="mb-0 lh-lg">{{ $order->cart }}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h4 class="mb-0">Tổng cộng:</h4>
                        <h2 class="text-danger fw-bold mb-0">{{ number_format($order->total, 0, ',', '.') }} VNĐ</h2>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('trang-chu') }}" class="btn btn-outline-primary px-5 py-2" style="border-radius: 8px;">
                            Quay lại trang chủ
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection