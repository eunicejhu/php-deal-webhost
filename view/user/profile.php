<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");

if (!empty($_GET["logged_id"])) {
    setcookie("login", "true", 0, '/');
    setcookie("logged_id", $_GET["logged_id"], 0, '/');

    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);    $user = $userController->fetchOne($_GET["logged_id"]);
}




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Se connecter</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./profile.css" rel="stylesheet" />
</head>

<body>
    <div id="profile">
        <h1>Profile</h1>
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" name="pseudo" type="text" value="<?php echo $user["pseudo"] ?>" disabled />
        <label for="nom">Nom</label>
        <input id="nom" name="nom" type="text" value="<?php echo $user["nom"] ?>" disabled />
        <label for="prenom">Prénom</label>
        <input id="prenom" name="prenom" type="text" value="<?php echo $user["prenom"] ?>" disabled />
        <label for="telehpone">Téléhpone</label>
        <input id="telehpone" name="telehpone" type="text" value="<?php echo $user["telephone"] ?>" disabled />

        <label for="email">Email</label>
        <input id="email" name="email" type="text" value="<?php echo $user["email"] ?>" disabled />
        <label for="civilite">civilite</label>
        <input id="civilite" name="civilite" type="text"
            value="<?php echo $user['civilite'] == 'f' ? 'Femme' : 'Homme'; ?>" disabled />
        <button onclick="document.cookie =''; window.location.href='./login.php'"> Déconnexion </button>

        <a href="./edit.php?id=<?php echo $_GET["logged_id"] ?>"> Modifier </a>
    </div>

</body>

</html>