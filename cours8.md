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

## 


