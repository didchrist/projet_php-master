<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bases - POO - MVC</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="<?= $style ?? '' ?>">
</head>

<body>
    <header>
        <div class="contour-logo">
            <a class="logo" href="../index.php">Projet Blog PHP</a>
        </div>
        <ul class="header-menu">
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/homepage' ? 'active' : '' ?>" href="homepage">Home</a>
            </li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/homepage' ? 'active' : '' ?>" href="homepage">Articles</a>
            </li>
            <?php if (!isset($_SESSION['utilisateur']) and !isset($_COOKIE['utilisateur'])) : ?>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/login' ? 'active' : '' ?>" href="login">Login</a></li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/register' ? 'active' : '' ?>" href="register">Register</a>
            </li>
            <?php else : ?>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/add-article' ? 'active' : '' ?>" href="add-article">Créer un
                    article</a></li>
            <li><a class="<?= $_SERVER['REQUEST_URI'] === '/profile' ? 'active' : '' ?>" href="profile">Profile</a></li>
            <li><a href="disconnect">Se déconnecter</a></li>
            <?php endif; ?>
            <li><a href="../test.php">test</a></li>
        </ul>
    </header>
    <div class="container">
        <?= $content ?>
    </div>

</body>

</html>