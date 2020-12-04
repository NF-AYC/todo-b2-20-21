<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardUser extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @see https://laravel.com/docs/8.x/eloquent-relationships#defining-custom-intermediate-table-models
     * @var bool
     */
    public $incrementing = true;

    protected $primaryKey = "id";

    /**
     * Renvoi l'utilisateur lié au board
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Renvoi le board lié à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Permet de récupérer toutes les tâches de la board. 
     * Servira de lien pour récupérer les tâches d'un utilisateur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tasks() {
        return $this->hasManyThrough(Task::class, Board::class, 'id', 'board_id', 'board_id');
    }

}
