<?php

namespace Models\article;

use Models\Database;

class ArticleManager extends Database
{
    public function getArticles()
    {
        $req = 'SELECT articles.*, categories.category FROM articles INNER JOIN categories ON articles.idcat=categories.id';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $articles = $statement->fetchAll();
        $statement->closeCursor();
        return $articles;
    }

    public function getArticle($id)
    {
        $req = "SELECT articles.*, categories.* FROM articles INNER JOIN categories ON articles.idcat=categories.id WHERE articles.id=$id";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $article = $statement->fetch();
        $statement->closeCursor();
        return $article;
    }

    public function addArticle($title, $image_chemin, $description, $option, $user)
    {
        $req = 'INSERT INTO articles (titre, image, description, idcat , iduser) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$title, $image_chemin, $description, $option, $user]);
    }

    public function updateArticle($title, $image_chemin, $description, $option, $id)
    {
        $req = 'UPDATE articles SET titre = ?, image = ?, description = ?, idcat = ? WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$title, $image_chemin, $description, $option, $id]);
    }

    public function deleteArticle($id)
    {
        $req = 'DELETE FROM articles WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
    }
}