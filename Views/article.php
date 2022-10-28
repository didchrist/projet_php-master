<div class="page-article">
    <h1><?= $article->titre; ?></h1>
    <div class="image">
        <img src="<?= $article->image; ?>" alt="image">
    </div>
    <p><?= $article->description; ?></p>
    <p>Redact by <span><?= $article->pseudonyme ?></span>.</p>
    <?php if ($droit) : ?>
    <div class="block-btn">
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
    <?php endif; ?>
</div>