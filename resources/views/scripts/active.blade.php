@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Scripts Actifs' }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('scripts.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i>Tous les scripts
                    </a>
                    <a href="{{ route('scripts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>Nouveau Script
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <p class="text-gray-600 mb-6">{{ $message ?? 'Liste des scripts actuellement actifs' }}</p>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Cette page affichera tous les scripts avec le statut "actif". 
                            Ces scripts peuvent être exécutés automatiquement selon leur planification.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-play-circle text-green-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-green-600 text-sm font-medium">Scripts Actifs</p>
                            <p class="text-2xl font-bold text-green-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-blue-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Planifiés</p>
                            <p class="text-2xl font-bold text-blue-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-orange-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-orange-600 text-sm font-medium">En cours</p>
                            <p class="text-2xl font-bold text-orange-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-history text-purple-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-purple-600 text-sm font-medium">Dernière exécution</p>
                            <p class="text-sm font-bold text-purple-800">Jamais</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrôles -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex space-x-2">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-play mr-2"></i>Démarrer tout
                    </button>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-stop mr-2"></i>Arrêter tout
                    </button>
                </div>
                <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-sync mr-2"></i>Actualiser
                </button>
            </div>

            <!-- Liste des scripts actifs (sera remplie dynamiquement) -->
            <div class="text-center py-12">
                <i class="fas fa-server text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun script actif</h3>
                <p class="text-gray-500 mb-4">Il n'y a actuellement aucun script en état actif.</p>
                <a href="{{ route('scripts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>Créer un script
                </a>
            </div>
        </div>
    </div>
</div>
@endsection