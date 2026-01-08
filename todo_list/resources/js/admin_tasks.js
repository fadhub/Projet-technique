document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const tasksTableBody = document.getElementById('tasksTableBody');
    const filterForm = document.getElementById('filterForm');
    const categorySelect = filterForm ? filterForm.querySelector('select') : null;

    if (searchInput) {
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

    function fetchTasks(search, categoryId) {
        const url = new URL(window.location.href);
        url.searchParams.set('search', search);
        if (categoryId) {
            url.searchParams.set('category_id', categoryId);
        } else {
            url.searchParams.delete('category_id');
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                tasksTableBody.innerHTML = html;
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    // Modal Logic
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const addTaskModal = document.getElementById('addTaskModal');

    if (openModalBtn && addTaskModal) {
        openModalBtn.addEventListener('click', () => {
            addTaskModal.style.display = 'flex';
        });

        const closeModal = () => {
            addTaskModal.style.display = 'none';
        };

        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
        if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

        window.addEventListener('click', (event) => {
            if (event.target === addTaskModal) {
                closeModal();
            }
        });
    }
});
