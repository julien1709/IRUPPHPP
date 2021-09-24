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

    $stmt = $pdo->prepare("SELECT * FROM users AS id WHERE id = :id");

    $stmt->bindValue(':id', $_SESSION['user_id']);

    $stmt->execute();

    $user_info = $stmt->fetch();


?>
<html>
<head>
    <title>Bienvenue sur votre profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $_SESSION['prenom']; ?></h6>
                                <p><?php echo $_SESSION['nom']; ?></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16" onclick="location.href='profile.edit.php?id=<?php echo $_SESSION['user_id']; ?>'"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['email']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['phone']; ?></h6>
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Complémentaires</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Pseudo</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['username']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Permissions</p>
                                        <h6 class="text-muted f-w-400"><?php if($_SESSION['perm'] == 1) {echo "Utilisateur"; }else{ echo "Administrateur"; }?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>