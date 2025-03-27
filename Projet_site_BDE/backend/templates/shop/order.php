<div class="form-container">
    <h2>Commander un produit</h2>
    <form action="/api/orders/create" method="POST" id="orderForm">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
        
        <div class="form-group">
            <label for="quantity">Quantité</label>
            <input type="number" id="quantity" name="quantity" min="1" max="<?= $product['stock'] ?>" required onchange="updateTotal()">
            <small>Stock disponible: <?= $product['stock'] ?></small>
        </div>

        <div class="form-group">
            <label for="size">Taille</label>
            <select id="size" name="size" required>
                <option value="">Choisir une taille</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>

        <div class="form-group">
            <label for="color">Couleur</label>
            <select id="color" name="color" required>
                <option value="">Choisir une couleur</option>
                <option value="noir">Noir</option>
                <option value="blanc">Blanc</option>
                <option value="gris">Gris</option>
            </select>
        </div>

        <div class="form-group">
            <h3>Informations de livraison</h3>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" required>
            
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" required>
            
            <label for="postal_code">Code postal</label>
            <input type="text" id="postal_code" name="postal_code" pattern="[0-9]{5}" required>
        </div>

        <div class="price-summary">
            <p>Prix unitaire: <span id="unit-price"><?= $product['prix'] ?></span>€</p>
            <p>Total: <span id="total-price">0</span>€</p>
        </div>

        <button type="submit">Commander</button>
    </form>
</div>
<script>
function updateTotal() {
    const quantity = document.getElementById('quantity').value;
    const unitPrice = parseFloat(document.getElementById('unit-price').textContent);
    document.getElementById('total-price').textContent = (quantity * unitPrice).toFixed(2);
}
</script>
