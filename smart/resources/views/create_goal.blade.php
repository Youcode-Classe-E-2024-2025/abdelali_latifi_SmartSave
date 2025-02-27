<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('financial.storeGoal') }}" method="POST">
    @csrf
    <label for="name">Nom de l'objectif</label>
    <input type="text" name="name" required>

    <label for="target_amount">Montant cible</label>
    <input type="number" name="target_amount" step="0.01" required>

    <button type="submit">Ajouter Objectif</button>
</form>
</body>
</html>