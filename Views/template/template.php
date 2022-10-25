<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bases - POO - MVC</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="<?= $style ?? ''?>">
</head>

<body>
    <header>
        <div class="contour-logo">
            <a class="logo" href="../index.php">Projet Blog PHP</a>
        </div>
        <ul class="header-menu">
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=homepage' ? 'active' : '' ?>"
            href="../index.php">Home</a></li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=homepage' ? 'active' : '' ?>"
            href="../index.php?page=homepage">Articles</a></li>
            <?php if (!isset($_SESSION['utilisateur']) and !isset($_COOKIE['utilisateur'])): ?>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=loggin' ? 'active' : '' ?>" 
            href="../index.php?page=loggin">Loggin</a></li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=register' ? 'active' : '' ?>"
            href="../index.php?page=register">Register</a></li>
            <?php else: ?>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=add-article' ? 'active' : '' ?>"
                    href="../index.php?page=add-article">Créer un article</a></li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=profil' ? 'active' : '' ?>"
                     href="../index.php?page=profil">Profil</a></li>
            <li><a href="/index.php?page=disconnect">Se déconnecter</a></li>
            <?php endif; ?>
            <li><a href="../test.php">test</a></li>
        </ul>
    </header>
    <div class="container">
        <?= $content ?>
    </div>

</body>

</html>