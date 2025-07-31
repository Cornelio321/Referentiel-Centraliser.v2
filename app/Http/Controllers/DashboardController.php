<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Menu items spécifiques à l'admin
        $menuItems = [
            [
                'label' => 'Dashboard Admin',
                'icon' => 'bi bi-house',
                'route' => 'dashboard',
            ],
            [
                'label' => 'Gestion Utilisateurs',
                'icon' => 'bi bi-people',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'Tous les Utilisateurs', 'route' => 'utilisateurs.index'],
                    ['label' => 'Ajout Utilisateur', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'Rapports & Analytics',
                'icon' => 'bi bi-graph-up',
                'route' => 'reports.index',
                'children' => [
                    ['label' => 'Rapports système', 'route' => 'reports.index'],
                    ['label' => 'Statistiques globales', 'route' => 'reports.stats'],
                ],
            ],
            [
                'label' => 'Administration',
                'icon' => 'bi bi-gear',
                'route' => '#',
                'children' => [
                    ['label' => 'Configuration système', 'route' => '#'],
                    ['label' => 'Logs d\'activité', 'route' => '#'],
                    ['label' => 'Maintenance', 'route' => '#'],
                ],
            ],
            [
                'label' => 'Se déconnecter',
                'icon' => 'fas fa-sign-out-alt',
                'action' => 'logout',
            ],
        ];

        // Statistiques pour le dashboard admin
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_editors' => User::where('role', 'editeur')->count(),
            'total_readers' => User::where('role', 'lecteur')->count(),
            'users_need_password_change' => User::whereNull('password_changed_at')->count(),
            'recent_logins' => User::whereNotNull('password_changed_at')
                                  ->orderBy('updated_at', 'desc')
                                  ->limit(5)
                                  ->get(),
        ];

        return view('dashboards.admin', compact('menuItems', 'stats', 'user'));
    }
}
