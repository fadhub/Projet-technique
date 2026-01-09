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
        const fetchUrl = new URL(window.location.protocol + '//' + window.location.host + window.location.pathname);

        if (search) fetchUrl.searchParams.set('search', search);
        if (categoryId) fetchUrl.searchParams.set('category_id', categoryId);

        fetch(fetchUrl, {
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
});

