<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Transaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Ajouter une Transaction</h1>

        <form action="{{ route('financial.updateTransaction', $transaction->id) }}" method="POST">
        @csrf
            @method('PUT')
            <!-- Type de transaction -->
            <div>
                <label for="type" class="block text-lg font-medium text-gray-700 mb-2">Type de Transaction</label>
                <select name="type" id="type" required class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Revenu</option>
                <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Dépense</option>
                </select>
            </div>

            <!-- Montant -->
            <div>
                <label for="amount" class="block text-lg font-medium text-gray-700 mb-2">Montant (€)</label>
                <input type="number" name="amount" id="amount" step="0.01" required class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"  value="{{ old('amount', $transaction->amount) }}">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description</label>
                <input type="text" name="description" id="description" required class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ old('description', $transaction->description) }}">
            </div>

            <!-- Objectif -->
            <div>
                <label for="goal_id" class="block text-lg font-medium text-gray-700 mb-2">Objectif</label>
                <select name="goal_id" id="goal_id" class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Aucun</option>
                    @foreach ($goals as $goal)
                    <option value="{{ $goal->id }}" {{ $transaction->goal_id == $goal->id ? 'selected' : '' }}>{{ $goal->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-center">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Mettre à jour
                </button>
            </div>
        </form>
    </div>

</body>
</html>
