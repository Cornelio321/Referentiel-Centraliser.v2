@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Administrateur</h1>
                    <p class="mb-0 text-muted">Bienvenue, {{ $user->name }}</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Rôle: <span class="badge bg-danger">{{ ucfirst($user->role) }}</span></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des utilisateurs -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Utilisateurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Administrateurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_admins'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shield-check fs-2 text-gray-300"></i>
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
                                Éditeurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_editors'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-pencil-square fs-2 text-gray-300"></i>
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
                                Lecteurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_readers'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-book fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes et statistiques importantes -->
    <div class="row mb-4">
        @if($stats['users_need_password_change'] > 0)
        <div class="col-12 mb-3">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div>
                    <strong>Attention :</strong> {{ $stats['users_need_password_change'] }} utilisateur(s) doivent changer leur mot de passe lors de leur prochaine connexion.
                </div>
            </div>
        </div>
        @endif

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-person-plus me-2"></i>
                                Nouvel Utilisateur
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('utilisateurs.index') }}" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-list-ul me-2"></i>
                                Gérer Utilisateurs
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('reports.index') }}" class="btn btn-info btn-lg w-100">
                                <i class="bi bi-graph-up me-2"></i>
                                Voir Rapports
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="#" class="btn btn-warning btn-lg w-100">
                                <i class="bi bi-gear me-2"></i>
                                Configuration
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribution des Rôles</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="rolesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="row">
        <!-- Utilisateurs récents -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Activité Récente des Utilisateurs</h6>
                    <a href="{{ route('utilisateurs.index') }}" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Rôle</th>
                                    <th>Email</th>
                                    <th>Dernière Activité</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_logins'] as $recentUser)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle me-2"></i>
                                            {{ $recentUser->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $recentUser->role === 'admin' ? 'danger' : ($recentUser->role === 'editeur' ? 'success' : 'info') }}">
                                            {{ ucfirst($recentUser->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $recentUser->email }}</td>
                                    <td>{{ $recentUser->updated_at->diffForHumans() }}</td>
                                    <td>
                                        @if($recentUser->password_changed_at)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-warning">Première connexion</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('utilisateurs.edit', $recentUser) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucune activité récente</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques système -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques Système</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Utilisateurs actifs</span>
                        <span class="font-weight-bold">{{ $stats['total_users'] - $stats['users_need_password_change'] }}</span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" style="width: {{ $stats['total_users'] > 0 ? (($stats['total_users'] - $stats['users_need_password_change']) / $stats['total_users']) * 100 : 0 }}%"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Première connexion</span>
                        <span class="font-weight-bold text-warning">{{ $stats['users_need_password_change'] }}</span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning" style="width: {{ $stats['total_users'] > 0 ? ($stats['users_need_password_change'] / $stats['total_users']) * 100 : 0 }}%"></div>
                    </div>

                    <hr>

                    <div class="text-center">
                        <h6 class="text-muted">Répartition des Rôles</h6>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="text-danger font-weight-bold">{{ $stats['total_admins'] }}</div>
                                <div class="text-xs">Admins</div>
                            </div>
                            <div class="col-4">
                                <div class="text-success font-weight-bold">{{ $stats['total_editors'] }}</div>
                                <div class="text-xs">Éditeurs</div>
                            </div>
                            <div class="col-4">
                                <div class="text-info font-weight-bold">{{ $stats['total_readers'] }}</div>
                                <div class="text-xs">Lecteurs</div>
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
.border-left-danger {
    border-left: 0.25rem solid #dc3545 !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('rolesChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Administrateurs', 'Éditeurs', 'Lecteurs'],
            datasets: [{
                data: [{{ $stats['total_admins'] }}, {{ $stats['total_editors'] }}, {{ $stats['total_readers'] }}],
                backgroundColor: ['#dc3545', '#28a745', '#17a2b8'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
});
</script>
@endsection