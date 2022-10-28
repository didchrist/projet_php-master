<div class="content">
    <div class="block p-20 form-container">
        <?php if (isset($error)) : ?>
        <div class="box-error">
            <p class="error-message"><?= $error ?? '' ?></p>
        </div>
        <?php endif; ?>
        <h2>Login</h2>
        <form action="#" method="POST">
            <div class="form-control">
                <label for="email">Email :</label>
                <input type="email" name="email" value="<?= $email ?? '' ?>" placeholder="example@example.com" required>
            </div>
            <div class="form-control">
                <label for="password">Password :</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>