@extends('admin.layouts.app')

@section('styles')
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background-color: var(--white);
        padding: 2rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 600px;
        position: relative;
    }
    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--text-muted);
    }
</style>
@endsection

@section('content')
<div class="header">
    <h1>All Tasks</h1>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <input type="text" id="searchInput" placeholder="Search tasks..." style="padding: 0.625rem; border-radius: 0.5rem; border: 1px solid var(--border-color); width: 250px;">
        <form action="{{ route('admin.tasks.index') }}" method="GET" id="filterForm">
            <select name="category_id" onchange="document.getElementById('filterForm').submit();" style="padding: 0.625rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--white); cursor: pointer;">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
        <button id="openModalBtn" class="btn btn-primary">Add New Task</button>
    </div>
</div>

<div style="background: var(--white); border-radius: 0.5rem; border: 1px solid var(--border-color); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #f3f4f6; color: var(--text-muted); font-size: 0.875rem; text-transform: uppercase;">
            <tr>
                <th style="padding: 1rem;">Title</th>
                <th style="padding: 1rem;">Created By</th>
                <th style="padding: 1rem;">Description</th>
                <th style="padding: 1rem;">Actions</th>
            </tr>
        </thead>
        <tbody id="tasksTableBody" style="font-size: 0.9375rem;">
            @include('admin.tasks._table')
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    {{ $tasks->links() }}
</div>

<!-- Add Task Modal -->
<div id="addTaskModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" id="closeModalBtn">&times;</span>
        <h2 style="margin-bottom: 1.5rem;">Create New Task</h2>
        <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Title</label>
                <input type="text" name="title" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
                <textarea name="description" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;"></textarea>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Categories</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; max-height: 150px; overflow-y: auto;">
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

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="button" class="btn" id="cancelModalBtn" style="background: #e5e7eb; color: var(--text-main);">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/admin_tasks.js'])
@endsection
