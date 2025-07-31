<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Menu items spécifiques à l'éditeur
        $menuItems = [
            [
                'label' => 'Dashboard Éditeur',
                'icon' => 'bi bi-house',
                'route' => 'editor.dashboard',
            ],
            [
                'label' => 'Gestion Documents',
                'icon' => 'bi bi-file-earmark-text',
                'route' => '#',
                'children' => [
                    ['label' => 'Créer un document', 'route' => '#'],
                    ['label' => 'Mes documents', 'route' => '#'],
                    ['label' => 'Documents en attente', 'route' => '#'],
                ],
            ],
            [
                'label' => 'Révision',
                'icon' => 'bi bi-pencil-square',
                'route' => '#',
                'children' => [
                    ['label' => 'Documents à réviser', 'route' => '#'],
                    ['label' => 'Historique des révisions', 'route' => '#'],
                ],
            ],
            [
                'label' => 'Rapports',
                'icon' => 'bi bi-graph-up',
                'route' => '#',
                'children' => [
                    ['label' => 'Statistiques édition', 'route' => '#'],
                    ['label' => 'Rapports d\'activité', 'route' => '#'],
                ],
            ],
            [
                'label' => 'Mon Profil',
                'icon' => 'bi bi-person',
                'route' => '#',
                'children' => [
                    ['label' => 'Voir le profil', 'route' => '#'],
                    ['label' => 'Modifier le profil', 'route' => '#'],
                ],
            ],
        ];

        $stats = [
            'documents_crees' => 15,
            'documents_en_cours' => 3,
            'documents_publies' => 12,
            'revisions_en_attente' => 5,
            'derniere_edition' => now()->subHours(4)->format('d/m/Y H:i'),
        ];

        return view('dashboards.editor', compact('menuItems', 'stats', 'user'));
    }
}