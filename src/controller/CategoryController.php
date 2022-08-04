<?php
// require_once("../config/database.php");
// require_once("../model/CategoryModel.php");
// require_once("../util/validate.php");

// $categoryController = new CategoryController("Multimedia", "Projecteur");
// $categoryController->create();
// var_dump($categoryController->fetchAll());
// var_dump($categoryController->fetchOne(3));

// $categoryController->update(3);
// // var_dump($photoController->update(43, "this is image url"));

// $categoryController->delete(3);

class CategoryController
{
    private string $id_categorie;
    private ?string $titre;
    private ?string $motscles;



    public function __construct(string $titre, string $motscles)
    {
        $this->setTitre($titre);
        $this->setMotscles($motscles);

    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->create($this->getTitre(), $this->getMotscles());
    }

    public function fetchAll()
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->fetchAll();
    }

    public function fetchOne(int $id)
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->fetchOne($id);
    }

    public function update(int $id_categorie)
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->update($id_categorie, $this->titre, $this->motscles);
    }

    public function delete(int $id)
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->delete($id);
    }




    /**
     * Get the value of id_categorie
     */
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return decode($this->titre);
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = encode($titre);

        return $this;
    }

    /**
     * Get the value of motscles
     */
    public function getMotscles()
    {
        return decode($this->motscles);
    }

    /**
     * Set the value of motscles
     *
     * @return  self
     */
    public function setMotscles($motscles)
    {
        $this->motscles = encode($motscles);

        return $this;
    }
}
?>