@extends('layouts.tailadmin')

@section('title', 'Profil')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profil</h1>
    <p class="text-gray-500 dark:text-gray-400">Gérez vos informations de compte</p>
</div>

<div class="space-y-6">
    <!-- Update Profile Information -->
    <div class="card">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informations du Profil</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Mettez à jour vos informations et votre adresse email.</p>
        </div>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="input-field">
                @error('name')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="input-field">
                @error('email')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Votre adresse email n'est pas vérifiée.
                            <button form="send-verification" class="text-primary-500 hover:underline">
                                Cliquez ici pour renvoyer l'email de vérification.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-success-500">
                                Un nouveau lien de vérification a été envoyé à votre adresse email.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary">Sauvegarder</button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success-500">Sauvegardé.</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div class="card">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Modifier le Mot de Passe</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Assurez-vous d'utiliser un mot de passe long et aléatoire pour rester sécurisé.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="current_password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Mot de passe actuel</label>
                <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                    class="input-field">
                @error('current_password', 'updatePassword')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" autocomplete="new-password"
                    class="input-field">
                @error('password', 'updatePassword')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                    class="input-field">
                @error('password_confirmation', 'updatePassword')
                    <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary">Sauvegarder</button>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success-500">Sauvegardé.</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="card border border-danger-200 dark:border-danger-500/30">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-danger-600 dark:text-danger-500">Supprimer le Compte</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées.</p>
        </div>

        <div x-data="{ showModal: false }">
            <button type="button" @click="showModal = true" class="btn-danger">
                Supprimer le compte
            </button>

            <!-- Delete Confirmation Modal -->
            <div x-show="showModal" x-cloak class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto bg-black/50">
                <div @click.away="showModal = false" class="w-full max-w-lg rounded-lg bg-white p-6 shadow-xl dark:bg-boxdark">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                        Êtes-vous sûr de vouloir supprimer votre compte ?
                    </h3>
                    <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                        Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer.
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-6">
                            <label for="delete_password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Mot de passe</label>
                            <input type="password" id="delete_password" name="password" placeholder="Mot de passe"
                                class="input-field">
                            @error('password', 'userDeletion')
                                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showModal = false" class="btn-secondary">
                                Annuler
                            </button>
                            <button type="submit" class="btn-danger">
                                Supprimer le compte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
