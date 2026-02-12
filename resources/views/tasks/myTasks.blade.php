@extends('layouts.tailadmin')

@section('title', 'Mes Tâches')

@section('content')
<!-- Page Header -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Mes Tâches</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tâches qui vous sont assignées</p>
    </div>
    <span class="badge-primary">{{ count($teTasks) }} tâche(s)</span>
</div>

@if(count($teTasks) === 0)
<!-- Empty State -->
<div class="card">
    <div class="flex flex-col items-center justify-center py-12">
        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <h4 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Aucune tâche assignée</h4>
        <p class="text-sm text-gray-500 dark:text-gray-400">Vous n'avez aucune tâche pour le moment</p>
    </div>
</div>
@else
<!-- Tasks Grid -->
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
    @foreach($teTasks as $teTask)
    <div class="card hover:shadow-lg transition-shadow duration-200">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $teTask->tetitle }}</h4>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $teTask->tedescription }}</p>
            </div>
            @if($teTask->tepriority == 'haute')
            <span class="badge-danger ml-2">Haute</span>
            @elseif($teTask->tepriority == 'moyenne')
            <span class="badge-warning ml-2">Moyenne</span>
            @else
            <span class="badge-success ml-2">Basse</span>
            @endif
        </div>

        <div class="flex items-center gap-4 mb-4 text-sm text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-1">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ \Carbon\Carbon::parse($teTask->tedue_date)->format('d/m/Y') }}
            </div>
            <div class="flex items-center gap-1">
                @if($teTask->testatus == 'a_faire')
                <span class="badge-warning">À faire</span>
                @elseif($teTask->testatus == 'en_cours')
                <span class="badge-primary">En cours</span>
                @else
                <span class="badge-success">Terminé</span>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between border-t border-stroke pt-4 dark:border-strokedark">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-500 text-xs font-semibold text-white">
                    {{ strtoupper(substr($teTask->creator->name ?? 'NA', 0, 2)) }}
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Par {{ $teTask->creator->name ?? 'Inconnu' }}</span>
            </div>
            <a href="{{ route('tasks.show', ['teTask' => $teTask->id]) }}" class="text-sm font-medium text-primary-500 hover:underline">
                Voir détails →
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
