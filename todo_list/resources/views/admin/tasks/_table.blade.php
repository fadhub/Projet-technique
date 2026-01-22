@forelse($tasks as $task)
<tr class="hover:bg-gray-50/40 transition-colors group">
    <td class="px-6 py-5 whitespace-nowrap">
        <div>
            <div class="text-sm font-bold text-gray-900">{{ $task->title }}</div>
            <div class="text-xs text-gray-400 max-w-xs truncate">{{ $task->description }}</div>
        </div>
    </td>
    <td class="px-6 py-5 whitespace-nowrap">
        @forelse($task->categories as $category)
            <span class="text-sm text-gray-600">{{ $category->name }}</span>
        @empty
            <span class="text-gray-300 italic text-xs">Aucune</span>
        @endforelse
    </td>
    <td class="px-6 py-5 whitespace-nowrap">
        @if($task->is_completed)
            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                Actif
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                Inactif
            </span>
        @endif
    </td>
    <td class="px-6 py-5 whitespace-nowrap text-end">
        <div class="flex justify-end items-center gap-x-2">
            <button type="button" 
                    data-task="{{ json_encode($task) }}"
                    data-categories="{{ json_encode($task->categories->pluck('id')) }}"
                    onclick="openEditModal(JSON.parse(this.getAttribute('data-task')), JSON.parse(this.getAttribute('data-categories')))"
                    class="p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
            </button>
            
<form action="{{ route('admin.tasks.toggle', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        title="{{ $task->is_completed ? 'Marquer comme inactif' : 'Marquer comme actif' }}"
                        class="p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg transition-colors {{ $task->is_completed ? 'text-emerald-500 hover:bg-emerald-50' : 'text-gray-400 hover:bg-gray-100' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                </button>
            </form>

            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg text-rose-500 hover:bg-rose-50 transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="px-6 py-20 text-center text-gray-500">
        Aucune tâche trouvée
    </td>
</tr>
@endforelse
