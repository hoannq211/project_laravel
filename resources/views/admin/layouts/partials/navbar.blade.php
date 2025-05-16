<nav class="navbar navbar-expand navbar-light navbar-bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-crown me-2"></i>
            <span class="d-none d-md-inline">Admin Panel</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                 <li>
                    <p>{{ __('messages.language') }}:
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}">English</a> |
                        <a href="{{ route('lang.switch', ['locale' => 'vi']) }}">Tiếng Việt</a>
                    </p>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="fas fa-bell"></i>
                            <span class="indicator">4</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0">
                        <div class="dropdown-menu-header">
                            4 New Notifications
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="fas fa-bell text-danger"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">Update completed</div>
                                        <div class="text-muted small mt-1">Restart server 12 to complete the update.
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="#" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-cog"></i>
                    </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                        data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random"
                            class="avatar img-fluid rounded-circle me-1" alt="Admin" />
                        <span class="text-dark">Admin</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>
                            Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
