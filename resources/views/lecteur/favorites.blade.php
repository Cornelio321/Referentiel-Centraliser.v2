@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Mes Scripts Favoris</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Découvrir des scripts
                    </a>
                    <a href="{{ route('lecteur.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if(isset($favorites) && $favorites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        @php $script = $favorite->script @endphp
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $script->name }}</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-heart mr-1"></i>Favori
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
                                <span>Ajouté le {{ $favorite->created_at->format('d/m/Y') }}</span>
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
                                
                                <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Retirer ce script de vos favoris ?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-heart text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun favori</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore ajouté de scripts à vos favoris.</p>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Découvrir des scripts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection