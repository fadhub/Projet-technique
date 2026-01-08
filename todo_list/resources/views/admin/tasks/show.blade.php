@extends('admin.layouts.app')

@section('content')
<div class="header">
    <h1>Task Details</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.tasks.index') }}" class="btn" style="background: #e5e7eb; color: var(--text-main);">Back</a>
        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn" style="background: #eef2ff; color: var(--primary);">Edit</a>
    </div>
</div>

<div style="background: var(--white); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color);">
    <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
        @if($task->image)
            <div style="flex: 1; min-width: 300px;">
                <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" style="width: 100%; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            </div>
        @endif
        
        <div style="flex: 2; min-width: 300px;">
            <h2 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 1rem;">{{ $task->title }}</h2>
            
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Description</h3>
                <p style="line-height: 1.6; color: #4b5563;">{{ $task->description ?: 'No description provided.' }}</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Categories</h3>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    @forelse($task->categories as $category)
                        <span style="background: #f3f4f6; color: #1f2937; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">{{ $category->name }}</span>
                    @empty
                        <span style="color: var(--text-muted);">No categories.</span>
                    @endforelse
                </div>
            </div>

            <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem; color: var(--text-muted); font-size: 0.875rem;">
                <p>Created at: {{ $task->created_at->format('M d, Y H:i') }}</p>
                <p>Last updated: {{ $task->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
