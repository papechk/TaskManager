<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Confirmer le mot de passe</h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ceci est une zone sécurisée. Veuillez confirmer votre mot de passe.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Mot de passe</label>
            <div class="relative">
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    placeholder="Entrez votre mot de passe"
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

        <button type="submit" class="btn-primary w-full">
            Confirmer
        </button>
    </form>
</x-guest-layout>
