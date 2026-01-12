<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.dashboard_title') }}</title>
    <style>
        /* Minimal CSS for Modal functionality only */
        .modal { display: none; background: #eee; padding: 20px; border: 1px solid #000; position: absolute; top: 10%; left: 10%; }
    </style>
</head>
<body>

    <h1>{{ __('messages.dashboard_title') }}</h1>
    
    <button id="openModalBtn">{{ __('messages.add_task') }}</button>
    
    <input type="text" id="searchInput" placeholder="{{ __('messages.search_placeholder') }}">

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.description') }}</th>
                <th>{{ __('messages.status') }}</th>
            </tr>
        </thead>
        <tbody id="tasksTableBody">
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->is_completed ? __('messages.completed') : __('messages.pending') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Minimal Modal -->
    <div id="myModal" class="modal">
        <h3>{{ __('messages.add_task') }}</h3>
        <button id="closeModalBtn">X</button>
        <form id="addTaskForm">
            <input type="text" name="title" placeholder="{{ __('messages.title') }}" required><br><br>
            <textarea name="description" placeholder="{{ __('messages.description') }}"></textarea><br><br>
            <select name="status">
                <option value="0">{{ __('messages.pending') }}</option>
                <option value="1">{{ __('messages.completed') }}</option>
            </select><br><br>
            <button type="submit">{{ __('messages.save') }}</button>
        </form>
    </div>

    @vite(['resources/js/tasks.js'])
    <script>
        const messages = {
            pending: "{{ __('messages.pending') }}",
            completed: "{{ __('messages.completed') }}",
            no_tasks: "{{ __('messages.no_tasks') }}"
        };
    </script>
</body>
</html>
