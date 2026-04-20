document.getElementById('openModal').onclick = () => {
    document.getElementById('modal').style.display = 'block';
};

document.getElementById('saveTask').onclick = () => {
    fetch('/tasks', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: document.getElementById('taskTitle').value
        })
    })
    .then(() => location.reload());
};

// Search AJAX
document.getElementById('search').addEventListener('keyup', function () {
    fetch('/tasks?search=' + this.value, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('tasksTable').innerHTML = data;
    });
});
