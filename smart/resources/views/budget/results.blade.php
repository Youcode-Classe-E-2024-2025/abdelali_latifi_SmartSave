<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de l'Optimisation Budgétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Résultats de l'Optimisation Budgétaire</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p class="mb-2">Budget Total: {{ number_format($results['total_budget'], 2) }} €</p>
            <p class="mb-2">Besoins: {{ number_format($results['needs'], 2) }} €</p>
            <p class="mb-2">Envies: {{ number_format($results['wants'], 2) }} €</p>
            <p class="mb-2">Épargne: {{ number_format($results['savings'], 2) }} €</p>

            @if(!empty($results['category_priorities']))
                <h2 class="text-xl font-semibold mt-4 mb-2">Priorités des Catégories:</h2>
                <ul>
                    @foreach($results['category_priorities'] as $categoryId)
                        <li>{{ \App\Models\Category::find($categoryId)->name }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($results['goal_priorities']))
                <h2 class="text-xl font-semibold mt-4 mb-2">Priorités des Objectifs:</h2>
                <ul>
                    @foreach($results['goal_priorities'] as $goalId)
                        <li>{{ \App\Models\Goal::find($goalId)->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</body>
</html>
