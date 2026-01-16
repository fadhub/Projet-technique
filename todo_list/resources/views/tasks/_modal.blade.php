<!-- Add Task Modal -->
<div id="hs-add-task-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[100] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1">
  <div class="hs-modal-content mt-7 opacity-0 transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="flex flex-col w-full bg-white border border-gray-200 shadow-xl rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <h3 class="font-bold text-gray-800 dark:text-white">
          {{ __('tasks_views.modal_title') }}
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden data-hs-overlay="#hs-add-task-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto">
        @include('tasks._form')
      </div>
      <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
        <button type="button" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-hs-overlay="#hs-add-task-modal">
          {{ __('tasks_views.close') }}
        </button>
        <button type="submit" form="addTaskForm" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
          {{ __('tasks_views.save') }}
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  /* Fix total pour Preline + CDN Tailwind */
  .hs-overlay.open {
    display: block !important;
    opacity: 1 !important;
    pointer-events: auto !important;
    z-index: 100 !important;
  }
  .hs-overlay.open .hs-modal-content {
    opacity: 1 !important;
    margin-top: 1.75rem !important;
  }
  .hs-overlay-backdrop {
    z-index: 90 !important;
    background-color: rgba(0, 0, 0, 0.5) !important;
  }
</style>