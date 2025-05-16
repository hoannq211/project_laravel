@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết sản phẩm</h6>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{!! nl2br(e($product->description)) !!}</td>
                        </tr>
                        <tr>
                            <th>Giá</th>
                            <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        </tr>
                        <tr>
                            <th>Số lượng tồn kho</th>
                            <td>{{ $product->stock_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Ngày cập nhật</th>
                            <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <!-- Có thể thêm ảnh sản phẩm ở đây nếu có -->
                    <div class="text-center bg-light p-4 rounded">
                        <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
                        <p class="text-muted">Chưa có hình ảnh</p>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
            </div>
        </div>
    </div>
@endsection
