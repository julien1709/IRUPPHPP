<?php

ini_set('display_errors', 'on');

// On récupère la connexion à la BDD
require '../database/connect_to_db.php';


// Requête pour récupèrer le nombre de sondes qu'on stocke sous "app_connect".
$stmt = $pdo->prepare("SELECT COUNT(uuid) AS app_connect FROM sondes");
$stmt->execute();
$result = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr-FR" style="background-color: lightgreen;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/logo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Dashboard Arduino</title>
</head>
<body class="container-fluid">
<?php include_once("../navBar.php"); ?>
<div class="row" style="background-color: lightgreen;">
    <?php include_once("../home/cardAppereilsOn.php"); ?>
    <?php include_once("../home/addDataValueIntoDB.php"); ?>
    <img src="../assets/Morpheus.png" class="logoMorpheus">
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>