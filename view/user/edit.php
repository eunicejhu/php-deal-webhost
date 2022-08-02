<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");

if(!empty($_GET["id"])) {
    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);    $user = $userController->fetchOne($_GET["id"]);
}

const DEFAULT_STATUT = 0; // user

$isValid = true;
$isValidMdp = true;

if (!(empty($_GET["id"]) || empty($user) || empty($_POST["pseudo"]) || empty($_POST["mdp"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["email"]) || empty($_POST["civilite"])) && $_POST["type"] == "edit") {
    $isValid = preg_match('/^[\d]{6,12}$/i', $_POST["telephone"]);
    $isValidMdp = preg_match('/^[a-zA-Z0-9!]{9,13}$/i', $_POST["mdp"]);
    if ($isValid && $isValidMdp) {

         $userController = new UserController($_POST["pseudo"], $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"], $_POST["civilite"], $user["statut"]);
        $userController->update($_GET["id"]);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Modifier</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./edit.css" rel="stylesheet" />
    <link href="./form/style.css" rel="stylesheet" />
</head>

<body>
    <div id="edit">
        <h1>Modifier</h1>
        <form action="./edit.php?id=<?php echo $_GET["id"] ?>" method="POST">
            <label for="pseudo">Pseudo</label>
            <input id="pseudo" name="pseudo" type="text" placeholder="pseudo" value="<?php echo $user["pseudo"] ?>"
                required />
            <label for="mdp">Votre mot de passe (Entre 9 et 13, pas de caractères spécieux)</label>
            <input id="mdp" name="mdp" type="password" placeholder="Saisir un nouveau mot de passe" required value=""
                class="<?php echo $isValidMdp ? '' : 'invalid'; ?>" />
            <label for="nom">Votre nom</label>
            <input id="nom" name="nom" type="text" value="<?php echo $user["nom"] ?>" required />
            <label for="prenom">Votre prénom</label>
            <input id="prenom" name="prenom" type="text" value="<?php echo $user["prenom"] ?>" required />
            <label for="email">Votre email</label>
            <input id="email" name="email" type="email" value="<?php echo $user["email"] ?>" required />
            <label for="telephone">Votre téléphone (numéro, longeur entre 6 et 12)</label>
            <input id="telephone" name="telephone" type="text" value="<?php echo $user["telephone"] ?>"
                class="<?php echo $isValid ? '' : 'invalid'; ?>" required />
            <label for="civilite">Votre civilité</label>
            <select id="civilite" name="civilite">
                <option <?php echo $user["civilite"] == "m" ? "selected" : "" ?> value="m">Homme</option>
                <option <?php echo $user["civilite"] == "f" ? "selected" : "" ?> value="f">Femme</option>
            </select>

            <input type="hidden" name="type" value="edit" />
            <a href="./profile.php?logged_id=<?php echo $_GET["id"]; ?>">Retour</a>
            <input type="submit" value="Sauvegarder" />
        </form>
    </div>

</body>

</html>