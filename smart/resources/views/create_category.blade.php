<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4" x-data="categoryForm()">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-blue-600 text-white p-6 text-center">
            <h2 class="text-2xl font-bold">Nouvelle Catégorie</h2>
            <p class="text-sm text-blue-100">Organisez vos finances</p>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de la Catégorie</label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        x-model="categoryName"
                        @input="validateInput"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        :class="{'border-red-500': !isValid, 'border-green-500': isValid && categoryName.length > 0}"
                        required
                        placeholder="Ex: Alimentation, Transport, Loisirs"
                    >
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <template x-if="categoryName.length > 0">
                            <svg x-show="isValid" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </template>
                        <template x-if="!isValid && categoryName.length > 0">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </template>
                    </div>
                </div>
                <p x-show="!isValid && categoryName.length > 0" class="text-red-500 text-xs mt-1">
                    Le nom doit contenir au moins 3 caractères et ne pas contenir de caractères spéciaux
                </p>
            </div>

</body>
</html>