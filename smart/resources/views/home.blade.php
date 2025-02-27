<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans SaveSmart</h1>

        <!-- Affichage des objectifs financiers -->
        <section class="goals-section">
            <h2>Mes Objectifs Financiers</h2>
            @if($goals->isEmpty())
                <p>Aucun objectif ajouté pour le moment.</p>
            @else
                <ul>
                    @foreach($goals as $goal)
                        <li>
                            <strong>{{ $goal->name }}</strong><br>
                            Montant cible: {{ number_format($goal->target_amount, 2) }}€<br>
                            Montant actuel: {{ number_format($goal->current_amount, 2) }}€<br>
                            <progress value="{{ $goal->current_amount }}" max="{{ $goal->target_amount }}"></progress>
                        </li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('financial.createGoal') }}" class="btn btn-primary">Ajouter un Objectif</a>
        </section>

        <hr>

        <!-- Affichage des transactions récentes -->
        <section class="transactions-section">
            <h2>Dernières Transactions</h2>
            @if($transactions->isEmpty())
                <p>Aucune transaction enregistrée pour le moment.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                <td>{{ ucfirst($transaction->type) }}</td>
                                <td>{{ number_format($transaction->amount, 2) }}€</td>
                                <td>{{ $transaction->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{ route('financial.createTransaction') }}" class="btn btn-primary">Ajouter une Transaction</a>
        </section>

        <hr>

        <!-- Visualisation du budget -->
        <section class="budget-visualization-section">
            <h2>Visualisation du Budget</h2>
            <p>Voici un aperçu de vos revenus et dépenses sous forme de diagrammes.</p>
            <div class="charts">
                <!-- Placeholder pour les graphiques -->
                <div id="income-expense-chart"></div>
            </div>
        </section>
    </div>
</body>
</html>