<?php
require_once("../../src/config/database.php");
require_once("../../src/model/CategoryModel.php");
require_once("../../src/controller/CategoryController.php");
require_once("../../src/util/validate.php");


if (!empty($_GET["id_category"])) {

    $categoryController = new CategoryController("", "");
    $categoryController->delete($_GET["id_category"]);
}


?>

</html>