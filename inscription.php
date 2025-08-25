<?php
$conn = new mysqli("localhost", "root", "", "livreor",3306);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
    inscription();
}
function inscription(){
if (isset($_POST['login'])&& isset($_POST['password'])){
    $login= $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    global $conn;
        $check = $conn->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $check->bind_param("s", $login);
        $check->execute();
        $check->store_result();
        if ($check->num_rows >0){
        echo 'utlisateur existe déja';
    }
    else
        {
         $stmt = $conn->prepare("INSERT INTO utilisateurs (login,password) values (?, ?)");
         $stmt->bind_param('ss',$login, $password);
        if ($stmt->execute() === true){
             header("Location: connexion.php");
             exit();
            
        }   
        else{
            header("location: inscription.php?error=1");
            exit();
        } 
        }
    

}}
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
        
        <h2>Inscription</h2>
        <form method="post" >
            <div class="input-group">
                <label for="login" >Login</label>
                <input type="text" id="login" name="login" required>
            </div>
             <div class="input-group">
                <label for="password">password</label>
                <input type="text" id="password" name="password" required>
            </div>
            <button type="submit" name="inscription">s'inscrire</button>
            <a class="register-link" href="connexion.php">Se connecter</a>
        </form>
    </div>
</body>
</html>
