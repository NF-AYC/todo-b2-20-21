<?php

namespace App\Http\Controllers;

use App\Models\{Category,Task, Board};
use Database\Factories\CategoryFactory;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        return view('tasks.index', ['board' => $board]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Board $board le board à partir duquel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function create(Board $board)
    {
        $categories = Category::all(); 
        return view('tasks.create', ['categories' => $categories, 'board' => $board]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board pour lequel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id', 
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout. 
        $validatedData['board_id'] = $board->id; 
        Task::create($validatedData); 
        return redirect()->route('tasks.index', [$board]);

    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board, Task $task)
    {
        //
        return view('tasks.show', ['board' => $board, 'task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board, Task $task)
    {
        //
        return view('tasks.edit', ['board' => $board, 'task' => $task, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board, Task $task)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id', 
            'state' => 'in:todo,ongoing,done'
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout. 
        
        $task->update($validatedData); 
        return redirect()->route('tasks.index', [$board]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board, Task $task)
    {
        $task->delete(); 
        return redirect()->route('tasks.index', [$board]);
    }
}
