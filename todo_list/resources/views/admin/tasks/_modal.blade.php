{{-- resources/views/admin/tasks/_modal.blade.php --}}
<div id="taskModal" class="hidden fixed top-0 inset-x-0 z-[80] w-full h-full overflow-x-hidden overflow-y-auto bg-gray-900/50 flex items-center justify-center p-4">
  <div class="bg-white border shadow-sm rounded-xl w-full max-w-lg mx-auto dark:bg-neutral-800 dark:border-neutral-700">
    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
      <h3 class="modal-title font-bold text-gray-800 dark:text-neutral-200">
        Ajouter une tâche
      </h3>
      <button type="button" onclick="tasksManager.closeModal()" class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-200 dark:hover:bg-neutral-700">
        <span class="sr-only">Fermer</span>
        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
    </div>

    <form id="taskForm" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="POST">

      <div class="p-4 overflow-y-auto max-h-[70vh]">
        <div class="space-y-4">
          <div>
            <label for="task-title" class="block text-sm font-medium mb-2 dark:text-neutral-200">Titre</label>
            <input type="text" id="task-title" name="title" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          
          <div>
            <label for="task-description" class="block text-sm font-medium mb-2 dark:text-neutral-200">Description</label>
            <textarea id="task-description" name="description" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="3"></textarea>
          </div>
          
          <div>
            <label class="block text-sm font-medium mb-2 dark:text-neutral-200">Catégories</label>
            <div class="grid grid-cols-2 gap-2 p-3 border border-gray-200 rounded-lg max-h-40 overflow-y-auto dark:border-neutral-700">
              @foreach($categories as $category)
                <div class="flex items-center">
                  <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700">
                  <label for="cat-{{ $category->id }}" class="text-sm text-gray-500 ms-2 cursor-pointer dark:text-neutral-400">{{ $category->name }}</label>
                </div>
              @endforeach
            </div>
          </div>
          
          <div>
            <label for="task-image" class="block text-sm font-medium mb-2 dark:text-neutral-200">Image</label>
            <input type="file" name="image" id="task-image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 file:dark:bg-neutral-700 file:dark:text-neutral-400">
          </div>
          
          <div class="flex items-center">
            <input type="checkbox" name="is_completed" id="task-completed" value="1" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700">
            <label for="task-completed" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Complétée</label>
          </div>
        </div>
      </div>

          <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
            <button type="button" onclick="tasksManager.closeModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
              Annuler
            </button>
            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
              Enregistrer
            </button>
          </div>
    </form>
  </div>
</div>
