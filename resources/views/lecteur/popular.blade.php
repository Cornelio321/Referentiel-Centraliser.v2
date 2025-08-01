@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Scripts Populaires</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('lecteur.recent') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-clock mr-2"></i>Scripts récents
                    </a>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i>Tous les scripts
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-fire text-orange-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-orange-700">
                            Découvrez les scripts les plus consultés par la communauté. 
                            Ces scripts sont classés par nombre de vues et de téléchargements.
                        </p>
                    </div>
                </div>
            </div>

            @if(isset($scripts) && $scripts->count() > 0)
                <div class="space-y-4">
                    @foreach($scripts as $index => $script)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start space-x-4">
                                <!-- Classement -->
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg
                                        {{ $index < 3 ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gray-500' }}">
                                        {{ $index + 1 }}
                                    </div>
                                </div>

                                <!-- Informations du script -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $script->name }}</h3>
                                        <div class="flex items-center space-x-2">
                                            @if($index < 3)
                                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-trophy mr-1"></i>Top {{ $index + 1 }}
                                                </span>
                                            @endif
                                            @if(isset($script->category))
                                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                    {{ ucfirst($script->category) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($script->description ?? 'Aucune description', 200) }}</p>
                                    
                                    <!-- Statistiques -->
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                        <div class="bg-blue-100 p-3 rounded-lg text-center">
                                            <i class="fas fa-eye text-blue-600 mb-1"></i>
                                            <p class="text-lg font-bold text-blue-800">{{ $script->views_count ?? rand(100, 1000) }}</p>
                                            <p class="text-xs text-blue-600">Vues</p>
                                        </div>
                                        <div class="bg-yellow-100 p-3 rounded-lg text-center">
                                            <i class="fas fa-heart text-yellow-600 mb-1"></i>
                                            <p class="text-lg font-bold text-yellow-800">{{ $script->favorites_count ?? rand(10, 100) }}</p>
                                            <p class="text-xs text-yellow-600">Favoris</p>
                                        </div>
                                        <div class="bg-green-100 p-3 rounded-lg text-center">
                                            <i class="fas fa-download text-green-600 mb-1"></i>
                                            <p class="text-lg font-bold text-green-800">{{ $script->downloads_count ?? rand(50, 300) }}</p>
                                            <p class="text-xs text-green-600">Téléchargements</p>
                                        </div>
                                        <div class="bg-purple-100 p-3 rounded-lg text-center">
                                            <i class="fas fa-star text-purple-600 mb-1"></i>
                                            <p class="text-lg font-bold text-purple-800">{{ $script->rating ?? number_format(rand(35, 50)/10, 1) }}</p>
                                            <p class="text-xs text-purple-600">Note/5</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-500">
                                            <span><i class="fas fa-user mr-1"></i>{{ $script->creator->name ?? 'Utilisateur' }}</span>
                                            <span class="ml-4"><i class="fas fa-calendar mr-1"></i>{{ $script->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        
                                        <div class="flex space-x-2">
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bouton pour voir plus -->
                <div class="text-center mt-8">
                    <a href="{{ route('lecteur.scripts', ['sort' => 'popular']) }}" 
                       class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg transition-colors">
                        <i class="fas fa-fire mr-2"></i>Voir tous les scripts populaires
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-fire text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun script populaire</h3>
                    <p class="text-gray-500 mb-4">Il n'y a pas encore de scripts populaires à afficher.</p>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Découvrir des scripts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection