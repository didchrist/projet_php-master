<div class="content">
    <div class="block p-20 form-container">
        <?php if (isset($error)) : ?>
        <div class="box-error">
            <p class="error-message"><?= $error ?? '' ?></p>
        </div>
        <?php endif; ?>
        <h2>Create account</h2>
        <form action="#" method="POST">
            <div class="form-control">
                <label for="nom">First name :</label>
                <input type="text" name="nom" value="<?= $nom ?? '' ?>" placeholder="First Name" required>
            </div>
            <div class="form-control">
                <label for="prenom">Last name :</label>
                <input type="text" name="prenom" value="<?= $prenom ?? '' ?>" placeholder="Last Name" required>
            </div>
            <div class="form-control">
                <label for="pseudonyme">Pseudonym :</label>
                <input type="text" name="pseudonyme" value="<?= $pseudonyme ?? '' ?>" placeholder="Pseudonyme" required>
            </div>
            <div class="form-control">
                <label for="email">Email :</label>
                <input type="email" name="email" value="<?= $email ?? '' ?>" placeholder="Email" required>
            </div>
            <?php if ($_SERVER['REQUEST_URI'] === '/register') : ?>
            <div class="form-control">
                <label for="password">Password :</label>
                <input type="password" name="password" placeholder="******" minlength="4" maxlength="20" required>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Register</button>
            </div>
            <?php else : ?>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>