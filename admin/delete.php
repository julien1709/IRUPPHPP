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

    $uuid = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM sondes WHERE uuid = :uuid");
    $stmt->bindValue(':uuid', $uuid);
    $stmt->execute();

    header('Location: admin.php');

?>

