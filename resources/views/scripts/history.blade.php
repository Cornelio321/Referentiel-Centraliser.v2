@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Historique des Scripts' }}</h2>
                <div class="flex space-x-2">
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>Vider l'historique
                    </button>
                    <a href="{{ route('scripts.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <p class="text-gray-600 mb-6">{{ $message ?? "Historique d'exécution des scripts" }}</p>

            <!-- Filtres -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les scripts</option>
                            <option value="success">Scripts réussis</option>
                            <option value="error">Scripts en erreur</option>
                            <option value="running">En cours</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Toutes les périodes</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" placeholder="Rechercher..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
                            <i class="fas fa-search mr-2"></i>Filtrer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistiques rapides -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-green-600 text-sm font-medium">Succès</p>
                            <p class="text-2xl font-bold text-green-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-times-circle text-red-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-red-600 text-sm font-medium">Erreurs</p>
                            <p class="text-2xl font-bold text-red-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-yellow-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-yellow-600 text-sm font-medium">En cours</p>
                            <p class="text-2xl font-bold text-yellow-800">0</p>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-list text-blue-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Total</p>
                            <p class="text-2xl font-bold text-blue-800">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table d'historique -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Script</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Début</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Les données seront ajoutées ici dynamiquement -->
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun historique disponible</h3>
                                <p class="text-gray-500">L'historique d'exécution des scripts apparaîtra ici.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    Affichage de 0 à 0 sur 0 entrées
                </div>
                <div class="flex space-x-2">
                    <button disabled class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">
                        Précédent
                    </button>
                    <button disabled class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">
                        Suivant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection