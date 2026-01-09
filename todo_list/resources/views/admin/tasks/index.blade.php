{{-- admin/tasks/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-900">Liste des tâches</h2>
        <a href="{{ route('tasks.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Ajouter une tâche
        </a>
    </div>
    <div class="border-t border-gray-200">
        <!-- Contenu de la liste des tâches -->
        @foreach($tasks as $task)
            <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $task->description }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.show', $task) }}" 
                           class="text-blue-500 hover:text-blue-700">Voir</a>
                        <a href="{{ route('tasks.edit', $task) }}" 
                           class="text-yellow-500 hover:text-yellow-700">Modifier</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('Êtes-vous sûr ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="px-4 py-4 sm:px-6">
        {{ $tasks->links() }}
    </div>
</div>
@endsection