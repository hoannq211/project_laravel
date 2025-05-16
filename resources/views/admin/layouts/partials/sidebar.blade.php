<div class="sidebar">
    <div class="sidebar-header">
        <h3 class="brand">
            <span class="fas fa-tachometer-alt"></span>
            <span>Admin</span>
        </h3>
        <label for="sidebar-toggle" class="fas fa-bars"></label>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <span class="fas fa-tachometer-alt"></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fas fa-users"></span>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}">
                    <span class="fas fa-box"></span>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fas fa-shopping-cart"></span>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.attendance-log.index') }}">
                    <span class="fas fa-chart-bar"></span>
                    <span>Attendance Log</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fas fa-cog"></span>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
