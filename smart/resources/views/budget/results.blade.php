<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de l'Optimisation Budgétaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-3xl w-full bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-semibold text-blue-700 mb-6 text-center">
            🎯 Résultats de l'Optimisation
        </h1>

        <div class="bg-blue-100 p-6 rounded-lg shadow-md">
            <p class="text-lg font-medium text-gray-800">💰 Budget Total : 
                <span class="font-bold text-blue-700">{{ number_format($results['total_budget'], 2) }} €</span>
            </p>
            <p class="text-lg font-medium text-gray-800">📌 Besoins : 
                <span class="font-bold text-green-600">{{ number_format($results['needs'], 2) }} €</span>
            </p>
            <p class="text-lg font-medium text-gray-800">🎭 Envies : 
                <span class="font-bold text-yellow-600">{{ number_format($results['wants'], 2) }} €</span>
            </p>
            <p class="text-lg font-medium text-gray-800">📈 Épargne : 
                <span class="font-bold text-purple-600">{{ number_format($results['savings'], 2) }} €</span>
            </p>
        </div>

        @if(!empty($results['category_priorities']))
            <h2 class="text-xl font-semibold mt-6 text-gray-800">📂 Priorités des Catégories :</h2>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($results['category_priorities'] as $categoryId)
                    <li class="py-1">{{ \App\Models\Category::find($categoryId)->name }}</li>
                @endforeach
            </ul>
        @endif

        @if(!empty($results['goal_priorities']))
            <h2 class="text-xl font-semibold mt-6 text-gray-800">🎯 Priorités des Objectifs :</h2>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($results['goal_priorities'] as $goalId)
                    <li class="py-1">{{ \App\Models\Goal::find($goalId)->name }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mt-6 flex justify-center">
            <a href="{{ route('budget.form') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                🔄 Refaire une Optimisation
            </a>
        </div>
    </div>

</body>
</html>
