<?php

require_once("../common/env.php");

require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");
require_once("../../src/util/validate.php");

const DEFAULT_STATUT = 0; // user

$error = $_GET["error"] ?? "";

$isValidTelephone = true;
$isValidMdp = true;

if (!(empty($_POST["pseudo"]) || empty($_POST["mdp"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["email"]) || empty($_POST["civilite"])) && $_POST["type"] == "register") {
    $isValidTelephone = testTelephone($_POST["telephone"]);
    $isValidMdp = testMdp($_POST["mdp"]);
    if ($isValidTelephone && $isValidMdp) {
        $userController = new UserController($_POST["pseudo"], $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"], $_POST["civilite"], DEFAULT_STATUT);
        $userController->register();
    }
}

?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../index.css" rel="stylesheet" />
    <link href="./inscription.css" rel="stylesheet" />
    <script src='./inscription.js'></script>
    <!-- <script src='../common/checkLoggedIn.js'></script> -->
    <title>Deal | Inscription</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <div id="inscription">
        <h1><a class="nav-link" href="https://deal-zuoqin.000webhostapp.com/index.php">Deal<a></h1>
        <form class="needs-validation" novalidate action="./inscription.php?" method="POST">
            <div class=" col-md-12 ">

                <p class="invalid">
                    <?php echo $error; ?>
                </p>
            </div>
            <div class="col-md-12">

                <label for="pseudo" class="form-label">Pseudo</label>
                <input id="pseudo" class="form-control" name="pseudo" type="text" placeholder="Pseudo" required />
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" class="form-control" type="email" placeholder="Email" required />
                <div class="invalid-feedback">
                    Email not valid
                </div>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="mdp">Votre mot de passe (Entre 9 et 13, pas de caractères
                    spécieux)</label>
                <input id="mdp" name="mdp" type="password" required
                    class="form-control <?php echo $isValidMdp ? '' : 'invalid'; ?>" />
                <div class="invalid-feedback">
                    Entre 9 et 13, pas de caractères spécieux
                </div>
            </div>
            <div class="col-md-12">
                <label for="nom" class="form-label">Nom</label>
                <input id="nom" name="nom" class="form-control" type="text" placeholder="Nom" required />
            </div>

            <div class="col-md-12">
                <label for="prenom" class="form-label">Prénom</label>
                <input id="prenom" name="prenom" class="form-control" type="text" placeholder="Prénom" required />
            </div>
            <div class="col-md-12">
                <label for="telephone" class="form-label">Votre téléphone (numéro, longeur entre 6 et 12)</label>
                <input id="telephone" name="telephone" type="text"
                    class="<?php echo $isValidTelephone ? '' : 'invalid'; ?> form-control" required />

                <div class="invalid-feedback">
                    Numéro, longeur entre 6 et 12
                </div>
            </div>


            <div class="col-md-12">
                <label for="civilite" class="form-label">Civilite</label>
                <select id="civilite" name="civilite" class="form-select" aria-label="Default select example">
                    <option value="m">Homme</option>
                    <option value="f">Femme</option>
                </select>
            </div>


            <div class="col-md-12">
                <input type="hidden" name="type" value="register" />
                <input name="submit" type="submit" class="btn btn-primary form-control" value="S'inscrire" />
            </div>
        </form>
    </div>
</body>

</html>