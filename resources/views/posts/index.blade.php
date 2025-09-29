
@extends('layouts.app')

@section('content')
<div class="container px-4 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Gestion des Articles</h1>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Créer un nouvel article</a>
    </div>

    <div class="space-y-8">
        @foreach($posts as $post)
            <article class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="mb-2 text-2xl font-bold">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                        </h2>
                        <div class="mb-4 text-sm text-gray-500">
                            <span>Par {{ $post->author ?? 'Auteur inconnu' }}</span>
                            <span class="mx-2">|</span>
                            <span>Publié le {{ $post->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    @auth
                    <div class="flex-shrink-0">
                        <a href="{{ route('posts.edit', $post) }}" class="px-3 py-1 text-sm text-indigo-600 border border-indigo-200 rounded-md hover:bg-indigo-50">Modifier</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm text-red-600 border border-red-200 rounded-md hover:bg-red-50" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                        </form>
                    </div>
                    @endauth
                </div>
                <div class="prose max-w-none text-gray-700">
                    {{ $post->excerpt }}
                </div>
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
                                            </div>                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }} 
    </div>
</div>
@endsection
