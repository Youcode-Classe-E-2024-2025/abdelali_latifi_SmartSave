<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Profils</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Liste des Profils</h1>

    <!-- Bouton pour ajouter un profil -->
    <div class="mb-6">
        <a href="/add-profile" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300">
            Ajouter un Profil
        </a>
    </div>

    <!-- Conteneur des profils -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($profiles as $profile)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('storage/' . $profile->img) }}" alt="Image de profil" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $profile->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $profile->user->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
