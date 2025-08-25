<?php
ob_start();

if (!isset($_COOKIE['isConnected']))
{
    header("Location: connexion.php");
    exit();
}

$commentaire = $_POST['commentaire'];
var_dump($commentaire);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="menu">
                <button class="menu-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Utilisateur" class="user-icon">
                </button>
                <div class="dropdown-content">
                    <?php if (isset($_COOKIE['isConnected'])): ?>
                        <a href="profil.php">Profil</a>
                        <a href="logout.php">Se déconnecter</a>
                    <?php else: ?>
                        <a href="inscription.php">S'inscrire</a>
                        <a href="logout.php">Se connecter</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>


    <!-- commentaires -->
    <h1>Commentaires</h1>
    <form action="" method="post">
        <input type="text" name="commentaire" id="commentaire" placeholder="votre commentaire ici">
        <button type="submit" name="connexion">Envoyer</button>
    </form>
    <?php
    
    ?>

    
</body>
</html>
<?php
ob_end_flush();