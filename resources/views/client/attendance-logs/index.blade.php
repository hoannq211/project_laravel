@extends('client.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title m-0">
                        <i class="fas fa-clock me-2"></i>Danh Sách Chấm Công
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Tổng số giờ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendanceLogs as $index => $attendanceLog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $attendanceLog['date'] }}</td>
                                    <td>{{ number_format($attendanceLog->total_hours, 2) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
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

    @push('scripts')
    @endpush
@endsection
