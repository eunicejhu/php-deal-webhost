<?php


//testing

// require_once("../config/database.php");
// require_once("../util/date.php");

// $postModel = new PostModel();

// echo "<pre>";
// var_dump($postModel->fetchPageForUser(53, null, null));
// echo "</pre>";
//-- create

// // // -- fetchPage 
// echo "<pre>";
// var_dump($postModel->fetchPage());
// echo "</pre>";
//-- create

// date_default_timezone_set("Europe/Paris");
// $postModel->create("Macbook Pro", "pc", "pc Apple", "1299€", "photo_lien", "photo1_lien", "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2); // pass
// $postModel->create("Macbook Pro", "pc", "pc Apple", "1299€", "photo_lien", "France", "Paris", '11 Avenue Richard', 75003, 25, 1, 2, date("Y-m-d H:i:s")); // pass

//-- fetcheAll
// set host to localhost1  see exception        
// echo "<pre>";
// var_dump($postModel->fetchAll());
// echo "</pre>";
//-- fetchOne
// echo "<pre>";
// var_dump($postModel->fetchOne(1)); //  id=1 does not exist , return false;  but the result of execution of request is true 

// echo "</pre>";
// var_dump($postModel->fetchOne(12)); // id=12 exist
// var_dump($postModel->fetchOne("some string")); // invalid id, exception SQL thrown
// var_dump($postModel->fetchOne(null)); // non integer value are invalid , will throw exception
// -- update

// date_default_timezone_set("Europe/Paris");
// $postModel->update(31, "Macbook Pro", "pc", "pc Apple", "1299€", "photo_lien", 2, "France", "Paris", "20 Avenue du l'opéra", 75001, null, 1);
// $postModel->update(1, "isa", "z", "isa@icloud.com", "sdf"); // id=1 does not exist, nothing changed in Database, no error thrown
//$postModel->update(12, "isa", "z", "isa@icloud.com", "sdf"); // id=12 exist, success
//   $postModel->update(12, "isa", "z", "eunicejhu@gmail.com", "sdf"); // id=12 exist, update with a used email, Error thrown
// $postModel->update("12", "isa2", "z", "isa@icloud.com", "sdf"); // id="12" string, success, no error thrown
// $postModel->update(12, "isa2", "z", "isa@icloud.com", null); // pass null to no-null parameter 'password', no error thrown, but no action!!!!IMPORTANT DON'T PASS NULL TO NO-NULL params.
// delete
// $postModel->delete(1); // id=1 does not exist, no error thrown, no update in db.
//   $postModel->delete(12); //id=12 exist, deleted
//   $postModel->delete("12"); // id="12", pass string to int field, no error thrown. Success.
// $postModel->delete(null); // cannot pass null to int parameter, no error thrown. !!!!IMPORTANT DON'T PASS NULL TO NO-NULL params.



