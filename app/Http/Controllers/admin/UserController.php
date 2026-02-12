<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    // Affiche la liste des utilisateurs avec pagination
    public function index()
    {
        $teUsers = User::paginate(10); // Paginer les utilisateurs, 10 par page
        $roles = Role::all();
        return view('admin.users.liste', compact('teUsers', 'roles'));
    }

    // Affiche le formulaire de création d'un utilisateur
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // Enregistre un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles'));

        session()->flash('success', 'Compte utilisateur créé avec succès');

        return redirect()->route('admin.users.index');
    }

    // Affiche le formulaire d'édition d'un utilisateur
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    // Met à jour les informations d'un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles'));

        session()->flash('success', 'Utilisateur mis à jour avec succès');

        return redirect()->route('admin.users.index');
    }

    // Supprime un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
