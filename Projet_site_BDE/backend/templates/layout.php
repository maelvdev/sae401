<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE IUT Info</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <h1>BDE IUT Info</h1>
            <button class="menu-toggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links">
                <li><a href="/">Accueil</a></li>
                <li><a href="/evenements">Événements</a></li>
                <li><a href="/boutique">Boutique</a></li>
                <li><a href="/contact">Contact</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="/connexion">Connexion</a></li>
                <?php else: ?>
                    <li><a href="/deconnexion">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <?php include $content; ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> BDE IUT Info</p>
    </footer>
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>
