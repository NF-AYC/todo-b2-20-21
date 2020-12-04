# Cours laravel 8 : 4/12/2020

## Cloner le projet du cours : 
Si ce n'est déjà fait : 

`git clone https://github.com/NF-yac/todo-b2-20-21`

On récupère la branche `b2b` : 
```sh 
cd todo-b2-20-21/
git branch b2b # on crée la branche si elle n'existe pas en local
git checkout b2b # on se positionne sur la branche
git pull origin b2b
```

Il faut installer les dépendances du projet :
```sh
composer install
```

On créée le fichier d'environnement `.env` 
```sh
cp .env.example .env
```
On configurer le .env pour la connexion à la base de données : 
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_b2
DB_USERNAME=laravel
DB_PASSWORD=l4R4V3l
```
Si besoin, on génère un clé d'API : 
```sh
php artisan key:generate
# Application key set successfully.
```
Si vous avez récupéré le projet dans un projet déjà existant, il est possible que les fichiers de migrations apparaissent en double. En effet, il y a un horodatage dans le nom des fichiers, et des migrations similaires peuvent avoir un nom de fichier différent à cause de la date de génération. Il est recommandé de déplacer vos fichiers dans un sous répertoire (ils ne seront pas pris en compte lors des migrations). 

On peut maintenant  migrer : 
```sh 
php artisan migrate:fresh # fresh car dans mon cas la base existe déjà et contient des données
```
Pour obtenir les « assets » propres aux templates de connexion/enregistrement (dans le cas où il n'y sont pas).
```sh
npm install && npm run dev
```

## Réalisation du CRUD : BoardUser

BoardUser est modèle pivot qui permet de gérer les participants d'un board. 
Par défaut, le propriétaire d'un board est automatiquement participant (cf cours #7). 

À partir d'un board, on souhaite pouvoir y ajouter des participants et les supprimer et c'est tout. 

On va faire en sorte de pouvoir ajouter un utilisateur depuis l'affichage de la board. 
Pour cela, il nous faut afficher la liste des utilisateurs **qui ne sont pas déjà dans le board** et la transmettre à la vue responsable de l'affichage du board (`users.boards.show`). 


Maintenant que l'on a la liste des utilisateurs que l'on peut rajouter dans la board, il faut faire le contrôleur BoardUser, qui ne contiendra que 2 méthodes : `store` et `destroy`.

Avant d'implémenter ces méthodes, nous allons nous intéresser aux routes. Il en faut 2, une pour `store` une pour `destroy`. 

TODO : correction du bug sur destroy

## Réalisation du CRUD Task. 
On souhaite pouvoir ajouter une tâche, la modifier, la supprimer et les afficher toutes (ou bien une seule). 

On commence par le contrôleur en mode `resource` : 
```sh 
php artisan make:controller TaskController --model=Task
```

Pour pouvoir tester, nous n'avons qu'à créer une route `resource`. 
Lorsque l'on crée la tâhce, il n'y a pas besoin de mettre son état car par défaut elle est à faire (todo). 
Passons à la fonction store, et occupons nous de la validation. 

Pour sauver un modèle en base en lui passant un tableau d'attribut, on effectue une "assignation de masse". 
Pour cela, on doit déclarer un tableau protégé nommé `fillable` qui contient toutes les propriétés que l'on autorise à assigner en masse : https://laravel.com/docs/8.x/eloquent#mass-assignment

### Variante : 
On peut directement créer une tâche pour un board donné, avec une url de la forme `boards/60/tasks/create`.
Commençons par créer 2 routes dans `routes/web.php` : une pour le formulaire, une pour la création effective. 
On les associe à deux nouvelles méthodes du contrôleur : `createFromBoard` et `storeFromBoard`.
La première renvoie une nouvelle vue contenant le formulaire de création, sans la liste déroulante qui permet de choisir le board. On l'appelle `user.boards.tasks.create`, elle est donc stockées dans un sous répertoire `tasks` dans le répertoire `boards`

TODO : le reste. 


#### Pour la prochaine fois : 
Finir les contrôleurs TaskController, BoardController, et faire TaskUSer. 

Il faudrait pouvoir faire en sorte que seul le propriétaire d'un board puisse ajouter/supprimer des utilisateurs participant au board : https://laravel.com/docs/8.x/authorization (vous serez surtout attentif aux policies)

On fera aussi en sorte de finir nos todo : à savoir quand on ajoute une tache à un board, il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout : fonction `store` et `storeFromBoard`. 

