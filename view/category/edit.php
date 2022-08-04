<?php

require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/CategoryModel.php");
require_once("../../src/controller/CategoryController.php");
require_once("../../src/util/validate.php");

if(!empty($_GET["id_category"])) {
    $categoryController = new CategoryController("", "");    
    $category = $categoryController->fetchOne($_GET["id_category"]);
}


const DEFAULT_STATUT = 0; // user
$error = $_GET["error"] ?? false;

$isValidTelephone = true;
$isValidMdp = true;

if (!empty($_POST["submit"])) {
    switch ($_POST["type"]) {
        case "update_category": {
                if (!(empty($_GET["id_category"]) || empty($_POST["titre"]) || empty($_POST["motscles"]))) {
                        $categoryController = new CategoryController($_POST["titre"], $_POST["motscles"]);
                        $categoryController->update($_GET["id_category"]);
                }
                break;
            }
    }
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
    <link href="./edit.css" rel="stylesheet" />
    <script src='/deal/view/category/edit.js'></script>
    <title>Deal | Gestion des categories</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>
    <div id="edit">
        <h1>Modifier</h1>

        <form class="row g-3 needs-validation" novalidate
            action="./edit.php?id_category=<?php echo $_GET["id_category"] ?>" method="POST">
            <div class="col-md-12">
                <p class="invalid">
                    <?php echo $error; ?>
                </p>
            </div>
            <div class="col-md-6">
                <label for="titre" class="form-label">Titre</label>
                <input id="titre" class="form-control" name="titre" value="<?php echo $category['titre']?>" type="text"
                    placeholder="titre" required />
            </div>

            <div class="col-md-6">
                <label for="motscles" class="form-label">Mots clés</label>
                <input id="motscles" class="form-control" name="motscles"
                    value="<?php echo htmlspecialchars_decode($category['motscles'])?>" type="text"
                    placeholder="motscles" required />
            </div>



            <div class="col-12 ">
                <input type="hidden" name="type" value="update_category" />
                <a href="./list.php" class="btn btn-outline-primary" role="button">Retour</a>
                <input name=" submit" type="submit" class="btn btn-primary" value="Sauvegarder" />


            </div>
        </form>

    </div>

</body>

</html>