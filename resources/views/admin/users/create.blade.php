@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-person-plus me-2"></i>Nouvel Utilisateur
    </h1>
    <p class="lead mb-0">Créer un nouveau compte utilisateur</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-custom">
            <div class="card-body p-4 p-lg-5">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="bi bi-person me-1 text-primary"></i>Nom
                        </label>
                        <input type="text" name="name" id="name"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Nom de l'utilisateur" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">
                            <i class="bi bi-envelope me-1 text-info"></i>Email
                        </label>
                        <input type="email" name="email" id="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="exemple@email.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">
                            <i class="bi bi-lock me-1 text-warning"></i>Mot de passe
                        </label>
                        <input type="password" name="password" id="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               placeholder="Minimum 8 caractères" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-bold">
                            <i class="bi bi-lock-fill me-1 text-warning"></i>Confirmer le mot de passe
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control form-control-lg"
                               placeholder="Retapez le mot de passe" required>
                    </div>

                    <!-- Rôles -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-shield-check me-1 text-success"></i>Rôles
                        </label>
                        <div class="row g-3">
                            @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check card p-3 h-100">
                                    <input class="form-check-input" type="checkbox"
                                           name="roles[]" value="{{ $role->id }}"
                                           id="role-{{ $role->id }}"
                                           {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="role-{{ $role->id }}">
                                        @if($role->name == 'admin')
                                            <i class="bi bi-shield-fill text-danger me-1"></i>
                                        @elseif($role->name == 'manager')
                                            <i class="bi bi-briefcase-fill text-warning me-1"></i>
                                        @else
                                            <i class="bi bi-person-fill text-secondary me-1"></i>
                                        @endif
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <button type="submit" class="btn btn-gradient btn-lg">
                            <i class="bi bi-check-lg me-2"></i>Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
