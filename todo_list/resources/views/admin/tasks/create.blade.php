@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold mb-8">Nouvelle tâche</h1>
    
    <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="title" id="title" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image"
                   class="mt-1 block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700
                          hover:file:bg-blue-100">
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Sélectionnez une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_completed" id="is_completed"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="is_completed" class="ml-2 block text-sm text-gray-700">
                Tâche terminée
            </label>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.tasks.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection