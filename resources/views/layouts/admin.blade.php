<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TaskManager') }} - Admin</title>

    <!-- Font Awesome -->
    <link href="{{ asset('templates/templateAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('templates/templateAdmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body { font-family: 'Inter', 'Nunito', system-ui, -apple-system, sans-serif; }
        .sidebar-brand-text { font-weight: 700; letter-spacing: 0.4px; }
        .topbar .nav-item .nav-link { color: #1f2937; }
        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }
        .card { border: none; border-radius: 0.5rem; }
        .card-header { background-color: #f8f9fc; border-bottom: 1px solid #e3e6f0; }
        .table thead th { border-top: none; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; color: #5a5c69; }
        .btn-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border: none;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #224abe 0%, #1a3a9e 100%);
            color: white;
        }
    </style>
    @stack('styles')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TaskManager</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Gestion</div>

            <!-- Tâches -->
            <li class="nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Toutes les tâches</span>
                </a>
            </li>

            <!-- Mes Tâches -->
            <li class="nav-item {{ request()->routeIs('tasks.MyTask') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tasks.MyTask') }}">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Mes tâches</span>
                </a>
            </li>

            <!-- Nouvelle Tâche -->
            <li class="nav-item {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tasks.create') }}">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Nouvelle tâche</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('admin'))
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Administration</div>

            <!-- Utilisateurs -->
            <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggle -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Mobile) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('templates/templateAdmin/img/undraw_profile.svg') }}" alt="avatar">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; {{ date('Y') }} TaskManager - Tous droits réservés</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    <script src="{{ asset('templates/templateAdmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/templateAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templates/templateAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('templates/templateAdmin/js/sb-admin-2.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
