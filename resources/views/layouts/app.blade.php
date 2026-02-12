<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Task Manager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --card-shadow: 0 10px 40px rgba(0,0,0,0.1);
            }
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                font-family: 'Figtree', sans-serif;
            }
            .navbar-custom {
                background: var(--primary-gradient);
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            }
            .card-custom {
                border: none;
                border-radius: 15px;
                box-shadow: var(--card-shadow);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card-custom:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            }
            .btn-gradient {
                background: var(--primary-gradient);
                border: none;
                color: white;
                transition: all 0.3s ease;
            }
            .btn-gradient:hover {
                transform: scale(1.05);
                box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
                color: white;
            }
            .table-modern {
                border-radius: 15px;
                overflow: hidden;
                box-shadow: var(--card-shadow);
            }
            .table-modern thead {
                background: var(--primary-gradient);
                color: white;
            }
            .badge-haute { background-color: #dc3545 !important; }
            .badge-moyenne { background-color: #ffc107 !important; color: #212529 !important; }
            .badge-faible { background-color: #198754 !important; }
            .badge-a_faire { background-color: #dc3545 !important; }
            .badge-en_cours { background-color: #ffc107 !important; color: #212529 !important; }
            .badge-termine { background-color: #198754 !important; }
            .form-control:focus, .form-select:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            }
            .page-header {
                background: var(--primary-gradient);
                color: white;
                padding: 2rem;
                border-radius: 15px;
                margin-bottom: 2rem;
                text-align: center;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.navBar')

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
