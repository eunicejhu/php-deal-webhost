<?php


// require_once("../config/database.php");
// require_once("../model/PostModel.php");
// require_once("../util/date.php");
// require_once("../util/validate.php");


// $postController = new PostController("Macbook Pro 13", "pc", "pc Apple", "1299€", "photo_lien", "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2);


// // $postController->create();
// // $postController->update(3, "Macbook Pro", "pc", "pc Apple", "1299€", "photo_lien", "France", "Paris", '11 Avenue Richard', 75003, null, 1, 2);

// echo "<pre>";
// // var_dump($postController->fetchAll());
// var_dump($postController->fetchPage());
// echo "</pre>";

// $postController->delete(4);


class PostController
{
    private string $titre;
    private string $description_courte;
    private string $description_longue;
    private string $prix;
    private string $photo;
    private string $pays;
    private string $ville;
    private string $adresse;

    private int $cp;
    private ?int $membre_id;
    private ?int $photo_id;
    private ?int $categorie_id;


    public function __construct(string $titre, string $description_courte, string $description_longue, string $prix, string $photo, string $pays, string $ville, string $adresse, int $cp, ?string $membre_id = null, ?int $photo_id = null, ?int $categorie_id = null)
    {

        $this->setTitre($titre);
        $this->setDescription_courte($description_courte);
        $this->setDescription_longue($description_longue);
        $this->setPrix($prix);
        $this->setPhoto($photo);
        $this->setPays($pays);
        $this->setVille($ville);
        $this->setAdresse($adresse);
        $this->setCp($cp);
        $this->setMembre_id($membre_id);
        $this->setPhoto_id($photo_id);
        $this->setCategorie_id($categorie_id);


    }
    public function create()
    {
        $postModel = new PostModel();


        $postModel->create($this->getTitre(), $this->getDescription_courte(), $this->getDescription_longue(), $this->getPrix(), $this->getPhoto(), $this->getPays(), $this->getVille(), $this->getAdresse(), $this->getCp(), $this->getMembre_id(), $this->getPhoto_id(), $this->getCategorie_id());
    }

    public function update(int $id_annonce)
    {
        $postModel = new PostModel();
        $postModel->update($id_annonce, $this->getTitre(), $this->getDescription_courte(), $this->getDescription_longue(), $this->getPrix(), $this->getPhoto(), $this->getPays(), $this->getVille(), $this->getAdresse(), $this->getCp(), $this->getMembre_id(), $this->getPhoto_id(), $this->getCategorie_id());
    }

    public function fetchPage(?int $offset = null, ?int $page_limit = null)
    {
        $postModel = new PostModel();
        return $postModel->fetchPage($offset, $page_limit);

    }
    public function fetchAll()
    {
        $postModel = new PostModel();
        return $postModel->fetchAll();
    }
    public function fetchOne(int $id_annonce)
    {
        $postModel = new PostModel();
        return $postModel->fetchOne($id_annonce);
    }
    public function delete(int $id_annonce)
    {
        $postModel = new PostModel();
        $postModel->delete($id_annonce);
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
     * Get the value of description_courte
     */
    public function getDescription_courte()
    {
        return decode($this->description_courte);
    }

    /**
     * Set the value of description_courte
     *
     * @return  self
     */
    public function setDescription_courte($description_courte)
    {
        $this->description_courte = encode($description_courte);

        return $this;
    }

    /**
     * Get the value of description_longue
     */
    public function getDescription_longue()
    {
        return decode($this->description_longue);
    }

    /**
     * Set the value of description_longue
     *
     * @return  self
     */
    public function setDescription_longue($description_longue)
    {
        $this->description_longue = encode($description_longue);

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix()
    {
        return encode($this->prix);
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */
    public function setPrix($prix)
    {
        $this->prix = decode($prix);

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of pays
     */
    public function getPays()
    {
        return decode($this->pays);
    }

    /**
     * Set the value of pays
     *
     * @return  self
     */
    public function setPays($pays)
    {
        $this->pays = encode($pays);

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille()
    {
        return decode($this->ville);
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */
    public function setVille($ville)
    {
        $this->ville = encode($ville);

        return $this;
    }

    /**
     * Get the value of adresse
     */
    public function getAdresse()
    {
        return decode($this->adresse);
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = encode($adresse);

        return $this;
    }

    /**
     * Get the value of cp
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of membre_id
     */
    public function getMembre_id()
    {
        return $this->membre_id;
    }

    /**
     * Set the value of membre_id
     *
     * @return  self
     */
    public function setMembre_id($membre_id)
    {
        $this->membre_id = $membre_id;

        return $this;
    }

    /**
     * Get the value of photo_id
     */
    public function getPhoto_id()
    {
        return $this->photo_id;
    }

    /**
     * Set the value of photo_id
     *
     * @return  self
     */
    public function setPhoto_id($photo_id)
    {
        $this->photo_id = $photo_id;

        return $this;
    }

    /**
     * Get the value of categorie_id
     */
    public function getCategorie_id()
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     *
     * @return  self
     */
    public function setCategorie_id($categorie_id)
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

}

?>