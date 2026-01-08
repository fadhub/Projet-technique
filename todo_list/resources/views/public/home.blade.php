@extends('layouts.app')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Liste des Tâches</h1>
    <p class="text-gray-500">Consultez la liste des tâches existantes.</p>
</div>

<!-- Task Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($tasks as $task)
        @include('partials.tasks_card', ['task' => $task])
    @empty
        <div class="col-span-full py-12 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
            <p class="text-gray-500">Aucune tâche disponible pour le moment.</p>
        </div>
    @endforelse
</div>

@if($tasks->hasPages())
<div class="mt-12">
    {{ $tasks->links() }}
</div>
@endif
@endsection
