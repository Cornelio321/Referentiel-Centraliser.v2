@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Gestion des Scripts</h2>
                <a href="{{ route('scripts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>Nouveau Script
                </a>
            </div>
        </div>

        <!-- Filtres de recherche -->
        <div class="p-6 border-b border-gray-200">
            <form method="GET" action="{{ route('scripts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Rechercher..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Toutes les catégories</option>
                        <option value="automation" {{ request('category') == 'automation' ? 'selected' : '' }}>Automatisation</option>
                        <option value="monitoring" {{ request('category') == 'monitoring' ? 'selected' : '' }}>Surveillance</option>
                        <option value="backup" {{ request('category') == 'backup' ? 'selected' : '' }}>Sauvegarde</option>
                    </select>
                </div>
                <div>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des scripts -->
        <div class="p-6">
            @if(isset($scripts) && $scripts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($scripts as $script)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $script->name ?? 'Script sans nom' }}</h3>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ ($script->status ?? 'inactive') == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($script->status ?? 'Inactif') }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($script->description ?? 'Aucune description', 100) }}</p>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                <span>Par: {{ $script->creator->name ?? 'Inconnu' }}</span>
                                <span>{{ $script->created_at ? $script->created_at->format('d/m/Y') : 'Date inconnue' }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <a href="{{ route('scripts.show', $script->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Voir
                                    </a>
                                    <a href="{{ route('scripts.edit', $script->id) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Modifier
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('scripts.destroy', $script->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce script ?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Supprimer
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
                    <i class="fas fa-file-code text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun script trouvé</h3>
                    <p class="text-gray-500 mb-4">Commencez par créer votre premier script.</p>
                    <a href="{{ route('scripts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>Créer un script
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection