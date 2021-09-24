<?php

    @ini_set('display_errors', 'ON');

    /* Dépendance de la page */

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

    /** Récupération du post */

    if(isset($_POST['submit'])){

        if(empty($_POST['prenom'])){
            $prenom = $user_info['prenom'];
        }else{
            $prenom = $_POST['prenom'];
        }

        if(empty($_POST['nom'])){
            $nom = $user_info['nom'];
        }else{
            $nom = $_POST['nom'];
        }

        if(empty($_POST['email'])){
            $email = $user_info['email'];
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['phone'])){
            $phone = $user_info['phone'];
        }else{
            $phone = $_POST['phone'];
        }

        $modif = $pdo->prepare('UPDATE users SET prenom = :prenom, nom = :nom, email = :email, phone = :phone WHERE id = :id');
        $modif->bindValue(':prenom', $prenom);
        $modif->bindValue(':nom', $nom);
        $modif->bindValue(':email', $email);
        $modif->bindValue(':phone', $phone);
        $modif->bindValue(':id', $_SESSION['user_id']);
        $rsult = $modif->execute();
        if($rsult){
            header("Location: profile.edit.php?id=" . $_SESSION['user_id'] . "&n=1");
        }else{
            header("Location: profile.edit.php?id=" . $_SESSION['user_id'] . "&n=2");
        }

    }


?>
<html>
<head>
    <title>Modification du profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
    <link rel="stylesheet" href="../css/profile.edit.css">
</head>
<body>
    <div class="container">
        <form id="contact" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <h3>Modification de profil</h3>
            <h4>Modifier les champs ci-dessous</h4>
            <fieldset>
                <input placeholder="<?php echo $_SESSION['prenom']; ?>" type="text" name="prenom" tabindex="1" autofocus>
            </fieldset>
            <fieldset>
                <input placeholder="<?php echo $_SESSION['nom']; ?>" type="text" name="nom" tabindex="2">
            </fieldset>
            <fieldset>
                <input placeholder="<?php echo $_SESSION['email']; ?>" type="email" name="email" tabindex="3">
            </fieldset>
            <fieldset>
                <input placeholder="<?php echo $_SESSION['phone']; ?>" type="tel" name="phone" tabindex="4">
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Modifier les informations</button>
            </fieldset>
            <h3>
                <?php if(empty($_GET['n']) || !isset($_GET['n']))
                {
                    echo "";
                } elseif($_GET['n'] == 1){
                    echo "Modification prise en compte";
                }else{
                    echo "Erreur lors des modifications, merci de réessayer !";
                }
                ?>
            </h3>
        </form>
    </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
