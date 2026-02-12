@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-folder me-2"></i>Tâches Créées
    </h1>
    <p class="lead mb-0">Gérez les tâches que vous avez créées</p>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('tasks.create') }}" class="btn btn-gradient btn-lg">
        <i class="bi bi-plus-circle me-2"></i>Nouvelle Tâche
    </a>
    <span class="badge bg-secondary fs-6">{{ $teTasks->total() }} tâche(s)</span>
</div>

@if($teTasks->isEmpty())
    <!-- Empty State -->
    <div class="card card-custom">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">Aucune tâche créée</h4>
            <p class="text-muted mb-4">Commencez par créer votre première tâche</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-gradient">
                <i class="bi bi-plus-circle me-2"></i>Créer une tâche
            </a>
        </div>
    </div>
@else
    <!-- Tasks Table -->
    <div class="card card-custom">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="ps-4">Titre</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Priorité</th>
                        <th scope="col">Assigné à</th>
                        <th scope="col">Échéance</th>
                        <th scope="col" class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teTasks as $teTask)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $teTask->tetitle }}</div>
                            <small class="text-muted">{{ Str::limit($teTask->tedescription, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge badge-{{ $teTask->testatus }}">
                                @if($teTask->testatus == 'a_faire')
                                    <i class="bi bi-circle me-1"></i>À faire
                                @elseif($teTask->testatus == 'en_cours')
                                    <i class="bi bi-arrow-repeat me-1"></i>En cours
                                @else
                                    <i class="bi bi-check-circle me-1"></i>Terminé
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $teTask->tepriority }}">
                                {{ ucfirst($teTask->tepriority) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                    <i class="bi bi-person-fill text-primary small"></i>
                                </div>
                                {{ $teTask->assignedUser->name ?? 'Non assigné' }}
                            </div>
                        </td>
                        <td>
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ \Carbon\Carbon::parse($teTask->tedue_date)->format('d/m/Y') }}
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('tasks.show', ['teTask' => $teTask->id]) }}" class="btn btn-outline-info" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('tasks.edit', ['teTask' => $teTask->id]) }}" class="btn btn-outline-primary" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('tasks.remove', ['teTask' => $teTask->id]) }}" class="btn btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $teTasks->links('pagination::bootstrap-5') }}
    </div>
@endif

@endsection
