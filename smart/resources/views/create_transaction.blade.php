<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('financial.storeTransaction') }}" method="POST">
    @csrf
    <label for="type">Type</label>
    <select name="type" required>
        <option value="income">Revenu</option>
        <option value="expense">Dépense</option>
    </select>

    <label for="amount">Montant</label>
    <input type="number" name="amount" step="0.01" required>

    <label for="description">Description</label>
    <input type="text" name="description" required>

    <label for="goal_id">Objectif</label>
    <select name="goal_id">
        <option value="">Aucun</option>
        @foreach ($goals as $goal)
            <option value="{{ $goal->id }}">{{ $goal->name }}</option>
        @endforeach
    </select>

    <button type="submit">Ajouter Transaction</button>
</form>

</body>
</html>