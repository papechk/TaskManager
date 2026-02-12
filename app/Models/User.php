<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtenir les attributs qui doivent être castés.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation many-to-many avec le modèle Role.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Vérifie si l'utilisateur a plusieurs rôles.
     *
     * @param array $teroles
     * @return bool
     */
    public function manyRoles(array $teroles)
    {
        return $this->roles()->whereIn('name', $teroles)->exists();
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles()->where('name', '=', 'admin')->exists();
    }

    /**
     * Relation one-to-many avec le modèle Task.
     */
    public function teTasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Relation one-to-many avec le modèle Task pour les tâches créées par l'utilisateur.
     */
    public function teCreateTask()
    {
        return $this->hasMany(Task::class, 'teuser_created_by');
    }

    /**
     * Relation one-to-many avec le modèle Task pour les tâches assignées à l'utilisateur.
     */
    public function teAssignedTasks()
    {
        return $this->hasMany(Task::class, 'teuser_assigned_to');
    }
}
