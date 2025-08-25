<?php
ob_start();
if (!isset($_COOKIE['isConnected']))
{
    header("Location: connexion.php");
    exit();
}
function logout()
{
    setcookie("isConnected", "", time() - 3600, "/");
    header("Location: connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['logout'])) {
   logout();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1>Commentaires</h1>
    <form action="" method="post">
        <input type="text" name="text" id="" placeholder="text">
        <input type="submit" name="logout" id="logout" value="Se deconnecter">

    </form>
    <?php
    var_dump($_POST);

    ?>
</body>
</html>
<?php
ob_end_flush();