<?php

require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");
require_once("../../src/util/validate.php");

const DEFAULT_STATUT = 0; // user

$isValidTelephone = true;
$isValidMdp = true;

if (!(empty($_POST["pseudo"]) || empty($_POST["mdp"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["email"]) || empty($_POST["civilite"])) && $_POST["type"] == "create") {
    $isValidTelephone = testTelephone($_POST["telephone"]);
    $isValidMdp = testMdp($_POST["mdp"]);
    if ($isValidTelephone && $isValidMdp) {
        $userController = new UserController($_POST["pseudo"], $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"], $_POST["civilite"], DEFAULT_STATUT);
        $userController->create();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inscription</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href="./inscription.css" rel="stylesheet" />
    <link href="./form/style.css" rel="stylesheet" />
</head>

<body>
    <div id="inscription">
        <h1>S'inscrire</h1>
        <form action="./inscription.php" method="POST">
            <label for="pseudo">Pseudo</label>
            <input id="pseudo" name="pseudo" type="text" placeholder="pseudo" required />
            <label for="mdp">Votre mot de passe (Entre 9 et 13, pas de caractères spécieux)</label>
            <input id="mdp" name="mdp" type="password" required class="<?php echo $isValidMdp ? '' : 'invalid'; ?>" />
            <label for="nom">Votre nom</label>
            <input id="nom" name="nom" type="text" required />
            <label for="prenom">Votre prénom</label>
            <input id="prenom" name="prenom" type="text" required />
            <label for="email">Votre email</label>
            <input id="email" name="email" type="email" required />
            <label for="telephone">Votre téléphone (numéro, longeur entre 6 et 12)</label>
            <input id="telephone" name="telephone" type="text" class="<?php echo $isValidTelephone ? '' : 'invalid'; ?>"
                required />
            <label for="civilite">Votre civilité</label>
            <select id="civilite" name="civilite">
                <option checked="true" value="m">Homme</option>
                <option value="f">Femme</option>
            </select>

            <input type="hidden" name="type" value="create" />
            <input type="submit" value="Inscription" />
        </form>
    </div>
</body>

</html>