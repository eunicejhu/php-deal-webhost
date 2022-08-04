<?php

class Database
{

    public function getPDO()
    {
        try {

            $pdo = new PDO(getenv("DATABASE_DNS"), getenv("DATABASE_USER"), getenv("DATABASE_PASSWORD"));
            // On précise le système de gestion de base données. 
            // Dès que l'on instancie PDO, la connexion est établie.
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // On va ajouter des attributs à notre connexion PDO. 
            // Deux paramètres : 
            // - ATTR_ERMODE permet de spécifier que l'on veut modifier le type d'erreur. 
            // - ERRMODE_EXCEPTION permet de spécifier que l'on veut des erreurs de type PDOException.
            return $pdo;
        }
        catch (PDOException $error) {
            // On peut typer les paramètres avec des class.
            // Ici on demande au catch de récupérer une erreur de type PDOException.
            // exit($error); exit est un alias de die(); Ces fonctions permettent l'arrêt du script courant tout en retournant l'erreur.
            //fopen() register to a file
            header("Location: /deal/error.php?error=" . $error->getMessage());
        }
    }

}


?>