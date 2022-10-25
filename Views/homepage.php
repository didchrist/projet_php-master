<div class="container">
    <div class="content">
        <div class="block-articles">
            <?php foreach ($articles as $article) : ?>
            <div class="card">
                <div class="card-image-div">
                    <img class="card-image" src="<?= $article->image ?? ''; ?>" alt="image">
                </div>
                <h2 class="card-title"><?= $article->titre ?></h2>
                <p class="card-category"><?= $article->category; ?></p>
                <form action="./index.php?page=article" method="POST">
                    <input name="article-index" value="<?= $article->id; ?>" type="hidden">
                    <button class="btn btn-color-card" type="submit">More details</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>