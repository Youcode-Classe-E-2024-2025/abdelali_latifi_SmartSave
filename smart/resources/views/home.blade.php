<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart - Tableau de Bord Financier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <!-- Header avec profil utilisateur -->
        <header class="flex items-center justify-between mb-8 bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center space-x-6">
                <img src="{{ asset('storage/' . $profile->img) }}" 
                     alt="Photo de {{ $profile->name }}" 
                     class="w-20 h-20 rounded-full border-4 border-blue-500 object-cover">
                <div>
                    <h1 class="text-3xl font-bold text-blue-800">Bonjour, {{ $profile->name }}</h1>
                    <p class="text-gray-500">Votre tableau de bord financier personnel</p>
                </div>
            </div>
            <div>
                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full">
                    Solde Total: {{ number_format($monthlyStats['net_balance'], 2) }}€
                </span>
            </div>
        </header>

        <!-- Grille principale avec statistiques et graphiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Colonne Gauche: Objectifs Financiers -->
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-blue-800">Mes Objectifs</h2>
                        <a href="{{ route('financial.createGoal') }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition">
                            + Ajouter
                        </a>
                    </div>
                    @if($goals->isEmpty())
                        <p class="text-gray-500 text-center">Aucun objectif défini</p>
                    @else
                        <div class="space-y-4">
                            @foreach($goals as $goal)
                                <div class="bg-blue-50 rounded-lg p-4 relative">
                                    <div class="flex justify-between items-center mb-2">
                                        <h3 class="font-semibold">{{ $goal->name }}</h3>
                                        <span class="text-sm text-blue-600">
                                            {{ number_format(($goal->current_amount / $goal->target_amount) * 100, 1) }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-blue-200 rounded-full h-2.5 mb-2">
                                        <div class="bg-blue-600 h-2.5 rounded-full" 
                                             style="width: {{ ($goal->current_amount / $goal->target_amount) * 100 }}%">
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>{{ number_format($goal->current_amount, 2) }}€</span>
                                        <span>{{ number_format($goal->target_amount, 2) }}€</span>
                                    </div>
                                    
                                    <!-- Actions pour chaque objectif -->
                                    <div class="flex space-x-2 mt-2">
                                        <a href="{{ route('financial.editGoal', $goal->id) }}" 
                                           class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600 transition text-xs">
                                            Modifier
                                        </a>
                                        <form action="{{ route('financial.deleteGoal', $goal->id) }}" method="POST" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?');"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-700 transition text-xs">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Autres sections restent identiques -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-blue-800 mb-4">Statistiques</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-green-600">Revenus</span>
                            <span class="font-semibold">{{ number_format($monthlyStats['total_income'], 2) }}€</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-red-600">Dépenses</span>
                            <span class="font-semibold">{{ number_format($monthlyStats['total_expenses'], 2) }}€</span>
                        </div>
                        <div class="flex justify-between items-center font-bold">
                            <span>Solde Net</span>
                            <span class="{{ $monthlyStats['net_balance'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($monthlyStats['net_balance'], 2) }}€
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne Centrale et Droite: Graphiques et Transactions -->
            <div class="md:col-span-2 space-y-6">
                <!-- Graphiques (restent identiques) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4">Revenus vs Dépenses</h3>
                        <canvas id="incomeExpenseChart" class="h-64"></canvas>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4">Répartition Transactions</h3>
                        <canvas id="transactionTypeChart" class="h-64"></canvas>
                    </div>
                </div>

                <!-- Liste des Transactions Récentes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-blue-800">Transactions Récentes</h2>
                        <a href="{{ route('financial.createTransaction') }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Nouvelle Transaction
                        </a>
                    </div>
                    @if($transactions->isEmpty())
                        <p class="text-center text-gray-500">Aucune transaction</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-blue-50 text-blue-800">
                                        <th class="p-3 text-left">Date</th>
                                        <th class="p-3 text-left">Type</th>
                                        <th class="p-3 text-left">Montant</th>
                                        <th class="p-3 text-left">Description</th>
                                        <th class="p-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions->take(5) as $transaction)
                                        <tr class="border-b hover:bg-blue-50 transition">
                                            <td class="p-3">{{ $transaction->created_at->format('d/m/Y') }}</td>
                                            <td class="p-3">
                                                <span class="{{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ ucfirst($transaction->type) }}
                                                </span>
                                            </td>
                                            <td class="p-3">{{ number_format($transaction->amount, 2) }}€</td>
                                            <td class="p-3">{{ $transaction->description }}</td>
                                            <td class="p-3 flex space-x-2">
                                                <a href="{{ route('financial.editTransaction', $transaction->id) }}" 
                                                   class="text-yellow-600 hover:text-yellow-800">
                                                    Modifier
                                                </a>
                                                <form action="{{ route('financial.deleteTransaction', $transaction->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-800">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Section Catégories -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-blue-800">Catégories</h2>
                        <a href="{{ route('categories.create') }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition">
                            + Ajouter
                        </a>
                    </div>
                    @if(isset($categories) && $categories->isNotEmpty())
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($categories as $category)
                                <div class="bg-blue-50 p-3 rounded-md shadow-sm flex justify-between items-center">
                                    <span>{{ $category->name }}</span>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('categories.destroy', $category->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center">Aucune catégorie disponible</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Le script reste identique à la version précédente -->
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    // Log des transactions brutes pour vérification
    const transactions = @json($transactions);
    console.log("Transactions brutes:", transactions);

    // Calcul manuel des totaux pour vérification
    const incomeTotal = transactions
        .filter(t => t.type === 'income')
        .reduce((sum, t) => sum + parseFloat(t.amount), 0);
    
    const expenseTotal = transactions
        .filter(t => t.type === 'expense')
        .reduce((sum, t) => sum + parseFloat(t.amount), 0);

    console.log("Total Revenus:", incomeTotal);
    console.log("Total Dépenses:", expenseTotal);

    // Configuration des graphiques avec debug
    const chartOptions = {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return ` ${context.label}: ${context.formattedValue}€`;
                    }
                }
            }
        }
    };

    // Vérification de l'existence des canvas
    const incomeExpenseCanvas = document.getElementById('incomeExpenseChart');
    const transactionTypeCanvas = document.getElementById('transactionTypeChart');

    if (!incomeExpenseCanvas || !transactionTypeCanvas) {
        console.error("Un ou plusieurs canvas sont manquants");
        return;
    }

    // Graphique Revenus vs Dépenses
    new Chart(incomeExpenseCanvas, {
        type: 'pie',  // Changé en pie pour plus de clarté
        data: {
            labels: ['Revenus', 'Dépenses'],
            datasets: [{
                data: [
                    incomeTotal, 
                    expenseTotal
                ],
                backgroundColor: ['#34D399', '#F87171']
            }]
        },
        options: {
            ...chartOptions,
            plugins: {
                ...chartOptions.plugins,
                datalabels: {
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1) + '%';
                        return percentage;
                    },
                    color: 'white',
                    font: { weight: 'bold' }
                }
            }
        }
    });

    // Graphique Répartition des Transactions
    const incomeTransactionsCount = transactions.filter(t => t.type === 'income').length;
    const expenseTransactionsCount = transactions.filter(t => t.type === 'expense').length;

    new Chart(transactionTypeCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Revenus', 'Dépenses'],
            datasets: [{
                data: [
                    incomeTransactionsCount,
                    expenseTransactionsCount
                ],
                backgroundColor: ['#34D399', '#F87171']
            }]
        },
        options: {
            ...chartOptions,
            plugins: {
                ...chartOptions.plugins,
                datalabels: {
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1) + '%';
                        return percentage;
                    },
                    color: 'white',
                    font: { weight: 'bold' }
                }
            }
        }
    });
});    </script>
</body>
</html>