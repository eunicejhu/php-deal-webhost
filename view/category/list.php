<?php
require_once("../common/env.php");
require_once("../../src/util/DotEnv.php");
require_once("../../src/config/database.php");
require_once("../../src/model/CategoryModel.php");
require_once("../../src/controller/CategoryController.php");
require_once("../../src/util/validate.php");

$isAdmin = $_COOKIE["is_admin"] ?? false;
// 1. check user role
if ($isAdmin) {
   
    $categoryController = new CategoryController("", "");
    $categories = $categoryController->fetchAll();
}

// 2. Form submit


$error = $_GET["error"] ?? false;

if(!empty($_POST["submit"])) {
    switch($_POST["type"]) {
        case "create_category": {
                if (!(empty($_POST["titre"]) || empty($_POST["motscles"]))) {
                    echo " create_category";

                    $categoryController = new CategoryController($_POST["titre"], $_POST["motscles"]);
                        $categoryController->create();
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
    <link href="./list.css" rel="stylesheet" />
    <script src='/deal/view/category/list.js'></script>
    <title>Deal | Gestion des categories</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="category">
        <a href="/deal/index.php" class="btn btn-outline-primary" role="button" ">Retour</a>
        <h1>Deal | Gestion des membre</h1>


        <div class=" table-responsive col-md-12">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <td>id categorie</td>
                        <td>titre</td>
                        <td>motscles</td>
                        <td>actions</td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category["id_categorie"] ?></td>
                        <td><?= $category["titre"] ?></td>
                        <td> <?= htmlspecialchars_decode($category['motscles']) ?></td>
                        <td>
                            <a href="./edit.php?id_category=<?php echo $category["id_categorie"]; ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a>
                            <a href="./delete.php?id_category=<?php echo $category["id_categorie"]; ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg></a>

                            <a href="./view.php?id_category=<?php echo $category["id_categorie"]; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg></a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>

    <form class="row g-3 needs-validation" novalidate action="/deal/view/category/list.php?" method="POST">
        <div class="col-md-12">
            <p class="invalid">
                <?php echo $error; ?>
            </p>
        </div>
        <div class="col-md-12">
            <label for="titre" class="form-label">Titre</label>
            <input id="titre" class="form-control" name="titre" value="<?php echo $category['titre']?>" type="text"
                placeholder="titre" value="" required />
        </div>
        <div class="col-md-12">
            <label for="motscles" class="form-label">motscles</label>
            <input id="motscles" value="<?php echo htmlspecialchars_decode($category['motscles']); ?>" name="motscles"
                class="form-control" type="text" placeholder="motscles" value="" required />
        </div>


        <div class="col-12">
            <input type="hidden" name="type" value="create_category" />
            <input name="submit" type="submit" class="btn btn-primary" value="Créer" />
        </div>
    </form>
    </div>

</body>

</html>