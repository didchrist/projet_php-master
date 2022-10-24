<header>
    <div class="contour-logo">
        <a class="logo" href="../index.php">Projet Blog PHP</a>
    </div>
    <ul class="header-menu">
        <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=add-article' ? 'active' : '' ?>"
                href="../index.php?page=add-article">Créer un article</a></li>
        <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=homepage' ? 'active' : '' ?>"
                href="../index.php">Home</a></li>
        <li><a class="<?= $_SERVER['REQUEST_URI'] === '/index.php?page=homepage' ? 'active' : '' ?>"
                href="../index.php?page=homepage">Articles</a></li>
        <li><a href="../test.php">test</a></li>
    </ul>
</header>