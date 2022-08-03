<?php

require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");
require_once("../../src/util/validate.php");

$id_post = $_GET["id_post"] ?? null;


if (!empty($id_post)) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien",1, "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2);
    $post = $postController->fetchOne($id_post);
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

    <title>Deal | Annonce</title>
</head>

<body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="wrapper">
        <a href="../../index.php" class="btn btn-outline-primary" role="button" ">Retour</a>
        <h1> <?php echo $post['titre'] ?></h1>
        <form class=" row g-3" action="./create.php" method="POST">
            <p>Description: <?php echo $post['description_longue'] ?></p>
            <p>Prix: <?php echo $post['prix'] ?></p>

            <img src="<?php echo $post['photo'] ?>" width="400" height="400" alt="<?php echo $post['titre']; ?>">

            <p>categorie_id: <?php echo $post['categorie_id'] ?></p>
            <p>Ville: <?php echo $post['ville'] ?></p>
            <p>Pays: <?php echo $post['pays'] ?></p>
            <p>membre_id: <?php echo $post['membre_id'] ?></p>
            <p>date_enregistrement: <?php echo $post['date_enregistrement'] ?></p>

            </form>
    </div>



</body>

</html>