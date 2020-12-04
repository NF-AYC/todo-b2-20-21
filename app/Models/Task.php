<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Le modèle Task qui est lié à la table tasks dans la base de données
 * 
 * @author Nicolas Faessel <nicolas.faessel@ynov.com>
 * 
 */
class Task extends Model
{
    use HasFactory;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'due_date', 'category_id', 'board_id', 'state'];


    /**
     * Renvoie la catégorie de la tâche
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    /**
     * Renvoie le board qui contient la tâche
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board()
    {
        return $this->belongsTo('App\Models\Board');
    } 


    /**
     * Renvoie tous les utilisateurs qui sont assignés à la tâche
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assignedUsers()
    {
        return $this->belongsToMany('App\Models\User')
                    ->using("App\Models\TaskUser")
                    ->withPivot("id")
                    ->withTimestamps();
    }

    

    /**
     * Renvoie la liste des utilisateurs du board auquel appartient la tâche (hormis le propriétaire ?)
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function participants()
    {
        return $this->hasManyThrough(User::class, BoardUser::class, "board_id", 'id', 'board_id', 'user_id');    
    }

    /**
     * Renvoie la liste des commentaires associés à la tâche
     *
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Renvoie la liste des pièces jointes associées à la tâche
     *
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments() 
    {
        return $this->hasMany('App\Models\Attachment');
    }


}
