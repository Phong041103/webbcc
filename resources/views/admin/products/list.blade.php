@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Danh sách sản phẩm</div>

                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tạo sản phẩm</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">tên sản phẩm</th>
                                    <th scope="col">ảnh</th>
                                    <th scope="col">giá</th>
                                    <th scope="col">số lượng</th>
                                    <th scope="col">loại</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $pro)
                                    <tr>
                                        <th scope="row">{{ $pro->id }}</th>
                                        <td>{{ $pro->tensp }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $pro->image) }}" width="100">
                                        </td>
                                        <td>{{ number_format($pro->gia, 0, ',', '.') }}</td>
                                        <td>{{ $pro->quantity }}</td>
                                        <td>{{ $pro->category->name ?? 'Chưa có danh mục' }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $pro->id) }}"
                                                class="btn btn-sm btn-warning">Sửa</a>
                                            <form action="{{ route('products.destroy', $pro->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Bạn muốn xóa không ?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
