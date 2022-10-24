<?php
require_once './database.php';

class Articles
{
    public string $title, $image, $description, $category;
    public function __construct(array $article)
    {
        $this->title = $article['title'];
        $this->image = $article['image'];
        $this->description = $article['description'];
        $this->category = $article['category'];
    }
}
function articleObjet($data)
{
    $class_article = new Articles($data);
    return $class_article;
}

function dectecOption($data)
{
    $option = [];
    foreach ($data as $objet) {
        $tableauObjet[] = $objet ->category; 
        $cmp = array_diff($option,$tableauObjet);
        if ($cmp === '') {
            $option[] = $objet->category;
        }

    }
    return $option;
}


$articles_Objets = array_map('articleObjet', $articles);
array_multisort(array_column($articles_Objets, 'category'), SORT_NATURAL, $articles_Objets);
echo '<pre>';
var_dump($articles_Objets, '<br>');
echo '</pre>';
var_dump(dectecOption($articles_Objets));
?>

<head>
    <?php require_once './includes/head.php' ?>
    <title>Articles</title>
    <link rel="stylesheet" href="./assets/css/articles.css">
</head>

<body>
    <div class="container">
        <?php require_once './includes/header.php' ?>
        <div class="content">
        </div>
    </div>
</body>

</html>