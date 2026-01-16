const refreshTable = (search = '') => {
    const tableBody = document.querySelector('#table-body');
    fetch(`/tasks/search?search=${encodeURIComponent(search)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(res => res.text())
        .then(html => {
            if (tableBody) tableBody.innerHTML = html;
        })
        .catch(err => console.error(err));
};


document.querySelector('#search')?.addEventListener('input', (e) => refreshTable(e.target.value));


document.querySelector('#addTaskForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    fetch(this.action, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: new FormData(this)
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.reset();
               
                if (window.HSOverlay) {
                    const modal = document.querySelector('#hs-add-task-modal');
                    HSOverlay.close(modal);
                }
                refreshTable(document.querySelector('#search')?.value || '');
            }
        })
        .catch(err => console.error(err));
});