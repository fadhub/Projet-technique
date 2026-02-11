import baseComponent from './baseComponent';

export default (initialTasks = [], config = {}) => ({
    ...baseComponent(),

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

    init() {
        this.$watch('search', () => this.performSearch());
        this.$watch('category', () => this.performSearch());
        this.$watch('status', () => this.performSearch());
    },

    performSearch() {
        const query = new URLSearchParams({
            search: this.search,
            category_id: this.category,
            status: this.status
        });

        fetch(`${window.location.pathname}?${query.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                document.getElementById('tasksTableWrapper').innerHTML = html;
            });
    },

    // Form fields specific to tasks
    task: {
        title: '',
        description: '',
        is_completed: false,
        categories: [],
        current_image: ''
    },

    openCreateModal() {
        this.task = {
            title: '',
            description: '',
            is_completed: false,
            categories: [],
            current_image: ''
        };
        this.openModal('Ajouter une tâche', config.storeRoute || '/admin/tasks', 'POST');
    },

    openEditModal(task, categoryIds) {
        this.task = {
            title: task.title,
            description: task.description,
            is_completed: !!task.is_completed,
            categories: categoryIds.map(String),
            current_image: task.image ? `/storage/${task.image}` : ''
        };
        this.openModal('Modifier la tâche', `/admin/tasks/${task.id}`, 'PUT');
    }
});

