<?php
require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");

require_once("../../src/util/validate.php");

require_once("../../src/controller/UserController.php");
require_once("../../src/model/UserModel.php");

require_once("../../src/controller/CategoryController.php");
require_once("../../src/model/CategoryModel.php");

$id_post = $_GET["id_post"] ?? null;


if (!empty($id_post)) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien",1, "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2);
    $post = $postController->fetchOne($id_post);

    if($post) {
        $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
        $user = $userController->fetchOne($post["membre_id"]);

        $categoryController = new CategoryController("", "");
        $category = $categoryController->fetchOne($post["categorie_id"]);
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

    <title>Deal | Annonce</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="wrapper">
        <a href="https://deal-zuoqin.000webhostapp.com/index.php" class="btn btn-outline-primary" role="button" ">Retour</a>
        <h1 style=" margin: 60px 0;"> <?php echo htmlspecialchars_decode($post['titre']) ?></h1>
            <form class=" row g-3" action="" method="POST">
                <h4> <?php echo htmlspecialchars_decode($post['description_courte']) ?></h4>
                <p>Description: <?php echo htmlspecialchars_decode($post['description_longue']) ?></p>
                <img src="<?php echo $post['photo'] ?>" style="width: 400px;" alt="<?php echo $post['titre']; ?>">
                <p>Prix: <?php echo htmlspecialchars_decode($post['prix']) ?></p>
                <p>Categorie:
                    <?php echo htmlspecialchars_decode($category["titre"]). " | " .htmlspecialchars_decode($category["motscles"]) ?>
                </p>
                <p>Ville: <?php echo htmlspecialchars_decode($post['ville']) ?></p>
                <p>Pays: <?php echo htmlspecialchars_decode($post['pays'] )?></p>
                <p>Membre: <?php echo htmlspecialchars_decode($user['nom']. " ". $user["prenom"]) ?></p>
                <p>Date Enregistrement: <?php echo $post['date_enregistrement'] ?></p>

            </form>
    </div>

</body>



</html>