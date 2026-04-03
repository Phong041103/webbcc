<?php

namespace App\Http\Controllers\front;
use App\Models\Products;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $products = Products::latest()->paginate(6);
        $newOffers = Products::latest()->paginate(4);
        return view('index', compact('categories', 'products', 'newOffers'));
    }

    public function category($id)
    {
        $category = Categories::findOrFail($id);
        $products = Products::where('category_id', $id)->get();
        return view('category', compact('category', 'products'));
    }

    public function product()
    {
        $products = Products::latest()->paginate(8);
        return view('product', compact('products'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function detail($id)
    {
        $product =Products::findOrFail($id);
        return view('detail', compact('product'));
    }

    public function addToCart(Request $request)
    {
    $product = Products::findOrFail($request->product_id);

    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "tensp" => $product->tensp,
            "gia" => $product->gia,
            "image" => $product->image,
            "quantity" => 1
        ];
    }
    session()->put('cart', $cart);
    return redirect()->route('gio-hang');
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart');

        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $qty = max(1, $request->quantity);
        $cart[$request->id]['quantity'] = $qty;
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}
