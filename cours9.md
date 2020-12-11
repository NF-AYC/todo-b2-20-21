# Ce qu'il y a avait à faire :

Finir les contrôleurs TaskController, BoardController, et faire TaskUSer.

Il faudrait pouvoir faire en sorte que seul le propriétaire d'un board puisse ajouter/supprimer des utilisateurs participant au board : https://laravel.com/docs/8.x/authorization (vous serez surtout attentif aux policies)

On fera aussi en sorte de finir nos todo : à savoir quand on ajoute une tache à un board, il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout : fonction store et storeFromBoard.


## TaskController

On considère qu'une tâche est toujours associée à un board. Ainsi, il serait d'obtenir le board depuis la route (l'url). 

On définie la route suivante : `Route::resource("/boards/{board}/tasks", TaskController::class)->middleware('auth');` sans oublié le middleware `auth`.

Nous devrons rajouter un paramètre `Board $board` pour chacune des fonctions du contrôleur. Les routes et fonctions `createFromBoard` et `storeFromBoard` ne seront plus nécessaires. 

On a fait la vue `tasks.index` qui permet l'affichage de toutes les tâches d'une board. 

On a fini le TaskController.

## Les règles de gestions. 

On va gérer les règles suivantes : 
 1. Pour les boards : 
    - un utilisateur ne peut voir que les boards auxquels il appartient
    - seul le propriétaire d'un board peut le supprimer ou le modifier
    - tous les utilisateurs connectés peuvent créer un board. 
 2. Pour les taĉhes d'un board
    - tous les participants du board peuvent en créer une
    - tous les participants du board peuvent assigner une tâche 
    
Pour pouvoir ces règles, nous allons utiliser les policies, qui consiste en un mécanisme fournie par Laravel, permettant de spécifier les différentes actions qu'un utilisateur peut effectuer sur un modèle : https://laravel.com/docs/8.x/authorization#creating-policies
La commande pour créer notre boardPolicy : 
```sh
php artisan make:policy BoardPolicy --model=board
```

Un fichier de policy contient plusieurs fonctions : 

 - `viewAny` à utiliser dans la fonction `index` du contrôleur
 - `viewy` à utiliser dans la fonction `show` du contrôleur
 - `create` à utiliser dans les fonctions `create` et `store` du contrôleur
 - `update` à utiliser dans les fonctions `edit` et `update` du contrôleur
 - `delete` à utiliser dans la fonction `destroy` du contrôleur

Pour utiliser les policies, on a trois possibilités : 

 - en utilisant une fonction `authorize` du contrôleur (dans un contrôleur) :
   ```php
   public function create(Request $request) 
   {
      $this->authorize('create', Board::class);

      // Si on arrive ici on peut créer le board
   }
   ```

- en utilisant le modèle `user`  que l'on récupère depuis la requête (dans un contrôleur) :
   ```php
   public function store(Request $request) 
   {
      if($request->user->cannot('create', Board::class)) { // Il existe can et cannot
         abort(403);    // Renvoi un code de réponse HTTP 403, qui signifie non autorisé
      }

      // Si on arrive ici, on peut créer le board

   }
   ```

- Via les middleware `can` et `cannot` (dans les routes et les vues)
   ```php
      Route::put('boards/{board}', [BoardController::class, 'update'])->middleware('can:update,board');
   ```
   cf : https://laravel.com/docs/8.x/authorization#via-middleware

On peut aussi utiliser les policies dans les templates blade : en utilisant les directive `@can('update', $board) .... @endcan` : 

```html
      @can('update', $board)
      <a href="{{route('boards.edit', $board)}}">edit</a></p></p>
      @endcan 
```

cf https://laravel.com/docs/8.x/authorization#via-blade-templates

on peut se contenter d'initialiser les instructions dans le constructeur de notre contrôleur, si celui-ci soit un `resource controler`, lié à un modèle (Board par exemple) : 

```php
    public function __construct()
    {
        /*
         * Cette fonction gre directement les autorisations pour chacune des méthodes du contrôleur 
         * en fonction des méthode du BoardPolicy (viewAny, view, update, create, ...)
         * 
         *  https://laravel.com/docs/8.x/authorization#authorizing-resource-controllers
         */
        $this->authorizeResource(Board::class, 'board');
    }
```

