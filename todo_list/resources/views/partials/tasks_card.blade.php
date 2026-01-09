<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    @if($task->image)
        <div class="h-48 w-full bg-gray-100 overflow-hidden border-b border-gray-100">
            <img src="{{ Storage::url($task->image) }}" alt="{{ $task->title }}" class="w-full h-full object-cover">
        </div>
    @endif
    
    <div class="p-5 flex-1 flex flex-col">
        <div class="flex flex-wrap gap-2 mb-3">
            @forelse($task->categories as $category)
                <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wider">
                    {{ $category->name }}
                </span>
            @empty
                <span class="px-2.5 py-0.5 rounded-full bg-gray-50 text-gray-400 text-[10px] font-bold uppercase tracking-wider">
                    Sans catégorie
                </span>
            @endforelse
        </div>
        
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-xl font-bold text-gray-900 line-clamp-1 leading-tight">{{ $task->title }}</h3>
            @if($task->is_completed)
                <span class="text-emerald-500 bg-emerald-50 p-1 rounded-full">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endif
        </div>

        <p class="text-gray-500 text-sm line-clamp-2 mb-6 flex-1">{{ $task->description }}</p>
        
        <div class="flex justify-between items-center pt-4 border-t border-gray-50 mt-auto">
            <div class="flex items-center text-xs text-gray-400">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $task->created_at->diffForHumans() }}
            </div>
            <a href="{{ route('tasks.show', $task->id) }}" 
               class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-bold rounded-lg hover:bg-indigo-700 transition-colors group">
                Consulter
                <svg class="w-3 h-3 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
