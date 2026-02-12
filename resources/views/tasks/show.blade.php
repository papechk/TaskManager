@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-eye me-2"></i>Détails de la Tâche
    </h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">{{ $task->tetitle }}</h4>
                    <div>
                        <span class="badge badge-{{ $task->testatus }} me-2">
                            @if($task->testatus == 'a_faire')
                                <i class="bi bi-circle me-1"></i>À faire
                            @elseif($task->testatus == 'en_cours')
                                <i class="bi bi-arrow-repeat me-1"></i>En cours
                            @else
                                <i class="bi bi-check-circle me-1"></i>Terminé
                            @endif
                        </span>
                        <span class="badge badge-{{ $task->tepriority }}">
                            {{ ucfirst($task->tepriority) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase small fw-bold mb-2">
                        <i class="bi bi-text-paragraph me-1"></i>Description
                    </h6>
                    <p class="mb-0 fs-5">{{ $task->tedescription }}</p>
                </div>

                <hr>

                <!-- Dates -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-calendar-event fs-4 text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted">Date de début</small>
                                <h6 class="mb-0">{{ \Carbon\Carbon::parse($task->testart_date)->format('d/m/Y') }} à {{ $task->testart_time }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-calendar-check fs-4 text-warning"></i>
                            </div>
                            <div>
                                <small class="text-muted">Date de fin</small>
                                <h6 class="mb-0">{{ \Carbon\Carbon::parse($task->tedue_date)->format('d/m/Y') }} à {{ $task->teend_time }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Users -->
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted">Créé par</small>
                                <h6 class="mb-0">{{ $task->creator->name ?? 'Inconnu' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-check fs-4 text-info"></i>
                            </div>
                            <div>
                                <small class="text-muted">Assigné à</small>
                                <h6 class="mb-0">{{ $task->assignedUser->name ?? 'Non assigné' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour
                    </a>
                    @can('tecanCreateTask')
                    <div>
                        <a href="{{ route('tasks.edit', ['teTask' => $task->id]) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i>Modifier
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
