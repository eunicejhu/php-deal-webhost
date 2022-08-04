<?php

require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");


if (!empty($_GET["id_user"])) {

    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
    $userController->delete($_GET["id_user"]);
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Delete user</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <h1>Delete a user</h1>
</body>

</html>