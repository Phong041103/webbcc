@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sửa sản phẩm</div>

                    <div class="card-body">
                        <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên</label>
                                <input type="text" class="form-control" name="tensp" value="{{ $products->tensp }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ảnh</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả</label>
                                <input type="text" class="form-control" name="mota" value="{{ $products->mota }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Giá</label>
                                <input type="number" class="form-control" name="gia" value="{{ $products->gia }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" name="quantity" value="{{ $products->quantity }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Danh mục</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}" {{ $products->category_id == $cate->id ? 'selected' : '' }}>
                                            {{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
