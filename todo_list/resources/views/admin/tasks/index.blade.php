{{-- admin/tasks/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<!-- Table Section -->
<div x-data="tasksManager([], { storeRoute: '{{ route('admin.tasks.store') }}' })" 
     @open-edit-modal.window="openEditModal($event.detail.task, $event.detail.categories)"
     class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
          
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Gestion des Tâches
              </h2>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Gerez votre inventaire : ajoutez, modifiez ou supprimez vos tâches.
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" @click="openCreateModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Ajouter une tâche
                </button>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Search & Filter -->
          <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end gap-3">
              <!-- Search -->
              <div class="relative max-w-xs w-full">
                <input type="text" id="adminSearchInput" x-model="search" class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Rechercher une tâche...">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                  <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
              </div>

              <!-- filters -->
              <div class="flex flex-wrap gap-2">
                <select id="indexCategorySelect" x-model="category" class="py-2 px-3 pe-9 block w-full md:w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                  <option value="">Catégories...</option>
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                
                <select id="indexStatusSelect" x-model="status" class="py-2 px-3 pe-9 block w-full md:w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                  <option value="">Statut...</option>
                  <option value="1">Actif</option>
                  <option value="0">Inactif</option>
                </select>
              </div>
            </div>
          </div>
          <!-- End Search & Filter -->

          <!-- Table -->
          <div id="tasksTableWrapper" class="relative">
            @include('admin.tasks._table_container')
          </div>
          <!-- End Table -->

        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->

  <!-- Modal -->
  @include('admin.tasks._modal')

</div>
<!-- End Table Section -->
@endsection
