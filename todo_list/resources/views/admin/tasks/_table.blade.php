@foreach($tasks as $task)
<tr style="border-top: 1px solid var(--border-color);">
    <td style="padding: 1rem; font-weight: 500;">{{ $task->title }}</td>
    <td style="padding: 1rem; color: var(--text-muted);">{{ $task->user->name ?? 'Unknown' }}</td>
    <td style="padding: 1rem; color: var(--text-muted);">{{ Str::limit($task->description, 50) }}</td>
    <td style="padding: 1rem; display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn" style="background: #eef2ff; color: var(--primary);">Edit</a>
        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background: #fef2f2; color: #b91c1c;">Delete</button>
        </form>
    </td>
</tr>
@endforeach
