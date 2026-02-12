@extends('layouts.tailadmin')

@section('title', 'Toutes les tâches')

@section('content')
<!-- Page Header -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Tâches créées</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les tâches que vous avez créées</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="badge-primary">{{ $teTasks->total() }} tâche(s)</span>
        <a href="{{ route('tasks.create') }}" class="btn-primary">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nouvelle Tâche
        </a>
    </div>
</div>

@if($teTasks->isEmpty())
<!-- Empty State -->
<div class="card">
    <div class="flex flex-col items-center justify-center py-12">
        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
        </div>
        <h4 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Aucune tâche créée</h4>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Commencez par créer votre première tâche</p>
        <a href="{{ route('tasks.create') }}" class="btn-primary">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Créer une tâche
        </a>
    </div>
</div>
@else
<!-- Tasks Table -->
<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50 text-left dark:bg-boxdark-2">
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Titre</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Statut</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Priorité</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Assigné à</th>
                    <th class="px-4 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">Échéance</th>
                    <th class="px-4 py-4 text-right text-sm font-medium text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teTasks as $teTask)
                <tr class="border-b border-stroke dark:border-strokedark hover:bg-gray-50 dark:hover:bg-boxdark-2">
                    <td class="px-4 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $teTask->tetitle }}</div>
                        <p class="text-xs text-gray-500">{{ Str::limit($teTask->tedescription, 50) }}</p>
                    </td>
                    <td class="px-4 py-4">
                        @if($teTask->testatus == 'a_faire')
                        <span class="badge-warning">
                            <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            À faire
                        </span>
                        @elseif($teTask->testatus == 'en_cours')
                        <span class="badge-primary">
                            <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            En cours
                        </span>
                        @else
                        <span class="badge-success">
                            <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Terminé
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        @if($teTask->tepriority == 'haute')
                        <span class="badge-danger">Haute</span>
                        @elseif($teTask->tepriority == 'moyenne')
                        <span class="badge-warning">Moyenne</span>
                        @else
                        <span class="badge-success">Basse</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-500 text-xs font-semibold text-white">
                                {{ strtoupper(substr($teTask->assignedUser->name ?? 'NA', 0, 2)) }}
                            </div>
                            <span class="text-sm text-gray-900 dark:text-white">{{ $teTask->assignedUser->name ?? 'Non assigné' }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($teTask->tedue_date)->format('d/m/Y') }}
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('tasks.show', ['teTask' => $teTask->id]) }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-stroke bg-white text-gray-500 hover:bg-gray-50 hover:text-primary-500 dark:border-strokedark dark:bg-boxdark dark:hover:bg-boxdark-2" title="Voir">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('tasks.edit', ['teTask' => $teTask->id]) }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-stroke bg-white text-gray-500 hover:bg-gray-50 hover:text-warning-500 dark:border-strokedark dark:bg-boxdark dark:hover:bg-boxdark-2" title="Modifier">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <a href="{{ route('tasks.remove', ['teTask' => $teTask->id]) }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-stroke bg-white text-gray-500 hover:bg-danger-50 hover:text-danger-500 dark:border-strokedark dark:bg-boxdark dark:hover:bg-danger-500/20" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
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
    {{ $teTasks->links() }}
</div>
@endif
@endsection
