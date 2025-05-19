@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm chấm công mới</h6>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <form action="{{ route('admin.attendance-log.store') }}" method="POST" enctype="multipart/form-data"
                class="p-4 rounded-1 mx-1" style="background-color: #e5e5e5;">
                @csrf

                {{-- Thông tin chung --}}
                <div class="border p-3 row shadow-sm mb-3 mt-2 rounded-1" style="background-color: #fff;">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="date">Ngày</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                   name="date" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="user_id">Người điểm danh</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">-- Chọn --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user['id'] }}" {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                                        {{ $user['id'] . ' - ' . $user['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Các log thời gian --}}
                <div id="time-log-wrapper">
                    <div class="row border rounded-1 mb-3 p-4 mt-3" style="background-color: #fff;">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Thời gian bắt đầu</label>
                                <input type="number" class="form-control @error('time_logs.0.start_time') is-invalid @enderror"
                                       name="time_logs[0][start_time]" min="0" max="24" step="0.01"
                                       value="{{ old('time_logs.0.start_time') }}">
                                @error('time_logs.0.start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Thời gian kết thúc</label>
                                <input type="number" class="form-control @error('time_logs.0.end_time') is-invalid @enderror"
                                       name="time_logs[0][end_time]" min="0" max="24" step="0.01"
                                       value="{{ old('time_logs.0.end_time') }}">
                                @error('time_logs.0.end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control @error('time_logs.0.image') is-invalid @enderror"
                                       name="time_logs[0][image]">
                                @error('time_logs.0.image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Nút thêm thời gian --}}
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" id="addTimeLog" class="btn btn-secondary">+ Thêm thời gian</button>
                </div>

                {{-- Nút lưu --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.attendance-log.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let index = 1;

    document.getElementById('addTimeLog').addEventListener('click', () => {
        const container = document.getElementById('time-log-wrapper');

        const newHtml = `
            <div class="row border rounded-3 mb-3 p-4 mt-3" style="background-color: #fff;">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label>Thời gian bắt đầu</label>
                        <input type="number" class="form-control"
                               name="time_logs[${index}][start_time]" min="0" max="24" step="0.01">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group mb-3">
                        <label>Thời gian kết thúc</label>
                        <input type="number" class="form-control"
                               name="time_logs[${index}][end_time]" min="0" max="24" step="0.01">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group mb-3">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="time_logs[${index}][image]">
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newHtml);
        index++;
    });
</script>
@endpush
