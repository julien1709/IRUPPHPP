<?php

    @ini_set('display_errors', 'ON');

    /* Dépendance de la page */

    require '../database/connect_to_db.php';

    /* Vérification de la connectivité de la page */

    session_start();

    if(empty($_SESSION['user_is_connect']) || $_SESSION['user_is_connect'] !== true){
        session_destroy();
        header('Location: login.php?info=3');
    }

    /* Get user info */

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");

    $stmt->bindValue(':id', $_SESSION['user_id']);

    $stmt->execute();

    $user_info = $stmt->fetch();


?>
<html>
<head>
    <title>Bienvenue sur votre profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h3></h3>
    <a>Votre nom d'utilisateur est : <?php echo $user_info['username']; ?></a>
</body>
</html>
