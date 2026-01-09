<?php

return [
    // Navigation
    'tasks' => 'Tasks',
    'categories' => 'Categories',
    'login' => 'Login',
    'register' => 'Register',
    'logout' => 'Logout',
    'admin_panel' => 'Admin Panel',
    'profile' => 'Profile',

    // Tasks
    'task_list' => 'Task List',
    'add_task' => 'Add Task',
    'edit_task' => 'Edit Task',
    'delete_task' => 'Delete Task',
    'task_title' => 'Task Title',
    'task_description' => 'Description',
    'task_due_date' => 'Due Date',
    'task_status' => 'Status',
    'task_priority' => 'Priority',
    'task_category' => 'Category',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'confirm_delete' => 'Are you sure you want to delete this task?',
    'no_tasks' => 'No tasks found.',

    // Statuses
    'status' => [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed'
    ],

    // Priorities
    'priority' => [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High'
    ],

    // Messages
    'task_created' => 'Task created successfully.',
    'task_updated' => 'Task updated successfully.',
    'task_deleted' => 'Task deleted successfully.',
    'error_occurred' => 'An error occurred. Please try again.',

    // Validation
    'title_required' => 'The title field is required.',
    'title_max' => 'The title may not be greater than :max characters.',
    'description_required' => 'The description field is required.',
    'due_date_required' => 'The due date field is required.',
    'due_date_after' => 'The due date must be a date after now.',
    'status_required' => 'The status field is required.',
    'priority_required' => 'The priority field is required.',
    'category_required' => 'The category field is required.',
];