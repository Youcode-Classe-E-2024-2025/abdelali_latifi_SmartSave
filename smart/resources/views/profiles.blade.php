<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Profils</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <!-- En-tête de page -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-user-circle mr-2 text-blue-600"></i>Gestion des Profils
            </h1>
            <div class="flex space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un profil..." class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <a href="/profiles_create" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300 shadow-md">
                    <i class="fas fa-plus mr-2"></i> Ajouter un Profil
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-6">
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Total des profils</p>
                        <p class="text-2xl font-bold text-blue-600">{{ count($profiles) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Profils actifs</p>
                        <p class="text-2xl font-bold text-green-600">{{ count($profiles) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Conteneur des profils (grille de cartes de profil) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($profiles as $profile)
            <div class="group">
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1 hover:scale-105">
                    <!-- Image de profil -->
                    <div class="relative">
                        <img src="{{ asset('storage/' . $profile->img) }}" alt="Image de profil" class="w-full h-48 object-cover">
                        <div class="absolute top-0 right-0 m-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500 mr-1"></span>
                                Actif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Informations du profil -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $profile->name }}</h2>
                        <p class="text-sm text-gray-500 mb-3">Créé le {{ date('d/m/Y') }}</p>
                        
                        <!-- Actions et statistiques -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-1">
                                <a href="{{ route('home', ['id' => $profile->id]) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</body>
</html>