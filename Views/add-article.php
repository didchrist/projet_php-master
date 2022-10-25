<div class="content">
    <div class="block p-20 form-container">
        <form action="../index.php?page=add-article" method="POST" enctype="multipart/form-data">
            <?= $errors ?? '' ?>
            <div class="form-control">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="title" value="<?= $title ?? '' ?>">
            </div>
            <div class="form-control">
                <label for="image">.jpg and .png only</label>
                <input name="image" type="file">
            </div>
            <div class="form-control">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10"><?= $description ?? '' ?></textarea>
            </div>
            <div class="form-control">
                <label for="category">Choose option :</label>
                <select name="category" id="">
                    <option value="">--Please choose an option--</option>
                    <option value="1" <?= $option === '1' ? 'selected' : ''; ?>>Nature</option>
                    <option value="3" <?= $option === '3' ? 'selected' : ''; ?>>
                        Technology</option>
                    <option value="2" <?= $option === '2' ? 'selected' : ''; ?>>Politics
                    </option>
                </select>
            </div>
            <div class="form-actions">
                <input type="hidden" name="article-index" value="<?= $article_index ?? '' ?>">
                <button class="btn" name="validate" type="submit">Validate</button>
                <button class="btn" name="cancel" type="submit">Cancel</button>
            </div>
        </form>
    </div>
</div>