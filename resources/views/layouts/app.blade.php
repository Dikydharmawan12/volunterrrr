<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pendaftaran Volunter Pengajian Akbar Poliwangi 2025')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --primary-color: #16a34a;
            --secondary-color: #22c55e;
            --accent-color: #bbf7d0;
            --success-color: #16a34a;
            --warning-color: #facc15;
            --light-bg: #f0fdf4;
            --text-main: #14532d;
            --text-dark: #222;
            --text-light: #fff;
        }
        
        body {
            background: #111827;
            min-height: 100vh;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f0fdf4;
        }
        
        .navbar {
            background: #16a34a !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(22,163,74,0.08);
            color: var(--text-light);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--text-light) !important;
        }
        
        .navbar .navbar-brand, .navbar .nav-link, .navbar .btn {
            color: var(--text-light) !important;
        }
        
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(22,163,74,0.08);
            backdrop-filter: blur(10px);
            background: #18181b;
            color: #f0fdf4;
        }
        
        .card-header {
            background: #16a34a;
            color: #fff;
            border-radius: 18px 18px 0 0 !important;
            border: none;
            padding: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .btn, .btn-primary, .btn-success, .btn-warning, .btn-danger, .btn-info, .btn-secondary {
            color: #fff !important;
        }
        
        .btn-primary, .btn-success {
            background: #16a34a;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover, .btn-success:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(22,163,74,0.18);
        }
        
        .btn-info {
            background: #bbf7d0;
            color: #14532d !important;
        }
        
        .btn-info:hover {
            background: #16a34a;
            color: #fff !important;
        }
        
        .btn-light, .btn-outline-light {
            color: #14532d !important;
            background: #fff !important;
            border: 1px solid #bbf7d0 !important;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #bbf7d0;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            color: #f0fdf4;
            background: #23272f;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(22,163,74,0.15);
            color: #f0fdf4;
            background: #23272f;
        }
        
        .form-label, label {
            color: #bbf7d0;
            font-weight: 500;
        }
        
        ::placeholder {
            color: #a3a3a3;
            opacity: 1;
        }
        
        .form-text, .text-muted {
            color: #bbf7d0 !important;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }
        
        .alert-success, .alert-info {
            background: #bbf7d0;
            color: #065f46;
        }
        
        .alert-danger, .alert-warning {
            background: #fef9c3;
            color: #b91c1c;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            color: #f0fdf4;
            background: #18181b;
            border: 1px solid #22c55e;
        }
        
        .table thead th {
            background: #16a34a;
            color: #fff;
            border: none;
            font-weight: 600;
        }
        
        .table tbody td {
            color: #000000 !important;
            font-weight: 500;
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #23272f;
        }
        
        .table-striped > tbody > tr:nth-of-type(even) {
            background-color: #18181b;
        }
        
        .table-bordered > :not(caption) > * > * {
            border-color: #22c55e;
        }
        
        .badge.bg-info, .badge.bg-success {
            background: #bbf7d0;
            color: #065f46 !important;
            font-weight: 600;
        }
        
        .badge.bg-primary, .badge.bg-warning, .badge.bg-danger {
            color: #fff !important;
        }
        
        .hero-section {
            background: #16a34a;
            color: #fff;
            padding: 4rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
        }
        
        .feature-card {
            transition: all 0.3s ease;
            cursor: pointer;
            color: #f0fdf4;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(22,163,74,0.12);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #16a34a;
        }
        
        a, .nav-link {
            color: #bbf7d0;
        }
        
        a:hover, .nav-link:hover {
            color: #22c55e;
        }
        
        .text-dark { color: #f0fdf4 !important; }
        .text-main { color: #bbf7d0 !important; }
        .text-white { color: #fff !important; }
        .text-success { color: #16a34a !important; }
        .text-danger { color: #b91c1c !important; }
        .text-warning { color: #facc15 !important; }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }
            
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .card-header {
                padding: 1rem;
            }
        }
        
        /* Button Logout khusus di navbar */
        .navbar .btn-logout, .navbar .btn-outline-light {
            background: #bbf7d0 !important;
            color: #065f46 !important;
            border: none !important;
            font-weight: 600;
            border-radius: 20px;
            padding: 6px 18px;
            transition: all 0.2s;
        }
        .navbar .btn-logout:hover, .navbar .btn-outline-light:hover {
            background: #16a34a !important;
            color: #fff !important;
        }
        
        /* Badge di dalam tabel */
        .table .badge, .table .bg-info, .table .bg-primary, .table .bg-success {
            background: #16a34a !important;
            color: #fff !important;
            font-weight: 600;
            border-radius: 8px;
            font-size: 0.95em;
        }
        
        /* Tombol aksi di tabel */
        .table .btn {
            margin-right: 0.3rem;
        }
        .table .btn:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-mosque me-2"></i>
                Volunter Pengajian Akbar
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pendaftaran">
                            <i class="fas fa-user-plus me-1"></i>Pendaftaran
                        </a>
                    </li>
                </ul>
                @if(session('admin_verified'))
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-logout btn-sm">
                                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>