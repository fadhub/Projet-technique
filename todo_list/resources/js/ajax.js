// Configuration
const config = {
    baseUrl: '/admin/tasks',
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

// DOM Elements
const elements = {
    tasksTableWrapper: document.getElementById('tasksTableWrapper'),
    searchInput: document.getElementById('adminSearchInput'),
    categorySelect: document.getElementById('indexCategorySelect'),
    statusSelect: document.getElementById('indexStatusSelect'),
    addTaskBtn: document.getElementById('adminAddTaskBtn'),
    taskModal: document.getElementById('taskModal'),
    taskForm: document.getElementById('taskForm'),
    modalTitle: document.querySelector('#taskModal .modal-title'),
    closeModalBtn: document.querySelector('[data-modal-hide="taskModal"]')
};

// State
let currentPage = 1;
let debounceTimer;

// Initialize the application
function init() {
    // Event Listeners
    elements.searchInput.addEventListener('input', handleSearch);
    elements.categorySelect.addEventListener('change', fetchTasks);
    elements.statusSelect.addEventListener('change', fetchTasks);
    elements.addTaskBtn.addEventListener('click', openCreateModal);
    elements.closeModalBtn.addEventListener('click', closeModal);
    elements.taskForm.addEventListener('submit', handleFormSubmit);
    
    // Close modal when clicking outside
    document.addEventListener('click', (e) => {
        if (e.target === elements.taskModal) {
            closeModal();
        }
    });

    // Initial fetch
    fetchTasks();
}

// Fetch tasks with current filters
async function fetchTasks(page = 1) {
    currentPage = page;
    
    const params = new URLSearchParams({
        search: elements.searchInput.value,
        category: elements.categorySelect.value === 'all' ? '' : elements.categorySelect.value,
        status: elements.statusSelect.value === 'all' ? '' : elements.statusSelect.value,
        page: currentPage
    });

    try {
        const response = await fetch(`${config.baseUrl}/table?${params}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            }
        });

        if (!response.ok) throw new Error('Network response was not ok');
        
        const html = await response.text();
        elements.tasksTableWrapper.innerHTML = html;
        
        // Re-attach event listeners to pagination links
        attachPaginationListeners();
    } catch (error) {
        console.error('Error fetching tasks:', error);
        showAlert('error', 'Erreur lors du chargement des tâches');
    }
}

// Handle search with debounce
function handleSearch() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        fetchTasks(1);
    }, 500);
}

// Open create task modal
function openCreateModal() {
    elements.modalTitle.textContent = 'Ajouter une tâche';
    elements.taskForm.reset();
    elements.taskForm.setAttribute('action', config.baseUrl);
    elements.taskForm.setAttribute('method', 'POST');
    elements.taskForm.querySelector('input[name="_method"]')?.remove();
    elements.taskModal.classList.remove('hidden');
}

// Open edit task modal
function openEditModal(taskId) {
    fetch(`${config.baseUrl}/${taskId}/edit`)
        .then(response => response.json())
        .then(data => {
            elements.modalTitle.textContent = 'Modifier la tâche';
            elements.taskForm.querySelector('#title').value = data.title;
            elements.taskForm.querySelector('#description').value = data.description || '';
            elements.taskForm.querySelector('#is_completed').checked = data.is_completed;
            
            // Set categories
            const categorySelects = elements.taskForm.querySelectorAll('select[name="categories[]"]');
            categorySelects.forEach(select => {
                Array.from(select.options).forEach(option => {
                    option.selected = data.categories.includes(parseInt(option.value));
                });
            });
            
            elements.taskForm.setAttribute('action', `${config.baseUrl}/${taskId}`);
            elements.taskForm.setAttribute('method', 'POST');
            
            // Add method spoofing for PUT
            elements.taskForm.querySelector('input[name="_method"]')?.remove();
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            elements.taskForm.appendChild(methodInput);
            
            elements.taskModal.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error fetching task:', error);
            showAlert('error', 'Erreur lors du chargement de la tâche');
        });
}

// Close modal
function closeModal() {
    elements.taskModal.classList.add('hidden');
}

// Handle form submission
async function handleFormSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(elements.taskForm);
    const url = elements.taskForm.getAttribute('action');
    const method = elements.taskForm.getAttribute('method');
    
    try {
        const response = await fetch(url, {
            method: method === 'GET' ? 'GET' : 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': config.csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();
        
        if (response.ok) {
            closeModal();
            showAlert('success', data.message || 'Opération réussie');
            fetchTasks(currentPage);
        } else {
            showAlert('error', data.message || 'Une erreur est survenue');
        }
    } catch (error) {
        console.error('Error submitting form:', error);
        showAlert('error', 'Erreur lors de la soumission du formulaire');
    }
}

// Toggle task status
async function toggleTaskStatus(taskId, isCompleted) {
    try {
        const response = await fetch(`${config.baseUrl}/${taskId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': config.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ is_completed: !isCompleted })
        });

        const data = await response.json();
        
        if (response.ok) {
            showAlert('success', data.message || 'Statut mis à jour');
            fetchTasks(currentPage);
        } else {
            throw new Error(data.message || 'Erreur lors de la mise à jour du statut');
        }
    } catch (error) {
        console.error('Error toggling task status:', error);
        showAlert('error', error.message || 'Erreur lors de la mise à jour du statut');
    }
}

// Delete task
async function deleteTask(taskId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
        return;
    }
    
    try {
        const response = await fetch(`${config.baseUrl}/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': config.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        
        if (response.ok) {
            showAlert('success', data.message || 'Tâche supprimée avec succès');
            fetchTasks(currentPage);
        } else {
            throw new Error(data.message || 'Erreur lors de la suppression de la tâche');
        }
    } catch (error) {
        console.error('Error deleting task:', error);
        showAlert('error', error.message || 'Erreur lors de la suppression de la tâche');
    }
}

// Attach event listeners to pagination links
function attachPaginationListeners() {
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = new URL(link.href);
            const page = url.searchParams.get('page');
            if (page) {
                fetchTasks(page);
                // Update URL without page reload
                window.history.pushState({}, '', url);
            }
        });
    });
}

// Show alert message
function showAlert(type, message) {
    // You can implement a toast notification system here
    alert(`${type.toUpperCase()}: ${message}`);
}

// Initialize the application when DOM is loaded
document.addEventListener('DOMContentLoaded', init);

// Make functions available globally for inline event handlers
window.openEditModal = openEditModal;
window.toggleTaskStatus = toggleTaskStatus;
window.deleteTask = deleteTask;
