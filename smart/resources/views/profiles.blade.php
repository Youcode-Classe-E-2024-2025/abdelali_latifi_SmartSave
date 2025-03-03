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
        <a href="/profiles_create" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300">
            Ajouter un Profil
        </a>
    </div>

    <!-- Conteneur des profils (grille de cartes de profil) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @foreach ($profiles as $profile)
        <a href="{{ route('home', ['id' => $profile->id]) }}">
            <div class="relative group">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <!-- Image de profil -->
                    <img src="{{ asset('storage/' . $profile->img) }}" alt="Image de profil" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity duration-300">
                </div>
                <!-- Nom du profil -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black via-transparent to-transparent p-2">
                    <h2 class="text-white text-lg font-semibold">{{ $profile->name }}</h2>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

</body>
</html>
