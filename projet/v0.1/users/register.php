<?php

@ini_set('display_errors', 'ON');

// Lib de mot de passe + connexion bdd

require 'lib/password.php';

require '../database/connect_to_db.php';

// Récupération du register

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirm'];


    if ($password !== $confirm_password) {
        die("Les mots de passes ne correspondent pas !");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (prenom, nom, username, password, email, phone, perm) VALUES (0, 0, :username, :password, :email, 0, 1)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $hashed_password);

    $stmt->execute();
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Créer son compte</title>
    <link rel="stylesheet" type="text/css" href="assets/u.css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <h2 class="active"> Créer son compte </h2>

<form action="register.php" method="post">
    <input type="text" id="login" class="fadeIn second" name="username" placeholder="Nom d'utilisateur">
    <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail">
    <input type="text" id="password" class="fadeIn second" name="password" placeholder="Mot de passe">
    <input type="text" id="password" class="fadeIn second" name="password_confirm" placeholder="Confirmation mot de passe">
    <input type="submit" class="fadeIn fourth" name="register" value="Créer son compte">
</form>
        <div id="formFooter">
            <a class="underlineHover" href="login.php">Connectez-vous dès maintenant</a>
            <!-- <a class="underlineHover" href="changepwd.php">Mot de passe oublié ?</a> -->
        </div>

    </div>
</div>
</body>
</html>