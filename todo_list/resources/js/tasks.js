document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById("myModal");
    const tableBody = document.getElementById('tasksTableBody');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // Modal Control
    document.getElementById("openModalBtn").onclick = () => modal.style.display = "block";
    document.getElementById("closeModalBtn").onclick = () => modal.style.display = "none";

    // Search AJAX
    document.getElementById('searchInput').addEventListener('keyup', function () {
        fetch(`/tasks/search?search=${this.value}`)
            .then(res => res.json())
            .then(data => {
                tableBody.innerHTML = '';
                data.data.forEach(task => {
                    const status = task.is_completed ? messages.completed : messages.pending;
                    tableBody.innerHTML += `
                        <tr>
                            <td>${task.title}</td>
                            <td>${task.description || ''}</td>
                            <td>${status}</td>
                        </tr>`;
                });
            });
    });

    // Add Task AJAX
    document.getElementById('addTaskForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        data.is_completed = data.status === '1';

        fetch('/tasks', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(task => {
                modal.style.display = "none";
                this.reset();
                const status = task.is_completed ? messages.completed : messages.pending;
                tableBody.insertAdjacentHTML('afterbegin', `
                <tr>
                    <td>${task.title}</td>
                    <td>${task.description || ''}</td>
                    <td>${status}</td>
                </tr>`);
            });
    });
});
