<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");
require_once("../../src/util/validate.php");

$isAdmin = $_COOKIE["is_admin"] ?? false;

if ($isAdmin) {
   
    $userController = new UserController("", "123456789", "", "", "12345678", "", "", 1);
    $users = $userController->fetchAll();
}

// 2. Form submit
$isValidTelephone = true;
$isValidMdp = true;

$error = $_GET["error"] ?? false;

$isValidTelephone = true;
$isValidMdp = true;

if(!empty($_POST["submit"])) {
    switch($_POST["type"]) {
        case "create_user": {
                if (!(empty($_POST["pseudo"]) || empty($_POST["mdp"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["email"]) || empty($_POST["civilite"]) || !isset($_POST["statut"]))) {
                    $isValidTelephone = testTelephone($_POST["telephone"]);
                    $isValidMdp = testMdp($_POST["mdp"]);
                    
                    if ($isValidTelephone && $isValidMdp) {
                        $userController = new UserController($_POST["pseudo"], $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"], $_POST["civilite"], intval($_POST["statut"]));

                        $userController->create();
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
    <link href="./list.css" rel="stylesheet" />
    <script src='/deal/view/user/list.js'></script>
    <title>Deal | Gestion des membre</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <?php include_once("../common/nav.php")?>

    <div id="profile">
        <h1>Deal | Gestion des membre</h1>


        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <td>id membre</td>
                        <td>pseudo</td>
                        <td>nom</td>
                        <td>prenom</td>
                        <td>email</td>
                        <td>telephone</td>
                        <td>civilite</td>
                        <td>statut</td>
                        <td>date_enregistrement</td>
                        <td>actions</td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user["id_membre"] ?></td>
                        <td><?= $user["pseudo"] ?></td>
                        <td> <?= $user["nom"]?></td>
                        <td> <?= $user["prenom"]?></td>
                        <td> <?= $user["email"]?></td>
                        <td> <?= $user["telephone"]?></td>
                        <td> <?= $user["civilite"] == 'f' ? "Femme":"Homme" ?></td>
                        <td> <?= $user["statut"] == '1' ? "Admin" : "user" ?></td>
                        <td> <?= $user["date_enregistrement"]?></td>
                        <td>
                            <?php if($isAdmin) {  ?>
                            <a href="./edit.php?id_user=<?php echo $user["id_membre"]; ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a>
                            <a href="./delete.php?id_user=<?php echo $user["id_membre"]; ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg></a>
                            <?php } ?>

                            <a href="./view.php?id_user=<?php echo $user["id_membre"]; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg></a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <form class="row g-3 needs-validation" novalidate action="/deal/view/user/list.php?" method="POST">
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
                <input id="email" value="<?php echo $user['email']?>" name="email" class="form-control" type="email"
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

            <div class="col-12">
                <input type="hidden" name="type" value="create_user" />
                <input name="submit" type="submit" class="btn btn-primary" value="Sauvegarder" />
            </div>
        </form>
    </div>

</body>

</html>