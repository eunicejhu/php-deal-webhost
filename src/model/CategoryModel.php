<?php

//testing


// require_once("../config/database.php");

// $categoryModel = new CategoryModel();


//-- create
// $categoryModel->create("high-tech", "portable");

//-- fetcheAll
// set host to localhost1  see exception        
// echo "<pre>";
// var_dump($categoryModel->fetchAll());
// echo "</pre>";
//-- fetchOne
// echo "<pre>";
// var_dump($categoryModel->fetchOne(1));
// echo "</pre>";
// -- update

// $categoryModel->update(1, "high-tech", "电脑");
// delete
// $categoryModel->delete(1);



class CategoryModel
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPDO();

    }

    public function create(string $titre, string $motscles)
    {
        try {
            $request = $this->pdo->prepare("INSERT INTO categorie(titre, motscles) VALUES(:titre, :motscles)");


            $request->bindParam(":titre", $titre);
            $request->bindParam(":motscles", $motscles);

            $request->execute();

            header("Location: ../../view/category/list.php?success");

        }
        catch (PDOException $error) {
            header("Location: ../../view/category/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function fetchAll()
    {
        try {
            $request = $this->pdo->prepare("SELECT * from categorie");
            $request->execute();

            return $request->fetchAll();
        }
        catch (PDOException $error) {
            header("Location: ../../view/category/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }

    public function fetchOne(int $id)
    {
        try {
            $request = $this->pdo->prepare("SELECT * from categorie where id_categorie=" . $id);
            $request->execute();

            return $request->fetch();
        }
        catch (PDOException $error) {
            header("Location: ../../view/category/error.php?error=" . $error->getCode() . "-" . $error->getMessage());
        }
    }
    public function update(int $id_categorie, string $titre, string $motscles)
    {

        try {
            $request = $this->pdo->prepare("UPDATE categorie SET titre= :titre, motscles= :motscles  WHERE id_categorie=" . $id_categorie . ";");

            $request->bindParam("titre", $titre, PDO::PARAM_STR);
            $request->bindParam(":motscles", $motscles, PDO::PARAM_STR);

            $request->execute();

            header("Location: ../../view/category/list.php?success");
        }
        catch (PDOException $error) {

            header("Location: ../../view/category/list.php?error=" . $error->getMessage());
            return false;
        }
    }
    public function delete(int $id_categorie)
    {
        try {
            $request = $this->pdo->prepare("DELETE FROM categorie WHERE id_categorie=:id_categorie");
            $request->bindParam(":id_categorie", $id_categorie);

            $request->execute();
            header("Location: ../../view/category/list.php?success");
        }
        catch (PDOException $error) {
            header("Location: ../../view/category/list.php?error=" . $error->getMessage());
            return false;
        }
    }
}

?>