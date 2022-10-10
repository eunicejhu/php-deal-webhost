<?php
// TODO: clean css file, clean list.js list.php of post
// TODO: reset isAdmin
// TODO: adapt <a> href when deploy
// TODO: when table has no items, should we hide it?
// TODO: category show error in Bootstrap style
// TODO: do category view.php
// TODO: auth on controller!, if user are deleted, the logged user shoud be logged out

define('PAGE_LIMIT', 10);
define('CURRENT_PAGE_DEFAULT', 1);


require("./src/util/DotEnv.php");
(new DotEnv(".env"))->load();

require_once("./src/util/validate.php");

require_once("./src/config/database.php");
require_once("./src/model/PostModel.php");
require_once("./src/controller/PostController.php");

require_once("./src/controller/UserController.php");
require_once("./src/model/UserModel.php");

require_once("./src/controller/CategoryController.php");
require_once("./src/model/CategoryModel.php");





$logged_id = $_COOKIE["logged_id"] ?? null;
$isUser = isset($_COOKIE["logged_id"]) && $_COOKIE["login"];



$postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", 1, "France", "Paris", '11 Avenue Richard', 75003, null, 1);
$posts = $postController->fetchPage($_GET["currentPage"] ?? CURRENT_PAGE_DEFAULT, PAGE_LIMIT);

$postsTotalCount = count($postController->fetchAll());

$nbPages = $postsTotalCount > 0 ? ceil($postsTotalCount / PAGE_LIMIT) : 1;
$currentPage = $_GET["currentPage"] ?? CURRENT_PAGE_DEFAULT;

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-commerce website for Apple products">


    <!-- Primary Meta Tags -->
    <title>Deal | Price tag platform for Apple products</title>
    <meta name="title" content="Deal — Price tag platform for Apple products">
    <meta name="description"
        content="e-commerce website for Apple products. iMac, Macbook Pro, iPhone, Apple Watch, Magic Mouse etc">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://deal-zuoqin.000webhostapp.com/">
    <meta property="og:title" content="Deal — Price tag platform for Apple products!">
    <meta property="og:description"
        content="E-commerce website for Apple products. iMac, Macbook Pro, iPhone, Apple Watch, Magic Mouse etc">
    <meta property="og:image" content="./assets/img/deal-apple.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://deal-zuoqin.000webhostapp.com/">
    <meta property="twitter:title" content="Deal — Price tag platform for Apple products!">
    <!-- <meta property="twitter:site" content="" > -->
    <meta property="twitter:creator" content="@eunicejhu">
    <meta property="twitter:description"
        content="E-commerce website for Apple products. iMac, Macbook Pro, iPhone, Apple Watch, Magic Mouse etc">
    <meta property="twitter:image" content="./assets/img/deal-apple.png">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./index.css" rel="stylesheet" />


</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="./index.js"></script>
    <?php include_once("./view/common/nav.php")?>
    <div id="pagination" class="sticky-top col-ms-6 offset-ms-6 col-md-6 offset-md-6 col-6 offset-6">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if ($currentPage - 1 > 0) { ?>
                <li class="page-item"><a class="page-link"
                        href="./index.php?currentPage=<?php echo $currentPage - 1; ?>">Précedent</a>
                </li>
                <?php
}
else { ?>
                <li class="page-item disabled"><a class="page-link" aria-disabled="true" href="#">Précedent</a></li>
                <?php
}?>
                <?php if ($currentPage + 1 <= $nbPages) { ?>
                <li class="page-item "><a class="page-link"
                        href="./index.php?currentPage=<?php echo $currentPage + 1; ?>">Suivante</a>
                </li>
                <?php
}
else { ?>
                <li class="page-item disabled"><a class="page-link" aria-disabled="true" href="#">Suivante</a>
                </li>
                <?php
}?>

            </ul>
        </nav>
    </div>
    <div>

        <?php foreach ($posts as $post): ?>

        <div class="card mb-12" style="max-width: 800px; margin: 0 auto;">
            <a class="item" href="./view/post/view.php?id_post=<?php echo $post['id_annonce']?>">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo $post['photo']?>"
                            style="padding: 20px; width: 200px; height: 220px;object-fit: contain;"
                            class="img-fluid rounded-start" alt="<?php echo $post['titre']; ?>">
                    </div>
                    <div class="col-md-8 verticle-middle">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars_decode($post["titre"])?>
                            </h5>
                            <p class="card-text">
                                <?= htmlspecialchars_decode($post["description_courte"])?>
                            </p>
                            <p class="card-text"><small class="text-muted">
                                    <?= htmlspecialchars_decode($post["prix"])?>
                                </small></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>



        <?php
endforeach; ?>


    </div>



</body>

<?php require_once("./view/common/footer.php")?>

</html>