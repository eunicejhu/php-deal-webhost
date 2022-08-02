<?php
require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");
require_once("../../src/util/date.php");
require_once("../../src/util/validate.php");


if (!(empty($_POST["titre"]) || empty($_POST["description_courte"]) || empty($_POST["description_longue"]) || empty($_POST["prix"]) || empty($_POST["categorie_id"]) || empty($_POST["photo"]) || empty($_POST["pays"]) || empty($_POST["ville"]) || empty($_POST["adresse"]) || empty($_POST["cp"]))) {
    echo $_COOKIE["logged_id"];

    $postController = new PostController($_POST["titre"], $_POST["description_courte"], $_POST["description_longue"], $_POST["prix"], $_POST["photo"], $_POST["pays"], $_POST["ville"], $_POST["adresse"], $_POST["cp"], null, null, $_POST["categorie_id"]);

    $postController->create();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>FrontOffice / Déposer une announce</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../common/form/style.css" rel="stylesheet" />
    <link rel='stylesheet' type='text/css' media='screen' href='create.css'>
    <script src='../common/checkLoggedIn.js'></script>
    <script src='create.js'></script>
</head>

<body>
    <div id="wrapper">
        <h1>FrontOffice / Déposer une announce</h1>
        <form action="./create.php" method="POST">
            <div class="flex">
                <section>
                    <label for="titre">Titre</label>
                    <input id="titre" name="titre" type="text" placeholder="Titre de l'annonce" required />

                    <label for="description_courte">Description courte</label>
                    <input id="description_courte" name="description_courte" type="text"
                        placeholder="description courte de votre annonce" required />

                    <label for="description_longue">Description longue</label>
                    <input id="description_longue" name="description_longue" type="text"
                        placeholder="description_longue" required />

                    <label for="prix">Prix</label>
                    <input id="prix" name="prix" type="text" placeholder="prix" required />

                    <label for="categorie_id">categorie id</label>
                    <input id="categorie_id" name="categorie_id" type="text" placeholder="categorie_id" required />
                </section>

                <section>
                    <label for="photo">Photo</label>
                    <input id="photo" name="photo" type="text" placeholder="photo" required />

                    <label for="pays">Pays</label>
                    <input id="pays" name="pays" type="text" placeholder="pays" required />

                    <label for="ville">Ville</label>
                    <input id="ville" name="ville" type="text" placeholder="ville" required />

                    <label for="adresse">Adresse</label>
                    <input id="adresse" name="adresse" type="textarea" placeholder="Adresse figurant dnas l'annonce"
                        required />

                    <label for="cp">Code Postal</label>
                    <input id="cp" name="cp" type="text" placeholder="Code Postal dans l'annonce" required />
                </section>
            </div>
            <input type="hidden" name="type" value="create" />
            <a href="./list.php">Retour</a>
            <input type="submit" value="Sauvegarder" />
        </form>
    </div>


</body>

</html>