<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Board, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{


    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Cette fonction gre directement les autorisations pour chacune des méthodes du contrôleur 
         * en fonction des méthode du BoardPolicy (viewAny, view, update, create, ...)
         * 
         *  https://laravel.com/docs/8.x/authorization#authorizing-resource-controllers
         */
        //$this->authorizeResource(Board::class, 'board');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupérer tous les boards auxquels participe l'utilisateur connecté 
        $user = Auth::user();
        //return view('user.boards.index', ['boards' =>  $user->boards]);
        return Board::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->authorize('create', Board::class);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
        ]);
        $board = new Board(); 
        $board->user_id = Auth::user()->id; 
        $board->title = $validatedData['title']; 
        $board->description = $validatedData['description']; 

        
        
        $board->save();
        return $board; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return $board; 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
        ]);
        $board->title = $validatedData['title']; 
        $board->description = $validatedData['description']; 
        $board->update();

        return  $board; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        //
        $board->delete(); 
        return $board; 
    }
}
