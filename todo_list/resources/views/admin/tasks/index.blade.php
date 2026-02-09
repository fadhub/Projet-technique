{{-- admin/tasks/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<!-- Table Section -->
<div x-data="tasksManager({{ $tasksJson->toJson() }}, { storeRoute: '{{ route('admin.tasks.store') }}' })" 
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
                Gérez votre inventaire : ajoutez, modifiez ou supprimez vos tâches.
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
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
             <div class="sm:col-span-1">
               <label for="searchInput" class="sr-only">Search</label>
               <div class="relative">
                 <input type="text" x-model="search" class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Rechercher une tâche...">
                 <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                   <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                 </div>
               </div>
             </div>
             
             <div class="sm:col-span-2 md:grow">
               <div class="flex justify-end gap-x-2">
                 <select x-model="category" class="py-2 px-3 pe-9 block w-full md:w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option value="">Catégories...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                 </select>
                 
                 <select x-model="status" class="py-2 px-3 pe-9 block w-full md:w-auto border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option value="">Statut...</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                 </select>
               </div>
             </div>
          </div>
          <!-- End Search & Filter -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 relative">
            <template x-if="isLoading">
                <div class="absolute inset-0 bg-white/50 dark:bg-neutral-900/50 flex items-center justify-center z-10">
                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </template>
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
                <template x-for="task in filteredTasks" :key="task.id">
                    <tr>
                        <!-- Image Column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                            <template x-if="task.image">
                                <img class="inline-block size-[38px] rounded-md object-cover" :src="task.image" :alt="task.title">
                            </template>
                            <template x-if="!task.image">
                                <span class="inline-flex items-center justify-center size-[38px] rounded-md bg-gray-200 text-gray-800 text-xs font-semibold" x-text="task.title.substring(0,2)">
                                </span>
                            </template>
                        </td>
                        
                        <!-- Designation (Title) -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200" x-text="task.title"></td>
                        
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span x-show="task.is_completed" class="text-green-600 font-semibold dark:text-green-500">Actif</span>
                            <span x-show="!task.is_completed" class="text-gray-500 font-semibold">Inactif</span>
                        </td>
                        
                        <!-- Category -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            <div class="flex flex-wrap gap-1">
                                <template x-for="catName in task.category_names">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white" x-text="catName"></span>
                                </template>
                                <template x-if="task.category_names.length === 0">
                                    <span class="text-xs text-gray-400">Aucune</span>
                                </template>
                            </div>
                        </td>
                        
                        <!-- Description -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            <span class="block max-w-[200px] truncate" :title="task.description" x-text="task.description"></span>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <button type="button" 
                                    @click="openEditModal(task.raw_task, task.category_ids)"
                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </button>
                            
                            <form :action="'/admin/tasks/' + task.id" method="POST" class="inline-block ms-3" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400">
                                   <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredTasks.length === 0">
                    <tr>
                      <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-800 dark:text-neutral-200">
                        Aucune tâche trouvée
                      </td>
                    </tr>
                </template>
            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer -->
          @if($tasks->hasPages())
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
            <div>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Found <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $tasks->total() }}</span> results
              </p>
            </div>
            <div>
              <div class="inline-flex gap-x-2">
                 {{ $tasks->links('vendor.pagination.simple-tailwind') }}
              </div>
            </div>
          </div>
          @endif
          <!-- End Footer -->
          
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
