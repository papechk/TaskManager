<x-guest-layout>
    <h4 class="mb-6 text-center text-2xl font-bold text-gray-900 dark:text-white">Connexion</h4>

    <!-- Session Status -->
    @if(session('status'))
        <div class="mb-4 rounded-lg bg-success-100 px-4 py-3 text-sm text-success-600 dark:bg-success-500/20 dark:text-success-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Email
            </label>
            <div class="relative">
                <input type="email" id="email" name="email"
                       class="input-field pl-10 @error('email') border-danger-500 @enderror"
                       value="{{ old('email') }}"
                       placeholder="votre@email.com" required autofocus>
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
                       placeholder="••••••••" required>
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

        <!-- Remember Me -->
        <div class="mb-6 flex items-center">
            <input type="checkbox" class="h-4 w-4 rounded border-stroke text-primary-500 focus:ring-primary-500 dark:border-strokedark dark:bg-boxdark" id="remember_me" name="remember">
            <label class="ml-2 text-sm text-gray-600 dark:text-gray-300" for="remember_me">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-primary w-full justify-center">
            <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Se connecter
        </button>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-primary-500 dark:text-gray-400 dark:hover:text-primary-400">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>
    </form>

    <div class="my-6 border-t border-stroke dark:border-strokedark"></div>

    <div class="text-center">
        <span class="text-sm text-gray-500 dark:text-gray-400">Pas encore de compte ?</span>
        <a href="{{ route('register') }}" class="ml-1 text-sm font-semibold text-primary-500 hover:underline">
            S'inscrire
        </a>
    </div>
</x-guest-layout>
