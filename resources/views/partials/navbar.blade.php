
<nav class="bg-white shadow-md">
    <div class="container px-6 py-4 mx-auto">
        <div class="flex items-center justify-between">
            <div class="text-2xl font-bold text-blue-600">KGB Info</div>
            <div class="hidden space-x-4 md:flex">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-500">Accueil</a>
                <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-blue-500">Articles</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">À propos</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-2">
                            <span class="font-semibold">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="user-menu" class="absolute left-0 top-full z-50 hidden w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Mon Profil</a>
                            <form action="/logout" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-gray-600 hover:text-blue-500">Connexion</a>
                    <a href="/register" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Inscription</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    // User menu toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    if (userMenuButton) {
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
</script>
