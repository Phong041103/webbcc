<?php

namespace App\Http\Controllers\Admin;
use App\Models\Products;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::orderBy('created_at')->paginate(10);
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $products = new Products();
        $products->tensp = $data['tensp'];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $products->image = $imagePath;
        }
        $products->mota = $data['mota'];
        $products->gia = $data['gia'];
        $products->quantity = $data['quantity'];
        $products->category_id = $data['category_id'];
        $products->save();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::findOrFail($id);
    return view('detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Products::findOrFail($id);
        $categories = Categories::all();
        return view('admin.products.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Products::findOrFail($id);
        $data = $request->all();
        $products->tensp = $data['tensp'];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $products->image = $imagePath;
        }
        $products->mota = $data['mota'];
        $products->gia = $data['gia'];
        $products->quantity = $data['quantity'];
        $products->category_id = $data['category_id'];
        $products->save();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Products::findOrFail($id);
        $products->delete();
        return redirect()
            ->route('products.index')
            ->with('success', 'Xóa sản phẩm thành công');
    }
}
