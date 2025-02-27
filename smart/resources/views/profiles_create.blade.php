<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
<div class="max-w-md mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
    <h1 class="text-3xl font-semibold text-gray-700 mb-6">Ajouter un Profil</h1>
    <!-- Formulaire d'ajout de profil -->
    <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-lg font-medium mb-2">Nom du Profil</label>
            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('name') 
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-6">
            <label for="img" class="block text-gray-700 text-lg font-medium mb-2">Image de Profil</label>
            <input type="file" name="img" id="img" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('img') 
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div> 
            @enderror
        </div>
        <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">
            Ajouter le Profil
        </button>
    </form>
</div>
</body>
</html>
