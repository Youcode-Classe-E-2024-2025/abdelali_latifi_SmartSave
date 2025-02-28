<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Bienvenue dans SaveSmart</h1>

        <!-- Affichage des objectifs financiers -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Mes Objectifs Financiers</h2>
            @if($goals->isEmpty())
                <p class="text-gray-600">Aucun objectif ajouté pour le moment.</p>
            @else
                <ul class="space-y-4">
                    @foreach($goals as $goal)
                        <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <strong class="text-lg text-gray-900">{{ $goal->name }}</strong><br>
                            <span class="text-sm text-gray-600">Montant cible: {{ number_format($goal->target_amount, 2) }}€</span><br>
                            <span class="text-sm text-gray-600">Montant actuel: {{ number_format($goal->current_amount, 2) }}€</span><br>
                            <progress class="w-full mt-2" value="{{ $goal->current_amount }}" max="{{ $goal->target_amount }}"></progress>
                        </li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('financial.createGoal') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Ajouter un Objectif</a>
        </section>

        <hr class="my-6 border-gray-300">

        <!-- Affichage des transactions récentes -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dernières Transactions</h2>
            @if($transactions->isEmpty())
                <p class="text-gray-600">Aucune transaction enregistrée pour le moment.</p>
            @else
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Type</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Montant</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr class="border-t">
                                <td class="py-2 px-4 text-sm">{{ $transaction->created_at->format('d/m/Y') }}</td>
                                <td class="py-2 px-4 text-sm">{{ ucfirst($transaction->type) }}</td>
                                <td class="py-2 px-4 text-sm">{{ number_format($transaction->amount, 2) }}€</td>
                                <td class="py-2 px-4 text-sm">{{ $transaction->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{ route('financial.createTransaction') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Ajouter une Transaction</a>
        </section>

        <hr class="my-6 border-gray-300">

        <!-- Visualisation du budget -->
        <section>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Visualisation du Budget</h2>
            <p class="text-gray-600 mb-4">Voici un aperçu de vos revenus et dépenses sous forme de diagrammes.</p>
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <!-- Placeholder pour les graphiques -->
                <div id="income-expense-chart" class="h-64 bg-gray-200 rounded-lg"></div>
            </div>
        </section>
    </div>

</body>
</html>
