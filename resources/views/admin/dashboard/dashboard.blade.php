@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h5">Total Users</h2>
                            <h3 class="fw-extrabold mb-1">1,234</h3>
                        </div>
                        <small class="d-flex align-items-center text-success">
                            12.5% <i class="fas fa-arrow-up ms-1"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h5">Total Orders</h2>
                            <h3 class="fw-extrabold mb-1">567</h3>
                        </div>
                        <small class="d-flex align-items-center text-success">
                            7.8% <i class="fas fa-arrow-up ms-1"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h5">Total Revenue</h2>
                            <h3 class="fw-extrabold mb-1">$34,567</h3>
                        </div>
                        <small class="d-flex align-items-center text-danger">
                            3.2% <i class="fas fa-arrow-down ms-1"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-8 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">Recent Orders</h2>
                <a href="#" class="btn btn-sm btn-primary">See all</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">Order ID</th>
                                <th class="border-0">Customer</th>
                                <th class="border-0">Date</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">#0123</td>
                                <td>John Doe</td>
                                <td>May 10, 2023</td>
                                <td>$125.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                            <!-- More rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">Top Products</h2>
                <a href="#" class="btn btn-sm btn-primary">See all</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-0">
                        <div class="d-flex">
                            <div class="icon-shape icon-shape-sm bg-primary rounded me-3">
                                <i class="fas fa-box text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Premium T-Shirt</h6>
                                <small class="text-muted">Fashion</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">45</span>
                    </li>
                    <!-- More items... -->
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
