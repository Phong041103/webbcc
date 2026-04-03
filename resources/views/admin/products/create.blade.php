@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm sản phẩm</div>

                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên</label>
                                <input type="text" class="form-control" name="tensp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ảnh</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả</label>
                                <input type="text" class="form-control" name="mota">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Giá</label>
                                <input type="number" class="form-control" name="gia">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Danh mục</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
