<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");



if (!(empty($_POST["pseudo"]) || empty($_POST["mdp"])) && $_POST["type"] == "login") {
    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
    $userController->login($_POST["pseudo"], $_POST["mdp"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Se connecter</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./login.css" rel="stylesheet" />
</head>

<body>
    <div id="login">
        <h1>Se connecter</h1>
        <form action="./login.php" method="POST">
            <label for="pseudo">Pseudo</label>
            <input id="pseudo" name="pseudo" type="text" required />
            <label for="mdp">Votre mot de passe</label>
            <input id="mdp" name="mdp" type="password" required />

            <input type="hidden" name="type" value="login" />
            <input type="submit" value="Connexion" />
        </form>
    </div>

</body>

</html>