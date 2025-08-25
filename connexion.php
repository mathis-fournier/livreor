<?php
$conn = new mysqli("localhost", "root", "", "livreor",3306);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    connexion();
}

if (isset($_COOKIE['isConnected']))
{
    header("Location: index.php");
    exit();
}
function connexion(){
    global $conn;
    if (isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0)
            {
           $stmt->bind_result($id, $login_db, $password_hash);
            $stmt->fetch();
            if (password_verify($password, $password_hash)){
                echo 'connexion';
                session_start();
                $_SESSION['user_id'] = $id;
                setcookie("isConnected", $id, time() + (86400), "/");
                header("Location: index.php");
                exit();
            } 
            else 
            {
                echo 'Mot de passe incorrect';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        
        <h2>Connexion</h2>
        <form method="post" action="connexion.php">
            <div class="input-group">
                <label for="login" >Login</label>
                <input type="text" id="login" name="login" required>
            </div>
            
             <div class="input-group">
                <label for="password">password</label>
                <input type="text" id="password" name="password" required>
            </div>
            <button type="submit" name="connexion">Se connecter</button>
        </form>
        <a class="register-link" href="inscription.php">Créer un compte</a>
    </div>
</body>
</html>