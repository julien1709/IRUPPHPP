<?php

$sql = "INSERT INTO data (uuid,num,valeur) VALUES (:uuid, :num, :valeur)";
$getuuid = 'SELECT uuid FROM sondes WHERE uuid = :uuid';

if(isset($_GET['uuid']) && isset($_GET['num']) && isset($_GET['valeur'])) {

    require '../database/connect_to_db.php';

    print $_POST ['uuid'];
    print $_POST ['num'];
    print $_POST ['valeur'];

    $uuid = $_POST ['uuid'];
    $sth = $pdo->prepare($getuuid);
    $sth->execute([':uuid' => $uuid]);
    $data = $sth->fetch();

    print $data;
}


    /*
    if ($data['uuid'] == $uuid) {

        $sth = $pdo->prepare($sql);
        $sth->execute(array(
            ":uuid" => $_POST['uuid'],
            ":num" => $_POST['num'],
            ":valeur" => $_POST['valeur'],
        ));

    } else {
        print 'Unknown';
    }

} else {
    print 'Error';
};


?>
