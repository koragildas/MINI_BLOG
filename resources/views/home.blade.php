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
        <!-- Slider Section -->
        <section class="mb-12 relative">
            <div class="slider-container relative w-full h-[400px] rounded-lg overflow-hidden">
                @if($sliderPosts->count())
                    @foreach($sliderPosts as $index => $post)
                        <div class="slider-item absolute inset-0 transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                            <img src="{{ Storage::url($post->featured_image) ?? '/img/img1.jpeg' }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                            <div class="absolute bottom-0 p-8 text-white">
                                <h2 class="text-4xl font-bold">{{ $post->title }}</h2>
                                <p class="mt-2 text-lg">{{ $post->excerpt }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="inline-block px-6 py-2 mt-4 font-semibold text-white bg-blue-600 rounded-md">Lire la suite</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="slider-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100">
                        <img src="/img/img1.jpeg" alt="Featured Article" class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h2 class="text-4xl font-bold">Aucun article en vedette</h2>
                            <p class="mt-2 text-lg">Revenez plus tard pour découvrir nos derniers articles.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Slider Navigation -->
            @if($sliderPosts->count() > 1)
            <button class="slider-prev absolute top-1/2 left-4 -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full z-20">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-next absolute top-1/2 right-4 -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full z-20">
                <i class="fas fa-chevron-right"></i>
            </button>
            @endif
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
                                <h4 class="text-xl font-bold text-gray-800">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                                </h4>
                                <p class="mt-2 text-gray-600">{{ $post->excerpt }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('posts.show', $post) }}" class="font-semibold text-blue-600 hover:text-blue-800">Lire la suite &rarr;</a>
                                </div>

                                <div class="flex items-center justify-between mt-4 flex-wrap">
                                    <button class="flex items-center space-x-1 text-gray-500 hover:text-red-500 like-button"
                                            data-post-id="{{ $post->id }}"
                                            data-liked="{{ $post->is_liked ? 'true' : 'false' }}">
                                        <i class="{{ $post->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                                        <span class="likes-count">{{ $post->likers_count }}</span>
                                    </button>

                                    <a href="{{ route('posts.show', $post) }}#comment-input" class="flex items-center space-x-1 text-gray-500 hover:text-blue-500">
                                        <i class="far fa-comment"></i>
                                        <span>{{ $post->comments_count }}</span>
                                    </a>

                                    <div class="relative">
                                        <button class="text-gray-500 hover:text-green-500 share-button">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden share-dropdown">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $post)) }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fab fa-facebook-f mr-2"></i> Facebook
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $post)) }}&text={{ urlencode($post->title) }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fab fa-twitter mr-2"></i> Twitter
                                            </a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('posts.show', $post)) }}&title={{ urlencode($post->title) }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('posts.show', $post)) }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                                            </a>
                                        </div>
                                    </div>
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
                                <div class="flex items-center justify-between mt-4 flex-wrap">
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