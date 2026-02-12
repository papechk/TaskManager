@extends('layouts.tailadmin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7">
    <!-- Total Tasks Card -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-500/20">
                <svg class="h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="ml-4">
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTasks ?? 0 }}</h4>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total des tâches</span>
            </div>
        </div>
    </div>

    <!-- Pending Tasks Card -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-warning-100 dark:bg-warning-500/20">
                <svg class="h-6 w-6 text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingTasks ?? 0 }}</h4>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">En attente</span>
            </div>
        </div>
    </div>

    <!-- In Progress Tasks Card -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/20">
                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $inProgressTasks ?? 0 }}</h4>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">En cours</span>
            </div>
        </div>
    </div>

    <!-- Completed Tasks Card -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-success-100 dark:bg-success-500/20">
                <svg class="h-6 w-6 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedTasks ?? 0 }}</h4>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Terminées</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Tasks and Quick Actions -->
<div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 2xl:gap-7">
    <!-- My Tasks -->
    <div class="card">
        <div class="mb-4 flex items-center justify-between border-b border-stroke pb-4 dark:border-strokedark">
            <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Mes tâches récentes</h4>
            <a href="{{ route('tasks.MyTask') }}" class="text-sm font-medium text-primary-500 hover:underline">Voir tout</a>
        </div>
        <div class="flex flex-col gap-3">
            @forelse($myTasks ?? [] as $task)
            <div class="flex items-center justify-between rounded-lg border border-stroke p-3 dark:border-strokedark">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full
                        @if($task->status === 'completed') bg-success-100 dark:bg-success-500/20
                        @elseif($task->status === 'in_progress') bg-blue-100 dark:bg-blue-500/20
                        @else bg-warning-100 dark:bg-warning-500/20 @endif">
                        @if($task->status === 'completed')
                        <svg class="h-4 w-4 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        @elseif($task->status === 'in_progress')
                        <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        @else
                        <svg class="h-4 w-4 text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @endif
                    </div>
                    <div>
                        <h5 class="text-sm font-medium text-gray-900 dark:text-white">{{ $task->title }}</h5>
                        <p class="text-xs text-gray-500">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Pas de date' }}</p>
                    </div>
                </div>
                <span class="badge-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning') }}">
                    {{ $task->status === 'completed' ? 'Terminée' : ($task->status === 'in_progress' ? 'En cours' : 'En attente') }}
                </span>
            </div>
            @empty
            <p class="py-4 text-center text-sm text-gray-500 dark:text-gray-400">Aucune tâche assignée</p>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="mb-4 border-b border-stroke pb-4 dark:border-strokedark">
            <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Actions rapides</h4>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('tasks.create') }}" class="flex flex-col items-center justify-center rounded-lg border border-stroke p-6 transition hover:bg-gray-50 dark:border-strokedark dark:hover:bg-boxdark-2">
                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-500/20">
                    <svg class="h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Nouvelle tâche</span>
            </a>
            <a href="{{ route('tasks.index') }}" class="flex flex-col items-center justify-center rounded-lg border border-stroke p-6 transition hover:bg-gray-50 dark:border-strokedark dark:hover:bg-boxdark-2">
                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-success-100 dark:bg-success-500/20">
                    <svg class="h-6 w-6 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Voir les tâches</span>
            </a>
            <a href="{{ route('tasks.MyTask') }}" class="flex flex-col items-center justify-center rounded-lg border border-stroke p-6 transition hover:bg-gray-50 dark:border-strokedark dark:hover:bg-boxdark-2">
                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-warning-100 dark:bg-warning-500/20">
                    <svg class="h-6 w-6 text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Mes tâches</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center rounded-lg border border-stroke p-6 transition hover:bg-gray-50 dark:border-strokedark dark:hover:bg-boxdark-2">
                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-500/20">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Paramètres</span>
            </a>
        </div>
    </div>
</div>

@if(Auth::user()->hasRole('admin'))
<!-- Users Overview for Admin -->
<div class="mt-6">
    <div class="card">
        <div class="mb-4 flex items-center justify-between border-b border-stroke pb-4 dark:border-strokedark">
            <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Utilisateurs récents</h4>
            <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-primary-500 hover:underline">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 text-left dark:bg-boxdark-2">
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-300">Utilisateur</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-300">Rôle</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-300">Date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers ?? [] as $user)
                    <tr class="border-b border-stroke dark:border-strokedark">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-500 text-white text-sm font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @foreach($user->roles as $role)
                            <span class="badge-{{ $role->name === 'admin' ? 'danger' : ($role->name === 'manager' ? 'warning' : 'primary') }}">
                                {{ ucfirst($role->name) }}
                            </span>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">Aucun utilisateur</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
