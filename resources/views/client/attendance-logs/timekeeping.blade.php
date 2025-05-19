@extends('client.layouts.main')

@push('styles')
    <style>
        /* Custom CSS for Timekeeping System */

        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Header Styles */
        header {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 500;
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            border-bottom: none;
            font-weight: 600;
        }

        /* Time Display Styles */
        .time-display {
            border: 1px solid #dee2e6;
        }

        .current-time {
            color: #0d6efd;
        }

        .current-date {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Attendance Status Styles */
        .attendance-status {
            border: 1px solid #dee2e6;
        }

        .status-icon {
            color: #28a745;
        }

        /* Button Styles */
        .btn-lg {
            padding: 0.5rem 1.5rem;
            font-size: 1.1rem;
        }

        /* Calendar Styles */
        #mini-calendar table {
            width: 100%;
        }

        #mini-calendar th {
            font-size: 0.8rem;
            text-align: center;
            padding: 0.3rem;
        }

        #mini-calendar td {
            font-size: 0.9rem;
            text-align: center;
            padding: 0.5rem;
            cursor: pointer;
        }

        #mini-calendar td:hover {
            background-color: #f8f9fa;
        }

        #mini-calendar .text-muted {
            color: #adb5bd !important;
        }

        /* Footer Styles */
        footer {
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer h5 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.5rem;
        }

        footer ul li {
            margin-bottom: 0.5rem;
        }

        footer a {
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #0dcaf0 !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .logo h1 {
                font-size: 1.2rem;
            }

            .user-info .btn {
                font-size: 0.9rem;
                padding: 0.25rem 0.5rem;
            }

            .current-time {
                font-size: 2rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-8">
            <!-- Phần chấm công -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title m-0">
                        <i class="fas fa-fingerprint me-2"></i>Chấm công hôm nay
                    </h3>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="time-display bg-light p-3 rounded">
                                <h4>Giờ hiện tại</h4>
                                <div class="current-time fs-1 fw-bold" id="clock"></div>
                                <div class="current-date" id="date"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <form action="{{ route('staff.timekeeping') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="check-in">
                            <button class="btn btn-success btn-lg me-md-2" {{ $hasCheckedIn ? 'disabled' : '' }}>
                                <i class="fas fa-sign-in-alt me-2"></i>Check-in
                            </button>
                        </form>

                        <form action="{{ route('staff.timekeeping.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="check-out">
                            <button class="btn btn-danger btn-lg" {{ $hasCheckedIn && !$hasCheckedOut ? '' : 'disabled' }}>
                                <i class="fas fa-sign-out-alt me-2"></i>Check-out
                            </button>
                        </form>
                    </div>
                    <div class="row mt-3 mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Giờ check-in</th>
                                    <th>Giờ check-out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeEntries as $index => $timeEntry)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ number_format($timeEntry->start_time, 2) }}</td>
                                        <td>{{ number_format($timeEntry->end_time, 2) }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Thông tin cá nhân -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title m-0">
                        <i class="fas fa-user me-2"></i>Thông tin cá nhân
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="#" class="rounded-circle img-thumbnail" alt="Avatar">
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Họ tên</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Điện Thoại</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Chức vụ</th>
                            <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function updateClock() {
            const now = new Date();

            // Lấy giờ hiện tại
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;

            // Lấy ngày hiện tại
            const weekdays = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
            const dayName = weekdays[now.getDay()];
            const dateString =
                `${dayName}, ${now.getDate().toString().padStart(2, '0')}/${(now.getMonth()+1).toString().padStart(2, '0')}/${now.getFullYear()}`;

            // Hiển thị lên HTML
            document.getElementById('clock').textContent = timeString;
            document.getElementById('date').textContent = dateString;
        }

        // Cập nhật mỗi giây
        setInterval(updateClock, 1000);
        updateClock(); // gọi lần đầu để hiển thị ngay lập tức
    </script>
@endpush
