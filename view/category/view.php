<?php
require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/CategoryModel.php");
require_once("../../src/controller/CategoryController.php");
require_once("../../src/util/validate.php");

$id_category = $_GET["id_category"] ?? null;


if (!empty($id_category)) {
    $categoryController = new CategoryController("", "");
    $category = $categoryController->fetchOne($id_category);
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

    <title>Deal | Categorie</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="wrapper">
        <a href="./list.php" class="btn btn-outline-primary" role="button" ">Retour</a>
        <h1 style=" margin: 60px 0;"> Deal | Categorie</h1>
            <form class=" row g-3" action="" method="POST">
                <p>Id: <?php echo $category['id_categorie'] ?></p>
                <p>Titre: <?php echo $category['titre'] ?></p>
                <p>Mots clés: <?php echo $category['motscles'] ?></p>
            </form>
    </div>

</body>

</html>