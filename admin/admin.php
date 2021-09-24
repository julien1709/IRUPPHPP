<?php

    @ini_set('display_errors', 'ON');

    require '../database/connect_to_db.php';

    /* Vérification de la connectivité de la page */

    // Récupère les infos de la session du login
    session_start();

    if(empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
        session_destroy();
        header('Location: login.php');
    }

    /* Get user info */

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");

    $stmt->bindValue(':id', $_SESSION['user_id']);

    $stmt->execute();

    $user_info = $stmt->fetch();

    /** Get arduino infos */

    $stmt = $pdo->prepare("SELECT * FROM sondes ORDER BY number_capteur DESC");

    $stmt->execute();

    $arduino_info = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/logo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Dashboard Arduino</title>
</head>
<body class="container-fluid">
<?php include_once("../navBar.php"); ?>
<div class="row">
    <?php

        foreach ($arduino_info as $arduino){
            ?>

            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $arduino['number_capteur']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $arduino['uuid']; ?></p>
                    <p class="card-text"><?php echo $arduino['type']; ?></p>
                    <p class="card-text">Valeur : <?php echo $arduino['value']; ?></p>
                    <button type="button" class="btn btn-primary" onclick="location.href='delete.php?id=<?php echo $arduino['uuid']; ?>'">Supprimer</button>
                </div>
            </div>

            <?php
        }

    ?>
    <img src="../assets/Logo-IRUP.jpg" class="logoIrup">
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
