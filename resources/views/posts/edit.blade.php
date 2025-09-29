
@extends('layouts.app')

@section('content')
<div class="container px-4 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Modifier l'article</h1>

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
            <p class="font-bold">Erreurs de validation</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="title" id="title" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
            <textarea name="content" id="content" rows="10" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Image à la une</label>
            <input type="file" name="featured_image" id="featured_image" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @if ($post->featured_image)
                <div class="mt-4">
                    <p>Image actuelle :</p>
                    <img src="{{ Storage::url($post->featured_image) }}" alt="Image à la une" class="w-32 h-32 mt-2 rounded-md">
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Annuler</a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
