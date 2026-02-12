@extends('layouts.tailadmin')

@section('title', 'Détails de la Tâche')

@section('content')
<!-- Page Header -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Détails de la Tâche</h2>
</div>

<div class="mx-auto max-w-3xl">
    <div class="card">
        <!-- Header -->
        <div class="mb-6 flex items-start justify-between border-b border-stroke pb-6 dark:border-strokedark">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $task->tetitle }}</h3>
                <div class="mt-2 flex items-center gap-2">
                    @if($task->testatus == 'a_faire')
                    <span class="badge-warning">À faire</span>
                    @elseif($task->testatus == 'en_cours')
                    <span class="badge-primary">En cours</span>
                    @else
                    <span class="badge-success">Terminé</span>
                    @endif

                    @if($task->tepriority == 'haute')
                    <span class="badge-danger">Priorité haute</span>
                    @elseif($task->tepriority == 'moyenne')
                    <span class="badge-warning">Priorité moyenne</span>
                    @else
                    <span class="badge-success">Priorité basse</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h4 class="mb-2 text-sm font-medium uppercase text-gray-500 dark:text-gray-400">Description</h4>
            <p class="text-gray-900 dark:text-white">{{ $task->tedescription }}</p>
        </div>

        <!-- Dates -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="flex items-center gap-4 rounded-lg border border-stroke p-4 dark:border-strokedark">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-success-100 dark:bg-success-500/20">
                    <svg class="h-6 w-6 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Date de début</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($task->testart_date)->format('d/m/Y') }} à {{ $task->testart_time }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 rounded-lg border border-stroke p-4 dark:border-strokedark">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-warning-100 dark:bg-warning-500/20">
                    <svg class="h-6 w-6 text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Date de fin</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($task->tedue_date)->format('d/m/Y') }} à {{ $task->teend_time }}</p>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="flex items-center gap-4 rounded-lg border border-stroke p-4 dark:border-strokedark">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-500/20">
                    <svg class="h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Créé par</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $task->creator->name ?? 'Inconnu' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 rounded-lg border border-stroke p-4 dark:border-strokedark">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/20">
                    <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Assigné à</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $task->assignedUser->name ?? 'Non assigné' }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between border-t border-stroke pt-6 dark:border-strokedark">
            <a href="{{ url()->previous() }}" class="btn-secondary">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour
            </a>
            @can('tecanCreateTask')
            <a href="{{ route('tasks.edit', ['teTask' => $task->id]) }}" class="btn-primary">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Modifier
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection
