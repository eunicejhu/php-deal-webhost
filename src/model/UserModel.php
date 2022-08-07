<?php

//testing


// require_once("../config/database.php");

// $userModel = new UserModel();

// //-- login

// echo($userModel->login("pseudo10", "1234567891"));

//-- create

// date_default_timezone_set("Europe/Paris");
// $userModel->create("pseudo8", "123", "nom", "prenom", "037293", "nom271@gmail.com", 'f', 0, date("Y-m-d H:i:s")); // pass
//$userModel->create("eunicejhu@gmail.com", "12SDJJSKJD", "isa", "z"); //   create user whose email has been used. -> Update column to be unique value   
//   $userModel->create( "isa4@gmail.com", "12SDJJSKJD", null, "H"); // firstname is null or NULL
//   $userModel->create( "gmail.com", "12SDJJSKJD", "eunice", "H"); // email is not valid
//-- fetcheAll
// set host to localhost1  see exception        
// echo "<pre>";
// var_dump($userModel->fetchAll());
// echo "</pre>";
//-- fetchOne
// echo "<pre>";
// var_dump($userModel->fetchOne(1)); //  id=1 does not exist , return false;  but the result of execution of request is true 
//var_dump($userModel->fetchOne(12)); // id=12 exist
//var_dump($userModel->fetchOne("some string")); // invalid id, exception SQL thrown
// var_dump($userModel->fetchOne(null)); // non integer value are invalid , will throw exception
// echo "</pre>";
// -- update

// date_default_timezone_set("Europe/Paris");
// $userModel->update(2, "pseudo", "123", "isa", "prenom", "037293", "isa@gmail.com", 'f', 0, date("Y-m-d H:i:s"));
// $userModel->update(1, "isa", "z", "isa@icloud.com", "sdf"); // id=1 does not exist, nothing changed in Database, no error thrown
//$userModel->update(12, "isa", "z", "isa@icloud.com", "sdf"); // id=12 exist, success
//   $userModel->update(12, "isa", "z", "eunicejhu@gmail.com", "sdf"); // id=12 exist, update with a used email, Error thrown
// $userModel->update("12", "isa2", "z", "isa@icloud.com", "sdf"); // id="12" string, success, no error thrown
// $userModel->update(12, "isa2", "z", "isa@icloud.com", null); // pass null to no-null parameter 'password', no error thrown, but no action!!!!IMPORTANT DON'T PASS NULL TO NO-NULL params.
// delete
//$userModel->delete(12); // id=1 does not exist, no error thrown, no update in db.
//   $userModel->delete(12); //id=12 exist, deleted
//   $userModel->delete("12"); // id="12", pass string to int field, no error thrown. Success.
// $userModel->delete(null); // cannot pass null to int parameter, no error thrown. !!!!IMPORTANT DON'T PASS NULL TO NO-NULL params.



class UserModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPDO();

    }

    public function login(string $pseudo, string $mdp)
    {
        try {
            $request = $this->pdo->prepare("SELECT mdp, id_membre, statut  FROM membre WHERE pseudo='" . $pseudo . "';");

            $request->execute();

            $result = $request->fetch();

            if (password_verify($mdp, $result["mdp"])) {

                setcookie("logged_id", $result["id_membre"], 0, "/");
                setcookie("login", "true", 0, "/");
                setcookie("is_admin", $result["statut"], 0, "/");
                header("Location: ../../index.php");
                return $result;
            }
            else {
                header("Location: ../../view/user/login.php?error=invalidMdp");
                return null;
            }
        }
        catch (PDOException $error) {

            header("Location: ../../view/user/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
            return null;
        }
    }


    public function create(string $pseudo, string $mdp, string $nom, string $prenom, string $telephone, string $email, string $civilite, int $statut, string $date_enregistrement)
    {
        try {
            $request = $this->pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :telephone, :email,:civilite, :statut, :date_enregistrement)");


            $request->bindParam(":pseudo", $pseudo);
            $request->bindParam(":mdp", $mdp);
            $request->bindParam(":nom", $nom);
            $request->bindParam(":prenom", $prenom);
            $request->bindParam(":telephone", $telephone);
            $request->bindParam(":email", $email);
            $request->bindParam(":civilite", $civilite);
            $request->bindParam(":statut", $statut);
            $request->bindParam(":date_enregistrement", $date_enregistrement);

            $request->execute();

            header("Location: ../../view/user/list.php");

        }
        catch (PDOException $error) {
            header("Location: ../../view/user/list.php?error=" . $error->getMessage());
        }
    }

    public function register(string $pseudo, string $mdp, string $nom, string $prenom, string $telephone, string $email, string $civilite, int $statut, string $date_enregistrement)
    {
        try {
            $request = $this->pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :telephone, :email,:civilite, :statut, :date_enregistrement)");


            $request->bindParam(":pseudo", $pseudo);
            $request->bindParam(":mdp", $mdp);
            $request->bindParam(":nom", $nom);
            $request->bindParam(":prenom", $prenom);
            $request->bindParam(":telephone", $telephone);
            $request->bindParam(":email", $email);
            $request->bindParam(":civilite", $civilite);
            $request->bindParam(":statut", $statut);
            $request->bindParam(":date_enregistrement", $date_enregistrement);

            $request->execute();
            header("Location: ../../view/user/login.php");

        }
        catch (PDOException $error) {
            header("Location: ../../view/user/inscription.php?error=" . $error->getMessage());
        }
    }

    public function fetchAll()
    {

        try {
            $request = $this->pdo->prepare("SELECT * from membre");
            $request->execute();

            return $request->fetchAll();
        }
        catch (PDOException $error) {
            header("Location: ../../view/user/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function fetchOne(int $id)
    {
        try {
            $request = $this->pdo->prepare("SELECT * from membre where id_membre=" . $id);
            $request->execute();

            return $request->fetch();
        }
        catch (PDOException $error) {
            header("Location: ../../view/user/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function update(int $id_membre, string $pseudo, string $mdp, string $nom, string $prenom, string $telephone, string $email, string $civilite, int $statut, string $date_enregistrement)
    {

        try {
            $request = $this->pdo->prepare("UPDATE membre SET pseudo= :pseudo, mdp= :mdp, nom= :nom , prenom= :prenom , telephone= :telephone , email= :email , civilite= :civilite , statut= :statut , date_enregistrement= :date_enregistrement  WHERE id_membre=" . $id_membre . ";");

            $request->bindParam("pseudo", $pseudo, PDO::PARAM_STR);
            $request->bindParam(":mdp", $mdp, PDO::PARAM_STR);
            $request->bindParam(":nom", $nom, PDO::PARAM_STR);
            $request->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $request->bindParam("telephone", $telephone, PDO::PARAM_STR);
            $request->bindParam("email", $email, PDO::PARAM_STR);
            $request->bindParam(":civilite", $civilite, PDO::PARAM_STR);
            $request->bindParam(":statut", $statut, PDO::PARAM_STR);
            $request->bindParam(":date_enregistrement", $date_enregistrement, PDO::PARAM_STR);

            $request->execute();

            header("Location: ../../view/user/view.php?id_user=" . $id_membre);

        }
        catch (PDOException $error) {
            header("Location: ../../view/user/edit.php?error=" . $error->getMessage());
        }
    }
    public function delete(int $id_membre)
    {
        try {
            $request = $this->pdo->prepare("DELETE FROM membre WHERE id_membre=:id_membre");
            $request->bindParam(":id_membre", $id_membre);

            $request->execute();
            header("Location: ../../view/user/list.php");
        }
        catch (PDOException $error) {
            header("Location: ../../view/user/list.php?error=" . $error->getMessage());
        }
    }
}

?>