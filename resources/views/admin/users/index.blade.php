@extends('layouts.tailadmin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<!-- Page Header -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestion des Utilisateurs</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Administrez les comptes utilisateurs</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="badge-primary">{{ $teUsers->total() }} utilisateur(s)</span>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Nouvel Utilisateur
        </a>
    </div>
</div>

<!-- Users Table -->
<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50 text-left dark:bg-boxdark-2">
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Utilisateur</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Rôles</th>
                    <th class="px-4 py-4 text-right text-sm font-medium text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teUsers as $teItems)
                <tr class="border-b border-stroke dark:border-strokedark hover:bg-gray-50 dark:hover:bg-boxdark-2">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-500 text-sm font-semibold text-white">
                                {{ strtoupper(substr($teItems->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $teItems->name }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $teItems->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $teItems->email }}
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach ($teItems->roles as $teRole)
                                @if($teRole->name == 'admin')
                                <span class="badge-danger">{{ ucfirst($teRole->name) }}</span>
                                @elseif($teRole->name == 'manager')
                                <span class="badge-warning">{{ ucfirst($teRole->name) }}</span>
                                @else
                                <span class="badge-primary">{{ ucfirst($teRole->name) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', ['user' => $teItems->id]) }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-stroke bg-white text-gray-500 hover:bg-gray-50 hover:text-warning-500 dark:border-strokedark dark:bg-boxdark dark:hover:bg-boxdark-2" title="Modifier">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.users.destroy', ['user' => $teItems->id]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-lg border border-stroke bg-white text-gray-500 hover:bg-danger-50 hover:text-danger-500 dark:border-strokedark dark:bg-boxdark dark:hover:bg-danger-500/20" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
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
<div class="mt-6 flex justify-center">
    {{ $teUsers->links() }}
</div>
@endsection
