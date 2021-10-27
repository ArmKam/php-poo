<?php

require_once('./libraries/controllers/Article.php');


$controllers = new \Controllers\Article();
$controllers->index();
/**
 * 
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */


// $userModel = new User();

// $users = $userModel->findAll();
// var_dump($users);
// die();
//$pdo = getPdo(); elle n'est plus utilisée



/**
 * 
 * 2. Récupération des articles
 */


/**
 * 3. Affichage
 */
