@extends('layouts.app')

@section('title', 'Changement de mot de passe obligatoire')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-exclamation me-2"></i>
                        Changement de mot de passe requis
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Attention :</strong> Pour des raisons de sécurité, vous devez changer votre mot de passe avant de continuer. 
                        Cette étape est obligatoire lors de votre première connexion.
                    </div>

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                <i class="bi bi-lock me-1"></i>
                                Mot de passe actuel
                            </label>
                            <input id="current_password" type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   name="current_password" required autocomplete="current-password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-shield-lock me-1"></i>
                                Nouveau mot de passe
                            </label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            <div class="form-text">
                                Le mot de passe doit contenir au moins 8 caractères.
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">
                                <i class="bi bi-shield-check me-1"></i>
                                Confirmer le nouveau mot de passe
                            </label>
                            <input id="password-confirm" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="bi bi-check-circle me-2"></i>
                                Changer le mot de passe
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="bi bi-box-arrow-right me-1"></i>
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Conseils de sécurité -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-lightbulb me-2"></i>
                        Conseils pour un mot de passe sécurisé
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Utilisez au moins 8 caractères</li>
                        <li>Mélangez lettres majuscules et minuscules</li>
                        <li>Incluez des chiffres et des caractères spéciaux</li>
                        <li>Évitez les informations personnelles évidentes</li>
                        <li>N'utilisez pas le même mot de passe pour plusieurs comptes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.alert {
    border-radius: 8px;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #dee2e6;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn {
    border-radius: 6px;
    font-weight: 500;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
    color: #212529;
}
</style>
@endsection