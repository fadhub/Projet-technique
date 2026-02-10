{{-- resources/views/admin/tasks/_table_container.blade.php --}}
<table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
  <thead class="bg-gray-50 dark:bg-neutral-800">
    <tr>
      <th scope="col" class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Image</span>
      </th>
      <th scope="col" class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Désignation</span>
      </th>
      <th scope="col" class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Statut</span>
      </th>
      <th scope="col" class="px-6 py-3 text-start">
         <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Catégorie</span>
      </th>
      <th scope="col" class="px-6 py-3 text-start">
         <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Description</span>
      </th>
      <th scope="col" class="px-6 py-3 text-end">
         <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Actions</span>
      </th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
      @include('admin.tasks._table_rows')
  </tbody>
</table>

<!-- Footer / Pagination -->
@if($tasks->hasPages())
<div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
  {{ $tasks->links('vendor.pagination.custom_ajax') }}
</div>
@endif
