<?php

@ini_set('display_errors', 'on');

if(isset($_POST['validate'])){
    executeSQLWithButton();
}

$sql = "INSERT INTO data (uuid, nom, value) VALUES (:uuid, :nom, :value)";

// On va checker que cette url n'est pas appelé en get par un arduino directement
if (isset($_GET['uuid']) && isset($_GET['nom']) && isset($_GET['value'])) {

    include_once $_SERVER['DOCUMENT_ROOT'] . '/database/connect_to_db.php';

    $uuid = $_GET['uuid'];
    $nom = $_GET['nom'];
    $value = $_GET['value'];

    $stmt = $pdo->prepare($sql);

    bindValuesForInsertSql($uuid, $nom, $value, $stmt);

    $stmt->execute();
}

function executeSQLWithButton() {

    include_once $_SERVER['DOCUMENT_ROOT'] . '/database/connect_to_db.php';

    $sql = "INSERT INTO data (uuid, nom, value) VALUES (:uuid, :nom, :value)";

    if (isset($_POST['validate'])) {
        if (isset($_POST['uuid']) && isset($_POST['nom']) && isset($_POST['value'])) {
            $uuid = $_POST['uuid'];
            $nom = $_POST['nom'];
            $value = $_POST['value'];
        }

        $stmt = $pdo->prepare($sql);

        // On associe les valeurs qu'on a mise dans la base de données à celle qu'on récupère grâce à leur name. Cela permet de protéger les données
        bindValuesForInsertSql($uuid, $nom, $value, $stmt);

        $stmt->execute();
    }
}

function bindValuesForInsertSql($uuid, $nom, $valeur, $stmt) {
    $stmt->bindValue(':uuid', $uuid);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':value', $valeur);
}

?>

<?php
    if (isset($_POST['validate']) === false) {
        echo '
<div class="card" style="width: 18rem;">
    <div class="card-header">
        <h5 class="card-title">Envoyer une donnée</h5>
    </div>
    <div class="card-body">
        <a class="card-text">
            <form action="../home/addDataValueIntoDB.php" method="post" class="form-text">
                <input name="uuid" placeholder="uuid" type="text">
                <input name="nom" placeholder="nom" type="text">
                <input name="value" placeholder="valeur" type="text">
                <button name="validate" type="submit" class="btn btn-primary" style="margin-top: 5px">Envoyer</button>
            </form>
        </a>
    </div>
</div>';
    }

?>