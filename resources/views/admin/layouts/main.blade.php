<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom CSS -->
    @vite('resources/css/admin.css')

    @stack('styles')
</head>

<body class="admin-layout">
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.partials.sidebar')

        <div class="main">
            <!-- Navbar -->
            @include('admin.layouts.partials.navbar')

            <!-- Main Content -->
            <main class="content">
                <div class="container-fluid p-4">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('admin.layouts.partials.footer')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Laravel Echo -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('js/admin-notifications.js') }}"></script>

    @stack('scripts')
    {{-- <script>
        window.Echo.channel('login-channel')
            .listen('.login-event', (e) => {
                const logList = document.getElementById('login-logs');
                const logItem = document.createElement('li');
                logItem.textContent = `User ${e.user.name} logged in at ${e.loginTime}`;
                logList.appendChild(logItem);
            });
    </script> --}}
</body>

</html>
