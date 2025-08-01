<nav class="navbar navbar-expand-lg navbar-light navbar-custom ps-3" style="margin-left: 250px;">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold text-danger">
            Admin – {{ auth()->user()->name ?? 'Nom inconnu' }}
        </span>

        <!-- Nouveaux menus de navigation -->
        <div class="navbar-nav d-flex flex-row">
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="contentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-alt me-1"></i> Contenu
                </a>
                <ul class="dropdown-menu" aria-labelledby="contentDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-plus me-2"></i>Nouveau Document</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-list me-2"></i>Tous les Documents</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i>Archives</a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="systemDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cogs me-1"></i> Système
                </a>
                <ul class="dropdown-menu" aria-labelledby="systemDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-database me-2"></i>Base de Données</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-server me-2"></i>Configuration Serveur</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-shield-alt me-2"></i>Sécurité</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Sauvegarde</a></li>
                </ul>
            </li>

            <li class="nav-item me-3">
                <a class="nav-link text-dark fw-bold" href="#">
                    <i class="fas fa-chart-line me-1"></i> Statistiques
                </a>
            </li>

            <li class="nav-item me-3">
                <a class="nav-link text-dark fw-bold" href="#">
                    <i class="fas fa-bell me-1"></i> Notifications
                    <span class="badge bg-danger ms-1">3</span>
                </a>
            </li>
        </div>

        <ul class="navbar-nav ms-auto me-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name ?? 'User' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-1"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-1"></i> Modifier le profil</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('password.change.form') }}">
                            <i class="fas fa-key me-1"></i> Modifier le mot de passe
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar-custom {
        background: linear-gradient(135deg, #ffcdd2, #ef9a9a) !important;
        border-bottom: 4px solid #dc3545;
        box-shadow: 0 2px 10px rgba(220, 53, 69, 0.2);
        height: 70px;
    }

    .navbar-custom .navbar-brand {
        font-size: 1.2rem;
        color: #c82333;
        text-shadow: 1px 1px rgba(255, 255, 255, 0.3);
    }

    .navbar-custom .nav-link {
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 6px;
        padding: 8px 12px;
        margin: 0 2px;
    }

    .navbar-custom .nav-link:hover {
        background-color: rgba(220, 53, 69, 0.1);
        transform: translateY(-1px);
    }

    .navbar-custom .dropdown-menu {
        border: 1px solid #dc3545;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
    }

    .navbar-custom .dropdown-item:hover {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .badge {
        font-size: 0.7rem;
        position: relative;
        top: -2px;
    }
</style>
