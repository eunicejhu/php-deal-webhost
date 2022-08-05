<?php
require_once("../common/env.php");

require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");
require_once("../../src/util/validate.php");

if(!empty($_GET["id_user"])) {
    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);    
    $user = $userController->fetchOne($_GET["id_user"]);
}


$error = $_GET["error"] ?? false;

$isValidTelephone = true;
$isValidMdp = true;

if (!empty($_POST["submit"])) {
    switch ($_POST["type"]) {
        case "update_user": {
              
                
                if (!(empty($_GET["id_user"]) || empty($_POST["pseudo"]) || empty($_POST["mdp"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["email"]) || empty($_POST["civilite"]) || !isset($_POST["statut"]))) {
                    $isValidTelephone = testTelephone($_POST["telephone"]);
                    $isValidMdp = testMdp($_POST["mdp"]);

                    if ($isValidTelephone && $isValidMdp) {
                        $userController = new UserController($_POST["pseudo"], $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"], $_POST["civilite"], intval($_POST["statut"]));

                        $userController->update($_GET["id_user"]);
                    }
                }
                break;
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
    <link href="./edit.css" rel="stylesheet" />
    <script src='../common/checkLoggedIn.js'></script>
    <script src='https://deal-zuoqin.000webhostapp.com/view/user/edit.js'></script>
    <title>Deal | Gestion des membre</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>
    <div id="edit">
        <a href="./list.php" class="btn btn-outline-primary" role="button">Retour</a>
        <h1>Modifier</h1>

        <form class="row g-3 needs-validation" novalidate action="./edit.php?id_user=<?php echo $_GET["id_user"] ?>"
            method="POST">
            <div class="col-md-12">
                <p class="invalid">
                    <?php echo $error; ?>
                    <?php echo !$isValidMdp ? "<br>Mot de passe invalide" : "" ?>
                    <?php echo !$isValidTelephone ? "<br>Téléphone invalide " : ""?>
                </p>
            </div>
            <div class="col-md-6">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input id="pseudo" class="form-control" name="pseudo"
                    value="<?php echo htmlspecialchars_decode($user['pseudo'])?>" type="text" placeholder="Pseudo"
                    required />
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input id="email" value="<?php echo $user['email']?>" name="email" class="form-control " type="email"
                    placeholder="Email" required />
                <div class="invalid-feedback">
                    Email not valid
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="mdp">Votre mot de passe (Entre 9 et 13, pas de caractères
                    spécieux)</label>
                <input id="mdp" name="mdp" type="password" required
                    class="form-control <?php echo $isValidMdp ? '' : 'invalid'; ?>" />
                <div class="invalid-feedback">
                    Entre 9 et 13, pas de caractères spécieux
                </div>
            </div>
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input id="nom" name="nom" value="<?php echo $user['nom']; ?>" class="form-control" type="text"
                    placeholder="Nom" required />
            </div>

            <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom</label>
                <input id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" class="form-control" type="text"
                    placeholder="Prénom" required />
            </div>
            <div class="col-md-6">
                <label for="telephone" class="form-label">Votre téléphone (numéro, longeur entre 6 et 12)</label>
                <input id="telephone" name="telephone" type="text"
                    class="<?php echo $isValidTelephone ? '' : 'invalid'; ?> form-control" required />

                <div class="invalid-feedback">
                    Numéro, longeur entre 6 et 12
                </div>
            </div>

            <div class="col-md-6">
                <label for="civilite" class="form-label">Civilite</label>
                <select id="civilite" name="civilite" class="form-select" aria-label="Default select example">
                    <option <?php echo $user["civilite"] == "m" ? "selected" : "" ?> value="m">Homme</option>
                    <option <?php echo $user["civilite"] == "f" ? "selected" : "" ?> value="f">Femme</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="statut" class="form-label">Statut</label>
                <select id="statut" name="statut" class="form-select" aria-label="Default select example">
                    <option <?php echo $user["statut"] == "1" ? "selected" : "" ?> value="1">Admin</option>
                    <option <?php echo $user["statut"] == "0" ? "selected" : "" ?> value="0">User</option>
                </select>
            </div>


            <div class="col-12 ">
                <input type="hidden" name="type" value="update_user" />

                <input name=" submit" type="submit" class="btn btn-primary" value="Sauvegarder" />


            </div>
        </form>

    </div>

</body>

</html>