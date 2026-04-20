<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.listorders', compact('orders'));
    }

    public function show($id)
{
    $order = Order::findOrFail($id);

    $items = explode(', ', $order->cart);

    $cart = [];

    foreach ($items as $item) {
        if (preg_match('/(.*)\s\(x(\d+)\)/', $item, $match)) {
            $cart[] = [
                'tensp' => $match[1],
                'quantity' => $match[2],
                'total' => 0
            ];
        }
    }

    return view('admin.orders.detailorders', compact('order', 'cart'));
}
}
