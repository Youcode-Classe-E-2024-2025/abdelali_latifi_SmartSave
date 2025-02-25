<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/react@1.0.0"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-gray-200">
    <div class="w-full max-w-md p-6 bg-gray-800/90 backdrop-blur-md rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-100">Connexion</h2>
        <form action="/login" method="POST" class="mt-4 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <div class="relative">
                    <input type="email" name="email" required 
                        class="w-full p-2 pl-10 border border-gray-600 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-200 transition-all duration-200 ease-in-out">
                    <span class="absolute left-3 top-2 text-gray-400">
                        📧
                    </span>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300">Mot de passe</label>
                <div class="relative">
                    <input type="password" name="password" required 
                        class="w-full p-2 pl-10 border border-gray-600 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-200 transition-all duration-200 ease-in-out">
                    <span class="absolute left-3 top-2 text-gray-400">
                        🔒
                    </span>
                </div>
            </div>
            <button type="submit" 
                class="w-full mt-4 p-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all duration-200 ease-in-out shadow-md">
                Se connecter
            </button>
        </form>
        <p class="mt-3 text-center text-sm text-gray-400">Pas encore inscrit ? 
            <a href="/signup" class="text-blue-400 hover:text-blue-300 transition-all duration-200">Créer un compte</a>
        </p>
    </div>
</body>
</html>
