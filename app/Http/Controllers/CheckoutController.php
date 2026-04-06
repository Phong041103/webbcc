<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        return view('checkout');
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống');
        }

        $total = 0;
        $names = [];

        foreach ($cart as $item) {
            $total += $item['gia'] * $item['quantity'];
            $names[] = $item['tensp'] . ' (x' . $item['quantity'] . ')';
        }
        $diaChiNhanHang = $request->diachi; 
        if ($request->shipping == 'store') {
            $diaChiNhanHang = 'Lấy tại cửa hàng';
        }

        $order = Order::create([
            'ten' => $request->ten,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diachi' => $diaChiNhanHang,
            'cart' => implode(', ', $names),
            'total' => $total,
            'payment_method' => $request->option,
            'status' => 'pending'
        ]);

        if ($request->option == 'cod') {
            $cart = session('cart', []);
            foreach ($cart as $id => $item) {\App\Models\Products::where('id', $id)->decrement('quantity', $item['quantity']);
            }
            session()->forget('cart');
            return redirect()->route('bill', $order->id)->with('success', 'Đặt hàng thành công!');
        }

        // 👉 VNPAY
        if ($request->option == 'qrcode') {
            return redirect()->route('vnpay_payment', ['id' => $order->id]);
        }

    }

    public function vnpayReturn(Request $request)
    {
        $orderId = $request->vnp_TxnRef; 
        $order = Order::findOrFail($orderId);

        if ($request->vnp_ResponseCode == "00") {
            
            // LƯU TRẠNG THÁI VÀ MÃ THANH TOÁN
            $order->update([
                'status' => 'paid',
                'ma_giao_dich' => $request->vnp_TransactionNo // Lấy mã giao dịch từ VNPay
            ]); 
            
            $cart = session('cart', []); 
            foreach ($cart as $id => $item) {
                \App\Models\Products::where('id', $id)->decrement('quantity', $item['quantity']);
            }
            session()->forget('cart');
            return redirect()->route('bill', $order->id)->with('success', 'Thanh toán VNPay thành công!');
        } else {
            return redirect()->route('checkout')->with('error', 'Giao dịch thanh toán bị hủy hoặc thất bại.');
        }
    }

    public function bill($id)
    {
        // Lấy thông tin đơn hàng từ Database
        $order = Order::findOrFail($id);
        return view('bill', compact('order'));
    }

}