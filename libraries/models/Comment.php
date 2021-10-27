<?php

namespace Models;

require_once('./libraries/models/Model.php');

class Comment extends Model
{

    protected $table = "comments";

    /**
     * Returne la laiste des commentaire d'un artilcle donné
     * 
     * @param integer $article_id
     * @return array 
     */
    public function findAllWithArticle($article_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }





    /**
     * Insèret un commentire dans la base de données
     * @param string $author
     * @param string $content
     * @param integer $article_id
     * @return void
     */

    public function insert(string $author, string  $content, int $article_id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
