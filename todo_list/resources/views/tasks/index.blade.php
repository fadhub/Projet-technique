@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">
    {{ __('tasks_views.dashboard_title') }}
</h1>

<!-- Search -->
<input type="text" id="search"
 class="border p-2 mb-4 w-1/3"
 placeholder="{{ __('tasks_views.search_placeholder') }}"
 data-url="{{ route('tasks.search') }}">

<!-- Add button -->
<button type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-add-task-modal" data-hs-overlay="#hs-add-task-modal">
  {{ __('tasks_views.add_task') }}
</button>

<!-- Table -->
<table class="w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2 border">ID</th>
            <th class="p-2 border">{{ __('tasks_attributes.title') }}</th>
            <th class="p-2 border">{{ __('tasks_attributes.description') }}</th>
        </tr>
    </thead>
    <tbody id="table-body">
        @include('tasks._table_body')
    </tbody>
</table>

@include('tasks._modal')

@endsection