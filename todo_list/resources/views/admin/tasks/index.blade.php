<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('tasks.title') }}</title>
</head>
<body>

<h1>{{ __('tasks.title') }}</h1>


<div>
    <input type="text" id="search" placeholder="{{ __('tasks.search_placeholder') }}">
    <button id="openModal">{{ __('tasks.add') }}</button>
</div>

<div id="tasksTable">
    @include('tasks.partials.table')
</div>

<!-- Add modal (basic vanilla) -->
<div id="modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.3);">
    <div style="background:#fff; max-width:480px; margin:6rem auto; padding:1rem;">
        <button id="add-modal-close" style="float:right;">&times;</button>
        <h3>{{ __('tasks.add') }}</h3>
        <div>
            <label>{{ __('tasks.title_label') }}</label>
            <input type="text" id="taskTitle" style="width:100%;" />
        </div>
        <div style="margin-top:8px;">
            <button id="saveTask">{{ __('tasks.save') }}</button>
        </div>
    </div>
</div>

<!-- View modal for a task -->
<div id="task-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.3);">
    <div style="background:#fff; max-width:640px; margin:6rem auto; padding:1rem;">
        <button id="modal-close" style="float:right;">&times;</button>
        <h2 id="modal-title">{{ __('tasks.view') }}</h2>
        <div id="modal-body">
            <p><strong>ID:</strong> <span id="task-id"></span></p>
            <p><strong>{{ __('tasks.title_label') }}:</strong> <span id="task-title"></span></p>
            <p><strong>{{ __('tasks.description') }}:</strong> <span id="task-desc"></span></p>
            <p><strong>{{ __('tasks.user') }}:</strong> <span id="task-user"></span></p>
            <p><strong>{{ __('tasks.done') }}:</strong> <span id="task-completed"></span></p>
            <p><strong>{{ __('tasks.created') }}:</strong> <span id="task-created"></span></p>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin/tasks.js') }}"></script>
</body>
</html>
