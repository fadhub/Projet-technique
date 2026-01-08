<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class PublicTaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Affiche la liste des tâches
     */
    public function index()
    {
        $tasks = $this->taskService->index(9);
        return view('public.home', compact('tasks'));
    }

    /**
     * Affiche les détails d'une tâche
     */
    public function show($id)
    {
        $task = $this->taskService->show($id);
        return view('public.show', compact('task'));
    }
}