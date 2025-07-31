<div class="sidebar sidebar-custom text-dark p-3" style="width: 250px; height: 100vh; position: fixed; top: 0; z-index: 1000;">
    <!-- Logo circulaire centré -->
    <div class="logo-container mb-4 mx-auto">
        <div class="logo-circle">
            <img src="{{ asset('images/ceet_officiel_logo-removebg-preview.png') }}" alt="Logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <i class="fas fa-building fa-3x text-danger" style="display: none;"></i>
        </div>
    </div>

    @php
        $userRole = Auth::user()->role ?? 'lecteur';
        $panelTitle = match($userRole) {
            'admin' => 'Admin Panel',
            'editeur' => 'Éditeur Panel',
            'lecteur' => 'Lecteur Panel',
            default => 'Dashboard'
        };
    @endphp

    <h4 class="text-center mb-4 fw-bold">{{ $panelTitle }}</h4>

    <!-- Informations utilisateur -->
    <div class="user-info mb-3 p-2 rounded" style="background-color: rgba(220, 53, 69, 0.1);">
        <div class="d-flex align-items-center">
            <div class="user-avatar me-2">
                <i class="fas fa-user-circle fa-2x text-danger"></i>
            </div>
            <div class="user-details">
                <div class="user-name text-truncate" style="max-width: 140px; font-weight: 600; font-size: 14px;">
                    {{ Auth::user()->name }}
                </div>
                <div class="user-role" style="font-size: 12px; color: #6c757d;">
                    <span class="badge badge-role">{{ ucfirst($userRole) }}</span>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav flex-column">
        @foreach ($menuItems as $item)
            @php
                $hasRoute = !empty($item['route']);
                $isActive = $hasRoute && request()->routeIs($item['route']);

                if (!empty($item['children'])) {
                    $childRoutes = collect($item['children'])->pluck('route');
                    $isActive = $childRoutes->contains(fn($r) => request()->routeIs($r));
                }
            @endphp

            @if (!empty($item['children']))
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center {{ $isActive ? 'active' : '' }}"
                       data-bs-toggle="collapse" href="#menu-{{ $loop->index }}">
                        <span><i class="{{ $item['icon'] ?? 'fas fa-folder' }}"></i> {{ $item['label'] }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu-{{ $loop->index }}">
                        @foreach ($item['children'] as $child)
                            <a class="nav-link ps-4 {{ request()->routeIs($child['route']) ? 'active' : '' }}"
                               href="{{ route($child['route']) }}">
                                <i class="{{ $child['icon'] ?? 'fas fa-circle' }} me-2"></i>{{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </li>
            @elseif(isset($item['action']) && $item['action'] === 'logout')
                <hr class="my-3" style="border-color: #dc3545;">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start logout-btn">
                            <i class="{{ $item['icon'] ?? 'fas fa-sign-out-alt' }}"></i> {{ $item['label'] }}
                        </button>
                    </form>
                </li>
            @elseif($hasRoute)
                <li class="nav-item">
                    <a class="nav-link {{ $isActive ? 'active' : '' }}"
                       href="{{ route($item['route']) }}">
                        <i class="{{ $item['icon'] ?? 'fas fa-link' }}"></i> {{ $item['label'] }}
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <span class="nav-link text-muted">
                        <i class="{{ $item['icon'] ?? 'fas fa-ban' }}"></i> {{ $item['label'] }}
                    </span>
                </li>
            @endif
        @endforeach
        
        <!-- Lien de déconnexion toujours présent -->
        @if (!collect($menuItems)->contains(fn($item) => isset($item['action']) && $item['action'] === 'logout'))
        <hr class="my-3" style="border-color: #dc3545;">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Se déconnecter
                </button>
            </form>
        </li>
        @endif
    </ul>
</div>

<style>
    .sidebar-custom {
    background: linear-gradient(135deg, #fff176, #fff59d) !important;
    border-right: 4px solid #dc3545;
    box-shadow: 4px 0 15px rgba(220, 53, 69, 0.2);
    position: relative;
}

.logo-container {
    text-align: center;
}

.logo-circle {
    width: 100px;
    height: 100px;
    background: white;
    border: 4px solid #dc3545;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
}

.logo-circle img {
    width: 90%;
    height: 90%;
    object-fit: cover;
    border-radius: 50%;
}

.sidebar-custom h4 {
    color: #c82333;
    text-shadow: 1px 1px 2px rgba(220, 53, 69, 0.2);
    border-bottom: 2px solid #dc3545;
    padding-bottom: 10px;
}

.user-info {
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.badge-role {
    background-color: #dc3545;
    color: white;
    padding: 2px 6px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 500;
}

.sidebar-custom .nav-link {
    color: #212529;
    border-radius: 8px;
    margin: 4px 0;
    padding: 10px 12px;
    font-weight: 500;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
}

.sidebar-custom .nav-link i {
    color: #dc3545;
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.sidebar-custom .nav-link:hover {
    background-color: rgba(220, 53, 69, 0.15);
    border-left: 4px solid #dc3545;
    transform: translateX(5px);
}

.sidebar-custom .nav-link.active {
    background-color: rgba(220, 53, 69, 0.2);
    font-weight: bold;
    border-left: 5px solid #dc3545;
    color: #000;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
}

.collapse .nav-link {
    background-color: rgba(255, 235, 59, 0.2);
    margin-left: 10px;
    margin-right: 5px;
    border-left: 3px solid #dc3545;
    padding-left: 20px;
}

.collapse .nav-link:hover {
    background-color: rgba(220, 53, 69, 0.1);
}

.logout-btn:hover {
    background-color: rgba(220, 53, 69, 0.2);
    border-left: 4px solid #dc3545;
}

[data-bs-toggle="collapse"] .fa-chevron-down {
    transition: transform 0.3s ease;
}

[data-bs-toggle="collapse"][aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
}

</style>
