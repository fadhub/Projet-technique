@extends('admin.layouts.app')

@section('content')
<div class="header">
    <h1>Edit Task: {{ $task->title }}</h1>
    <a href="{{ route('admin.tasks.index') }}" class="btn" style="background: #e5e7eb; color: var(--text-main);">Back to List</a>
</div>

<div style="background: var(--white); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); max-width: 600px;">
    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Title</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;">{{ old('description', $task->description) }}</textarea>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Categories</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                @foreach($categories as $category)
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Task Image</label>
            @if($task->image)
                <div style="margin-bottom: 0.5rem;">
                    <img src="{{ asset('storage/' . $task->image) }}" alt="" style="max-width: 200px; border-radius: 0.5rem;">
                </div>
            @endif
            <input type="file" name="image" style="width: 100%;">
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-top: 0.25rem;">Leave empty to keep current image.</p>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
