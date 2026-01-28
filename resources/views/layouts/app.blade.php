<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sauna Manager</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            /* Deep, relaxing, premium sauna vibes using dark blues and warm accents */
            --bg-gradient: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%); 
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --accent: #ff7e5f; /* Warm sunset/sauna glow */
            --accent-hover: #feb47b;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-gradient);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-sauna {
            background: linear-gradient(to right, var(--accent), #ff9966);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-sauna:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 126, 95, 0.4);
            color: white;
        }

        .btn-outline-sauna {
            background: transparent;
            border: 2px solid var(--glass-border);
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-sauna:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .nav-brand-text {
            font-weight: 700;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }

        /* Override Bootstrap Form Control for Dark Theme */
        .form-control, .form-select {
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--glass-border);
            color: white;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: rgba(0, 0, 0, 0.3);
            border-color: var(--accent);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(255, 126, 95, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .table-dark-glass {
            color: white;
            --bs-table-bg: transparent;
            --bs-table-border-color: var(--glass-border);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg glass-card mx-3 mt-3 p-3">
        <div class="container-fluid">
            <a class="navbar-brand nav-brand-text" href="{{ route('home') }}">Talai Herbal Sauna</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    @auth
                        <li class="nav-item">
                            <span class="text-white-50 me-2">Welcome, {{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="btn btn-sauna btn-sm">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-sauna btn-sm">Logout</button>
                            </form>
                        </li>
                        <!-- Login link hidden as per request. Access via /login directly. -->
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success bg-opacity-25 border-0 text-white" style="background-color: #198754 !important;">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger bg-opacity-25 border-0 text-white" style="background-color: #dc3545 !important;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center py-4 text-white-50">
        <div class="container">
            &copy; {{ date('Y') }} Talai Herbal Sauna. Providing relaxation at Nairobi & Kapsabet.
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
