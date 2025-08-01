@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Modifier le Script' }}</h2>
                <a href="{{ route('scripts.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
            </div>
        </div>

        <div class="p-6">
            <p class="text-gray-600 mb-6">{{ $message ?? 'Modifier le script #' . ($id ?? 'N/A') }}</p>

            <form method="POST" action="{{ route('scripts.update', $id ?? 1) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du script *</label>
                        <input type="text" id="name" name="name" required 
                               value="Script exemple"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nom du script">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                        <select id="category" name="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="automation" selected>Automatisation</option>
                            <option value="monitoring">Surveillance</option>
                            <option value="backup">Sauvegarde</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Description du script">Description exemple du script</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu du script *</label>
                    <textarea id="content" name="content" rows="12" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                              placeholder="#!/bin/bash&#10;# Votre script ici">#!/bin/bash
# Script exemple
echo "Ceci est un script d'exemple"
date
echo "Script terminé"</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <select id="status" name="status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="draft">Brouillon</option>
                            <option value="active" selected>Actif</option>
                            <option value="inactive">Inactif</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="schedule" class="block text-sm font-medium text-gray-700 mb-2">Planification (CRON)</label>
                        <input type="text" id="schedule" name="schedule" 
                               value="0 0 * * *"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="0 0 * * * (Optionnel)">
                        <p class="text-xs text-gray-500 mt-1">Format CRON pour la planification automatique</p>
                    </div>
                </div>

                <!-- Informations sur les modifications -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Informations de modification</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <strong>Créé le:</strong> {{ now()->subDays(7)->format('d/m/Y à H:i') }}
                        </div>
                        <div>
                            <strong>Créé par:</strong> Utilisateur Admin
                        </div>
                        <div>
                            <strong>Modifié le:</strong> {{ now()->subHours(2)->format('d/m/Y à H:i') }}
                        </div>
                        <div>
                            <strong>Modifié par:</strong> {{ Auth::user()->name ?? 'Utilisateur connecté' }}
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="history.back()" 
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition-colors">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors">
                        <i class="fas fa-save mr-2"></i>Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textarea
    const contentTextarea = document.getElementById('content');
    contentTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
});
</script>
@endsection