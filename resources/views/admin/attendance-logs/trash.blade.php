@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-danger">Danh sách chấm công đã xóa</h6>
                <a href="{{ route('admin.attendance-log.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Ngày</th>
                                <th>Thời gian làm việc (giờ)</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendanceLogs as $index => $attendanceLog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="d-flex align-items-center gap-3">
                                        <p>{{ $attendanceLog->user->name }}</p>
                                    </td>
                                    <td>{{ $attendanceLog->date }}</td>
                                    <td>{{ $attendanceLog->total_hours }}</td>
                                    <td>
                                        <form action="{{ route('admin.attendance-log.restore', $attendanceLog->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm"
                                                onclick="return confirm('Khôi phục bản ghi này?')">
                                                <i class="fas fa-undo"></i> Khôi phục
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.attendance-log.force-delete', $attendanceLog->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Xóa vĩnh viễn bản ghi này?')">
                                                <i class="fas fa-trash-alt"></i> Xóa vĩnh viễn
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $attendanceLogs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
