import './bootstrap';
import 'preline';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Register our tasksManager component
Alpine.data('tasksManager', (initialTasks = [], config = {}) => ({
    allTasks: initialTasks,
    search: '',
    category: '',
    status: '',

    get filteredTasks() {
        return this.allTasks.filter(task => {
            const searchLower = this.search.toLowerCase();
            const matchesSearch = !this.search ||
                task.title.toLowerCase().includes(searchLower) ||
                (task.description && task.description.toLowerCase().includes(searchLower));

            const matchesCategory = this.category === '' || task.category_ids.includes(parseInt(this.category));

            const matchesStatus = this.status === '' || task.is_completed === (this.status === '1');

            return matchesSearch && matchesCategory && matchesStatus;
        });
    },

    // Modal state
    showModal: false,
    modalTitle: 'Ajouter une tâche',
    formAction: '',
    formMethod: 'POST',

    // Form fields
    task: {
        title: '',
        description: '',
        is_completed: false,
        categories: []
    },

    init() {
        // Initialisation si nécessaire
    },

    openCreateModal() {
        this.modalTitle = 'Ajouter une tâche';
        this.formAction = config.storeRoute || '/admin/tasks';
        this.formMethod = 'POST';
        this.task = {
            title: '',
            description: '',
            is_completed: false,
            categories: []
        };
        this.showModal = true;
    },

    openEditModal(task, categoryIds) {
        this.modalTitle = 'Modifier la tâche';
        this.formAction = `/admin/tasks/${task.id}`;
        this.formMethod = 'PUT';

        this.task = {
            title: task.title,
            description: task.description,
            is_completed: !!task.is_completed,
            categories: categoryIds.map(String)
        };

        this.showModal = true;
    },

    closeModal() {
        this.showModal = false;
    }
}));

Alpine.start();
