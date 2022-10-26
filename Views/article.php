<div class="content">
    <div class="block p-20 form-container">
        <h1><?= $article->titre; ?></h1>
        <img src="<?= $article->image; ?>" alt="image">
        <p><?= $article->description; ?></p>
        <form action="../index.php?page=update-article" method="POST">
            <input type="hidden" name="article-index" value="<?= $article_index ?>" id="">
            <div class="form-actions">
                <button class="btn btn-primary" name="modifier">Edit</button>
            </div>
        </form>
        <form action="../index.php?page=remove-article" method="POST">
            <input type="hidden" name="article-index" value="<?= $article_index ?>" id="">
            <div class="form-actions">
                <button class="btn btn-primary" type="submit" name="delete">Delete</button>
            </div>
        </form>
    </div>
</div>
