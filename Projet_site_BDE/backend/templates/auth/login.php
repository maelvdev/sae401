<div class="form-container">
    <h2>Connexion</h2>
    <form action="/api/auth/login" method="POST" id="loginForm">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
        <div class="error-message" id="login-error" style="display:none;"></div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
        <div class="form-help">
            <a href="/reset-password">Mot de passe oublié ?</a>
        </div>
    </form>
</div>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    if(!validateEmail(this.email.value)) {
        document.getElementById('login-error').textContent = 'Email invalide';
        document.getElementById('login-error').style.display = 'block';
        return;
    }
    this.submit();
});
</script>
