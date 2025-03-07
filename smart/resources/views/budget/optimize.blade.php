<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimisation Budgétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Optimisation Budgétaire</h1>

        <form action="{{ route('budget.optimize') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="total_budget" class="block text-gray-700 text-sm font-bold mb-2">Budget Total:</label>
                <input type="number" name="total_budget" id="total_budget" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="needs_percentage" class="block text-gray-700 text-sm font-bold mb-2">Pourcentage pour les Besoins:</label>
                <input type="number" name="needs_percentage" id="needs_percentage" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0" max="100">
            </div>

            <div class="mb-4">
                <label for="wants_percentage" class="block text-gray-700 text-sm font-bold mb-2">Pourcentage pour les Envies:</label>
                <input type="number" name="wants_percentage" id="wants_percentage" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0" max="100">
            </div>

            <div class="mb-4">
                <label for="savings_percentage" class="block text-gray-700 text-sm font-bold mb-2">Pourcentage pour l'Épargne:</label>
                <input type="number" name="savings_percentage" id="savings_percentage" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0" max="100">
            </div>

            <div class="mb-4">
                <label for="category_priorities" class="block text-gray-700 text-sm font-bold mb-2">Priorités des Catégories:</label>
                <select name="category_priorities[]" id="category_priorities" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="goal_priorities" class="block text-gray-700 text-sm font-bold mb-2">Priorités des Objectifs d'Épargne:</label>
                <select name="goal_priorities[]" id="goal_priorities" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                    @foreach($goals as $goal)
                        <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Optimiser le Budget
                </button>
            </div>
        </form>
    </div>
</body>
</html>
