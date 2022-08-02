<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>FrontOffice / Déposer une announce</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='edit.css'>
    <script src='../common/checkLoggedIn.js'></script>
    <script src='edit.js'></script>
</head>

<body>
    <h1>FrontOffice / Déposer une announce</h1>
    <form action="./edit.php?id_annonce=<?php echo $_GET["id_annonce"] ?>" method="POST">
        <div>
            <label for="titre">Titre</label>
            <input id="titre" name="titre" type="text" placeholder="Titre de l'annonce"
                value="<?php echo $post["titre"] ?>" required />

            <label for="description_courte">Description courte</label>
            <input id="description_courte" name="description_courte" type="text"
                placeholder="description courte de votre annonce" value="<?php echo $post["description_courte"] ?>"
                required />

            <label for="description_longue">Description longue</label>
            <input id="description_longue" name="description_longue" type="text" placeholder="description_longue"
                value="<?php echo $post["description_longue"] ?>" required />

            <label for="prix">Prix</label>
            <input id="prix" name="prix" type="text" placeholder="prix" value="<?php echo $post["prix"] ?>" required />

            <label for="categorie_id">categorie id</label>
            <input id="categorie_id" name="categorie_id" type="text" placeholder="categorie_id"
                value="<?php echo $post["categorie_id"] ?>" required />
        </div>

        <div>
            <label for="photo">Photo</label>
            <input id="photo" name="photo" type="text" placeholder="photo" value="<?php echo $post["photo"] ?>"
                required />

            <label for="pays">Pays</label>
            <input id="pays" name="pays" type="text" placeholder="pays" value="<?php echo $post["pays"] ?>" required />

            <label for="ville">Ville</label>
            <input id="ville" name="ville" type="text" placeholder="ville" value="<?php echo $post["ville"] ?>"
                required />

            <label for="adresse">Adresse</label>
            <input id="adresse" name="adresse" type="textarea" placeholder="Adresse figurant dnas l'annonce"
                value="<?php echo $post["adresse"] ?>" required />


            <label for="cp">Code Postal</label>
            <input id="cp" name="cp" type="text" placeholder="Code Postal dans l'annonce"
                value="<?php echo $post["cp"] ?>" required />
        </div>


        <input type="hidden" name="type" value="edit" />
        <a href="./list.php">Retour</a>
        <input type="submit" value="Sauvegarder" />
    </form>
</body>

</html>