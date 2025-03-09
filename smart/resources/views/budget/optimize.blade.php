<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimisation Budgétaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-3xl w-full bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-semibold text-blue-700 mb-6 text-center">
            🔥 Optimisation Budgétaire
        </h1>

        <form action="{{ route('budget.optimize') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="total_budget" class="block text-gray-700 font-medium mb-2">💰 Budget Total :</label>
                <input type="number" name="total_budget" id="total_budget"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="needs_percentage" class="block text-gray-700 font-medium mb-2">📌 Besoins (%) :</label>
                    <input type="number" name="needs_percentage" id="needs_percentage" min="0" max="100"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>
                <div>
                    <label for="wants_percentage" class="block text-gray-700 font-medium mb-2">🎭 Envies (%) :</label>
                    <input type="number" name="wants_percentage" id="wants_percentage" min="0" max="100"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>
                <div>
                    <label for="savings_percentage" class="block text-gray-700 font-medium mb-2">📈 Épargne (%) :</label>
                    <input type="number" name="savings_percentage" id="savings_percentage" min="0" max="100"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>
            </div>

            <div>
                <label for="category_priorities" class="block text-gray-700 font-medium mb-2">📂 Priorités des Catégories :</label>
                <select name="category_priorities[]" id="category_priorities" multiple
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="goal_priorities" class="block text-gray-700 font-medium mb-2">🎯 Objectifs d'Épargne :</label>
                <select name="goal_priorities[]" id="goal_priorities" multiple
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach($goals as $goal)
                        <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    🚀 Optimiser le Budget
                </button>
            </div>
        </form>
    </div>

</body>
</html>
