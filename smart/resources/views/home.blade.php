<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

<!-- Affichage du profil -->
<div class="flex items-center justify-between p-6 bg-white rounded-lg shadow-md mb-6">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('storage/' . $profile->img) }}" alt="Photo de {{ $profile->name }}" class="w-16 h-16 rounded-full border-2 border-blue-600">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">{{ $profile->name }}</h2>
            <p class="text-sm text-gray-500">Bienvenue sur votre tableau de bord</p>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">

    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Bienvenue dans SaveSmart</h1>

    <!-- Affichage des objectifs financiers -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Mes Objectifs Financiers</h2>
        @if($goals->isEmpty())
            <p class="text-gray-600">Aucun objectif ajouté pour le moment.</p>
        @else
            <ul class="space-y-4">
                @foreach($goals as $goal)
                    <li class="bg-gray-50 p-4 rounded-lg shadow-sm hover:bg-gray-100 transition">
                        <strong class="text-lg text-gray-900">{{ $goal->name }}</strong><br>
                        <span class="text-sm text-gray-600">Montant cible: {{ number_format($goal->target_amount, 2) }}€</span><br>
                        <span class="text-sm text-gray-600">Montant actuel: {{ number_format($goal->current_amount, 2) }}€</span><br>
                        <progress class="w-full mt-2" value="{{ $goal->current_amount }}" max="{{ $goal->target_amount }}"></progress><br>
                        <span class="text-sm text-gray-500">Ajouté par: <strong>{{ $goal->user->name ?? 'Inconnu' }}</strong></span><br>
                        
                        <!-- Boutons Modifier et Supprimer -->
                        <div class="mt-2 flex space-x-4">
                            <a href="{{ route('financial.editGoal', $goal->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Modifier</a>
                            <form action="{{ route('financial.deleteGoal', $goal->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">Supprimer</button>
                            </form>
                        </div>
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
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Utilisateur</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Date</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Type</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Montant</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Description</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-t">
                            <td class="py-2 px-4 text-sm">{{ $transaction->user->name ?? 'Inconnu' }}</td>
                            <td class="py-2 px-4 text-sm">{{ $transaction->created_at->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 text-sm">{{ ucfirst($transaction->type) }}</td>
                            <td class="py-2 px-4 text-sm">{{ number_format($transaction->amount, 2) }}€</td>
                            <td class="py-2 px-4 text-sm">{{ $transaction->description }}</td>
                            <td class="py-2 px-4 text-sm">
                                <a href="{{ route('financial.editTransaction', $transaction->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Modifier</a>
                                <form action="{{ route('financial.deleteTransaction', $transaction->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('financial.createTransaction') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Ajouter une Transaction</a>
    </section>

    <!-- Affichage des catégories -->
    @if(isset($categories) && $categories->isNotEmpty())
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Catégories</h2>
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li class="bg-gray-50 p-3 rounded-md shadow-sm">{{ $category->name }}</li>
                @endforeach
            </ul>
        </section>
    @else
        <p class="text-gray-600">Aucune catégorie disponible.</p>
    @endif
    <a href="{{ route('categories.create') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        Ajouter une Catégorie
    </a>

</div>
<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Statistiques Financières Mensuelles</h2>
    
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-blue-100 p-4 rounded-lg">
            <h3 class="font-semibold">Revenus Totaux</h3>
            <p class="text-2xl text-green-600">{{ number_format($monthlyStats['total_income'], 2) }}€</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg">
            <h3 class="font-semibold">Dépenses Totales</h3>
            <p class="text-2xl text-red-600">{{ number_format($monthlyStats['total_expenses'], 2) }}€</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="font-semibold">Solde Net</h3>
            <p class="text-2xl {{ $monthlyStats['net_balance'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ number_format($monthlyStats['net_balance'], 2) }}€
            </p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg">
            <h3 class="font-semibold">Transactions</h3>
            <p>Revenus: {{ $monthlyStats['income_transactions_count'] }}</p>
            <p>Dépenses: {{ $monthlyStats['expense_transactions_count'] }}</p>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Préparation des données depuis les variables PHP
    const transactions = @json($transactions);
    const goals = @json($goals);

    // Revenus vs Dépenses
    const incomeExpenseData = {
        labels: ['Revenus', 'Dépenses'],
        datasets: [{
            data: [
                transactions.filter(t => t.type === 'income').reduce((sum, t) => sum + t.amount, 0),
                transactions.filter(t => t.type === 'expense').reduce((sum, t) => sum + t.amount, 0)
            ],
            backgroundColor: ['#34D399', '#F87171']
        }]
    };

    new Chart(document.getElementById('incomeExpenseChart'), {
        type: 'pie',
        data: incomeExpenseData,
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Répartition des Transactions
    const transactionTypeData = {
        labels: ['Revenus', 'Dépenses'],
        datasets: [{
            data: [
                transactions.filter(t => t.type === 'income').length,
                transactions.filter(t => t.type === 'expense').length
            ],
            backgroundColor: ['#34D399', '#F87171']
        }]
    };

    new Chart(document.getElementById('transactionTypeChart'), {
        type: 'doughnut',
        data: transactionTypeData,
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Progression des Objectifs
    const goalProgressData = {
        labels: goals.map(g => g.name),
        datasets: [{
            label: 'Progression',
            data: goals.map(g => (g.current_amount / g.target_amount) * 100),
            backgroundColor: '#3B82F6'
        }]
    };

    new Chart(document.getElementById('goalProgressChart'), {
        type: 'bar',
        data: goalProgressData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%'
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>

</body>
</html>
