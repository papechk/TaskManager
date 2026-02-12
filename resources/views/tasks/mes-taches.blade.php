@extends('layouts.admin')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Mes tâches assignées</h1>
            <div class="text-muted small">Tâches qui vous ont été assignées.</div>
        </div>
        <div class="ml-auto">
            <span class="badge badge-primary">{{ count($teTasks) }} tâche(s)</span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if($teTasks->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucune tâche assignée</h5>
                <p class="text-muted mb-0">Vous n'avez pas encore de tâches assignées</p>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($teTasks as $teTask)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        @if($teTask->tepriority == 'haute')
                            <span class="badge badge-danger"><i class="fa fa-exclamation-triangle mr-1"></i>Haute</span>
                        @elseif($teTask->tepriority == 'moyenne')
                            <span class="badge badge-warning">Moyenne</span>
                        @else
                            <span class="badge badge-secondary">Basse</span>
                        @endif

                        @if($teTask->testatus == 'a_faire')
                            <span class="badge badge-secondary"><i class="fa fa-circle mr-1"></i>À faire</span>
                        @elseif($teTask->testatus == 'en_cours')
                            <span class="badge badge-info"><i class="fa fa-sync-alt mr-1"></i>En cours</span>
                        @else
                            <span class="badge badge-success"><i class="fa fa-check-circle mr-1"></i>Terminé</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $teTask->tetitle }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($teTask->tedescription, 100) }}</p>

                        <div class="mb-2">
                            <small><i class="fa fa-calendar-alt text-warning mr-1"></i>Échéance: {{ \Carbon\Carbon::parse($teTask->tedue_date)->format('d/m/Y') }} à {{ $teTask->teend_time }}</small>
                        </div>

                        <div>
                            <small><i class="fa fa-user text-primary mr-1"></i>Par: {{ $teTask->creator->name ?? 'Inconnu' }}</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{ route('tasks.updateStatus', ['teTask' => $teTask->id]) }}" class="d-flex">
                            @csrf
                            <select name="testatus" class="form-control form-control-sm mr-2">
                                <option value="a_faire" {{ $teTask->testatus == 'a_faire' ? 'selected' : '' }}>À faire</option>
                                <option value="en_cours" {{ $teTask->testatus == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ $teTask->testatus == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-save"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
