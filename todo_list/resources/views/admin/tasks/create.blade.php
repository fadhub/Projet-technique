@extends('admin.layouts.app')

@section('content')
<div class="header">
    <h1>Create New Task</h1>
    <a href="{{ route('admin.tasks.index') }}" class="btn" style="background: #e5e7eb; color: var(--text-main);">Back to List</a>
</div>

<div style="background: var(--white); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); max-width: 600px;">
    <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Title</label>
            <input type="text" name="title" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;"></textarea>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Categories</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                @foreach($categories as $category)
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Task Image</label>
            <input type="file" name="image" style="width: 100%;">
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
