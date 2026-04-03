<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class VNPayController extends Controller
{
    // Thêm tham số $id để nhận ID đơn hàng từ URL
    public function vnpay_payment(Request $request, $id) 
    {
        // 1. Tìm đơn hàng trong Database
        $order = Order::findOrFail($id);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // Trỏ đúng về route get '/vnpay/return' của bạn
        $vnp_TmnCode = "XE5VHHXL"; // Mã website tại VNPAY 
        $vnp_HashSecret = "71B79D3OO6FMFVWJ8HLGC6IGMDABMKMY"; // Chuỗi bí mật

        // 2. Dùng ID đơn hàng thật để đối soát, thay vì rand()
        $vnp_TxnRef = $order->id; 
        $vnp_OrderInfo = 'Thanh toan don hang ' . $order->id;
        $vnp_OrderType = 'billpayment';
        
        // Lấy tổng tiền trực tiếp từ DB
        $vnp_Amount = $order->total * 100; 
        
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip(); // Lấy IP chuẩn theo Laravel

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            // LỖI Ở ĐÂY NÈ: Code cũ của bạn thiếu dấu '&' trước vnp_SecureHash
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash; 
        }

        // 3. Dùng redirect của Laravel để chuyển thẳng sang trang VNPay
        return redirect($vnp_Url);
    }


}