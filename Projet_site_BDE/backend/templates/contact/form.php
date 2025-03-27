<div class="form-container">
    <h2>Contact</h2>
    <form action="/api/contact/send" method="POST" id="contactForm">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
        <input type="hidden" name="honeypot" style="display:none">
        
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Sujet</label>
            <select id="subject" name="subject" required>
                <option value="">Choisir un sujet</option>
                <option value="question">Question générale</option>
                <option value="event">Question sur un événement</option>
                <option value="order">Question sur une commande</option>
                <option value="suggestion">Suggestion</option>
            </select>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" minlength="10" 
                      maxlength="1000" required></textarea>
            <small>10-1000 caractères</small>
        </div>

        <div class="g-recaptcha" data-sitekey="VOTRE_CLE_SITE"></div>
        <div id="submit-status" style="display:none;"></div>

        <button type="submit">Envoyer</button>
    </form>
</div>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    if(this.honeypot.value) return; // Anti-spam
    // Validation et soumission AJAX
});
</script>
