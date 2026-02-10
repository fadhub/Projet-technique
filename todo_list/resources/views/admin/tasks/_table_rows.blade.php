{{-- resources/views/admin/tasks/_table_rows.blade.php --}}
@forelse($tasks as $task)
<tr>
    <!-- Image Column -->
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
        @if($task->image)
             <img class="inline-block size-[38px] rounded-md object-cover" src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}">
        @else
             <span class="inline-flex items-center justify-center size-[38px] rounded-md bg-gray-200 text-gray-800 text-xs font-semibold">
                {{ substr($task->title, 0, 2) }}
             </span>
        @endif
    </td>
    
    <!-- Designation (Title) -->
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
        {{ $task->title }}
    </td>
    
    <!-- Status -->
    <td class="px-6 py-4 whitespace-nowrap text-sm">
        @if($task->is_completed)
            <span class="text-green-600 font-semibold dark:text-green-500">Actif</span>
        @else
            <span class="text-gray-500 font-semibold">Inactif</span>
        @endif
    </td>
    
    <!-- Category -->
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
       @forelse($task->categories as $category)
            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">
              {{ $category->name }}
            </span>
        @empty
            <span class="text-xs text-gray-400">Aucune</span>
        @endforelse
    </td>
    
     <!-- Description -->
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
        <span class="block max-w-[200px] truncate" title="{{ $task->description }}">{{ $task->description }}</span>
    </td>
    
    <!-- Actions -->
    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
        <button type="button" 
                data-action="edit-task"
                data-task-id="{{ $task->id }}"
                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
        </button>
        
        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block ms-3" data-confirm-message="Confirmer la suppression ?">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400">
               <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
  <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-800 dark:text-neutral-200">
    Aucune tâche trouvée
  </td>
</tr>
@endforelse
