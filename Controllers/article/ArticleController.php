<?php

namespace Controllers\article;

use Models\article\ArticleManager;

class ArticleController
{
    private $articleManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager;
    }
    public function getClean()
    {
        $_POST = filter_input_array(INPUT_POST, [
            'validate' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'cancel' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'modifier' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'article-index' => FILTER_SANITIZE_NUMBER_INT
        ]);
    }

    public function getArticles()
    {
        $this->getClean();
        $articles = $this->articleManager->getArticles();
        require_once './Views/homepage.php';
    }
    public function getArticle()
    {
        $this->getClean();
        $article_index = $_POST['article-index'] ?? '';
        $article = $this->articleManager->getArticle($article_index);
        require_once './Views/article.php';
    }
    public function setArticle()
    {
        $this->getClean();

        $article_index = $_POST['article-index'] ?? '';

        if (isset($_POST['modifier'])) {
            $article = $this->articleManager->getArticle($article_index);
            $title = $article->titre;
            $description = $article->description;
            $option = $article->idcat;
        } else {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $option = $_POST['category'] ?? '';
        }

        $image_chemin = '';
        $user = '1';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['validate'])) {
                if ($_FILES['image']['error'] == 4) {
                    $errors_succes = "Veuillez insérer une image valide.";
                }
                if ($_FILES['image']['error'] == 0) {
                    if ($_FILES['image']['size'] > 150000) {
                        $errors_succes = "Votre image est trop lourde.";
                    }
                    $extension = strchr($_FILES['image']['name'], '.');
                    if ($extension != '.jpg' and $extension != '.png') {
                        $errors_succes = "Votre format d'image n'est en .png ou .jpg.";
                    }
                    if (!isset($errors_succes)) {
                        $errors_succes = "l'image est chargée";
                        $image_chemin = './assets/img/' . uniqid() . $extension;
                        move_uploaded_file($_FILES['image']['tmp_name'], $image_chemin);
                    }
                }
            }
            if (isset($title) and isset($description) and isset($option) and file_exists($image_chemin) and $article_index === '') {

                $this->articleManager->addArticle($title, $image_chemin, $description, $option, $user);
            }

            if (isset($_POST['validate']) and $article_index != '' and isset($title) and isset($description) and isset($option)) {
                $article = $this->articleManager->getArticle($article_index);
                if ($image_chemin !== '') {
                    $imagename = $article->image;
                    unlink($imagename);
                } else {
                    $image_chemin = $article->image;
                }
                $this->articleManager->updateArticle($title, $image_chemin, $description, $option, $article_index);
            }
        }
        require_once './Views/add-article.php';
    }

    public function removeArticle()
    {
        $this->getClean();
        $article_index = $_POST['article-index'];
        $article = $this->articleManager->getArticle($article_index);
        $image_chemin = $article->image;
        unlink($image_chemin);
        $this->articleManager->deleteArticle($article_index);

        header('Location: ./index.php');
    }
}