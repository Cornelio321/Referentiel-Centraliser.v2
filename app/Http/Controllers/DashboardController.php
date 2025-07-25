<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'bi bi-house',
                'route' => 'dashboard',
            ],
            [
                'label' => 'Users',
                'icon' => 'bi bi-people',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'Tous les Utilisateurs', 'route' => 'utilisateurs.index'],
                    ['label' => 'Ajout Utilisateur', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'Reports',
                'icon' => 'bi bi-graph-up',
                'route' => 'reports.index',
            ],

             [
                'label' => 'Nouveau',
                'icon' => 'bi bi-graph-up',
                'route' => 'reports.index',
            ],



        ];

        return view('dashboard', compact('menuItems'));
    }
}
