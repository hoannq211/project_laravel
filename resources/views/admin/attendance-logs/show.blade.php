@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết chấm công</h1>
        <div>
            <a href="{{ route('admin.attendance-log.edit', $attendanceLog) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </a>
            <a href="{{ route('admin.attendance-log.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $attendanceLog->id }}</p>
                    <p><strong>Ngày:</strong> {{ $attendanceLog->date }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Người điểm danh:</strong> {{ $attendanceLog->user->name }}</p>
                    <p><strong>Tổng số giờ:</strong> {{ number_format($attendanceLog->total_hours, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Các khoảng thời gian</h6>
        </div>
        <div class="card-body">
            @foreach($attendanceLog->timeEntries as $index => $entry)
            <div class="card mb-3">
                <div class="card-header">
                    Khoảng thời gian #{{ $index + 1 }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Bắt đầu:</strong> {{ $entry->start_time }}</p>
                            <p><strong>Kết thúc:</strong> {{ $entry->end_time }}</p>
                            <p><strong>Thời gian làm:</strong> {{ number_format($entry->end_time - $entry->start_time, 2) }} giờ</p>
                        </div>
                        <div class="col-md-8">
                            @if($entry->image_path)
                            <p><strong>Hình ảnh:</strong></p>
                            <img src="{{ asset('storage/' . $entry->image_path) }}" alt="Ảnh chấm công" class="img-fluid img-thumbnail" style="max-height: 200px;">
                            @else
                            <p class="text-muted">Không có hình ảnh</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
