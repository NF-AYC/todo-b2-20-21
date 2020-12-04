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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all(); 
        $boards = Board::all(); 
        return view('tasks.create', ['categories' => $categories, 'boards' => $boards]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id', 
            'board_id' => 'required|integer|exists:boards,id', 
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout. 
        Task::create($validatedData); 
    }


    /**
     * Show the form for creating a new resource.
     * 
     * @param Board $board le board à partir duquel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function createFromBoard(Board $board)
    {
        $categories = Category::all(); 
        return view('user.boards.tasks.create', ['categories' => $categories, 'board' => $board]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board pour lequel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function storeFromBoard(Request $request, Board $board)
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
