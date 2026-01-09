<?php

return [
    // Navigation
    'tasks' => 'Tâches',
    'categories' => 'Catégories',
    'login' => 'Connexion',
    'register' => 'Inscription',
    'logout' => 'Déconnexion',
    'admin_panel' => 'Panneau d\'administration',
    'profile' => 'Profil',

    // Tâches
    'task_list' => 'Liste des tâches',
    'add_task' => 'Ajouter une tâche',
    'edit_task' => 'Modifier la tâche',
    'delete_task' => 'Supprimer la tâche',
    'task_title' => 'Titre de la tâche',
    'task_description' => 'Description',
    'task_due_date' => 'Date d\'échéance',
    'task_status' => 'Statut',
    'task_priority' => 'Priorité',
    'task_category' => 'Catégorie',
    'save' => 'Enregistrer',
    'cancel' => 'Annuler',
    'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer cette tâche ?',
    'no_tasks' => 'Aucune tâche trouvée.',

    // Statuts
    'status' => [
        'pending' => 'En attente',
        'in_progress' => 'En cours',
        'completed' => 'Terminé'
    ],

    // Priorités
    'priority' => [
        'low' => 'Basse',
        'medium' => 'Moyenne',
        'high' => 'Haute'
    ],

    // Messages
    'task_created' => 'Tâche créée avec succès.',
    'task_updated' => 'Tâche mise à jour avec succès.',
    'task_deleted' => 'Tâche supprimée avec succès.',
    'error_occurred' => 'Une erreur est survenue. Veuillez réessayer.',

    // Validation
    'title_required' => 'Le titre est requis.',
    'title_max' => 'Le titre ne doit pas dépasser :max caractères.',
    'description_required' => 'La description est requise.',
    'due_date_required' => 'La date d\'échéance est requise.',
    'due_date_after' => 'La date d\'échéance doit être ultérieure à maintenant.',
    'status_required' => 'Le statut est requis.',
    'priority_required' => 'La priorité est requise.',
    'category_required' => 'La catégorie est requise.',
];