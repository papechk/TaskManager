<x-guest-layout>
    <h4 class="mb-6 text-center text-2xl font-bold text-gray-900 dark:text-white">Inscription</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Nom complet
            </label>
            <div class="relative">
                <input type="text" id="name" name="name"
                       class="input-field pl-10 @error('name') border-danger-500 @enderror"
                       value="{{ old('name') }}"
                       placeholder="Votre nom" required autofocus autocomplete="name">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
            </div>
            @error('name')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Email
            </label>
            <div class="relative">
                <input type="email" id="email" name="email"
                       class="input-field pl-10 @error('email') border-danger-500 @enderror"
                       value="{{ old('email') }}"
                       placeholder="votre@email.com" required autocomplete="username">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
            </div>
            @error('email')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Mot de passe
            </label>
            <div class="relative">
                <input type="password" id="password" name="password"
                       class="input-field pl-10 @error('password') border-danger-500 @enderror"
                       placeholder="••••••••" required autocomplete="new-password">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Confirmer le mot de passe
            </label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="input-field pl-10"
                       placeholder="••••••••" required autocomplete="new-password">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full justify-center">
            <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            S'inscrire
        </button>
    </form>

    <div class="my-6 border-t border-stroke dark:border-strokedark"></div>

    <div class="text-center">
        <span class="text-sm text-gray-500 dark:text-gray-400">Déjà inscrit ?</span>
        <a href="{{ route('login') }}" class="ml-1 text-sm font-semibold text-primary-500 hover:underline">
            Se connecter
        </a>
    </div>
</x-guest-layout>
