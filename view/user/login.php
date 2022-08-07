<?php
require_once("../common/env.php");
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");


//redirect

$isValid = !isset($_GET["error"]);
if (!empty($_POST["submit"])) {
    if ($_POST["type"] == "login") {
        if (!(empty($_POST["pseudo"]) || empty($_POST["mdp"])) && $_POST["type"] == "login") {
            $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
            $loggedUser = $userController->login($_POST["pseudo"], $_POST["mdp"]);
        }
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
    <link href="./login.css" rel="stylesheet" />
    <script src='../common/checkLoggedIn.js'></script>
    <title>Deal | Connexion</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <div id="login">
        <h1><a class="nav-link" href="../../index.php">Deal<a></h1>
        <form class=" needs-validation" novalidate action="./login.php?" method="POST">
            <div class="col-md-12">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input id="pseudo" class="form-control <?php echo $isValid ? '' : 'is-invalid' ?> "" name=" pseudo"
                    type="text" required />
            </div>
            <div class="col-md-12">

                <label for="mdp" class="form-label">Votre mot de passe</label>
                <input id="mdp" name="mdp" class="form-control <?php echo $isValid ? '' : 'is-invalid' ?> "
                    type="password" required />
                <div class="invalid-feedback">
                    Mot de passe ou Pseudo not valid
                </div>
            </div>
            <div class="col-12">
                <input type="hidden" name="type" value="login" />
                <input name="submit" type="submit" class="btn btn-primary form-control"" value=" Se connecter" />
            </div>
        </form>

    </div>

</body>

</html>