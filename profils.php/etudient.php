<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-semibold text-gray-800">Mon Profil</div>
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</button>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center space-x-6">
                <img class="h-24 w-24 rounded-full" src="https://via.placeholder.com/150" alt="Profile Picture">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">John Doe</h1>
                    <p class="text-gray-600">john.doe@example.com</p>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Mes Informations</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attribut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valeur</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Nom</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Email</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">john.doe@example.com</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Téléphone</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+1 234 567 890</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Adresse</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">123 Rue de l'Exemple, Ville, Pays</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>