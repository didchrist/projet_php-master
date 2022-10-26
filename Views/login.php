<div class="content">
    <div class="block p-20 form-container">
        <h2>Login</h2>
        <form action="#" method="POST">
            <div class="form-control">
                <input type="email" name="email" value="<?= $email ?? '' ?>" placeholder="Email" required>
            </div>
            <div class="form-control">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Loggin</button>
            </div>
        </form>
    </div>
</div>