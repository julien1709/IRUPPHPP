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
        header('Location: register.php?info=1');
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (prenom, nom, username, password, email, phone, perm) VALUES (0, 0, :username, :password, :email, 0, 1)";

    $stmt = $pdo->prepare($sql);

    // On associe les valeurs qu'on a mise dans la base de données à celle qu'on récupère grâce à leur name. Cela permet de protéger les données
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
    <link rel="stylesheet" type="text/css" href="../css/u.css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <h2 class="active"> Créer son compte </h2>

        <form action="register.php" method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="Nom d'utilisateur"
                   required>
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail" required>
            <input type="text" id="password" class="fadeIn second" name="password" placeholder="Mot de passe" required>
            <input type="text" id="password" class="fadeIn second" name="password_confirm"
                   placeholder="Confirmation mot de passe" required>
            <input type="submit" class="fadeIn fourth" name="register" value="Créer son compte">
        </form>
        <div id="formFooter">
            <a class="underLineHover" style="color: red">
                <?php
                // On va regarder dans l'adresse de navigation quelle est la valeur de info.
                if (isset($_GET['info'])) {
                    $info = $_GET['info'];
                } else {
                    $info = "";
                }
                if ($info == 1) {
                    echo "Vos mots de passes ne correspondent pas !";
                } ?></a>
            <a class="underlineHover" href="login.php">Connectez-vous dès maintenant</a>
            <!-- <a class="underlineHover" href="changepwd.php">Mot de passe oublié ?</a> -->
        </div>

    </div>
</div>
</body>
</html>