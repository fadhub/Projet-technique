@extends('admin.layouts.app')

@section('content')
<div class="flex flex-col">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gestion des Tâches</h1>
            <p class="text-sm text-gray-500 mt-1">Gérer, ajouter ou supprimer vos tâches quotidiennes.</p>
        </div>
        <button type="button" 
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none" 
                data-hs-overlay="#hs-task-modal">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Ajouter une tâche
        </button>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            <div class="sm:col-span-1">
                <label for="hs-as-table-product-review-search" class="sr-only">Recherche</label>
                <div class="relative">
                    <input type="text" id="searchInput" class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Rechercher une tâche...">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2 md:grow">
                <div class="flex justify-end gap-x-2">
                    <form action="{{ route('admin.tasks.index') }}" method="GET" id="filterForm" class="flex items-center gap-x-2">
                        <select name="category_id" onchange="this.form.submit();" class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Titre</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Auteur</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Statut</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 font-bold">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody id="tasksTableBody" class="divide-y divide-gray-200">
                    @include('admin.tasks._table')
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
            <div>
                <p class="text-sm text-gray-600">
                    Affichage de <span class="font-semibold text-gray-800">{{ $tasks->firstItem() }}</span> à <span class="font-semibold text-gray-800">{{ $tasks->lastItem() }}</span> sur <span class="font-semibold text-gray-800">{{ $tasks->total() }}</span> tâches
                </p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    {{ $tasks->links('vendor.pagination.simple-tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<div id="hs-task-modal" class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="bg-white border shadow-sm rounded-xl pointer-events-auto">
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="font-bold text-gray-800">
                    Créer une nouvelle tâche
                </h3>
                <button type="button" class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-task-modal">
                    <span class="sr-only">Fermer</span>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-4 overflow-y-auto">
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium mb-2">Titre</label>
                            <input type="text" id="title" name="title" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Entrez le titre" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium mb-2">Description</label>
                            <textarea id="description" name="description" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500" rows="3" placeholder="Description de la tâche"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Catégories</label>
                            <div class="grid grid-cols-2 gap-2 bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-40 overflow-y-auto">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500">
                                        <label for="cat-{{ $category->id }}" class="text-sm text-gray-500 ms-3">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Image de la tâche</label>
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-600 file:text-white hover:file:bg-primary-700 id-file-input">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-task-modal">
                        Annuler
                    </button>
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                        Créer la tâche
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/admin_tasks.js'])
@endsection

