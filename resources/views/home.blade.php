@extends('layouts.tailadmin')

@section('title', 'Dashboard')

@section('content')
<!-- Hero Section -->
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
        Bienvenue, {{ Auth::user()->name }}!
    </h1>
    <p class="mt-2 text-gray-500 dark:text-gray-400">Gérez vos tâches efficacement avec Task Manager</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4 mb-6">
    <div class="card border-l-4 border-primary-500">
        <div class="flex items-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-500/20">
                <svg class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">Mes Tâches</p>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->teAssignedTasks()->count() }}</h4>
            </div>
        </div>
    </div>

    @can('tecanCreateTask')
    <div class="card border-l-4 border-success-500">
        <div class="flex items-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-success-100 dark:bg-success-500/20">
                <svg class="h-7 w-7 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">Tâches Créées</p>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->teCreateTask()->count() }}</h4>
            </div>
        </div>
    </div>
    @endcan

    <div class="card border-l-4 border-warning-500">
        <div class="flex items-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-warning-100 dark:bg-warning-500/20">
                <svg class="h-7 w-7 text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">En Cours</p>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->teAssignedTasks()->where('testatus', 'en_cours')->count() }}</h4>
            </div>
        </div>
    </div>

    <div class="card border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/20">
                <svg class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">Terminées</p>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->teAssignedTasks()->where('testatus', 'termine')->count() }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-6">
    <h4 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Actions Rapides</h4>
</div>

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
    <a href="{{ route('tasks.MyTask') }}" class="card group hover:shadow-lg transition-shadow">
        <div class="flex flex-col items-center text-center py-4">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 group-hover:bg-primary-200 dark:bg-primary-500/20 dark:group-hover:bg-primary-500/30 transition-colors">
                <svg class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h5 class="mb-2 font-semibold text-gray-900 dark:text-white">Mes Tâches Assignées</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">Voir et gérer vos tâches</p>
        </div>
    </a>

    @can('tecanCreateTask')
    <a href="{{ route('tasks.create') }}" class="card group hover:shadow-lg transition-shadow">
        <div class="flex flex-col items-center text-center py-4">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-success-100 group-hover:bg-success-200 dark:bg-success-500/20 dark:group-hover:bg-success-500/30 transition-colors">
                <svg class="h-8 w-8 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h5 class="mb-2 font-semibold text-gray-900 dark:text-white">Nouvelle Tâche</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">Créer et assigner une tâche</p>
        </div>
    </a>

    <a href="{{ route('tasks.index') }}" class="card group hover:shadow-lg transition-shadow">
        <div class="flex flex-col items-center text-center py-4">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 group-hover:bg-blue-200 dark:bg-blue-500/20 dark:group-hover:bg-blue-500/30 transition-colors">
                <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <h5 class="mb-2 font-semibold text-gray-900 dark:text-white">Mes Créations</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gérer vos tâches créées</p>
        </div>
    </a>
    @endcan

    @can('admin')
    <a href="{{ route('admin.users.index') }}" class="card group hover:shadow-lg transition-shadow">
        <div class="flex flex-col items-center text-center py-4">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-danger-100 group-hover:bg-danger-200 dark:bg-danger-500/20 dark:group-hover:bg-danger-500/30 transition-colors">
                <svg class="h-8 w-8 text-danger-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
            </div>
            <h5 class="mb-2 font-semibold text-gray-900 dark:text-white">Gestion Utilisateurs</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">Administrer les comptes</p>
        </div>
    </a>
    @endcan
</div>
@endsection
