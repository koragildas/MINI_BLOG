@php use Illuminate\Support\Facades\Storage; @endphp
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - KGB Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="container py-8 mx-auto">
        <!-- Featured Article -->
        <section class="mb-12">
            <div class="relative w-full h-[400px] rounded-lg overflow-hidden">
                <img src="/img/img1.jpeg" alt="Featured Article" class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <div class="absolute bottom-0 p-8 text-white">
                    <h2 class="text-4xl font-bold">Les dernières avancées technologiques de 2025</h2>
                    <p class="mt-2 text-lg">Un aperçu des innovations qui façonnent notre avenir.</p>
                    <a href="#" class="inline-block px-6 py-2 mt-4 font-semibold text-white bg-blue-600 rounded-md">Lire
                        la suite</a>
                </div>
            </div>
        </section>

        <!-- Articles Grid -->
        <section>
            <h3 class="mb-6 text-2xl font-bold text-gray-800">Derniers Articles</h3>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @if(isset($posts) && $posts->count())
                    @foreach($posts as $post)
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <img src="{{ Storage::url($post->featured_image) ?? '/img/img2.jpeg' }}" alt="Article Image"
                                class="object-cover w-full h-48">
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-gray-800">{{ $post->title }}</h4>
                                <p class="mt-2 text-gray-600">{{ $post->excerpt }}</p>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="flex items-center space-x-1 text-gray-500 hover:text-red-500">
                                            <i class="far fa-heart"></i>
                                            <span>J'aime</span>
                                        </button>
                                        <button class="flex items-center space-x-1 text-gray-500 hover:text-blue-500">
                                            <i class="far fa-comment"></i>
                                            <span>Commenter</span>
                                        </button>
                                    </div>
                                    <button class="text-gray-500 hover:text-green-500">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Placeholder Articles -->
                    @for ($i = 0; $i < 3; $i++)
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <img src="/img/img{{ $i + 1 }}.jpeg" alt="Article Image"
                                class="object-cover w-full h-48">
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-gray-800">Titre de l'article {{ $i + 1 }}</h4>
                                <p class="mt-2 text-gray-600">Ceci est un extrait de l'article. Le contenu complet est
                                    disponible sur la page de l'article.</p>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="flex items-center space-x-1 text-gray-500 hover:text-red-500">
                                            <i class="far fa-heart"></i>
                                            <span>J'aime</span>
                                        </button>
                                        <button class="flex items-center space-x-1 text-gray-500 hover:text-blue-500">
                                            <i class="far fa-comment"></i>
                                            <span>Commenter</span>
                                        </button>
                                    </div>
                                    <button class="text-gray-500 hover:text-green-500">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </section>
    </main>
@endsection

</html>