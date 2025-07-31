<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_changed_at' => 'datetime',
        ];
    }

    /**
     * Vérifier si l'utilisateur doit changer son mot de passe
     */
    public function mustChangePassword(): bool
    {
        return is_null($this->password_changed_at);
    }

    /**
     * Marquer le mot de passe comme changé
     */
    public function markPasswordAsChanged(): void
    {
        $this->update(['password_changed_at' => now()]);
    }

    /**
     * Vérifier si l'utilisateur a un rôle spécifique
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Vérifier si l'utilisateur a l'un des rôles spécifiés
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Obtenir le nom du dashboard approprié selon le rôle
     */
    public function getDashboardRoute(): string
    {
        switch ($this->role) {
            case 'admin':
                return 'dashboard';
            case 'editeur':
                return 'editor.dashboard';
            case 'lecteur':
                return 'reader.dashboard';
            default:
                return 'reader.dashboard';
        }
    }

    /**
     * Vérifier si l'utilisateur est un administrateur
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Vérifier si l'utilisateur est un éditeur
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editeur');
    }

    /**
     * Vérifier si l'utilisateur est un lecteur
     */
    public function isReader(): bool
    {
        return $this->hasRole('lecteur');
    }
}
