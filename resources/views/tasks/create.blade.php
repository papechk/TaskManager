@extends('layouts.tailadmin')

@section('title', 'Nouvelle Tâche')

@section('content')
<!-- Page Header -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Nouvelle Tâche</h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Créez et assignez une nouvelle tâche</p>
</div>

<div class="mx-auto max-w-3xl">
    <div class="card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <!-- Titre -->
            <div class="mb-6">
                <label for="tetitle" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Titre de la tâche
                </label>
                <input type="text" name="tetitle" id="tetitle"
                       class="input-field @error('tetitle') border-danger-500 @enderror"
                       value="{{ old('tetitle') }}"
                       placeholder="Entrez le titre de la tâche">
                @error('tetitle')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dates -->
            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="testart_date" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Date de début
                    </label>
                    <input type="date" name="testart_date" id="testart_date"
                           class="input-field @error('testart_date') border-danger-500 @enderror"
                           value="{{ old('testart_date') }}">
                    @error('testart_date')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="testart_time" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Heure de début
                    </label>
                    <input type="time" name="testart_time" id="testart_time"
                           class="input-field @error('testart_time') border-danger-500 @enderror"
                           value="{{ old('testart_time') }}">
                    @error('testart_time')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="tedue_date" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Date de fin
                    </label>
                    <input type="date" name="tedue_date" id="tedue_date"
                           class="input-field @error('tedue_date') border-danger-500 @enderror"
                           value="{{ old('tedue_date') }}">
                    @error('tedue_date')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="teend_time" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Heure de fin
                    </label>
                    <input type="time" name="teend_time" id="teend_time"
                           class="input-field @error('teend_time') border-danger-500 @enderror"
                           value="{{ old('teend_time') }}">
                    @error('teend_time')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="tedescription" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Description
                </label>
                <textarea name="tedescription" id="tedescription" rows="4"
                          class="input-field @error('tedescription') border-danger-500 @enderror"
                          placeholder="Décrivez la tâche en détail...">{{ old('tedescription') }}</textarea>
                @error('tedescription')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Priority & Status -->
            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="tepriority" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Priorité
                    </label>
                    <select name="tepriority" id="tepriority"
                            class="input-field @error('tepriority') border-danger-500 @enderror">
                        <option value="faible" {{ old('tepriority') == 'faible' ? 'selected' : '' }}>🟢 Faible</option>
                        <option value="moyenne" {{ old('tepriority') == 'moyenne' ? 'selected' : '' }}>🟡 Moyenne</option>
                        <option value="haute" {{ old('tepriority') == 'haute' ? 'selected' : '' }}>🔴 Haute</option>
                    </select>
                    @error('tepriority')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="testatus" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                        Statut
                    </label>
                    <select name="testatus" id="testatus"
                            class="input-field @error('testatus') border-danger-500 @enderror">
                        <option value="a_faire" {{ old('testatus') == 'a_faire' ? 'selected' : '' }}>À faire</option>
                        <option value="en_cours" {{ old('testatus') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('testatus') == 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                    @error('testatus')
                        <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Assigned User -->
            <div class="mb-6">
                <label for="teuser_assigned_to" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Assigner à
                </label>
                <select name="teuser_assigned_to" id="teuser_assigned_to"
                        class="input-field @error('teuser_assigned_to') border-danger-500 @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('teuser_assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('teuser_assigned_to')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between border-t border-stroke pt-6 dark:border-strokedark">
                <a href="{{ route('tasks.index') }}" class="btn-secondary">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Créer la tâche
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
