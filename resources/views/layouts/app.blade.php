<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Quiz App') }} - @yield('title')</title>
    
    <!-- Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Kustom -->
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3f37c9;
            --secondary-color: #f72585;
            --secondary-light: #ff4d6d;
            --secondary-dark: #b5179e;
            --accent-color: #4cc9f0;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #1f2937;
            --gray-color: #6b7280;
            --gray-light-color: #f3f4f6;
            --gray-dark-color: #374151;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #333;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
        }
        
        .navbar-brand i {
            background: white;
            color: var(--primary-color);
            padding: 8px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
        }
        
        .navbar .nav-link:hover {
            color: white !important;
        }
        
        .sidebar {
            background: linear-gradient(180deg, var(--primary-color), var(--primary-dark));
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            padding-top: 70px;
            transition: all 0.3s;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(45deg, var(--secondary-color), var(--secondary-light));
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 90px;
            transition: all 0.3s;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            border: none;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(45deg, var(--secondary-color), var(--secondary-light));
            border: none;
            box-shadow: 0 4px 10px rgba(247, 37, 133, 0.3);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(45deg, var(--secondary-dark), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(247, 37, 133, 0.4);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .badge-primary {
            background-color: var(--primary-color);
        }
        
        .progress {
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: 600;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Stat Card Styles untuk Dashboard */
        .stat-card {
            border-radius: 16px;
            padding: 30px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 250px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Warna untuk kartu statistik */
        .stat-card:nth-child(1) {
            background-color: #ffba08;
            background-image: linear-gradient(to bottom right, #ffba08, #faa307);
        }

        .stat-card:nth-child(2) {
            background-color: #4cc9f0;
            background-image: linear-gradient(to bottom right, #4cc9f0, #4361ee);
        }

        .stat-card:nth-child(3) {
            background-color: #2b9348;
            background-image: linear-gradient(to bottom right, #2b9348, #1b7a3e);
        }

        .stat-card:nth-child(4) {
            background-color: #7209b7;
            background-image: linear-gradient(to bottom right, #7209b7, #560bad);
        }

        .stat-card .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.2);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card .label {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 10px;
            color: white;
        }

        .stat-card .number {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1;
        }

        .stat-card .user {
            font-size: 1rem;
            opacity: 0.9;
        } 
        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 0;
                padding-top: 60px;
            }
            
            .sidebar.show {
                width: 250px;
            }
            
            .main-content {
                margin-left: 0;
                padding-top: 70px;
            }
            
            .navbar-toggler {
                display: block;
            }
        }
        
        /* Auth Pages */
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .auth-card {
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }
        
        .auth-card .card-header {
            background-color: transparent;
            text-align: center;
            padding: 30px 20px;
            border-bottom: none;
        }
        
        .auth-card .card-header h4 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.8rem;
        }
        
        .auth-card .card-body {
            padding: 30px;
        }
        
        .auth-card .form-group {
            margin-bottom: 20px;
        }
        
        .auth-card .form-control {
            height: 50px;
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #e9ecef;
            background-color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s;
        }
        
        .auth-card .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
            background-color: white;
        }
        
        .auth-card .btn {
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .auth-card .card-footer {
            background-color: transparent;
            text-align: center;
            padding: 20px;
            border-top: none;
        }
        
        .auth-card .card-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-card .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    @auth
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler me-2" type="button" id="sidebarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="fas fa-graduation-cap"></i>Quiz App
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4361ee&color=fff" class="avatar me-2">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard.profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}" href="{{ route('dashboard.profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('quizzes.*') ? 'active' : '' }}" href="{{ route('quizzes.index') }}">
                        <i class="fas fa-question-circle"></i> Practice Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" href="{{ route('dashboard.leaderboard') }}">
                        <i class="fas fa-trophy"></i> Leaderboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.history') ? 'active' : '' }}" href="{{ route('dashboard.history') }}">
                        <i class="fas fa-history"></i> History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    @else
        @yield('content')
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Sidebar Toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('show');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).click(function(event) {
                if (!$(event.target).closest('#sidebar').length && !$(event.target).closest('#sidebarToggle').length && $('#sidebar').hasClass('show')) {
                    $('#sidebar').removeClass('show');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>