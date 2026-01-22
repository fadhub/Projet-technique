document.addEventListener('DOMContentLoaded', function () {
    console.log('Admin Tasks JS chargé');

    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');
    const tasksTableBody = document.getElementById('tasksTableBody');

    // --- Recherche & Filtres AJAX ---
    function filterTasks() {
        if (!tasksTableBody) return;

        const search = searchInput ? searchInput.value : '';
        const category_id = categoryFilter ? categoryFilter.value : '';
        const is_completed = statusFilter ? statusFilter.value : '';

        const url = new URL(window.location.href);
        url.searchParams.set('search', search);
        url.searchParams.set('category_id', category_id);
        url.searchParams.set('is_completed', is_completed);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.text())
            .then(html => {
                tasksTableBody.innerHTML = html;
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    if (searchInput) {
        let timeout = null;
        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(filterTasks, 300);
        });
    }

    if (categoryFilter) categoryFilter.addEventListener('change', filterTasks);
    if (statusFilter) statusFilter.addEventListener('change', filterTasks);

    // --- Gestion de la Modale Task ---
    const taskModalEl = document.getElementById('task-modal');
    const taskForm = document.getElementById('task-form');
    const modalTitle = document.getElementById('modal-title');
    const methodField = document.getElementById('method-field');

    // Fonction globale pour ouvrir en mode création
    window.openCreateModal = function () {
        console.log('Ouverture modale création');
        if (!taskForm) {
            console.error('Formulaire task-form introuvable');
            return;
        }

        modalTitle.innerText = "Ajouter une tâche";
        taskForm.action = "/admin/tasks";
        methodField.innerHTML = "";
        taskForm.reset();

        const completedCheck = document.getElementById('task-completed');
        if (completedCheck) completedCheck.checked = false;

        // Ouvrir via Preline
        if (window.HSOverlay) {
            HSOverlay.open(taskModalEl);
        }

        // Sécurité pour forcer l'affichage si Preline est capricieux
        taskModalEl.classList.remove('hidden');
    };

    // Fonction globale pour ouvrir en mode édition
    window.openEditModal = function (task, categoryIds) {
        console.log('Ouverture modale édition', task);
        if (!taskForm) return;

        modalTitle.innerText = "Modifier la tâche";
        taskForm.action = `/admin/tasks/${task.id}`;
        methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('task-title').value = task.title;
        document.getElementById('task-description').value = task.description || '';

        // Cocher les catégories correspondantes
        const checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = categoryIds.includes(parseInt(cb.value));
        });

        const completedCheck = document.getElementById('task-completed');
        if (completedCheck) completedCheck.checked = !!task.is_completed;

        if (window.HSOverlay) {
            HSOverlay.open(taskModalEl);
        }

        taskModalEl.classList.remove('hidden');
    };

    window.closeTaskModal = function () {
        if (window.HSOverlay) {
            HSOverlay.close(taskModalEl);
        }
        taskModalEl.classList.add('hidden');
    };
});

