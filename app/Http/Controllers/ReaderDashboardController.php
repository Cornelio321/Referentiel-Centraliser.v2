<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReaderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Menu items spécifiques au lecteur
        $menuItems = [
            [
                'label' => 'Dashboard Lecteur',
                'icon' => 'bi bi-house',
                'route' => 'reader.dashboard',
            ],
            [
                'label' => 'Consulter Documents',
                'icon' => 'bi bi-file-text',
                'route' => '#',
                'children' => [
                    ['label' => 'Rapports', 'route' => '#'],
                    ['label' => 'Documents publics', 'route' => '#'],
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
            'documents_lus' => 25,
            'derniere_lecture' => now()->subDays(2)->format('d/m/Y'),
            'favoris' => 8,
            'notifications' => 3,
        ];

        return view('dashboards.reader', compact('menuItems', 'stats', 'user'));
    }
}