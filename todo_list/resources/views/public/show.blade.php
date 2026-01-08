@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour aux tâches
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="p-8 sm:p-12">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                @foreach($task->categories as $category)
                    <span class="px-4 py-1.5 rounded-full bg-blue-100 text-blue-700 text-sm font-bold tracking-wide">
                        {{ $category->name }}
                    </span>
                @endforeach
                
                @if($task->is_completed)
                    <span class="px-4 py-1.5 rounded-full bg-green-100 text-green-700 text-sm font-bold tracking-wide">
                        Complétée
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold tracking-wide">
                        En cours
                    </span>
                @endif
            </div>

            @if($task->image)
                <div class="mb-8 rounded-2xl overflow-hidden">
                    <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 leading-tight">{{ $task->title }}</h1>
            
            <div class="prose prose-blue max-w-none text-gray-600 text-lg mb-12">
                {{ $task->description ?? 'Aucune description fournie.' }}
            </div>

            <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between text-gray-400 text-sm italic gap-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Créé le {{ $task->created_at->format('d/m/Y à H:i') }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Assigné à {{ $task->user->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
