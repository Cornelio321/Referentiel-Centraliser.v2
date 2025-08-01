@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Historique de Consultation</h2>
                <div class="flex space-x-2">
                    <button onclick="clearHistory()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>Vider l'historique
                    </button>
                    <a href="{{ route('lecteur.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if(isset($views) && $views->count() > 0)
                <!-- Statistiques rapides -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-eye text-blue-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-blue-600 text-sm font-medium">Total consulté</p>
                                <p class="text-2xl font-bold text-blue-800">{{ $views->total() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-green-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-green-600 text-sm font-medium">Aujourd'hui</p>
                                <p class="text-2xl font-bold text-green-800">{{ $views->where('viewed_at', '>=', today())->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-week text-purple-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-purple-600 text-sm font-medium">Cette semaine</p>
                                <p class="text-2xl font-bold text-purple-800">{{ $views->where('viewed_at', '>=', now()->startOfWeek())->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-orange-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-star text-orange-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-orange-600 text-sm font-medium">Scripts uniques</p>
                                <p class="text-2xl font-bold text-orange-800">{{ $views->unique('script_id')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste de l'historique -->
                <div class="space-y-4">
                    @foreach($views as $view)
                        @php $script = $view->script @endphp
                        <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $script->name }}</h3>
                                        @if(isset($script->category))
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                {{ ucfirst($script->category) }}
                                            </span>
                                        @endif
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            {{ ucfirst($script->status) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($script->description ?? 'Aucune description', 150) }}</p>
                                    
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span><i class="fas fa-user mr-1"></i>{{ $script->creator->name ?? 'Inconnu' }}</span>
                                        <span><i class="fas fa-clock mr-1"></i>Consulté le {{ $view->viewed_at->format('d/m/Y à H:i') }}</span>
                                        <span><i class="fas fa-eye mr-1"></i>{{ $script->views_count ?? 0 }} vues totales</span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('lecteur.scripts.show', $script->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition-colors">
                                        <i class="fas fa-eye mr-1"></i>Revoir
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
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $views->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun historique</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore consulté de scripts.</p>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Découvrir des scripts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function clearHistory() {
    if (confirm('Êtes-vous sûr de vouloir vider votre historique de consultation ? Cette action est irréversible.')) {
        // Ici vous pourriez ajouter une requête AJAX pour vider l'historique
        alert('Fonctionnalité en cours de développement');
    }
}
</script>
@endsection