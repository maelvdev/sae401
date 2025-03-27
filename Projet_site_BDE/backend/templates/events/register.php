<div class="form-container">
    <h2>Inscription à l'événement</h2>
    <?php if (!isAdhérent()): ?>
        <div class="alert alert-warning">Vous devez être adhérent pour vous inscrire aux événements.</div>
    <?php else: ?>
    <form action="/api/events/register" method="POST" id="eventRegisterForm">
        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
        
        <div class="form-group">
            <label for="nb_participants">Nombre de participants</label>
            <input type="number" id="nb_participants" name="nb_participants" 
                   min="1" max="<?= $event['max_participants'] - $event['nb_inscrits'] ?>" required>
            <small>Places restantes: <?= $event['max_participants'] - $event['nb_inscrits'] ?></small>
        </div>

        <?php if ($event['prix'] > 0): ?>
            <div class="form-group">
                <h3>Informations de paiement</h3>
                <label for="card_number">Numéro de carte</label>
                <input type="text" id="card_number" name="card_number" pattern="[0-9]{16}" required>
                
                <div class="card-details">
                    <label for="expiry">Date d'expiration</label>
                    <input type="text" id="expiry" name="expiry" pattern="[0-9]{2}/[0-9]{2}" placeholder="MM/YY" required>
                    
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" required>
                </div>
            </div>
        <?php endif; ?>
        
        <button type="submit">Confirmer l'inscription</button>
    </form>
    <?php endif; ?>
</div>
