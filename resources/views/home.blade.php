@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="page-header mb-5">
    <h1 class="display-4 fw-bold mb-3">
        <i class="bi bi-check2-square me-3"></i>Bienvenue, {{ Auth::user()->name }}!
    </h1>
    <p class="lead mb-0">Gérez vos tâches efficacement avec Task Manager</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-list-task fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Mes Tâches</h6>
                        <h3 class="mb-0">{{ Auth::user()->teAssignedTasks()->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('tecanCreateTask')
    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-folder-check fs-3 text-success"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Tâches Créées</h6>
                        <h3 class="mb-0">{{ Auth::user()->teCreateTask()->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-hourglass-split fs-3 text-warning"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">En Cours</h6>
                        <h3 class="mb-0">{{ Auth::user()->teAssignedTasks()->where('testatus', 'en_cours')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-check-circle fs-3 text-info"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Terminées</h6>
                        <h3 class="mb-0">{{ Auth::user()->teAssignedTasks()->where('testatus', 'termine')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4">
    <div class="col-12">
        <h4 class="fw-bold mb-4"><i class="bi bi-lightning-charge me-2"></i>Actions Rapides</h4>
    </div>

    <div class="col-md-6 col-lg-4">
        <a href="{{ route('tasks.MyTask') }}" class="text-decoration-none">
            <div class="card card-custom h-100">
                <div class="card-body text-center py-5">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-list-task fs-1 text-primary"></i>
                    </div>
                    <h5 class="card-title">Mes Tâches Assignées</h5>
                    <p class="card-text text-muted">Voir et gérer les tâches qui vous sont assignées</p>
                </div>
            </div>
        </a>
    </div>

    @can('tecanCreateTask')
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('tasks.create') }}" class="text-decoration-none">
            <div class="card card-custom h-100">
                <div class="card-body text-center py-5">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-plus-circle fs-1 text-success"></i>
                    </div>
                    <h5 class="card-title">Nouvelle Tâche</h5>
                    <p class="card-text text-muted">Créer une nouvelle tâche et l'assigner</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-4">
        <a href="{{ route('tasks.index') }}" class="text-decoration-none">
            <div class="card card-custom h-100">
                <div class="card-body text-center py-5">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-folder fs-1 text-info"></i>
                    </div>
                    <h5 class="card-title">Mes Créations</h5>
                    <p class="card-text text-muted">Gérer les tâches que vous avez créées</p>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('admin')
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <div class="card card-custom h-100">
                <div class="card-body text-center py-5">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-people fs-1 text-danger"></i>
                    </div>
                    <h5 class="card-title">Gestion Utilisateurs</h5>
                    <p class="card-text text-muted">Administrer les comptes utilisateurs</p>
                </div>
            </div>
        </a>
    </div>
    @endcan
</div>

@endsection
