<?php

require_once("../common/env.php");

require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");

require_once("../../src/controller/UserController.php");
require_once("../../src/model/UserModel.php");

require_once("../../src/controller/CategoryController.php");
require_once("../../src/model/CategoryModel.php");

require_once("../../src/util/validate.php");



$logged_id = $_COOKIE["logged_id"] ?? null;


$offset = $_GET["offset"] ?? 0;
$isAdmin = $_COOKIE["is_admin"] ?? false;

$isUser = isset($_COOKIE["logged_id"]) && $_COOKIE["login"];


$posts = [];


if($isAdmin) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", 1, "France", "Paris", '11 Avenue Richard', 75003, null, 1);   
    $posts = $postController->fetchPage($_GET["offset"] ?? 0);
} else if($isUser) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", 1, "France", "Paris", '11 Avenue Richard', 75003, null, 1);
    $posts = $postController->fetchPageForUser($logged_id, $_GET["offset"] ?? 0 );
}

$nbPages = $_COOKIE["nbPages"] ?? 1;

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
    <link href="./list.css" rel="stylesheet" />
    <title>Deal</title>
</head>

<body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <?php include_once("../../view/common/nav.php") ?>
    <h1>Deal | Gestion des annonces</h1>
    <div id="pagination" class="sticky-top col-6 offset-md-6">


        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if ($offset - 1 >= 0) { ?>
                <li class="page-item"><a class="page-link"
                        href="./list.php?offset=<?php echo $offset - 1; ?>">Précedent</a>
                </li>
                <?php
}
else { ?>
                <li class="page-item disabled"><a class="page-link" aria-disabled="true" href="#">Précedent</a></li>
                <?php
}?>
                <?php if ($offset + 1 < $nbPages) { ?>
                <li class="page-item "><a class="page-link"
                        href="./list.php?offset=<?php echo $offset + 1; ?>">Suivante</a>
                </li>
                <?php
}
else { ?>
                <li class="page-item disabled"><a class="page-link" aria-disabled="true" href="#">Suivante</a></li>
                <?php
}?>

            </ul>
        </nav>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <td>id annonce</td>
                    <td>titre</td>
                    <td>description courte</td>
                    <td>description longue</td>
                    <td>prix</td>
                    <td>photo</td>
                    <td>pays</td>
                    <td>ville</td>
                    <td>adresse</td>
                    <td>cp</td>
                    <td>membre</td>
                    <td>categorie</td>
                    <td>date enregistrement</td>
                    <td>actions</td>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post["id_annonce"] ?></td>
                    <td>
                        <div><?= htmlspecialchars_decode($post["titre"]) ?></div>
                    </td>
                    <td>
                        <div><?= htmlspecialchars_decode($post["description_courte"])?></div>
                    </td>
                    <td>
                        <div><?= htmlspecialchars_decode($post["description_longue"])?></div>
                    </td>
                    <td>
                        <div><?= htmlspecialchars_decode($post["prix"])?></div>
                    </td>
                    <td>
                        <div><img src="<?php echo $post['photo'] ?>" width="200" height="200"
                                alt="<?php echo $post['titre']; ?>"></div>
                    </td>
                    <td> <?= htmlspecialchars_decode($post["pays"])?></td>
                    <td> <?= htmlspecialchars_decode($post["ville"])?></td>
                    <td>
                        <div><?= htmlspecialchars_decode($post["adresse"])?></div>
                    </td>
                    <td> <?= $post["cp"]?></td>
                    <td>
                        <?php

                        $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
                        $user = $userController->fetchOne($post["membre_id"]);
                        
                       
                    ?>
                        <?php if($user): ?>
                        <a class="nav-link"
                            href="/deal/view/user/view.php?id_user=<?php echo $user["id_membre"] ?>"><?php echo  $user["prenom"] . " " . $user["nom"] ?>
                        </a>
                        <?php endif; ?>

                    </td>

                    <td>
                        <?php
                        $categoryController = new CategoryController("", "");
                        $category = $categoryController->fetchOne($post["categorie_id"]);
                    ?>
                        <?php if($category): ?>
                        <a class="nav-link"
                            href="/deal/view/category/view.php?id_category=<?php echo $category["id_categorie"] ?>"><?php echo  $category["titre"] ?>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td><?= $post["date_enregistrement"] ?></td>
                    <td>

                        <?php if($isAdmin || ($logged_id == $post["membre_id"] && !is_null($post["membre_id"]))):  ?>
                        <a href="/deal/view/post/edit.php?id_post=<?php echo $post["id_annonce"]; ?>"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a>
                        <a href="/deal/view/post/delete.php?id_post=<?php echo $post["id_annonce"]; ?>"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                            </svg></a>
                        <?php endif; ?>
                        <a href="/deal/view/post/view.php?id_post=<?php echo $post["id_annonce"]; ?>">
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



</body>

</html>