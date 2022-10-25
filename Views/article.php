<div class="container">
    <div class="content">
        <h1><?= $article->titre; ?></h1>
        <img src="<?= $article->image; ?>" alt="image">
        <p><?= $article->description; ?></p>
        <form action="../index.php?page=update-article" method="POST">
            <input type="hidden" name="article-index" value="<?= $article_index ?>" id="">
            <button name="modifier">Edit</button>
        </form>
        <form action="../index.php?page=remove-article" method="POST">
            <input type="hidden" name="article-index" value="<?= $article_index ?>" id="">
            <button type="submit" name="delete">Delete</button>
        </form>
    </div>
</div>