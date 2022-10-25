<div class="content">
    <div class="block p-20 form-container">
        <form action="#" method="POST">
            <div class="form-control">
                <input type="text" name="nom" value="<?= $nom ?? ''?>" placeholder="First Name" required>
            </div>
            <div class="form-control">
                <input type="text" name="prenom" value="<?= $prenom ?? '' ?>" placeholder="Last Name" required>
            </div>
            <div class="form-control">
                <input type="text" name="pseudonyme" value="<?= $pseudonyme ?? ''?>" placeholder="Pseudonyme" required>
            </div>
            <div class="form-control">
                <input type="email" name="email" value="<?= $email ?? ''?>" placeholder="Email" required>
            </div>
            <?php if($_SERVER['REQUEST_URI'] === '/index.php?page=register'): ?>
            <div class="form-control">
                <input type="password" name="password" placeholder="******" required>
            </div>
            <div class="form-actions">
                <button type="submit">Register</button>
            </div>
            <?php else: ?>
            <div class="form-actions">
                <button type="submit">Edit</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>