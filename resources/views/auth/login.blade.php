<x-guest-layout>
    <h4 class="text-center fw-bold mb-4">Connexion</h4>

    <!-- Session Status -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">
                <i class="bi bi-envelope me-1"></i>Email
            </label>
            <input type="email" id="email" name="email"
                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="votre@email.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">
                <i class="bi bi-lock me-1"></i>Mot de passe
            </label>
            <input type="password" id="password" name="password"
                   class="form-control form-control-lg @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-gradient btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </button>
        </div>

        <div class="text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>
    </form>

    <hr class="my-4">

    <div class="text-center">
        <span class="text-muted">Pas encore de compte ?</span>
        <a href="{{ route('register') }}" class="fw-bold text-decoration-none ms-1">
            S'inscrire
        </a>
    </div>
</x-guest-layout>
