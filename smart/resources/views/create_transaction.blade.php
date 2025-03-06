<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Transaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8 mb-8">
        <div class="flex items-center mb-6">
            <a href="#" class="text-blue-600 hover:text-blue-800 mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-semibold text-gray-800">Ajouter une transaction</h1>
        </div>

        <form action="{{ route('financial.storeTransaction') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Type de transaction -->
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-3">
                    <i class="fas fa-exchange-alt mr-2 text-blue-500"></i>Type de transaction
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all" id="income-label">
                        <input type="radio" name="type" value="income" id="income" class="sr-only" required checked>
                        <div class="flex flex-col items-center space-y-2">
                            <i class="fas fa-arrow-down text-2xl text-green-500"></i>
                            <span>Revenu</span>
                        </div>
                    </label>
                    <label class="flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all" id="expense-label">
                        <input type="radio" name="type" value="expense" id="expense" class="sr-only" required>
                        <div class="flex flex-col items-center space-y-2">
                            <i class="fas fa-arrow-up text-2xl text-red-500"></i>
                            <span>Dépense</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Montant -->
            <div>
                <label for="amount" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-euro-sign mr-2 text-blue-500"></i>Montant
                </label>
                <div class="relative">
                    <input type="number" name="amount" id="amount" step="0.01" required 
                        class="block w-full p-3 pl-10 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-lg shadow-sm" 
                        placeholder="0.00">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">€</span>
                    </div>
                </div>
            </div>

            <!-- Date de la transaction -->
            <div>
                <label for="transaction_date" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>Date
                </label>
                <input type="date" name="transaction_date" id="transaction_date" required
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                    value="{{ date('Y-m-d') }}">
            </div>

            <!-- Catégorie -->
            <div id="category-container">
                <label for="category" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-folder mr-2 text-blue-500"></i>Catégorie
                </label>
                <select name="category" id="category" required
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="" disabled selected>Sélectionnez une catégorie</option>
                    <!-- Options pour les revenus -->
                    <optgroup label="Revenus" id="income-categories">
                        <option value="salary">Salaire</option>
                        <option value="freelance">Freelance</option>
                        <option value="investment">Investissements</option>
                        <option value="gift">Cadeau reçu</option>
                        <option value="other_income">Autre revenu</option>
                    </optgroup>
                    <!-- Options pour les dépenses -->
                    <optgroup label="Dépenses" id="expense-categories">
                        <option value="housing">Logement</option>
                        <option value="groceries">Courses alimentaires</option>
                        <option value="utilities">Factures (eau, électricité)</option>
                        <option value="transport">Transport</option>
                        <option value="healthcare">Santé</option>
                        <option value="leisure">Loisirs</option>
                        <option value="shopping">Shopping</option>
                        <option value="restaurant">Restaurant & sorties</option>
                        <option value="other_expense">Autre dépense</option>
                    </optgroup>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                </label>
                <input type="text" name="description" id="description" required 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                    placeholder="Ex: Courses au supermarché, Salaire mensuel...">
            </div>

            <!-- Mode de paiement -->
            <div>
                <label for="payment_method" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-credit-card mr-2 text-blue-500"></i>Mode de paiement
                </label>
                <select name="payment_method" id="payment_method"
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="card">Carte bancaire</option>
                    <option value="cash">Espèces</option>
                    <option value="transfer">Virement</option>
                    <option value="check">Chèque</option>
                    <option value="mobile">Paiement mobile</option>
                    <option value="other">Autre</option>
                </select>
            </div>

            <!-- Objectif associé -->
            <div>
                <label for="goal_id" class="block text-lg font-medium text-gray-700 mb-2">
                    <i class="fas fa-bullseye mr-2 text-blue-500"></i>Associer à un objectif
                </label>
                <select name="goal_id" id="goal_id" 
                    class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">Aucun</option>
                    @foreach ($goals as $goal)
                        <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Facultatif: associez cette transaction à un objectif d'épargne</p>
            </div>
            <!-- Boutons -->
            <div class="flex justify-between pt-4">
                <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>Ajouter la Transaction
                </button>
            </div>
        </form>
    </div>
