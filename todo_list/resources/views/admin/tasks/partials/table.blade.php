@if(isset($tasks) && $tasks->count())
<table border="1" width="100%" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#f5f5f5;">
            <th style="border:1px solid #ddd; padding:8px;">ID</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.title_label') }}</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.description') }}</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.user') }}</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.done') }}</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.created') }}</th>
            <th style="border:1px solid #ddd; padding:8px;">{{ __('tasks.view') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td style="border:1px solid #ddd; padding:8px;">{{ $task->id }}</td>
            <td style="border:1px solid #ddd; padding:8px;">{{ $task->title }}</td>
            <td style="border:1px solid #ddd; padding:8px;">{{ \Illuminate\Support\Str::limit($task->description, 50) }}</td>
            <td style="border:1px solid #ddd; padding:8px;">{{ $task->user?->name ?? '-' }}</td>
            <td style="border:1px solid #ddd; padding:8px;">{{ $task->is_completed ? 'Yes' : 'No' }}</td>
            <td style="border:1px solid #ddd; padding:8px;">{{ $task->created_at?->format('Y-m-d') ?? '' }}</td>
            <td style="border:1px solid #ddd; padding:8px;"><button class="view-task" data-id="{{ $task->id }}">{{ __('tasks.view') }}</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(method_exists($tasks, 'links'))
    {{ $tasks->links() }}
@endif
@else
<p>{{ __('tasks.no_tasks') }}</p>
@endif

