@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-people me-2"></i>Gestion des Utilisateurs
    </h1>
    <p class="lead mb-0">Administrez les comptes utilisateurs</p>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.users.create') }}" class="btn btn-gradient btn-lg">
        <i class="bi bi-person-plus me-2"></i>Nouvel Utilisateur
    </a>
    <span class="badge bg-secondary fs-6">{{ $teUsers->total() }} utilisateur(s)</span>
</div>

<!-- Users Table -->
<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="ps-4">Utilisateur</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôles</th>
                    <th scope="col" class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teUsers as $teItems)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-person-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $teItems->name }}</div>
                                <small class="text-muted">ID: {{ $teItems->id }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <i class="bi bi-envelope me-1 text-muted"></i>
                        {{ $teItems->email }}
                    </td>
                    <td>
                        @foreach ($teItems->roles as $teRole)
                            @if($teRole->name == 'admin')
                                <span class="badge bg-danger">{{ ucfirst($teRole->name) }}</span>
                            @elseif($teRole->name == 'manager')
                                <span class="badge bg-warning text-dark">{{ ucfirst($teRole->name) }}</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($teRole->name) }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.users.edit', ['user' => $teItems->id]) }}" class="btn btn-outline-primary" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', ['user' => $teItems->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $teUsers->links('pagination::bootstrap-5') }}
</div>

@endsection
