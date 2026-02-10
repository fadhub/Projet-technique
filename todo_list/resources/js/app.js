import './bootstrap';
import 'preline';

import initAdminTasks from './ajax.js';

// Initialize the tasks manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initAdminTasks();
});
