<form id="addTaskForm" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium mb-2 dark:text-white">{{ __('tasks_attributes.title') }}</label>
            <input type="text" id="title" name="title" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="{{ __('tasks_attributes.title') }}" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium mb-2 dark:text-white">{{ __('tasks_attributes.description') }}</label>
            <textarea id="description" name="description" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3" placeholder="{{ __('tasks_attributes.description') }}"></textarea>
        </div>


        <div>
            <label for="image" class="block text-sm font-medium mb-2 dark:text-white">{{ __('tasks_attributes.image') }}</label>
            <input type="file" name="image" id="image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-2 dark:text-white">{{ __('tasks_attributes.categories') }}</label>
            <div class="flex flex-wrap gap-4">
                @forelse($categories as $category)
                <div class="flex items-center">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                    <label for="category-{{ $category->id }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $category->name }}</label>
                </div>
                @empty
                <p class="text-sm text-gray-400 italic dark:text-neutral-500">{{ __('tasks_views.no_categories') }}</p>
                @endforelse
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_completed" value="1" id="is_completed" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
            <label for="is_completed" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ __('tasks_attributes.is_completed') }}</label>
        </div>
    </div>
</form>