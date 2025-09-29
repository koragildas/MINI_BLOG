
@extends('layouts.app')

@section('content')
<div class="container px-4 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow">
        @if ($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="Image à la une" class="object-cover w-full h-64 mb-6 rounded-md">
        @endif

        <h1 class="mb-4 text-4xl font-bold">{{ $post->title }}</h1>

        <div class="mb-6 text-sm text-gray-500">
            <span>Par {{ $post->author ?? 'Auteur inconnu' }}</span>
            <span class="mx-2">|</span>
            <span>Publié le {{ $post->created_at->format('d F Y') }}</span>
        </div>

        <div class="flex items-center space-x-4 mb-6 flex-wrap">
            <button class="flex items-center space-x-1 text-gray-500 hover:text-red-500 like-button"
                    data-post-id="{{ $post->id }}"
                    data-liked="{{ $post->is_liked ? 'true' : 'false' }}">
                <i class="{{ $post->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                <span class="likes-count">{{ $post->likers_count }}</span>
            </button>

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

        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Comments Section -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Commentaires ({{ $post->comments->count() }})</h2>

            @auth
            <div class="mb-6">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <textarea name="body" id="comment-input" rows="4" class="w-full p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Ajouter un commentaire..." required></textarea>
                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Envoyer le commentaire</button>
                </form>
            </div>
            @else
            <p class="mb-6 text-gray-600">Vous devez être connecté pour laisser un commentaire. <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connectez-vous ici</a>.</p>
            @endauth

            <div class="space-y-6">
                @forelse ($post->comments as $comment)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                            <span class="text-sm text-gray-500 ml-3">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->body }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Aucun commentaire pour le moment.</p>
                @endforelse
            </div>
        </div>

        <div class="pt-6 mt-6 border-t">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Retour à la liste des articles</a>
        </div>
    </div>
</div>
@endsection
