document.getElementById('openModal').onclick = () => {
    document.getElementById('modal').style.display = 'block';
};

document.getElementById('saveTask').onclick = () => {
    fetch('/admin/tasks', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': (document.querySelector('meta[name=csrf-token]') || {content:''}).content,
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            title: document.getElementById('taskTitle').value
        })
    })
    .then(() => location.reload());
};

// Search AJAX
const searchInput = document.getElementById('search');
if (searchInput) {
    searchInput.addEventListener('keyup', function () {
        fetch('/admin/tasks?search=' + encodeURIComponent(this.value), {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
        .then(res => res.text())
        .then(data => {
            const el = document.getElementById('tasksTable');
            if (el) el.innerHTML = data;
        });
    });
}

// Delegate view button clicks (table may be re-rendered)
document.addEventListener('click', function(e){
    if(e.target && e.target.matches('.view-task')){
        const id = e.target.dataset.id;
        fetch('/admin/tasks/' + id)
            .then(r => r.json())
            .then(data => {
                document.getElementById('task-id').textContent = data.id;
                document.getElementById('task-title').textContent = data.title || '';
                document.getElementById('task-desc').textContent = data.description || '';
                document.getElementById('task-user').textContent = (data.user && data.user.name) ? data.user.name : '';
                document.getElementById('task-completed').textContent = data.is_completed ? 'Yes' : 'No';
                document.getElementById('task-created').textContent = data.created_at || '';
                document.getElementById('task-modal').style.display = 'block';
            });
    }
});

const modalClose = document.getElementById('modal-close');
if (modalClose) modalClose.addEventListener('click', function(){
    const m = document.getElementById('task-modal'); if (m) m.style.display = 'none';
});
