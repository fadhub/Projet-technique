{{-- admin/tasks/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Tâches</h1>
            <p class="text-sm text-gray-500 mt-1">Ajouter, modifier, désactiver ou supprimer des tâches.</p>
        </div>
        <button type="button" 
                onclick="openCreateModal()"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Ajouter une tâche
        </button>
    </div>

    <!-- Filters & Table Section -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <!-- Filters Area -->
        <div class="p-6 border-b border-gray-50">
            <div class="flex flex-wrap items-center gap-4">
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input type="text" id="searchInput" class="py-2.5 ps-10 block w-full border-gray-100 rounded-lg text-sm bg-gray-50/50 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="Rechercher par titre...">
                </div>

                <select id="categoryFilter" class="py-2.5 px-4 block w-full md:w-48 border-gray-100 rounded-lg text-sm bg-gray-50/50 focus:border-blue-500 focus:ring-blue-500 transition-all">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select id="statusFilter" class="py-2.5 px-4 block w-full md:w-48 border-gray-100 rounded-lg text-sm bg-gray-50/50 focus:border-blue-500 focus:ring-blue-500 transition-all">
                    <option value="">Tous les statuts</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
            </div>
        </div>

        <!-- Table Area -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/30">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-400 uppercase tracking-widest">Titre & Description</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-400 uppercase tracking-widest">Catégorie</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-400 uppercase tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-4 text-end text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody id="tasksTableBody" class="divide-y divide-gray-100">
                    @include('admin.tasks._table')
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tasks->hasPages())
        <div class="px-6 py-4 border-t border-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500 italic">
                    Affichage de {{ $tasks->firstItem() }} à {{ $tasks->lastItem() }} sur {{ $tasks->total() }} résultats
                </div>
                <div>
                   {{ $tasks->links('vendor.pagination.simple-tailwind') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('admin.tasks._modal')

@endsection

@section('scripts')
@vite(['resources/js/admin_tasks.js'])
@endsection