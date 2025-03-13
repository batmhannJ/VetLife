<!-- resources/views/layouts/patient.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Patient Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #21324a !important;
        }
        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .nav-link {
            color: #fff !important;
            margin-right: 15px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #8ce99a !important;
        }
        .nav-link.active {
            color: #8ce99a !important;
            font-weight: bold;
        }
        .dropdown-menu {
            background-color: #21324a;
            border: none;
        }
        .dropdown-item {
            color: #fff;
        }
        .dropdown-item:hover {
            background-color: #2c3e50;
            color: #8ce99a;
        }
        .content-wrapper {
            padding: 30px 0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #21324a;
            color: white;
            font-weight: bold;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
        .main-content {
            min-height: calc(100vh - 160px);
        }
        .footer {
            background-color: #21324a;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('patient.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                CLSU-VETLIFE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}" href="{{ route('patient.dashboard') }}">
                            <i class="fas fa-home"></i> Appointment
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient.profile.*') ? 'active' : '' }}" href="{{ route('patient.profile.show') }}">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient.appointments.*') ? 'active' : '' }}" href="{{ route('patient.appointments.index') }}">
                            <i class="fas fa-calendar-check"></i> My Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient.prescriptions.*') ? 'active' : '' }}" href="{{ route('patient.prescriptions.index') }}">
                            <i class="fas fa-prescription"></i> Our Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient.test-results.*') ? 'active' : '' }}" href="{{ route('patient.test-results.index') }}">
                            <i class="fas fa-vial"></i> About Us
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('patient.profile.show') }}">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content py-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-0">&copy; {{ date('Y') }} CLSU-VETLIFE. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    @yield('scripts')
</body>
</html>