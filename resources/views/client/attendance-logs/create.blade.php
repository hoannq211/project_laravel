@extends('client.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title m-0">
                        <i class="fas fa-clock me-2"></i>Form Chấm Công
                    </h3>
                </div>
                <div class="card-body">
                    <form id="timekeepingForm">
                        <!-- Time Log Group 1 -->
                        <div class="time-log-group mb-4 p-3 border rounded">
                            <div class="row mb-3">
                                <label for="date" class="col-sm-2 col-form-label">Ngày <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date" required>
                                    <small class="text-muted">Chọn ngày chấm công</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="startTime1" class="col-sm-2 col-form-label">Giờ bắt đầu <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="startTime1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="endTime1" class="col-sm-2 col-form-label">Giờ kết thúc <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="endTime1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image1" class="col-sm-2 col-form-label">Ảnh <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image1" accept="image/*" required>
                                    <small class="text-muted">Ảnh sẽ được upload lên FTP server</small>
                                </div>
                            </div>
                        </div>

                        <!-- Additional time logs will be appended here -->
                        <div id="additionalTimeLogs"></div>

                        <!-- Add Time Log Button -->
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="button" class="btn btn-outline-primary" id="addTimeLogBtn">
                                    <i class="fas fa-plus me-2"></i>Thêm khoảng thời gian
                                </button>
                                <small class="text-muted d-block mt-1">Click để thêm khoảng thời gian mới</small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle me-2"></i>Gửi chấm công
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let timeLogCount = 1;

                // Add Time Log functionality
                document.getElementById('addTimeLogBtn').addEventListener('click', function() {
                    timeLogCount++;
                    const newGroup = document.createElement('div');
                    newGroup.className = 'time-log-group mb-4 p-3 border rounded';
                    newGroup.id = 'timeLogGroup' + timeLogCount;

                    newGroup.innerHTML = `
                    <div class="row mb-3">
                        <label for="startTime${timeLogCount}" class="col-sm-2 col-form-label">Giờ bắt đầu <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="startTime${timeLogCount}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="endTime${timeLogCount}" class="col-sm-2 col-form-label">Giờ kết thúc <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="endTime${timeLogCount}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="image${timeLogCount}" class="col-sm-2 col-form-label">Ảnh <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image${timeLogCount}" accept="image/*" required>
                            <small class="text-muted">Ảnh sẽ được upload lên FTP server</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-time-log" data-group="timeLogGroup${timeLogCount}">
                                <i class="fas fa-trash me-1"></i>Xóa khoảng này
                            </button>
                        </div>
                    </div>
                `;

                    document.getElementById('additionalTimeLogs').appendChild(newGroup);

                    // Add event listener for the new remove button
                    newGroup.querySelector('.remove-time-log').addEventListener('click', function() {
                        document.getElementById(this.dataset.group).remove();
                    });
                });

                // Form submission
                document.getElementById('timekeepingForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Here you would normally handle the form submission
                    // For example, upload images to FTP and save the time logs
                    alert('Thông tin chấm công đã được gửi thành công!');

                    // Reset form after submission (optional)
                    this.reset();
                    document.getElementById('additionalTimeLogs').innerHTML = '';
                    timeLogCount = 1;
                });
            });
        </script>
    @endpush
@endsection
