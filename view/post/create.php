<?php
require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");
require_once("../../src/util/date.php");
require_once("../../src/util/validate.php");

require_once("../../src/model/PhotoModel.php");
require_once("../../src/controller/PhotoController.php");

require_once("../../src/model/CategoryModel.php");
require_once("../../src/controller/CategoryController.php");

$logged_id = $_COOKIE["logged_id"] ?? null;

if($logged_id) {
    $categoryController = new CategoryController("", "");
    $categories = $categoryController->fetchAll();
}

if (!empty($_POST["submit"])) {
    switch ($_POST["type"]) {
        case "create": {
                if (!( empty($_POST["titre"]) || empty($_POST["description_courte"]) || empty($_POST["description_longue"]) || empty($_POST["prix"]) || empty($_POST["categorie_id"]) || empty($_POST["photo"]) || empty($_POST["pays"]) || empty($_POST["ville"]) || empty($_POST["adresse"]) || empty($_POST["cp"]) || empty($_POST["photo1"]))) {

                    $photoController = new PhotoController($_POST["photo1"], $_POST["photo2"], $_POST["photo3"], $_POST["photo4"], $_POST["photo5"]);
                   

                    $photo_id = intval($photoController->create());

                   $postController = new PostController($_POST["titre"], $_POST["description_courte"], $_POST["description_longue"], $_POST["prix"], $_POST["photo"], $photo_id, $_POST["pays"], $_POST["ville"], $_POST["adresse"], $_POST["cp"], $logged_id, $_POST["categorie_id"]);

                    $postController->create();   
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
    <link href="./create.css" rel="stylesheet" />
    <script src='../common/checkLoggedIn.js'></script>
    <title>Deal | Déposer une annonce</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>
    <div id="wrapper">
        <a href="./list.php" class="btn btn-outline-primary" role="button">Retour</a>
        <h1>FrontOffice / Déposer une announce</h1>
        <form class="row g-3" action="./create.php" method="POST">
            <div class="col-md-6">
                <label for="titre" class="form-label">Titre</label>
                <input id="titre" class="form-control" name="titre" type="text" placeholder="Titre de l'annonce"
                    required />
            </div>
            <div class="col-md-6">
                <label for="description_courte" class="form-label">Description courte</label>
                <input id="description_courte" name="description_courte" class="form-control" type="text"
                    placeholder="description courte de votre annonce" required />
            </div>

            <div class="col-md-6">
                <label for="description_longue" class="form-label">Description longue</label>
                <input id="description_longue" name="description_longue" class="form-control" type="text"
                    placeholder="description_longue" required />
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix</label>
                <input id="prix" name="prix" type="text" class="form-control" placeholder="prix" required />
            </div>
            <div class="col-md-6">
                <label for="categorie_id" class="form-label">Categorie</label>
                <select id="categorie_id" name="categorie_id" class="form-select" aria-label="Default select example">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["id_categorie"] ?>">
                        <?= htmlspecialchars_decode($category["titre"])." ".htmlspecialchars_decode($category["motscles"]) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="adresse" class="form-label">Adresse</label>
                <input id="adresse" name="adresse" type="textarea" class="form-control"
                    placeholder="Adresse figurant dnas l'annonce" required />
            </div>

            <div class="col-md-4">
                <label for="pays" class="form-label">Pays</label>
                <input id="pays" name="pays" type="text" class="form-control" placeholder="pays" required />
            </div>

            <div class="col-md-4">


                <label for="ville" class="form-label">Ville</label>
                <input id="ville" name="ville" type="text" class="form-control" placeholder="ville" required />
            </div>
            <div class="col-md-4">
                <label for="cp" class="form-label">Code Postal</label>
                <input id="cp" name="cp" type="text" class="form-control" placeholder="Code Postal dans l'annonce"
                    required />
            </div>

            <div class="col-md-4">
                <label for="photo" class="form-label">Photo (obligatoire)</label>
                <input id="photo" name="photo" type="text" class="form-control" placeholder="photo url" required />
            </div>
            <div class="col-md-4">
                <label for="photo1" class="form-label">Photo1 (obligatoire)</label>
                <input id="photo1" name="photo1" type="text" placeholder="photo1" class="form-control" required />
            </div>
            <div class="col-md-4">
                <label for="photo2" class="form-label">Photo2 (optionel)</label>
                <input id="photo2" name="photo2" type="text" placeholder="photo2" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="photo3" class="form-label">Photo3 (optionel)</label>
                <input id="photo3" name="photo3" type="text" placeholder="photo3" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="photo4" class="form-label">Photo4 (optionel)</label>
                <input id="photo4" name="photo4" type="text" placeholder="photo4" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="photo5" class="form-label">Photo5 (optionel)</label>
                <input id="photo5" name="photo5" type="text" placeholder="photo5" class="form-control" />
            </div>

            <div class="col-12">
                <input type="hidden" name="type" value="create" />

                <input type="submit" name="submit" class="btn btn-primary" value="Sauvegarder" />
            </div>
        </form>

    </div>


</body>

</html>