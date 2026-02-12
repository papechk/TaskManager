@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-pencil-square me-2"></i>Modifier la Tâche
    </h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-body p-4 p-lg-5">
                <form method="POST" action="{{ route('tasks.update', ['teTask' => $teTask->id]) }}">
                    @csrf

                    <!-- Titre -->
                    <div class="mb-4">
                        <label for="tetitle" class="form-label fw-bold">
                            <i class="bi bi-type me-1 text-primary"></i>Titre de la tâche
                        </label>
                        <input type="text" name="tetitle" id="tetitle"
                               class="form-control form-control-lg @error('tetitle') is-invalid @enderror"
                               value="{{ old('tetitle', $teTask->tetitle) }}"
                               placeholder="Entrez le titre de la tâche">
                        @error('tetitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dates -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="testart_date" class="form-label fw-bold">
                                <i class="bi bi-calendar-event me-1 text-success"></i>Date de début
                            </label>
                            <input type="date" name="testart_date" id="testart_date"
                                   class="form-control @error('testart_date') is-invalid @enderror"
                                   value="{{ old('testart_date', $teTask->testart_date) }}">
                            @error('testart_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="testart_time" class="form-label fw-bold">
                                <i class="bi bi-clock me-1 text-success"></i>Heure de début
                            </label>
                            <input type="time" name="testart_time" id="testart_time"
                                   class="form-control @error('testart_time') is-invalid @enderror"
                                   value="{{ old('testart_time', $teTask->testart_time) }}">
                            @error('testart_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tedue_date" class="form-label fw-bold">
                                <i class="bi bi-calendar-check me-1 text-warning"></i>Date de fin
                            </label>
                            <input type="date" name="tedue_date" id="tedue_date"
                                   class="form-control @error('tedue_date') is-invalid @enderror"
                                   value="{{ old('tedue_date', $teTask->tedue_date) }}">
                            @error('tedue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="teend_time" class="form-label fw-bold">
                                <i class="bi bi-clock-history me-1 text-warning"></i>Heure de fin
                            </label>
                            <input type="time" name="teend_time" id="teend_time"
                                   class="form-control @error('teend_time') is-invalid @enderror"
                                   value="{{ old('teend_time', $teTask->teend_time) }}">
                            @error('teend_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="tedescription" class="form-label fw-bold">
                            <i class="bi bi-text-paragraph me-1 text-secondary"></i>Description
                        </label>
                        <textarea name="tedescription" id="tedescription" rows="4"
                                  class="form-control @error('tedescription') is-invalid @enderror"
                                  placeholder="Décrivez la tâche en détail...">{{ old('tedescription', $teTask->tedescription) }}</textarea>
                        @error('tedescription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Priority & Status -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tepriority" class="form-label fw-bold">
                                <i class="bi bi-exclamation-triangle me-1 text-danger"></i>Priorité
                            </label>
                            <select name="tepriority" id="tepriority"
                                    class="form-select @error('tepriority') is-invalid @enderror">
                                <option value="faible" {{ old('tepriority', $teTask->tepriority) == 'faible' ? 'selected' : '' }}>🟢 Faible</option>
                                <option value="moyenne" {{ old('tepriority', $teTask->tepriority) == 'moyenne' ? 'selected' : '' }}>🟡 Moyenne</option>
                                <option value="haute" {{ old('tepriority', $teTask->tepriority) == 'haute' ? 'selected' : '' }}>🔴 Haute</option>
                            </select>
                            @error('tepriority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="testatus" class="form-label fw-bold">
                                <i class="bi bi-flag me-1 text-info"></i>Statut
                            </label>
                            <select name="testatus" id="testatus"
                                    class="form-select @error('testatus') is-invalid @enderror">
                                <option value="a_faire" {{ old('testatus', $teTask->testatus) == 'a_faire' ? 'selected' : '' }}>À faire</option>
                                <option value="en_cours" {{ old('testatus', $teTask->testatus) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('testatus', $teTask->testatus) == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            @error('testatus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Assigned User -->
                    <div class="mb-4">
                        <label for="teuser_assigned_to" class="form-label fw-bold">
                            <i class="bi bi-person-plus me-1 text-primary"></i>Assigner à
                        </label>
                        <select name="teuser_assigned_to" id="teuser_assigned_to"
                                class="form-select @error('teuser_assigned_to') is-invalid @enderror">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('teuser_assigned_to', $teTask->teuser_assigned_to) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('teuser_assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <button type="submit" class="btn btn-gradient btn-lg">
                            <i class="bi bi-check-lg me-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
