const API_URL = 'http://localhost:8000';

// Fonction pour charger le contenu dynamiquement
async function loadContent(path) {
    try {
        const response = await fetch(`${API_URL}${path}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur:', error);
        return null;
    }
}

// Gestionnaire de routes simple
function handleRoute() {
    const hash = window.location.hash || '#accueil';
    const app = document.getElementById('app');
    const forms = document.getElementById('forms');
    
    // Cacher tous les formulaires par défaut
    forms.style.display = 'none';
    
    switch(hash) {
        case '#accueil':
            app.innerHTML = '<h2>Bienvenue sur le site du BDE</h2>';
            break;
            
        case '#evenements':
            loadContent('/api/events')
                .then(events => {
                    app.innerHTML = `
                        <h2>Événements à venir</h2>
                        <div class="events-grid">
                            ${events.map(event => `
                                <div class="event-card">
                                    <h3>${event.titre}</h3>
                                    <p>${event.description}</p>
                                    <p>Date: ${new Date(event.dateEvenement).toLocaleDateString()}</p>
                                </div>
                            `).join('')}
                        </div>
                    `;
                });
            break;
            
        case '#boutique':
            loadContent('/api/products')
                .then(products => {
                    app.innerHTML = `
                        <h2>Notre boutique</h2>
                        <div class="products-grid">
                            ${products.map(product => `
                                <div class="product-card">
                                    <h3>${product.nom}</h3>
                                    <p>${product.description}</p>
                                    <p>Prix: ${product.prix}€</p>
                                    <button onclick="showOrderForm(${product.id})">Commander</button>
                                </div>
                            `).join('')}
                        </div>
                    `;
                });
            break;
            
        case '#contact':
            forms.style.display = 'block';
            document.getElementById('contactForm').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('orderForm').style.display = 'none';
            break;
    }
}

// Fonction utilitaire pour afficher le formulaire de commande
function showOrderForm(productId) {
    const forms = document.getElementById('forms');
    forms.style.display = 'block';
    const orderForm = document.getElementById('orderForm');
    orderForm.style.display = 'block';
    orderForm.querySelector('select[name="produit"]').value = productId;
}

// Écouteur d'événements pour le changement de route
window.addEventListener('hashchange', handleRoute);
window.addEventListener('load', handleRoute);

// Fonction pour envoyer une requête sécurisée
async function sendSecureRequest(url, formData) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('csrf_token', csrfToken);
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            credentials: 'include'
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('Erreur:', error);
        throw error;
    }
}

// Gestionnaire de formulaires
function handleForms() {
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        try {
            const formData = new FormData(e.target);
            const data = await sendSecureRequest(`${API_URL}/api/login`, formData);
            
            if (data.success) {
                localStorage.setItem('user', JSON.stringify(data.user));
                handleRoute();
            } else {
                alert(data.error || 'Erreur de connexion');
            }
        } catch (error) {
            alert('Erreur lors de la connexion');
        }
    });

    document.getElementById('orderForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        try {
            const data = await sendSecureRequest(`${API_URL}/api/commande`, formData);
            alert(data.success ? 'Commande effectuée!' : 'Erreur');
        } catch (error) {
            alert('Erreur lors de la commande');
        }
    });
}

handleForms();
