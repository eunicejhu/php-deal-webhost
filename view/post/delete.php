<?php

require_once("../common/env.php");

require_once("../../src/config/database.php");
require_once("../../src/model/PostModel.php");
require_once("../../src/controller/PostController.php");
require_once("../../src/util/validate.php");

require_once("../../src/model/PhotoModel.php");
require_once("../../src/controller/PhotoController.php");


$id_post = $_GET["id_post"] ?? null;

if ($id_post) {
    $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", 2, "France", "Paris", '11 Avenue Richard', 75003, null);

    $post = $postController->fetchOne($id_post);

    $photoController = new PhotoController("");
    $photoController->delete($post["photo_id"]);

    $postController->delete($id_post);

}

?>