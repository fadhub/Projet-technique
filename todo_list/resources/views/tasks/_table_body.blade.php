@forelse($tasks as $task)
<tr>
    <td class="border p-2">{{ $task->id }}</td>
    <td class="border p-2">{{ $task->title }}</td>
    <td class="border p-2">{{ $task->description }}</td>
</tr>
@empty
<tr>
    <td colspan="3" class="p-2 border text-center text-gray-500">
        {{ __('tasks_views.no_tasks') }}
    </td>
</tr>
@endforelse