<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Mot de passe oublié?</h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Entrez votre email pour recevoir un lien de réinitialisation.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded-lg bg-success-100 p-4 text-sm text-success-700 dark:bg-success-500/20 dark:text-success-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">Email</label>
            <div class="relative">
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Entrez votre email"
                    class="input-field pl-10">
                <span class="absolute left-4 top-4">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
            </div>
            @error('email')
                <p class="mt-1 text-sm text-danger-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full">
            Envoyer le lien
        </button>

        <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('login') }}" class="text-primary-500 hover:underline">Retour à la connexion</a>
        </p>
    </form>
</x-guest-layout>
