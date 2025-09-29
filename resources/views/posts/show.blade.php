
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

        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="pt-6 mt-6 border-t">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Retour à la liste des articles</a>
        </div>
    </div>
</div>
@endsection
