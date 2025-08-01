@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $script->name ?? 'Détails du Script' }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('scripts.edit', $script->id ?? 1) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                    <a href="{{ route('scripts.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Informations générales -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informations générales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom</label>
                                <p class="text-gray-900">{{ $script->name ?? 'Script exemple' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($script->category ?? 'automation') }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Statut</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ ($script->status ?? 'active') == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($script->status ?? 'Actif') }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Créé par</label>
                                <p class="text-gray-900">{{ $script->creator->name ?? 'Utilisateur Admin' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Actions</h3>
                        <div class="space-y-2">
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-play mr-2"></i>Exécuter maintenant
                            </button>
                            <form method="POST" action="{{ route('favorites.toggle', $script->id ?? 1) }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full {{ ($isFavorited ?? false) ? 'bg-red-600 hover:bg-red-700' : 'bg-yellow-600 hover:bg-yellow-700' }} text-white px-4 py-2 rounded transition-colors">
                                    <i class="fas {{ ($isFavorited ?? false) ? 'fa-heart' : 'fa-heart-o' }} mr-2"></i>
                                    {{ ($isFavorited ?? false) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                                </button>
                            </form>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-download mr-2"></i>Télécharger
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if(!empty($script->description ?? 'Description du script exemple'))
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $script->description ?? 'Description du script exemple' }}</p>
                </div>
            </div>
            @endif

            <!-- Contenu du script -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-800">Contenu du script</h3>
                    <button onclick="copyScript()" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm transition-colors">
                        <i class="fas fa-copy mr-1"></i>Copier
                    </button>
                </div>
                <div class="bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto">
                    <pre id="script-content"><code>{{ $script->content ?? "#!/bin/bash\n# Script exemple\necho \"Ceci est un script d'exemple\"\ndate\necho \"Script terminé\"" }}</code></pre>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-eye text-blue-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Vues</p>
                            <p class="text-2xl font-bold text-blue-800">{{ $script->views_count ?? 42 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-green-600 text-sm font-medium">Succès</p>
                            <p class="text-2xl font-bold text-green-800">{{ $script->success_count ?? 15 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-times-circle text-red-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-red-600 text-sm font-medium">Erreurs</p>
                            <p class="text-2xl font-bold text-red-800">{{ $script->error_count ?? 2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-purple-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-purple-600 text-sm font-medium">Dernière exec.</p>
                            <p class="text-sm font-bold text-purple-800">{{ $script->last_run ? $script->last_run->format('d/m/Y H:i') : 'Jamais' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Métadonnées</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div>
                        <label class="block font-medium text-gray-700">Créé le</label>
                        <p class="text-gray-900">{{ $script->created_at ? $script->created_at->format('d/m/Y à H:i') : now()->subDays(7)->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Modifié le</label>
                        <p class="text-gray-900">{{ $script->updated_at ? $script->updated_at->format('d/m/Y à H:i') : now()->subHours(2)->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Planification</label>
                        <p class="text-gray-900 font-mono">{{ $script->schedule ?? '0 0 * * *' }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Taille</label>
                        <p class="text-gray-900">{{ strlen($script->content ?? '') }} caractères</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyScript() {
    const content = document.getElementById('script-content').textContent;
    navigator.clipboard.writeText(content).then(function() {
        // Feedback visuel
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-1"></i>Copié!';
        button.classList.add('bg-green-600');
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600');
        }, 2000);
    });
}
</script>
@endsection