@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Détails de la tâche</h1>
            <div class="text-muted small">Consultez les informations de cette tâche.</div>
        </div>
        <div class="ml-auto">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left mr-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Details Card -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle mr-2"></i>{{ $task->tetitle }}</h6>
                    <div>
                        @if($task->testatus == 'a_faire')
                            <span class="badge badge-secondary mr-1">
                                <i class="fa fa-circle mr-1"></i>À faire
                            </span>
                        @elseif($task->testatus == 'en_cours')
                            <span class="badge badge-info mr-1">
                                <i class="fa fa-sync-alt mr-1"></i>En cours
                            </span>
                        @else
                            <span class="badge badge-success mr-1">
                                <i class="fa fa-check-circle mr-1"></i>Terminé
                            </span>
                        @endif

                        @if($task->tepriority == 'haute')
                            <span class="badge badge-danger">Haute</span>
                        @elseif($task->tepriority == 'moyenne')
                            <span class="badge badge-warning">Moyenne</span>
                        @else
                            <span class="badge badge-secondary">Basse</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Description -->
                    <h6 class="text-muted text-uppercase small font-weight-bold mb-2">
                        <i class="fa fa-align-left mr-1"></i>Description
                    </h6>
                    <p class="mb-4">{{ $task->tedescription }}</p>

                    <hr>

                    <!-- Dates -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mr-3" style="width:50px; height:50px;">
                                    <i class="fa fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Date de début</small>
                                    <div class="font-weight-bold">{{ \Carbon\Carbon::parse($task->testart_date)->format('d/m/Y') }} à {{ $task->testart_time }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mr-3" style="width:50px; height:50px;">
                                    <i class="fa fa-calendar-check"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Date de fin</small>
                                    <div class="font-weight-bold">{{ \Carbon\Carbon::parse($task->tedue_date)->format('d/m/Y') }} à {{ $task->teend_time }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Users Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-users mr-2"></i>Personnes</h6>
                </div>
                <div class="card-body">
                    <!-- Created By -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width:45px; height:45px; font-size:14px;">
                            {{ $task->creator ? strtoupper(substr($task->creator->name, 0, 2)) : '?' }}
                        </div>
                        <div>
                            <small class="text-muted">Créé par</small>
                            <div class="font-weight-bold">{{ $task->creator->name ?? 'Inconnu' }}</div>
                        </div>
                    </div>

                    <hr>

                    <!-- Assigned To -->
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mr-3" style="width:45px; height:45px; font-size:14px;">
                            {{ $task->assignedUser ? strtoupper(substr($task->assignedUser->name, 0, 2)) : '?' }}
                        </div>
                        <div>
                            <small class="text-muted">Assigné à</small>
                            <div class="font-weight-bold">{{ $task->assignedUser->name ?? 'Non assigné' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog mr-2"></i>Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('tasks.edit', ['teTask' => $task->id]) }}" class="btn btn-warning btn-block text-white mb-2">
                        <i class="fa fa-edit mr-2"></i>Modifier
                    </a>
                    @can('tecanCreateTask')
                    <a href="{{ route('tasks.remove', ['teTask' => $task->id]) }}" class="btn btn-danger btn-block" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                        <i class="fa fa-trash mr-2"></i>Supprimer
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
