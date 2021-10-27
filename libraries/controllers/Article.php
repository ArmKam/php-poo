<?php

namespace Controllers;

require_once('./libraries/utils.php');
require_once('./libraries/models/Article.php');
require_once('./libraries/controllers/Controller.php');
require_once('./libraries/models/Comment.php');

class Article extends Controller
{

    protected $modelName = \Models\Article::class;

    public function index()
    {
        // Montrer la liste






        /**
         * 
         * 2. Récupération des articles
         */
        $articles = $this->model->findAll("created_at DESC");

        /**
         * 3. Affichage
         */
        $pageTitle = "Accueil";

        render('/articles/index', compact("pageTitle", "articles"));
    }
    public function show()
    {
        // Montrer un article



        $commentModel = new \Models\Comment();
        /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
        // On part du principe qu'on ne possède pas de param "id"
        $article_id = null;

        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }


        $article = $this->model->find($article_id);


        /**
         * 4. Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */
        // $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        // $query->execute(['article_id' => $article_id]);
        // $commentaires = $query->fetchAll();

        $commentaires = $commentModel->findAllWithArticle($article_id);
        /**
         * 5. On affiche 
         */
        $pageTitle = $article['title'];

        render(
            'articles/show',
            //  [
            //     "page_title"    => $pageTitle,
            //     "article_id"    => $article,
            //     "article"       => $article,
            //     "commentaires"  => $commentaires
            // ]
            //compacte methode permet de comme nom d'écrire just des clef de tableau associatif
            //ça me mermet de créer un tableau associatif à partir du nom des variables que je mets dedans
            compact('article', 'commentaires', "pageTitle", 'article_id')
        );
    }

    public function delete()
    {
        // Suprimer un  article



        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];


        $pdo = getPdo();


        $article = $this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * 4. Réelle suppression de l'article
         */
        // $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        // $query->execute(['id' => $id]);

        $this->model->delete($id);
        /**
         * 5. Redirection vers la page d'accueil
         */
        // header("Location: index.php");
        // exit();

        redirect('index.php');
    }
}
