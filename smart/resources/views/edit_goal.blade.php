<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Objectif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Ajouter un Objectif</h1>

        <form action="{{ route('financial.updateGoal', $goal->id) }}    " method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Nom de l'objectif -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Nom de l'objectif</label>
                <input type="text" name="name" id="name" value="{{ old('name', $goal->name) }}"required class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" >
            </div>

            <!-- Montant cible -->
            <div>
                <label for="target_amount" class="block text-lg font-medium text-gray-700 mb-2">Montant cible (€)</label>
                <input type="number" name="target_amount" id="target_amount" step="0.01" value="{{ old('target_amount', $goal->target_amount) }}" class="block w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Entrez le montant cible">
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-center">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Ajouter l'Objectif
                </button>
            </div>
        </form>
    </div>

</body>
</html>
