<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Objectif Financier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8 mb-8">
        <div class="flex items-center mb-6">
            <a href="#" class="text-blue-600 hover:text-blue-800 mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-semibold text-gray-800">Ajouter un objectif financier</h1>
        </div>

        <form action="{{ route('financial.storeGoal') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nom de l'objectif -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag mr-2 text-blue-500"></i>Nom de l'objectif
                </label>
                <input type="text" name="name" id="name" required 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                    placeholder="Ex: Achat d'une voiture, Voyage au Japon...">
            </div>

            <!-- Montant cible -->
            <div>
                <label for="target_amount" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-euro-sign mr-2 text-blue-500"></i>Montant cible
                </label>
                <div class="relative">
                    <input type="number" name="target_amount" id="target_amount" step="0.01" required 
                        class="block w-full p-3 pl-10 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                        placeholder="Entrez le montant cible">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">€</span>
                    </div>
                </div>
            </div>

            <!-- Date limite -->
            <div>
                <label for="target_date" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>Date limite (optionnel)
                </label>
                <input type="date" name="target_date" id="target_date" 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>

            <!-- Catégorie -->
            <div>
                <label for="category" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-folder mr-2 text-blue-500"></i>Catégorie
                </label>
                <select name="category" id="category" 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="housing">Logement</option>
                    <option value="transport">Transport</option>
                    <option value="travel">Voyage</option>
                    <option value="education">Éducation</option>
                    <option value="retirement">Retraite</option>
                    <option value="other">Autre</option>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-blue-500"></i>Description (optionnel)
                </label>
                <textarea name="description" id="description" rows="3" 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                    placeholder="Quelques détails sur votre objectif..."></textarea>
            </div>

            <!-- Montant initial -->
            <div>
                <label for="initial_amount" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-money-bill-wave mr-2 text-blue-500"></i>Montant initial (optionnel)
                </label>
                <div class="relative">
                    <input type="number" name="initial_amount" id="initial_amount" step="0.01" 
                        class="block w-full p-3 pl-10 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                        placeholder="Si vous avez déjà commencé à épargner">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">€</span>
                    </div>
                </div>
            </div>
            <!-- Boutons -->
            <div class="flex justify-between pt-4">
                <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>Ajouter l'Objectif
                </button>
            </div>
        </form>
    </div>
</body>
</html>