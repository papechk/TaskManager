@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('tasks.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nouvelle tâche
        </a>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Total Tasks Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Tâches</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTasks ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks In Progress Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">En cours</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tasksInProgress ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sync-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Completed Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Terminées</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tasksCompleted ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- My Tasks -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check mr-2"></i>Mes tâches assignées</h6>
                    <a href="{{ route('tasks.MyTask') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    @if(isset($myTasks) && $myTasks->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($myTasks->take(5) as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <div class="font-weight-bold">{{ $task->tetitle }}</div>
                                        <small class="text-muted">Échéance: {{ \Carbon\Carbon::parse($task->tedue_date)->format('d/m/Y') }}</small>
                                    </div>
                                    @if($task->testatus == 'a_faire')
                                        <span class="badge badge-secondary">À faire</span>
                                    @elseif($task->testatus == 'en_cours')
                                        <span class="badge badge-info">En cours</span>
                                    @else
                                        <span class="badge badge-success">Terminé</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">Aucune tâche assignée</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-bolt mr-2"></i>Actions rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-block py-3">
                                <i class="fas fa-plus-circle mb-2 fa-2x d-block"></i>
                                Nouvelle tâche
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('tasks.index') }}" class="btn btn-info btn-block py-3">
                                <i class="fas fa-list mb-2 fa-2x d-block"></i>
                                Toutes les tâches
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('tasks.MyTask') }}" class="btn btn-success btn-block py-3">
                                <i class="fas fa-user-check mb-2 fa-2x d-block"></i>
                                Mes tâches
                            </a>
                        </div>
                        @if(Auth::user()->hasRole('admin'))
                        <div class="col-6 mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-block py-3">
                                <i class="fas fa-users mb-2 fa-2x d-block"></i>
                                Utilisateurs
                            </a>
                        </div>
                        @else
                        <div class="col-6 mb-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary btn-block py-3">
                                <i class="fas fa-user-cog mb-2 fa-2x d-block"></i>
                                Mon profil
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
