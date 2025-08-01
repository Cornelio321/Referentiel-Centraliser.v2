@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Scripts Disponibles</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('lecteur.favorites') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-heart mr-2"></i>Mes Favoris
                    </a>
                    <a href="{{ route('lecteur.history') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-history mr-2"></i>Historique
                    </a>
                </div>
            </div>
        </div>

        <!-- Filtres de recherche -->
        <div class="p-6 border-b border-gray-200">
            <form method="GET" action="{{ route('lecteur.scripts') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Rechercher un script..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Toutes les catégories</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Plus récents</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Plus populaires</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Liens rapides -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('lecteur.popular') }}" class="bg-orange-100 hover:bg-orange-200 text-orange-800 px-3 py-1 rounded-full text-sm transition-colors">
                    <i class="fas fa-fire mr-1"></i>Populaires
                </a>
                <a href="{{ route('lecteur.recent') }}" class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm transition-colors">
                    <i class="fas fa-clock mr-1"></i>Récents
                </a>
                <a href="{{ route('lecteur.scripts', ['category' => 'automation']) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm transition-colors">
                    <i class="fas fa-cogs mr-1"></i>Automatisation
                </a>
                <a href="{{ route('lecteur.scripts', ['category' => 'monitoring']) }}" class="bg-purple-100 hover:bg-purple-200 text-purple-800 px-3 py-1 rounded-full text-sm transition-colors">
                    <i class="fas fa-chart-line mr-1"></i>Surveillance
                </a>
            </div>
        </div>

        <!-- Liste des scripts -->
        <div class="p-6">
            @if(isset($scripts) && $scripts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($scripts as $script)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $script->name }}</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst($script->status) }}
                                    </span>
                                    @if(isset($script->category))
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($script->category) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($script->description ?? 'Aucune description', 100) }}</p>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                <span>Par: {{ $script->creator->name ?? 'Inconnu' }}</span>
                                <span>{{ $script->created_at->format('d/m/Y') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                <span><i class="fas fa-eye mr-1"></i>{{ $script->views_count ?? 0 }} vues</span>
                                <span><i class="fas fa-heart mr-1"></i>{{ $script->favorites_count ?? 0 }} favoris</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <a href="{{ route('lecteur.scripts.show', $script->id) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm transition-colors">
                                    <i class="fas fa-eye mr-1"></i>Voir détails
                                </a>
                                
                                <form method="POST" action="{{ route('favorites.toggle', $script->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition-colors">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $scripts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun script trouvé</h3>
                    <p class="text-gray-500 mb-4">Aucun script ne correspond à vos critères de recherche.</p>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-refresh mr-2"></i>Voir tous les scripts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection