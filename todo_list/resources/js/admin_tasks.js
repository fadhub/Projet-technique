document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const tasksTableBody = document.getElementById('tasksTableBody');
    const filterForm = document.getElementById('filterForm');
    const categorySelect = filterForm ? filterForm.querySelector('select') : null;

    // --- Recherche AJAX ---
    if (searchInput && tasksTableBody) {
        let timeout = null;
        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                const searchValue = searchInput.value;
                const categoryValue = categorySelect ? categorySelect.value : '';
                fetchTasks(searchValue, categoryValue);
            }, 300);
        });
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', function () {
            const searchValue = searchInput ? searchInput.value : '';
            const categoryValue = categorySelect.value;
            fetchTasks(searchValue, categoryValue);
        });
    }

    function fetchTasks(search, categoryId) {
        const fetchUrl = new URL(window.location.protocol + '//' + window.location.host + window.location.pathname);
        if (search) fetchUrl.searchParams.set('search', search);
        if (categoryId) fetchUrl.searchParams.set('category_id', categoryId);

        fetch(fetchUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.text())
            .then(html => {
                tasksTableBody.innerHTML = html;
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    // --- Modale : Ajouter une tâche ---
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const addTaskModal = document.getElementById('addTaskModal');

    if (openModalBtn && addTaskModal) {
        openModalBtn.addEventListener('click', () => {
            addTaskModal.classList.remove('hidden');
        });

        const closeAddModal = () => {
            addTaskModal.classList.add('hidden');
        };

        if (closeModalBtn) closeModalBtn.addEventListener('click', closeAddModal);
        if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeAddModal);

        addTaskModal.addEventListener('click', (event) => {
            if (event.target === addTaskModal) closeAddModal();
        });
    }

    // --- Modale : Modifier une tâche ---
    const editTaskModal = document.getElementById('editTaskModal');
    const editTaskForm = document.getElementById('editTaskForm');
    const closeEditModalBtn = document.getElementById('closeEditModalBtn');
    const cancelEditModalBtn = document.getElementById('cancelEditModalBtn');

    if (tasksTableBody && editTaskModal) {
        // Délégation d'événement car le tableau change avec l'AJAX
        tasksTableBody.addEventListener('click', (e) => {
            const btn = e.target.closest('.open-edit-modal');
            if (btn) {
                const id = btn.getAttribute('data-id');
                const title = btn.getAttribute('data-title');
                const description = btn.getAttribute('data-description');
                const categories = JSON.parse(btn.getAttribute('data-categories') || '[]');

                // Remplissage du formulaire
                editTaskForm.action = `/admin/tasks/${id}`;
                document.getElementById('edit_title').value = title;
                document.getElementById('edit_description').value = description;

                // Cocher les catégories
                document.querySelectorAll('.edit-category-checkbox').forEach(cb => {
                    cb.checked = categories.includes(parseInt(cb.value));
                });

                editTaskModal.classList.remove('hidden');
            }
        });

        const closeEditModal = () => {
            editTaskModal.classList.add('hidden');
        };

        if (closeEditModalBtn) closeEditModalBtn.addEventListener('click', closeEditModal);
        if (cancelEditModalBtn) cancelEditModalBtn.addEventListener('click', closeEditModal);

        editTaskModal.addEventListener('click', (event) => {
            if (event.target === editTaskModal) closeEditModal();
        });
    }
});
