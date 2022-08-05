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



class PhotoModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPDO();

    }

    public function create(string $photo1, ?string $photo2 = null, ?string $photo3 = null, ?string $photo4 = null, ?string $photo5 = null)
    {
        try {
            $request = $this->pdo->prepare("INSERT INTO photo(photo1, photo2, photo3, photo4, photo5) VALUES(:photo1, :photo2, :photo3, :photo4, :photo5)");


            $request->bindParam(":photo1", $photo1);
            $request->bindParam(":photo2", $photo2);
            $request->bindParam(":photo3", $photo3);
            $request->bindParam(":photo4", $photo4);
            $request->bindParam(":photo5", $photo5);

            $request->execute();

            return $this->pdo->lastInsertId();
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }

    public function fetchOne(int $id)
    {
        try {
            $request = $this->pdo->prepare("SELECT * from photo where id_photo=" . $id);
            $request->execute();

            return $request->fetch();
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function update(int $id_photo, string $photo1, ?string $photo2 = null, ?string $photo3 = null, ?string $photo4 = null, ?string $photo5 = null)
    {

        try {
            $request = $this->pdo->prepare("UPDATE photo SET photo1= :photo1, photo2= :photo2, photo3= :photo3 , photo4= :photo4 , photo5= :photo5  WHERE id_photo=" . $id_photo . ";");

            $request->bindParam("photo1", $photo1, PDO::PARAM_STR);
            $request->bindParam(":photo2", $photo2, PDO::PARAM_STR);
            $request->bindParam(":photo3", $photo3, PDO::PARAM_STR);
            $request->bindParam(":photo4", $photo4, PDO::PARAM_STR);
            $request->bindParam("photo5", $photo5, PDO::PARAM_STR);

            $request->execute();
            return $id_photo;
        }
        catch (PDOException $error) {

            header("Location: ../../view/post/edit.php?id_photo=" . $id_photo . "&error=fail");
            return false;
        }
    }
    public function delete(int $id_photo)
    {
        try {
            $request = $this->pdo->prepare("DELETE FROM photo WHERE id_photo=:id_photo");
            $request->bindParam(":id_photo", $id_photo);

            $request->execute();

            return true;
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
            return false;
        }
    }
}

?>