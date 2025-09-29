<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - KGB Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-hidden bg-gray-100">

    <main class="flex w-full h-screen">

        <!-- Section gauche : Formulaire de connexion -->
        <div class="flex flex-col justify-center w-1/2 h-full p-8 overflow-y-auto bg-white">
            <div class="w-full max-w-md mx-auto">
                <div class="flex justify-center mb-6">
                    <button class=" bg-[#00378a] text-white py-6 px-8 rounded-lg text-3xl mb-5">
                        <p>KGB info</p>
                    </button>
                </div>
                <h2 class="text-2xl font-bold text-center text-gray-700">Bienvenue</h2>
                <p class="text-center text-gray-500">Connectez-vous pour accéder à votre espace.</p>

                <div class="my-6">
                    @if(session('success'))
                    <div class="p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                    @endif

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

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Adresse Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            placeholder="votre.email@example.com"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Mot de passe</label>
                        <input type="password" id="password" name="password" required placeholder="********"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                        </div>
                        <a href="/forgot-password" class="text-sm text-blue-500 hover:underline">Mot de passe
                            oublié?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Se connecter
                    </button>
                </form>

                <div class="my-6 text-center">
                    <p class="text-sm text-gray-500">Ou connectez-vous avec :</p>
                    <div class="flex justify-center mt-4 space-x-4">
                        <a href="{{ route('google.login') }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                            <span class="mr-2">
                                <!-- Google Icon SVG -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M21.99 12.23c0-.64-.06-1.26-.16-1.86H12v3.51h5.6c-.24 1.13-.9 2.09-1.84 2.73v2.26h2.9c1.7-1.56 2.68-3.88 2.68-6.64z" />
                                    <path
                                        d="M12 22c2.96 0 5.44-1 7.22-2.7l-2.9-2.26c-.98.66-2.23 1.06-3.52 1.06-2.7 0-4.99-1.82-5.8-4.26H3.3v2.34C5.18 19.86 8.36 22 12 22z" />
                                    <path
                                        d="M6.2 10.56c-.18-.53-.28-1.1-.28-1.68s.1-1.15.28-1.68V4.86H3.3C2.46 6.62 2 8.73 2 11s.46 4.38 1.3 6.14l2.9-2.34z" />
                                    <path
                                        d="M12 6.2c1.58 0 2.88.55 3.97 1.49l2.58-2.58C16.43 3.1 14.27 2 12 2 8.36 2 5.18 4.14 3.3 6.86l2.9 2.34c.81-2.44 3.1-4.26 5.8-4.26z" />
                                </svg>
                            </span>
                            Google
                        </a>
                        <a href="{{ route('github.login') }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-900">
                            <span class="mr-2">
                                <!-- GitHub Icon SVG -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.17 6.84 9.5.5.09.68-.22.68-.48 0-.24-.01-1.02-.01-1.8-2.78.6-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.52 2.35 1.08 2.92.83.09-.64.35-1.08.63-1.33-2.22-.25-4.55-1.11-4.55-4.94 0-1.1.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33s1.71.11 2.5.33c1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85 0 1.33-.01 2.41-.01 2.73 0 .27.18.58.69.48A10 10 0 0 0 22 12c0-5.52-4.48-10-10-10z" />
                                </svg>
                            </span>
                            GitHub
                        </a>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas de compte?
                        <a href="/register" class="font-medium text-blue-500 hover:underline">Inscrivez-vous ici</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Section droite : Image -->
        <div class="w-1/2 h-full">
            <img src="/img/img3.jpg" alt="Image de fond" class="object-cover w-full h-full">
        </div>

    </main>

</body>

</html>
