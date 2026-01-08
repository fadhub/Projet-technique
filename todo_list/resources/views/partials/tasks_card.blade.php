<div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col justify-between overflow-hidden">
    @if($task->image)
        <div class="mb-4 -mx-6 -mt-6">
            <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" class="w-full h-48 object-cover">
        </div>
    @endif
    <div>
        <div class="flex flex-wrap gap-2 mb-4">
            @forelse($task->categories as $category)
                <span class="px-2 py-1 rounded-md bg-blue-50 text-blue-600 text-xs font-semibold uppercase tracking-wider">
                    {{ $category->name }}
                </span>
            @empty
                <span class="px-2 py-1 rounded-md bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                    Sans catégorie
                </span>
            @endforelse
        </div>
        
        @if($task->is_completed)
            <div class="mb-4">
                <span class="text-green-500 inline-flex items-center gap-1 text-sm font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Complétée
                </span>
            </div>
        @endif
        
        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $task->title }}</h3>
        <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $task->description }}</p>
    </div>
    
    <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
        <span class="text-xs text-gray-400 italic">Créé {{ $task->created_at->diffForHumans() }}</span>
        <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm inline-flex items-center group">
            Voir détails
            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
