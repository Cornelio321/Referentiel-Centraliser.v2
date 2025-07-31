@extends('layouts.app')

@section('title', 'Dashboard Lecteur')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Lecteur</h1>
                    <p class="mb-0 text-muted">Bienvenue, {{ $user->name }}</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Rôle: <span class="badge bg-info">{{ ucfirst($user->role) }}</span></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Documents Lus
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['documents_lus'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-book fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Favoris
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['favoris'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-heart-fill fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Dernière Lecture
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['derniere_lecture'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock-history fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Notifications
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['notifications'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-bell-fill fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="row">
        <!-- Documents récents -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Documents Récemment Consultés</h6>
                    <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Date de lecture</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Rapport mensuel Janvier
                                        </div>
                                    </td>
                                    <td>{{ now()->subDays(1)->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-success">Lu</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Relire</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Guide utilisateur v2.1
                                        </div>
                                    </td>
                                    <td>{{ now()->subDays(3)->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-success">Lu</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Relire</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Procédures de sécurité
                                        </div>
                                    </td>
                                    <td>{{ now()->subWeek()->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-warning">En cours</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-success">Continuer</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notifications Récentes</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nouveau document disponible</div>
                                <small class="text-muted">Il y a 2 heures</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Mise à jour du guide</div>
                                <small class="text-muted">Hier</small>
                            </div>
                            <span class="badge bg-secondary rounded-pill">1</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Rappel de lecture</div>
                                <small class="text-muted">Il y a 3 jours</small>
                            </div>
                            <span class="badge bg-warning rounded-pill">1</span>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir toutes les notifications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection