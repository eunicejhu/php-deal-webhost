<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");


try {
    if (!empty($_GET["id"])) {

        $userController = new UserController("", "", "", "");
        echo $_GET["id"];
        $userController->delete($_GET["id"]);
    }
}
catch (Exception $error) {
    echo $error;
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