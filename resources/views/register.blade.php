<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription - KGB Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-hidden bg-gray-100">

    <main class="flex w-full h-screen">

        <!-- Section gauche : Formulaire d'inscription -->
        <div class="flex flex-col justify-center w-1/2 h-full p-8 overflow-y-auto bg-white">
            <div class="w-full max-w-md mx-auto">
                <div class="flex justify-center mb-6">
                    <button class=" bg-[#00378a] text-white py-3 px-4 rounded-lg text-3xl mb-2">
                        <p>KGB info</p>
                    </button>
                </div>
                <h2 class="text-2xl font-bold text-center text-gray-700">Créer un compte</h2>
                <p class="text-center text-gray-500">Rejoignez-nous pour rester informé.</p>

                <div class="my-6">
                    @if($errors->any())
                    <div class="p-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            placeholder="Votre nom complet"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Adresse Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            placeholder="votre.email@example.com"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Mot de passe</label>
                        <input type="password" id="password" name="password" required placeholder="Créez un mot de passe"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-600">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="Confirmez votre mot de passe"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit"
                        class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        S'inscrire
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte?
                        <a href="/login" class="font-medium text-blue-500 hover:underline">Connectez-vous ici</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Section droite : Image -->
        <div class="w-1/2 h-full">
            <img src="/img/img2.jpeg" alt="Image de fond" class="object-cover w-full h-full">
        </div>

    </main>

</body>

</html>
