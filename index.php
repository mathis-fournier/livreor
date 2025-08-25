<?php
ob_start();

$conn = new mysqli("localhost", "root", "", "livreor",3306);

if (isset($_POST['commentaire']))
{
    $commentaire = $_POST['commentaire'];
    $id_utilisateur = $_COOKIE['isConnected'];
    $stmt = $conn->prepare("INSERT INTO commentaires (commentaire,id_utilisateur) values (?, ?)");
    $stmt->bind_param('ss',$commentaire, $id_utilisateur);
    $stmt->execute();
}

    $stmt = $conn->prepare("SELECT c.date, c.commentaire, u.login FROM commentaires c JOIN utilisateurs u ON c.id_utilisateur = u.id ORDER by date DESC;");
    $stmt->execute();
    $result = $stmt->get_result();

if (!isset($_COOKIE['isConnected']))
{
    header("Location: connexion.php");
    exit();
}

if (isset($_POST['envoyer']))
{
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
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
        <input style="width: 35%" type="text" name="commentaire" id="commentaire" placeholder="votre commentaire ici">
        <button style="width: 25%" type="submit" name="envoyer">Envoyer</button>
    </form>
        <table>
            <th style="width: 65%;">Commentaire</th>
            <th style="width: 25%;">Date</th>
            <th style="width: 10%;">Auteur</th>
        <?php
        while ($row = $result->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['commentaire']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['login']) . "</td>";
            echo "</tr>";
        }
        ?>
        </table>
        <?php
        $stmt->close();
        $conn->close();
        ?>

</body>
</html>
<?php
ob_end_flush();