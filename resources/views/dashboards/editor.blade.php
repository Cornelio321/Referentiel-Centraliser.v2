@extends('layouts.app')

@section('title', 'Dashboard Éditeur')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Éditeur</h1>
                    <p class="mb-0 text-muted">Bienvenue, {{ $user->name }}</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Rôle: <span class="badge bg-success">{{ ucfirst($user->role) }}</span></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Créés
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['documents_crees'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-plus fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En Cours
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['documents_en_cours'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-pencil-square fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Publiés
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['documents_publies'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fs-2 text-gray-300"></i>
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
                                Révisions en Attente
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['revisions_en_attente'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock-history fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Dernière Édition
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $stats['derniere_edition'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-event fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-file-plus me-2"></i>
                                Nouveau Document
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-pencil-square me-2"></i>
                                Continuer Édition
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-warning btn-lg w-100">
                                <i class="bi bi-eye me-2"></i>
                                Réviser Documents
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-info btn-lg w-100">
                                <i class="bi bi-graph-up me-2"></i>
                                Voir Statistiques
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="row">
        <!-- Documents en cours -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Documents en Cours d'Édition</h6>
                    <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Progression</th>
                                    <th>Dernière Modification</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Guide utilisateur v3.0
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%">75%</div>
                                        </div>
                                    </td>
                                    <td>{{ now()->subHours(2)->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-warning">Brouillon</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Éditer</a>
                                        <a href="#" class="btn btn-sm btn-outline-success">Publier</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Rapport trimestriel Q1
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 40%">40%</div>
                                        </div>
                                    </td>
                                    <td>{{ now()->subDays(1)->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-primary">En cours</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Éditer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2"></i>
                                            Procédures de sécurité mises à jour
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 90%">90%</div>
                                        </div>
                                    </td>
                                    <td>{{ now()->subHours(6)->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-danger">Révision requise</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Réviser</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activités Récentes</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Document publié</h6>
                                <p class="mb-1 text-muted">Guide d'installation v2.5</p>
                                <small class="text-muted">Il y a 3 heures</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Révision demandée</h6>
                                <p class="mb-1 text-muted">Procédures de sécurité</p>
                                <small class="text-muted">Il y a 6 heures</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Nouveau brouillon créé</h6>
                                <p class="mb-1 text-muted">Rapport mensuel Février</p>
                                <small class="text-muted">Hier</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Collaboration acceptée</h6>
                                <p class="mb-1 text-muted">Document partagé avec l'équipe</p>
                                <small class="text-muted">Il y a 2 jours</small>
                            </div>
                        </div>
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
.border-left-secondary {
    border-left: 0.25rem solid #858796 !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 3px #dee2e6;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 12px;
    bottom: -20px;
    width: 2px;
    background-color: #dee2e6;
}

.timeline-content h6 {
    font-size: 14px;
    font-weight: 600;
}

.timeline-content p {
    font-size: 13px;
}

.timeline-content small {
    font-size: 12px;
}
</style>
@endsection