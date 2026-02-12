@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Modifier la tâche</h1>
            <div class="text-muted small">Modifier les informations de la tâche.</div>
        </div>
        <div class="ml-auto">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left mr-1"></i> Retour
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle mr-2"></i>Veuillez corriger les erreurs ci-dessous.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit mr-2"></i>Informations de la tâche</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', ['teTask' => $teTask->id]) }}">
                @csrf

                <div class="row">
                    <!-- Titre -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tetitle" class="font-weight-bold">
                                <i class="fa fa-heading text-primary mr-1"></i>Titre de la tâche *
                            </label>
                            <input type="text" name="tetitle" id="tetitle"
                                   class="form-control @error('tetitle') is-invalid @enderror"
                                   value="{{ old('tetitle', $teTask->tetitle) }}"
                                   placeholder="Entrez le titre de la tâche" required>
                            @error('tetitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Date début -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="testart_date" class="font-weight-bold">
                                <i class="fa fa-calendar-alt text-success mr-1"></i>Date de début *
                            </label>
                            <input type="date" name="testart_date" id="testart_date"
                                   class="form-control @error('testart_date') is-invalid @enderror"
                                   value="{{ old('testart_date', $teTask->testart_date) }}" required>
                            @error('testart_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Heure début -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="testart_time" class="font-weight-bold">
                                <i class="fa fa-clock text-success mr-1"></i>Heure de début *
                            </label>
                            <input type="time" name="testart_time" id="testart_time"
                                   class="form-control @error('testart_time') is-invalid @enderror"
                                   value="{{ old('testart_time', $teTask->testart_time) }}" required>
                            @error('testart_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Date fin -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tedue_date" class="font-weight-bold">
                                <i class="fa fa-calendar-check text-warning mr-1"></i>Date de fin *
                            </label>
                            <input type="date" name="tedue_date" id="tedue_date"
                                   class="form-control @error('tedue_date') is-invalid @enderror"
                                   value="{{ old('tedue_date', $teTask->tedue_date) }}" required>
                            @error('tedue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Heure fin -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="teend_time" class="font-weight-bold">
                                <i class="fa fa-clock text-warning mr-1"></i>Heure de fin *
                            </label>
                            <input type="time" name="teend_time" id="teend_time"
                                   class="form-control @error('teend_time') is-invalid @enderror"
                                   value="{{ old('teend_time', $teTask->teend_time) }}" required>
                            @error('teend_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tedescription" class="font-weight-bold">
                                <i class="fa fa-align-left text-secondary mr-1"></i>Description *
                            </label>
                            <textarea name="tedescription" id="tedescription" rows="4"
                                      class="form-control @error('tedescription') is-invalid @enderror"
                                      placeholder="Décrivez la tâche en détail..." required>{{ old('tedescription', $teTask->tedescription) }}</textarea>
                            @error('tedescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Priorité -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tepriority" class="font-weight-bold">
                                <i class="fa fa-flag text-danger mr-1"></i>Priorité *
                            </label>
                            <select name="tepriority" id="tepriority"
                                    class="form-control @error('tepriority') is-invalid @enderror" required>
                                <option value="">Sélectionner...</option>
                                <option value="haute" {{ old('tepriority', $teTask->tepriority) == 'haute' ? 'selected' : '' }}>Haute</option>
                                <option value="moyenne" {{ old('tepriority', $teTask->tepriority) == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                                <option value="faible" {{ old('tepriority', $teTask->tepriority) == 'faible' ? 'selected' : '' }}>Basse</option>
                            </select>
                            @error('tepriority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Statut -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="testatus" class="font-weight-bold">
                                <i class="fa fa-tasks text-info mr-1"></i>Statut *
                            </label>
                            <select name="testatus" id="testatus"
                                    class="form-control @error('testatus') is-invalid @enderror" required>
                                <option value="">Sélectionner...</option>
                                <option value="a_faire" {{ old('testatus', $teTask->testatus) == 'a_faire' ? 'selected' : '' }}>À faire</option>
                                <option value="en_cours" {{ old('testatus', $teTask->testatus) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('testatus', $teTask->testatus) == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            @error('testatus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Assigné à -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teuser_assigned_to" class="font-weight-bold">
                                <i class="fa fa-user text-primary mr-1"></i>Assigner à *
                            </label>
                            <select name="teuser_assigned_to" id="teuser_assigned_to"
                                    class="form-control @error('teuser_assigned_to') is-invalid @enderror" required>
                                <option value="">Sélectionner un utilisateur...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('teuser_assigned_to', $teTask->teuser_assigned_to) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teuser_assigned_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times mr-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save mr-1"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
