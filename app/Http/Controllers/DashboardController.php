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
                    [
                        'label' => 'Rôles et Permissions',
                        'route' => 'users.roles',
                        'icon' => 'fas fa-user-shield'
                    ],
                    [
                        'label' => 'Utilisateurs Bloqués',
                        'route' => 'users.blocked',
                        'icon' => 'fas fa-user-slash'
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
                    [
                        'label' => 'Médias',
                        'route' => 'media.index',
                        'icon' => 'fas fa-images'
                    ],
                ],
            ],
            [
                'label' => 'E-Commerce',
                'icon' => 'fas fa-shopping-cart',
                'route' => 'ecommerce.index',
                'children' => [
                    [
                        'label' => 'Produits',
                        'route' => 'products.index',
                        'icon' => 'fas fa-box'
                    ],
                    [
                        'label' => 'Commandes',
                        'route' => 'orders.index',
                        'icon' => 'fas fa-shopping-bag'
                    ],
                    [
                        'label' => 'Clients',
                        'route' => 'customers.index',
                        'icon' => 'fas fa-user-friends'
                    ],
                    [
                        'label' => 'Inventaire',
                        'route' => 'inventory.index',
                        'icon' => 'fas fa-warehouse'
                    ],
                    [
                        'label' => 'Promotions',
                        'route' => 'promotions.index',
                        'icon' => 'fas fa-percent'
                    ],
                ],
            ],
            [
                'label' => 'Communication',
                'icon' => 'fas fa-comments',
                'route' => 'communication.index',
                'children' => [
                    [
                        'label' => 'Messages',
                        'route' => 'messages.index',
                        'icon' => 'fas fa-envelope'
                    ],
                    [
                        'label' => 'Newsletter',
                        'route' => 'newsletter.index',
                        'icon' => 'fas fa-newspaper'
                    ],
                    [
                        'label' => 'Chat Support',
                        'route' => 'support.chat',
                        'icon' => 'fas fa-comment-dots'
                    ],
                    [
                        'label' => 'FAQ',
                        'route' => 'faq.index',
                        'icon' => 'fas fa-question-circle'
                    ],
                ],
            ],
            [
                'label' => 'Rapports & Analytics',
                'icon' => 'fas fa-chart-bar',
                'route' => 'reports.index',
                'children' => [
                    [
                        'label' => 'Dashboard Analytics',
                        'route' => 'analytics.dashboard',
                        'icon' => 'fas fa-chart-pie'
                    ],
                    [
                        'label' => 'Rapport Mensuel',
                        'route' => 'reports.monthly',
                        'icon' => 'fas fa-calendar-alt'
                    ],
                    [
                        'label' => 'Statistiques Ventes',
                        'route' => 'reports.sales',
                        'icon' => 'fas fa-chart-line'
                    ],
                    [
                        'label' => 'Analytics Utilisateurs',
                        'route' => 'analytics.users',
                        'icon' => 'fas fa-users-cog'
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
                        'label' => 'Programmation',
                        'route' => 'scripts.schedule',
                        'icon' => 'fas fa-clock'
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
                        'label' => 'Configuration Générale',
                        'route' => 'system.config',
                        'icon' => 'fas fa-sliders-h'
                    ],
                    [
                        'label' => 'Base de Données',
                        'route' => 'system.database',
                        'icon' => 'fas fa-database'
                    ],
                    [
                        'label' => 'Serveurs & API',
                        'route' => 'system.servers',
                        'icon' => 'fas fa-server'
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
                    [
                        'label' => 'Sécurité',
                        'route' => 'system.security',
                        'icon' => 'fas fa-lock'
                    ],
                    [
                        'label' => 'Maintenance',
                        'route' => 'system.maintenance',
                        'icon' => 'fas fa-tools'
                    ],
                ],
            ],
            [
                'label' => 'Notifications & Alertes',
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
                        'label' => 'Notifications Push',
                        'route' => 'notifications.push',
                        'icon' => 'fas fa-mobile-alt'
                    ],
                    [
                        'label' => 'Email Templates',
                        'route' => 'notifications.email',
                        'icon' => 'fas fa-envelope-open-text'
                    ],
                    [
                        'label' => 'Historique',
                        'route' => 'notifications.history',
                        'icon' => 'fas fa-history'
                    ],
                ],
            ],
            [
                'label' => 'Formations',
                'icon' => 'fas fa-graduation-cap',
                'route' => 'formations.index',
                'children' => [
                    [
                        'label' => 'Toutes les Formations',
                        'route' => 'formations.index',
                        'icon' => 'fas fa-list'
                    ],
                    [
                        'label' => 'Nouvelle Formation',
                        'route' => 'formations.create',
                        'icon' => 'fas fa-plus-circle'
                    ],
                    [
                        'label' => 'Participants',
                        'route' => 'formations.participants',
                        'icon' => 'fas fa-users'
                    ],
                    [
                        'label' => 'Certificats',
                        'route' => 'formations.certificates',
                        'icon' => 'fas fa-certificate'
                    ],
                    [
                        'label' => 'Évaluations',
                        'route' => 'formations.evaluations',
                        'icon' => 'fas fa-star'
                    ],
                ],
            ],
            [
                'label' => 'Outils & Utilitaires',
                'icon' => 'fas fa-toolbox',
                'route' => 'tools.index',
                'children' => [
                    [
                        'label' => 'Calculateurs',
                        'route' => 'tools.calculators',
                        'icon' => 'fas fa-calculator'
                    ],
                    [
                        'label' => 'Convertisseurs',
                        'route' => 'tools.converters',
                        'icon' => 'fas fa-exchange-alt'
                    ],
                    [
                        'label' => 'Générateurs',
                        'route' => 'tools.generators',
                        'icon' => 'fas fa-magic'
                    ],
                    [
                        'label' => 'Import/Export',
                        'route' => 'tools.import',
                        'icon' => 'fas fa-file-import'
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