class PostModel
{
    private $pdo;
    private const PAGE_LIMIT = 10;
    private const OFFSET_DEFAULT = 0;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPDO();
    }


    public function create(string $titre, string $description_courte, string $description_longue, string $prix, string $photo, int $photo_id, string $pays, string $ville, string $adresse, int $cp, ?string $membre_id = null, ?int $categorie_id = null)
    {

        $date_enregistrement = getNow();

        try {

            $request = $this->pdo->prepare("INSERT INTO announce(titre, description_courte,  description_longue,  prix,  photo,  pays,  ville,  adresse,  cp,  membre_id,  photo_id, categorie_id,  date_enregistrement) VALUES(:titre, :description_courte, :description_longue, :prix, :photo, :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, :date_enregistrement)");


            $request->bindParam(":titre", $titre);
            $request->bindParam(":description_courte", $description_courte);
            $request->bindParam(":description_longue", $description_longue);
            $request->bindParam(":prix", $prix);
            $request->bindParam(":photo", $photo);
            $request->bindParam(":pays", $pays);
            $request->bindParam(":ville", $ville);
            $request->bindParam(":adresse", $adresse);
            $request->bindParam(":cp", $cp);
            $request->bindParam(":membre_id", $membre_id);
            $request->bindParam(":photo_id", $photo_id);
            $request->bindParam(":categorie_id", $categorie_id);
            $request->bindParam(":date_enregistrement", $date_enregistrement);



            $request->execute();

            header("Location: https://deal-zuoqin.000webhostapp.com/view/post/list.php");

        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }

    public function fetchPage(?int $currentPage, ?int $page_limit)
    {

        $page_limit = is_null($page_limit) ?self::PAGE_LIMIT : $page_limit;
        $offset = is_null($currentPage) ?self::OFFSET_DEFAULT * $page_limit : $currentPage * $page_limit;

        try {
            $request = $this->pdo->prepare("SELECT * from announce order by date_enregistrement DESC LIMIT " . $page_limit . " OFFSET " . $offset);
            $allRequest = $this->pdo->prepare("SELECT id_annonce from announce ");
            $allRequest->execute();
            $request->execute();

            $result = $request->fetchAll();
            $allResult = $allRequest->fetchAll();
            // unset before set
            setcookie("nbPages", "", time() - 300);
            setcookie("offset", "", time() - 300);

            // set new values to cookie
            setcookie("offset", $offset, 0, "/");
            setcookie("nbPages", ceil(count($allResult) / $page_limit), 0, "/");

            return $result;
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }

    public function fetchPageForUser(int $membre_id, ?int $currentPage, ?int $page_limit)
    {

        $page_limit = is_null($page_limit) ?self::PAGE_LIMIT : $page_limit;
        $offset = is_null($currentPage) ?self::OFFSET_DEFAULT * $page_limit : $currentPage * $page_limit;

        try {
            $request = $this->pdo->prepare("SELECT * from announce  WHERE membre_id=" . $membre_id . " order by date_enregistrement DESC LIMIT " . $page_limit . " OFFSET " . $offset);
            $allRequest = $this->pdo->prepare("SELECT id_annonce from announce WHERE membre_id=" . $membre_id);
            $allRequest->execute();
            $request->execute();

            $result = $request->fetchAll();
            $allResult = $allRequest->fetchAll();


            // unset before set
            setcookie("nbPages", "", time() - 300);
            setcookie("offset", "", time() - 300);

            // set new values to cookie (to avoid multiple same value)
            setcookie("offset", $offset, 0, "/");
            setcookie("nbPages", ceil(count($allResult) / $page_limit), 0, "/");

            return $result;
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }


    public function fetchAll()
    {

        try {
            $request = $this->pdo->prepare("SELECT * from announce");
            $request->execute();

            return $request->fetchAll();
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/list.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function fetchOne(int $id)
    {
        try {
            $request = $this->pdo->prepare("SELECT * from announce where id_annonce=" . $id);
            $request->execute();

            return $request->fetch();
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function update(int $id_annonce, string $titre, string $description_courte, string $description_longue, string $prix, string $photo, int $photo_id, string $pays, string $ville, string $adresse, int $cp, ?string $membre_id = null, ?int $categorie_id = null)
    {

        // modifier date

        $date_enregistrement = getNow();

        try {
            $request = $this->pdo->prepare("UPDATE announce SET titre= :titre, description_courte= :description_courte, description_longue= :description_longue , prix= :prix , photo= :photo , pays= :pays, ville= :ville, adresse= :adresse , 
            cp= :cp , membre_id= :membre_id , photo_id= :photo_id, categorie_id= :categorie_id, date_enregistrement= :date_enregistrement  WHERE id_annonce=" . $id_annonce . ";");
            echo "adresse from update $adresse";
            $request->bindParam(":titre", $titre);
            $request->bindParam(":description_courte", $description_courte);
            $request->bindParam(":description_longue", $description_longue);
            $request->bindParam(":prix", $prix);
            $request->bindParam(":photo", $photo);
            $request->bindParam(":pays", $pays);
            $request->bindParam(":ville", $ville);
            $request->bindParam(":adresse", $adresse);
            $request->bindParam(":cp", $cp);
            $request->bindParam(":membre_id", $membre_id);
            $request->bindParam(":photo_id", $photo_id);
            $request->bindParam(":categorie_id", $categorie_id);
            $request->bindParam(":date_enregistrement", $date_enregistrement);

            $request->execute();

            header("Location: https://deal-zuoqin.000webhostapp.com/view/post/list.php");

        }
        catch (PDOException $error) {
            echo "Error: $error";
        // header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function delete(int $id_annonce)
    {
        try {
            $request = $this->pdo->prepare("DELETE FROM announce WHERE id_annonce=:id_annonce");
            $request->bindParam(":id_annonce", $id_annonce);

            $request->execute();
            header("Location: https://deal-zuoqin.000webhostapp.com/view/post/list.php");
        }
        catch (PDOException $error) {
            header("Location: ../../view/post/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
}

?>