@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Scripts Récents</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('lecteur.popular') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-fire mr-2"></i>Scripts populaires
                    </a>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i>Tous les scripts
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-clock text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            Découvrez les scripts les plus récemment ajoutés à la plateforme. 
                            Ces scripts sont triés par date de création, du plus récent au plus ancien.
                        </p>
                    </div>
                </div>
            </div>

            @if(isset($scripts) && $scripts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($scripts as $script)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $script->name }}</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-clock mr-1"></i>Nouveau
                                    </span>
                                    @if(isset($script->category))
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($script->category) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($script->description ?? 'Aucune description', 100) }}</p>
                            
                            <!-- Badge "Nouveau" si créé dans les 7 derniers jours -->
                            @if($script->created_at && $script->created_at->diffInDays(now()) <= 7)
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-star mr-1"></i>Nouveau ! ({{ $script->created_at->diffForHumans() }})
                                    </span>
                                </div>
                            @endif
                            
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-blue-100 p-2 rounded text-center">
                                    <i class="fas fa-eye text-blue-600"></i>
                                    <p class="text-sm font-bold text-blue-800">{{ $script->views_count ?? 0 }}</p>
                                    <p class="text-xs text-blue-600">Vues</p>
                                </div>
                                <div class="bg-yellow-100 p-2 rounded text-center">
                                    <i class="fas fa-heart text-yellow-600"></i>
                                    <p class="text-sm font-bold text-yellow-800">{{ $script->favorites_count ?? 0 }}</p>
                                    <p class="text-xs text-yellow-600">Favoris</p>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                <span>Par: {{ $script->creator->name ?? 'Inconnu' }}</span>
                                <span>{{ $script->created_at->format('d/m/Y') }}</span>
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

                <!-- Timeline des ajouts récents -->
                <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Timeline des ajouts</h3>
                    <div class="space-y-3">
                        @foreach($scripts->take(5) as $script)
                            <div class="flex items-center space-x-3 text-sm">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-500">{{ $script->created_at->format('d/m/Y H:i') }}</span>
                                <span class="text-gray-700">{{ $script->name }}</span>
                                <span class="text-gray-500">par {{ $script->creator->name ?? 'Inconnu' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Bouton pour voir plus -->
                <div class="text-center mt-8">
                    <a href="{{ route('lecteur.scripts', ['sort' => 'created_at', 'order' => 'desc']) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors">
                        <i class="fas fa-clock mr-2"></i>Voir tous les scripts récents
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-clock text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun script récent</h3>
                    <p class="text-gray-500 mb-4">Il n'y a pas encore de scripts récents à afficher.</p>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Découvrir des scripts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection