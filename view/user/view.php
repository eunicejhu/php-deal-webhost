<?php

require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");
require_once("../../src/util/validate.php");

$id_user = $_GET["id_user"] ?? null;


if (!empty($id_user)) {
    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
    $user = $userController->fetchOne($_GET["id_user"]);
}

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../index.css" rel="stylesheet" />

    <title>Deal | Membre</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="wrapper">
        <a href="./list.php" class="btn btn-outline-primary" role="button" ">Retour</a>
        <h1> <?php echo $user['pseudo'] ?></h1>
        <form class=" row g-3" action="" method="POST">
            <p>Id: <?php echo $user['id_membre'] ?></p>
            <p>Email: <?php echo $user['email'] ?></p>
            <p>Nom: <?php echo $user['nom'] ?></p>

            <p>Prénom: <?php echo $user['prenom'] ?></p>
            <p>Téléphone: <?php echo $user['telephone'] ?></p>
            <p>Civilite: <?php echo $user['civilite'] == "f" ? "Femme" : "Homme" ?></p>
            <p>Statut: <?php echo $user['statut'] == "0" ? "User" : "Admin" ?></p>
            <p>Date enregistrement: <?php echo $user['date_enregistrement'] ?></p>
            </form>
    </div>

</body>

</html>