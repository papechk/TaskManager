<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Réinitialiser le mot de passe</h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Entrez votre nouveau mot de passe.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-4">
            <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                class="input-field">
            @error('email')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Nouveau mot de passe</label>
            <div class="relative">
                <input type="password" id="password" name="password" required autocomplete="new-password"
                    placeholder="Entrez votre nouveau mot de passe"
                    class="input-field pl-10">
                <span class="absolute left-4 top-4">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirmez votre mot de passe"
                    class="input-field pl-10">
                <span class="absolute left-4 top-4">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            @error('password_confirmation')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full">
            Réinitialiser le mot de passe
        </button>
    </form>
</x-guest-layout>
