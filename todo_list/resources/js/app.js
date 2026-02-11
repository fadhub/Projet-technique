import './bootstrap';
import 'preline';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import tasksManager from './components/tasksManager';

Alpine.data('tasksManager', tasksManager);

Alpine.start();
