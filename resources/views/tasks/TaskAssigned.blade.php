@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-list-task me-2"></i>Mes Tâches Assignées
    </h1>
    <p class="lead mb-0">Tâches qui vous ont été assignées</p>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($teTasks->isEmpty())
    <!-- Empty State -->
    <div class="card card-custom">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">Aucune tâche assignée</h4>
            <p class="text-muted mb-0">Vous n'avez pas encore de tâches assignées</p>
        </div>
    </div>
@else
    <!-- Tasks Grid -->
    <div class="row g-4">
        @foreach ($teTasks as $teTask)
        <div class="col-md-6 col-lg-4">
            <div class="card card-custom h-100">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                    <span class="badge badge-{{ $teTask->tepriority }}">
                        @if($teTask->tepriority == 'haute')
                            <i class="bi bi-exclamation-triangle me-1"></i>
                        @endif
                        {{ ucfirst($teTask->tepriority) }}
                    </span>
                    <span class="badge badge-{{ $teTask->testatus }}">
                        @if($teTask->testatus == 'a_faire')
                            <i class="bi bi-circle me-1"></i>À faire
                        @elseif($teTask->testatus == 'en_cours')
                            <i class="bi bi-arrow-repeat me-1"></i>En cours
                        @else
                            <i class="bi bi-check-circle me-1"></i>Terminé
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $teTask->tetitle }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($teTask->tedescription, 100) }}</p>

                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-calendar3 text-muted me-2"></i>
                        <small class="text-muted">
                            Échéance: {{ \Carbon\Carbon::parse($teTask->tedue_date)->format('d/m/Y') }} à {{ $teTask->teend_time }}
                        </small>
                    </div>

                    <div class="d-flex align-items-center">
                        <i class="bi bi-person text-muted me-2"></i>
                        <small class="text-muted">
                            Par: {{ $teTask->creator->name ?? 'Inconnu' }}
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-white border-top py-3">
                    <!-- Status Update Form -->
                    <form method="POST" action="{{ route('tasks.updateStatus', ['teTask' => $teTask->id]) }}" class="d-flex gap-2">
                        @csrf
                        <select name="testatus" class="form-select form-select-sm flex-grow-1">
                            <option value="a_faire" {{ $teTask->testatus == 'a_faire' ? 'selected' : '' }}>À faire</option>
                            <option value="en_cours" {{ $teTask->testatus == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="termine" {{ $teTask->testatus == 'termine' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-gradient">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <a href="{{ route('tasks.show', ['teTask' => $teTask->id]) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
