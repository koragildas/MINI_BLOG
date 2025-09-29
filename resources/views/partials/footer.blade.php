
<footer class="py-8 mt-12 text-white bg-gray-800">
    <div class="container px-6 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div>
                <h4 class="text-lg font-bold">KGB Info</h4>
                <p class="mt-2 text-gray-400">Votre source d'information fiable.</p>
            </div>
            <div>
                <h4 class="text-lg font-bold">Liens Rapides</h4>
                <ul class="mt-2 space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Accueil</a></li>
                    <li><a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white">Articles</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold">Suivez-nous</h4>
                <div class="flex mt-2 space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="pt-6 mt-8 text-center text-gray-500 border-t border-gray-700">
            &copy; {{ date('Y') }} KGB Info. Tous droits réservés.
        </div>
    </div>
</footer>
