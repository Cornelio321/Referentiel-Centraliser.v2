<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'label' => 'Tableau de bord',
                'icon' => 'fas fa-tachometer-alt',
                'route' => 'dashboard',
            ],
            [
                'label' => 'Utilisateurs',
                'icon' => 'fas fa-users',
                'route' => 'users.index',
                'children' => [
                    [
                        'label' => 'Tous les Utilisateurs',
                        'route' => 'users.index',
                        'icon' => 'fas fa-list'
                    ],
                    [
                        'label' => 'Ajout Utilisateur',
                        'route' => 'users.create',
                        'icon' => 'fas fa-user-plus'
                    ],
                ],
            ],
            [
                'label' => 'Gestion de Contenu',
                'icon' => 'fas fa-file-alt',
                'route' => 'content.index',
                'children' => [
                    [
                        'label' => 'Tous les Documents',
                        'route' => 'documents.index',
                        'icon' => 'fas fa-file-pdf'
                    ],
                    [
                        'label' => 'Nouveau Document',
                        'route' => 'documents.create',
                        'icon' => 'fas fa-plus-circle'
                    ],
                    [
                        'label' => 'Catégories',
                        'route' => 'categories.index',
                        'icon' => 'fas fa-tags'
                    ],
                    [
                        'label' => 'Archives',
                        'route' => 'documents.archives',
                        'icon' => 'fas fa-archive'
                    ],
                ],
            ],
            [
                'label' => 'Rapports',
                'icon' => 'fas fa-chart-bar',
                'route' => 'reports.index',
                'children' => [
                    [
                        'label' => 'Rapport Mensuel',
                        'route' => 'reports.monthly',
                        'icon' => 'fas fa-calendar-alt'
                    ],
                    [
                        'label' => 'Statistiques',
                        'route' => 'reports.statistics',
                        'icon' => 'fas fa-chart-line'
                    ],
                    [
                        'label' => 'Export de Données',
                        'route' => 'reports.export',
                        'icon' => 'fas fa-download'
                    ],
                ],
            ],
            [
                'label' => 'Gestion des Scripts',
                'icon' => 'fas fa-code',
                'route' => 'scripts.index',
                'children' => [
                    [
                        'label' => 'Tous les Scripts',
                        'route' => 'scripts.index',
                        'icon' => 'fas fa-list-ul'
                    ],
                    [
                        'label' => 'Nouveau Script',
                        'route' => 'scripts.create',
                        'icon' => 'fas fa-plus-circle'
                    ],
                    [
                        'label' => 'Scripts Actifs',
                        'route' => 'scripts.active',
                        'icon' => 'fas fa-play-circle'
                    ],
                    [
                        'label' => 'Historique',
                        'route' => 'scripts.history',
                        'icon' => 'fas fa-history'
                    ],
                ],
            ],
            [
                'label' => 'Administration Système',
                'icon' => 'fas fa-cogs',
                'route' => 'system.index',
                'children' => [
                    [
                        'label' => 'Configuration',
                        'route' => 'system.config',
                        'icon' => 'fas fa-sliders-h'
                    ],
                    [
                        'label' => 'Base de Données',
                        'route' => 'system.database',
                        'icon' => 'fas fa-database'
                    ],
                    [
                        'label' => 'Logs Système',
                        'route' => 'system.logs',
                        'icon' => 'fas fa-file-medical-alt'
                    ],
                    [
                        'label' => 'Sauvegardes',
                        'route' => 'system.backup',
                        'icon' => 'fas fa-shield-alt'
                    ],
                ],
            ],
            [
                'label' => 'Notifications',
                'icon' => 'fas fa-bell',
                'route' => 'notifications.index',
                'children' => [
                    [
                        'label' => 'Toutes les Notifications',
                        'route' => 'notifications.index',
                        'icon' => 'fas fa-inbox'
                    ],
                    [
                        'label' => 'Créer une Notification',
                        'route' => 'notifications.create',
                        'icon' => 'fas fa-bullhorn'
                    ],
                    [
                        'label' => 'Historique',
                        'route' => 'notifications.history',
                        'icon' => 'fas fa-history'
                    ],
                ],
            ],
            [
                'label' => 'Déconnexion',
                'icon' => 'fas fa-sign-out-alt',
                'action' => 'logout',
            ],
        ];

        return view('dashboard', compact('menuItems'));
    }
}
