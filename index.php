<?php
session_start();

use Controllers\article\ArticleController;
use Controllers\user\UserController;

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

$articleController = new ArticleController();
$userController = new UserController();

$page = $_GET['page'] ?? '';

ob_start();
if (isset($_SESSION['utilisateur']) or isset($_COOKIE['utilisateur'])) {
    if (empty($page)) {
        header('Location: homepage');
    } else {
        if ($page === 'homepage') {
            $articleController->getArticles();
            $style = './assets/css/articles.css';
        } elseif ($page === 'add-article') {
            $articleController->setArticle();
            $style = './assets/css/add-article.css';
        } elseif ($page === 'update-article') {
            $articleController->setArticle();
            $style = './assets/css/add-article.css';
        } elseif ($page === 'remove-article') {
            $articleController->removeArticle();
        } elseif ($page === 'article') {
            $articleController->getArticle();
            $style = './assets/css/articles.css';
        } elseif ($page === 'loggin') {
            $userController->getUser();
            $style = './assets/css/add-article.css';
        } elseif ($page === 'register') {
            $userController->addUser();
            $style = './assets/css/add-article.css';
        } elseif ($page === 'disconnect') {
            $userController->delogUser();
        } elseif ($page === 'profil') {
            $userController->updateUser();
            $style = './assets/css/add-article.css';
        }
    }
} else {
    if (empty($page)) {
        header('Location: homepage');
    } else {
        if ($page === 'homepage') {
            $articleController->getArticles();
            $style = './assets/css/articles.css';
        } elseif ($page === 'article') {
            $articleController->getArticle();
            $style = './assets/css/articles.css';
        } elseif ($page === 'loggin') {
            $userController->getUser();
            $style = './assets/css/add-article.css';
        } elseif ($page === 'register') {
            $userController->addUser();
            $style = './assets/css/add-article.css';
        }
    }
}

$content = ob_get_clean();

require_once './Views/template/template.php';