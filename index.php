<?php

use Controllers\article\ArticleController;

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

$articleController = new ArticleController();

$page = $_GET['page'] ?? '';

ob_start();

if (empty($page)) {
    header('Location: homepage');
} else {
    if ($page === 'homepage') {
        $articleController->getArticles();
    } elseif ($page === 'add-article') {
        $articleController->setArticle();
    } elseif ($page === 'update-article') {
        $articleController->setArticle();
    } elseif ($page === 'remove-article') {
        $articleController->removeArticle();
    } elseif ($page === 'article') {
        $articleController->getArticle();
    }
}

$content = ob_get_clean();

require_once './Views/template/template.php';