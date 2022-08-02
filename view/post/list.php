<?php


require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");
require_once("../../src/util/validate.php");


$offset = $_GET["offset"] ?? 0;
echo "offset: ". $offset;
if (!empty($_COOKIE["logged_id"])) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2);
    $posts = $postController->fetchPage($_GET["offset"] ?? 0);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Backoffice / Gestion des annonces</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='./list.js'></script>
    <script src='../common/checkLoggedIn.js'></script>
</head>

<body>
    <h1>Backoffice / Gestion des annonces</h1>
</body>

<a href="./create.php">Ajouter une annonce</a>

<div>

    <table>
        <thead>
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

        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post["id_annonce"] ?></td>
            <td><?= $post["titre"] ?></td>
            <td> <?= $post["description_courte"]?></td>
            <td> <?= $post["description_longue"]?></td>
            <td> <?= $post["prix"]?></td>
            <td><?= $post["photo"] ?></td>
            <td> <?= $post["pays"]?></td>
            <td> <?= $post["ville"]?></td>
            <td> <?= $post["adresse"]?></td>
            <td> <?= $post["cp"]?></td>
            <td><?= $post["membre_id"] ?></td>
            <td><?= $post["categorie_id"] ?></td>
            <td><?= $post["date_enregistrement"] ?></td>
            <td> <a href="./edit.php?id_post=<?php echo $post["id_annonce"]; ?>">Editer</a>
                <a href="./delete.php?id_post=<?php echo $post["id_annonce"]; ?>">Supprimer</a>
                <a href="./view.php?id_post=<?php echo $post["id_annonce"]; ?>">Voir</a>
            </td>

        </tr>
        <?php endforeach; ?>
    </table>
    <?php if($offset - 1 >= 0 ) {?>
    <a href="./list.php?offset=<?php echo $offset - 1; ?>">Précedent</a>
    <?php }?>
    <?php if($offset + 1 < $_COOKIE['nbPages'] ) {?>
    <a href="./list.php?offset=<?php echo $offset + 1; ?>">Suivant</a>
    <?php }?>

</div>
<input type="hidden" name="id_user" id="id_user" />

</html>