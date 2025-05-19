@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách chấm công</h1>
        <a href="{{ route('admin.attendance-log.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách chấm công</h6>
            <a href="{{ route('admin.attendance-log.trash') }}" class="btn btn-danger">thùng rác</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ngày</th>
                            <th>Người điểm danh</th>
                            <th>Số lượng khoảng thời gian</th>
                            <th>Tổng số giờ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->date }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->timeEntries->count() }}</td>
                            <td>{{ number_format($log->total_hours, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.attendance-log.show', $log) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.attendance-log.edit', $log) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.attendance-log.destroy', $log) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $attendanceLogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
