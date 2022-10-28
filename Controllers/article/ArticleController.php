<?php

namespace Controllers\article;

use Models\article\ArticleManager;

use Models\user;
use Models\user\UserManager;

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
            'article-index' => FILTER_SANITIZE_NUMBER_INT,
            'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'cat' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]);
    }

    public function detectCat($articles)
    {
        $option = [];
        foreach ($articles as $objet) {
            $tableauObjet[] = $objet->category;
            $cmp = array_diff($tableauObjet, $option);
            if (!empty($cmp)) {
                $option[] = $objet->category;
            }
        }
        return $option;
    }

    public function getArticles()
    {
        $this->getClean();
        $articles = $this->articleManager->getArticles();
        array_multisort(array_column($articles, 'category'), SORT_NATURAL, $articles);
        $option = $this->detectCat($articles);
        require_once './Views/homepage.php';
    }
    public function getArticlesByCategory()
    {
        $this->getClean();
        $cat = $_POST['cat'];
        $articles = $this->articleManager->getArticlesByCategory($cat);
        array_multisort(array_column($articles, 'titre'), SORT_NATURAL, $articles);
        $fullarticles = $this->articleManager->getArticles();
        $option = $this->detectCat($fullarticles);
        require_once './Views/homepage.php';
    }

    public function getArticle()
    {
        $this->getClean();
        $article_index = $_POST['article-index'] ?? '';
        $article = $this->articleManager->getArticle($article_index);
        if (isset($_COOKIE['utilisateur'])) {
            $info = $_COOKIE['utilisateur'];
        } else {
            $info = $_SESSION['utilisateur'] ?? '';
        }
        if ($info == $article->pseudonyme) {
            $droit = true;
        } else {
            $droit = false;
        }
        require_once './Views/article.php';
    }
    public function setArticle()
    {
        $this->getClean();
        require_once './Views/errors.php';

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
        $this->userManager = new UserManager;
        if (isset($_COOKIE['utilisateur'])) {
            $info = $_COOKIE['utilisateur'];
        } else {
            $info = $_SESSION['utilisateur'] ?? '';
        }
        $user = $this->userManager->getUser($info);
        $iduser = $user->id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['validate'])) {
                if ($_FILES['image']['error'] == 4) {
                    $error = ERROR_IMAGE_NOTHING;
                }
                if ($_FILES['image']['error'] == 0) {
                    if ($_FILES['image']['size'] > 150000) {
                        $error = ERROR_IMAGE_HEAVY;
                    }
                    $extension = strchr($_FILES['image']['name'], '.');
                    if ($extension != '.jpg' and $extension != '.png') {
                        $error = ERROR_IMAGE_EXTENSION;
                    }
                    if (!isset($error)) {
                        $image_chemin = './assets/img/' . uniqid() . $extension;
                        move_uploaded_file($_FILES['image']['tmp_name'], $image_chemin);
                    }
                }
            }
            if (isset($title) and isset($description) and isset($option) and file_exists($image_chemin) and $article_index === '') {

                $this->articleManager->addArticle($title, $image_chemin, $description, $option, $iduser);
                header('Location: homepage');
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
                header('Location: homepage');
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