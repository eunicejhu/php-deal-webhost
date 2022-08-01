<?php

require_once('../config/database.php');

// Pour se connecter à une base de données et effectuer nos requêtes, on peut utiliser : 
// - mysqli
// - PDO

class ProductModel {

    private PDO $pdo;
    // On va stocker la connexion PDO au sein de cette propriété.

    public function __construct(){
        $database = new Database();

        $this->pdo = $database->getPDO();
    }
    
    // CRUD : Create, Read, Update et Delete. 
    // Create : méthode gérant l'insertion des données
    // Read : méthode gérant la sélection des données. 
    // Update : méthode gérant la modification des données
    // Delete : méthode gérant la suppression des données. 


    public function create($entitled, $description, $price){
        // Méthode du CRUD.

        // $this->pdo->exec('INSERT INTO product');
        $request = $this->pdo->prepare('INSERT INTO product(entitled, description, price) VALUES (:entitled, :description, :price)');
        // On utilisera la méthode prepare qui va permettre de préparer des requêtes SQL.
        // Une requête preparée permettra d'être réutilisée autant de fois que l'on veut.
        
        // Au sein de prepare, on va utiliser des marqueurs, ces marqueurs prennent la place des futurs valeurs. Ils les remplacent temporairement au sein de la requête. 

        // Pour remplacer les marqueurs par les vraies valeurs, on a trois solutions :
        // - bindParam() : une variable est associée au marqueur (On utilisera plus bindParam que bindValue).
        // - bindValue() : une valeur est associée au marqueur.
        // - Donner le tableau de valeur dans la méthode execute().

        $request->bindParam(':entitled', $entitled, PDO::PARAM_STR); // On peut typer nos données. 
        $request->bindParam(':description', $description);
        $request->bindParam(':price', $price);

        if($request->execute()){
            header('Location: ../../view/index.php');
            // Fonction header va nous permettre de rediriger l'utilisateur vers une autre page. 
        }else{

        } // Cette méthode permet l'execution de la requête preparée.
        // var_dump($request);
        // La variable $request ne contient plus un objet PDO, lorsque l'on utilise prepare, on obtient un objet PDOStatement. PDO et PDOStatement ne sont pas les même class.
    }

    public function read(){
        // read permettra de récupérer l'intégralité des produits.
        $request = $this->pdo->prepare('SELECT * FROM product');

        $request->execute();

        $result = $request->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        // Pour récupérer les résultats, on doit utiliser les méthodes :
        // - fetch() : va récupérer une ligne par ligne.
        // - fetchAll() : va récupérer l'intégralité des lignes. FetchAll va retourner deux fois les données (avec un tableau associatif, un tableau numérique).
    }


}

?>