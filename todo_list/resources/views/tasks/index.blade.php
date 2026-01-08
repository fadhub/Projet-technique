@extends('layouts.app')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Mes Tâches</h1>
    <p class="text-gray-500">Gérez vos objectifs quotidiens avec efficacité (Mode: Sans Contrôleur).</p>
</div>

<!-- Filters -->
<div class="flex flex-wrap gap-2 mb-8">
    <a href="{{ route('tasks.index') }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ !$categoryId ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Toutes
    </a>
    @foreach($categories as $category)
        <a href="{{ route('tasks.index', ['category_id' => $category->id]) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ $categoryId == $category->id ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
            {{ $category->name }}
        </a>
    @endforeach
</div>

<!-- Task Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($tasks as $task)
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 rounded-md bg-blue-50 text-blue-600 text-xs font-semibold uppercase tracking-wider">
                        {{ $task->categories->first()->name ?? 'Sans catégorie' }}
                    </span>
                    @if($task->is_completed)
                        <span class="text-green-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $task->title }}</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $task->description }}</p>
            </div>
            
            <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                <span class="text-xs text-gray-400 italic">Créé {{ $task->created_at->diffForHumans() }}</span>
                <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm inline-flex items-center group">
                    Voir détails
                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full py-12 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
            <p class="text-gray-500">Aucune tâche trouvée dans cette catégorie.</p>
        </div>
    @endforelse
</div>

@if($tasks->hasPages())
<div class="mt-12">
    {{ $tasks->appends(['category_id' => $categoryId])->links() }}
</div>
@endif
@endsection
