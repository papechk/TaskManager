<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Jobs\SendTaskAssignedEmail;

class TaskController extends Controller
{
    /**
     * Affiche la liste des tâches créées par l'utilisateur connecté.
     */
    public function index()
    {
        $teUserId = Auth::id();
        $teUser = User::find($teUserId);

        if ($teUser) {
            $teTasks = Task::where('teuser_created_by', $teUserId) // Récupérer les tâches créées par l'utilisateur connecté
                         ->orderByRaw("CASE WHEN tepriority='haute' THEN 1 WHEN tepriority='moyenne' THEN 2 WHEN tepriority='faible' THEN 3 END")
                         ->orderBy('created_at', 'desc')
                         ->orderBy('tetitle', 'asc')
                         ->paginate(10);
            return view('tasks.liste', ['teTasks' => $teTasks]);
        } else {
            return redirect()->route('tasks.index')->with('error', 'Utilisateur non trouvé');
        }
    }

    /**
     * Affiche les tâches assignées à l'utilisateur connecté.
     */
    public function MyTask()
    {
        $teUser = Auth::user();
        $teTasks = Task::where('teuser_assigned_to', $teUser->id)
                     ->orderByRaw("CASE WHEN tepriority='haute' THEN 1 WHEN tepriority='moyenne' THEN 2 WHEN tepriority='faible' THEN 3 END")
                     ->orderBy('tedue_date', 'asc')
                     ->get();
        return view('tasks.mes-taches', ['teTasks' => $teTasks]);
    }

    /**
     * Affiche le formulaire de création d'une nouvelle tâche.
     */
    public function create()
    {
        $users = User::all();
        return view('tasks.nouveau', compact('users'));
    }

    /**
     * Enregistre une nouvelle tâche.
     */
    public function store(Request $teRequest)
    {
        $teRequest->validate([
            'tetitle' => 'required|string|max:255',
            'testart_date' => 'required|date|after_or_equal:today',
            'testart_time' => 'required|date_format:H:i',
            'tedue_date' => 'required|date|after_or_equal:testart_date',
            'teend_time' => 'required|date_format:H:i',
            'tedescription' => 'required|string|min:10',
            'tepriority' => 'required|in:haute,moyenne,faible',
            'teuser_assigned_to' => 'required|exists:users,id',
            'testatus' => 'required|in:a_faire,en_cours,termine',
        ]);

        $teTask = Task::create([
            'tetitle' => $teRequest->tetitle,
            'tedescription' => $teRequest->tedescription,
            'tepriority' => $teRequest->tepriority,
            'testart_date' => $teRequest->testart_date,
            'tedue_date' => $teRequest->tedue_date,
            'testart_time' => $teRequest->testart_time,
            'teend_time' => $teRequest->teend_time,
            'testatus' => $teRequest->testatus,
            'teuser_created_by' => Auth::id(),
            'teuser_assigned_to' => $teRequest->teuser_assigned_to,
        ]);

        // Dispatch the job to send the email
        SendTaskAssignedEmail::dispatch($teTask);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'une tâche.
     */
    public function edit(Task $teTask)
    {
        $users = User::all();
        return view('tasks.modifier', ['teTask' => $teTask, 'users' => $users]);
    }

    /**
     * Met à jour les informations d'une tâche.
     */
    public function update(Request $teRequest, Task $teTask)
    {
        $teRequest->validate([
            'tetitle' => 'required|string|max:255',
            'testart_date' => 'required|date|after_or_equal:today',
            'testart_time' => 'required|date_format:H:i',
            'tedue_date' => 'required|date|after_or_equal:testart_date',
            'teend_time' => 'required|date_format:H:i',
            'tedescription' => 'required|string|min:10',
            'tepriority' => 'required|in:haute,moyenne,faible',
            'teuser_assigned_to' => 'required|exists:users,id',
            'testatus' => 'required|in:a_faire,en_cours,termine',
        ]);

        $teTask->update([
            'tetitle' => $teRequest->tetitle,
            'tedescription' => $teRequest->tedescription,
            'tepriority' => $teRequest->tepriority,
            'testart_date' => $teRequest->testart_date,
            'tedue_date' => $teRequest->tedue_date,
            'testart_time' => $teRequest->testart_time,
            'teend_time' => $teRequest->teend_time,
            'testatus' => $teRequest->testatus,
            'teuser_assigned_to' => $teRequest->teuser_assigned_to,
        ]);

        // Dispatch the job to send the email
        SendTaskAssignedEmail::dispatch($teTask);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès');
    }

    /**
     * Supprime une tâche.
     */
    public function remove(Task $teTask)
    {
        $teTask->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès');
    }

    /**
     * Affiche les détails d'une tâche.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.detail', compact('task'));
    }

    /**
     * Met à jour le statut d'une tâche.
     */
    public function updateStatus(Request $request, Task $teTask)
    {
        $request->validate([
            'testatus' => 'required|in:a_faire,en_cours,termine',
        ]);

        $teTask->update([
            'testatus' => $request->testatus,
        ]);

        return redirect()->route('tasks.MyTask')->with('success', 'Statut de la tâche mis à jour avec succès');
    }

    /**
     * Affiche le formulaire d'assignation d'une tâche.
     */
    public function assignView(Task $teTask)
    {
        $users = User::all();
        return view('tasks.assigned-view', ['teTask' => $teTask, 'users' => $users]);
    }

    /**
     * Assigne une tâche à un utilisateur.
     */
    public function assign(Request $request, Task $teTask)
    {
        $request->validate([
            'teuser_assigned_to' => 'required|exists:users,id',
        ]);

        $teTask->update([
            'teuser_assigned_to' => $request->teuser_assigned_to,
        ]);

        // Dispatch the job to send the email
        SendTaskAssignedEmail::dispatch($teTask);

        return redirect()->route('tasks.index')->with('success', 'Tâche assignée avec succès');
    }
}
