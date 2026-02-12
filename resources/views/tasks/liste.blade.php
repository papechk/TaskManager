@extends('layouts.admin')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Gestion des tâches</h1>
            <div class="text-muted small">Gérez toutes les tâches du système.</div>
        </div>
        <div class="ml-auto">
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus mr-1"></i> Nouvelle tâche
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-times-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list mr-2"></i>Liste des tâches</h6>
            <span class="badge badge-secondary">{{ $teTasks->total() }} tâche(s)</span>
        </div>
        <div class="card-body">
            @if($teTasks->isEmpty())
                <div class="text-center py-5">
                    <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucune tâche créée</h5>
                    <p class="text-muted">Commencez par créer votre première tâche</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-success">
                        <i class="fa fa-plus mr-1"></i>Créer une tâche
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width:60px">#</th>
                                <th>Titre</th>
                                <th class="text-center">Statut</th>
                                <th class="text-center">Priorité</th>
                                <th>Assigné à</th>
                                <th class="text-center">Échéance</th>
                                <th class="text-center" style="width:140px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teTasks as $item)
                                <tr>
                                    <td class="text-center font-weight-bold text-secondary">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-weight-bold">{{ $item->tetitle }}</div>
                                        <small class="text-muted">{{ Str::limit($item->tedescription, 40) }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($item->testatus == 'a_faire')
                                            <span class="badge badge-pill badge-secondary">
                                                <i class="fa fa-circle mr-1"></i>À faire
                                            </span>
                                        @elseif($item->testatus == 'en_cours')
                                            <span class="badge badge-pill badge-info">
                                                <i class="fa fa-sync-alt mr-1"></i>En cours
                                            </span>
                                        @else
                                            <span class="badge badge-pill badge-success">
                                                <i class="fa fa-check-circle mr-1"></i>Terminé
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->tepriority == 'haute')
                                            <span class="badge badge-pill badge-danger">Haute</span>
                                        @elseif($item->tepriority == 'moyenne')
                                            <span class="badge badge-pill badge-warning">Moyenne</span>
                                        @else
                                            <span class="badge badge-pill badge-secondary">Basse</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width:30px; height:30px; font-size:11px;">
                                                {{ $item->assignedUser ? strtoupper(substr($item->assignedUser->name, 0, 2)) : '?' }}
                                            </div>
                                            {{ $item->assignedUser->name ?? 'Non assigné' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <small><i class="fa fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($item->tedue_date)->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('tasks.show', ['teTask' => $item->id]) }}" class="btn btn-sm btn-info text-white mr-1" title="Voir">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tasks.edit', ['teTask' => $item->id]) }}" class="btn btn-sm btn-warning text-white mr-1" title="Modifier">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('tasks.remove', ['teTask' => $item->id]) }}" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $teTasks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
