@extends('layouts.tailadmin')

@section('title', 'Nouvel Utilisateur')

@section('content')
<!-- Page Header -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Nouvel Utilisateur</h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Créer un nouveau compte utilisateur</p>
</div>

<div class="mx-auto max-w-xl">
    <div class="card">
        @if($errors->any())
            <div class="mb-6 rounded-lg bg-danger-100 px-4 py-3 text-sm text-danger-600 dark:bg-danger-500/20 dark:text-danger-400">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div class="mb-6">
                <label for="name" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Nom
                </label>
                <input type="text" name="name" id="name"
                       class="input-field @error('name') border-danger-500 @enderror"
                       value="{{ old('name') }}"
                       placeholder="Nom de l'utilisateur" required>
                @error('name')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Email
                </label>
                <input type="email" name="email" id="email"
                       class="input-field @error('email') border-danger-500 @enderror"
                       value="{{ old('email') }}"
                       placeholder="exemple@email.com" required>
                @error('email')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-6">
                <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Mot de passe
                </label>
                <input type="password" name="password" id="password"
                       class="input-field @error('password') border-danger-500 @enderror"
                       placeholder="Minimum 8 caractères" required>
                @error('password')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-6">
                <label for="password_confirmation" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Confirmer le mot de passe
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="input-field"
                       placeholder="Retapez le mot de passe" required>
            </div>

            <!-- Rôles -->
            <div class="mb-6">
                <label class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                    Rôles
                </label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($roles as $role)
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 hover:bg-gray-50 dark:border-strokedark dark:hover:bg-boxdark-2">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                               class="h-4 w-4 rounded border-stroke text-primary-500 focus:ring-primary-500 dark:border-strokedark dark:bg-boxdark"
                               {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ ucfirst($role->name) }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between border-t border-stroke pt-6 dark:border-strokedark">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
