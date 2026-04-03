<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Categories::orderBy('created_at')->paginate(10);
        return view('admin.categories.list', compact('categorys'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $category = new Categories();
        $category->name = $data['name'];
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $category = Categories::findOrFail($id);
        $category = Categories::withCount('products')->findOrFail($id);
        if ($category->products_count > 0) {
                return redirect()
                    ->route('categories.index')
                    ->with('error', 'Không thể sửa danh mục vì đã có sản phẩm!');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($data);
        return redirect()
            ->route('categories.index')
            ->with('success', 'Cập nhật danh mục thành công');
        }

    public function destroy(string $id)
    {
       $category = Categories::withCount('products')->findOrFail($id);
        if ($category->products_count > 0) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Không thể xóa vì danh mục còn sản phẩm');
        }

        $category->delete();
        return redirect()
            ->route('categories.index')
            ->with('success', 'Xóa danh mục thành công');
        }
}
