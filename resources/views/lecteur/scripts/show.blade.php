@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $script->name ?? 'Détails du Script' }}</h2>
                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('favorites.toggle', $script->id ?? 1) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas {{ ($isFavorited ?? false) ? 'fa-heart' : 'fa-heart-o' }} mr-2"></i>
                            {{ ($isFavorited ?? false) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                        </button>
                    </form>
                    <a href="{{ route('lecteur.scripts') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
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
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informations du script</h3>
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
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
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Actions rapides</h3>
                        <div class="space-y-2">
                            <button onclick="copyScript()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-copy mr-2"></i>Copier le script
                            </button>
                            <button onclick="downloadScript()" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-download mr-2"></i>Télécharger
                            </button>
                            <button onclick="shareScript()" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-share mr-2"></i>Partager
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
                    <p class="text-gray-700">{{ $script->description ?? 'Description du script exemple pour les lecteurs.' }}</p>
                </div>
            </div>
            @endif

            <!-- Contenu du script -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-800">Contenu du script</h3>
                    <div class="flex space-x-2">
                        <button onclick="toggleLineNumbers()" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm transition-colors">
                            <i class="fas fa-list-ol mr-1"></i>Numéros
                        </button>
                        <button onclick="copyScript()" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm transition-colors">
                            <i class="fas fa-copy mr-1"></i>Copier
                        </button>
                    </div>
                </div>
                <div class="bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto">
                    <pre id="script-content" class="text-sm"><code>{{ $script->content ?? "#!/bin/bash\n# Script exemple pour lecteur\necho \"Ceci est un script d'exemple\"\ndate\necho \"Script terminé avec succès\"" }}</code></pre>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-eye text-blue-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Vues</p>
                            <p class="text-2xl font-bold text-blue-800">{{ $script->views_count ?? 127 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-heart text-yellow-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-yellow-600 text-sm font-medium">Favoris</p>
                            <p class="text-2xl font-bold text-yellow-800">{{ $script->favorites_count ?? 23 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-download text-green-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-green-600 text-sm font-medium">Téléchargements</p>
                            <p class="text-2xl font-bold text-green-800">{{ $script->downloads_count ?? 45 }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-star text-purple-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-purple-600 text-sm font-medium">Note</p>
                            <p class="text-2xl font-bold text-purple-800">{{ $script->rating ?? '4.5' }}/5</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Informations techniques</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div>
                        <label class="block font-medium text-gray-700">Créé le</label>
                        <p class="text-gray-900">{{ $script->created_at ? $script->created_at->format('d/m/Y à H:i') : now()->subDays(7)->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Mis à jour le</label>
                        <p class="text-gray-900">{{ $script->updated_at ? $script->updated_at->format('d/m/Y à H:i') : now()->subHours(2)->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Taille</label>
                        <p class="text-gray-900">{{ strlen($script->content ?? '') }} caractères</p>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Type</label>
                        <p class="text-gray-900">Script Bash</p>
                    </div>
                </div>
            </div>

            <!-- Scripts similaires -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Scripts similaires</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-3 rounded border">
                        <h4 class="font-medium text-gray-800 mb-1">Script de sauvegarde</h4>
                        <p class="text-xs text-gray-600 mb-2">Automatisation de sauvegarde</p>
                        <a href="#" class="text-blue-600 text-xs hover:underline">Voir le script →</a>
                    </div>
                    <div class="bg-white p-3 rounded border">
                        <h4 class="font-medium text-gray-800 mb-1">Monitoring système</h4>
                        <p class="text-xs text-gray-600 mb-2">Surveillance des ressources</p>
                        <a href="#" class="text-blue-600 text-xs hover:underline">Voir le script →</a>
                    </div>
                    <div class="bg-white p-3 rounded border">
                        <h4 class="font-medium text-gray-800 mb-1">Nettoyage logs</h4>
                        <p class="text-xs text-gray-600 mb-2">Maintenance des logs</p>
                        <a href="#" class="text-blue-600 text-xs hover:underline">Voir le script →</a>
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
        showNotification('Script copié dans le presse-papiers!', 'success');
    });
}

function downloadScript() {
    const content = document.getElementById('script-content').textContent;
    const blob = new Blob([content], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = '{{ $script->name ?? "script" }}.sh';
    a.click();
    window.URL.revokeObjectURL(url);
    showNotification('Script téléchargé!', 'success');
}

function shareScript() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $script->name ?? "Script" }}',
            text: '{{ $script->description ?? "Découvrez ce script" }}',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        showNotification('Lien copié dans le presse-papiers!', 'success');
    }
}

function toggleLineNumbers() {
    // Fonction pour basculer l'affichage des numéros de ligne
    const pre = document.getElementById('script-content');
    pre.classList.toggle('line-numbers');
}

function showNotification(message, type) {
    // Créer une notification temporaire
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white z-50 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection