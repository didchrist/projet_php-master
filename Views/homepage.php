<div class="homepage">
    <aside class="aside" id="aside">
        <form action="homepage" method="POST">
            <button class="btn btn-primary">All</button>
        </form>
        <?php foreach ($option as $cat) : ?>
        <form action="article-category" method="POST">
            <input type="hidden" name="cat" value="<?= $cat ?>">
            <button class="btn btn-primary" type="submit" name="category"><?= $cat ?></button>
        </form>
        <?php endforeach; ?>
        <div class="div-fleche">
            <a href="#aside" class="fleche">></a>
        </div>
    </aside>
    <div class="block-articles">
        <?php foreach ($articles as $article) : ?>
        <div class="card">
            <div class="card-image-div">
                <img class="card-image" src="<?= $article->image ?? ''; ?>" alt="image">
            </div>
            <h2 class="card-title"><?= $article->titre ?></h2>
            <p class="card-category"><?= $article->category; ?></p>
            <form action="article" method="POST">
                <input name="article-index" value="<?= $article->id; ?>" type="hidden">
                <button class="btn btn-color-card" type="submit">More details</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>