<?php

// testing
// require_once("../config/database.php");
// require_once("../model/UserModel.php");

// date_default_timezone_set("Europe/Paris");
// $userController = new UserController("isao2", "123456789", "nom", "ss", "037293", "nom4@gmail.com", 'f', 0, null);


// $userController = new UserController("", "12345678", "", "", "", "nom2@gmail.com", 'f', 0, date("Y-m-d H:i:s"));





// $userController = new UserController("eunice2@gmail.com", "***********", "isa", "lastname");
// $userController = new UserController("sdf@sdf", "***********", null, "<script>alert('injection')</script>");
// $userController = new UserController("eunice1@gmail.com", "***********", null, "lastname");

// --login

// $userController->login("pseudo10", "123456789");

// -- create
//$userController->create(); // create with used gmail, error caught in UserModel level, no need to try-catch in UserController
//$userController->setFirstname(null); // DON'T SET null to no-null parameter


// -- update
//$userController->update(2); // works
// $userController->update("10"); // works

// --fetchAll
// echo "<pre>";
// var_dump($userController->fetchAll());
// echo "</pre>";

// --fetchOne


// echo "<pre>";
// var_dump($userController->fetchOne(2)); //works!  injection code will be executed here!!!! IMPORTANT User htmlentities to avoid execution of script!
// // var_dump($userController->fetchOne("10")); //works!
// echo "</pre>";

// --delete

//$userController->delete(2); // works


class UserController
{
    private string $pseudo;
    private string $mdp;
    private string $nom;
    private string $prenom;
    private string $telephone;
    private string $email;
    private string $civilite;
    private string $statut;
    private string $date_enregistrement;

    public function login(string $pseudo, string $mdp)
    {
        $userModel = new UserModel();
        $userModel->login($pseudo, $mdp);

    }

    public function getNow()
    {
        date_default_timezone_set("Europe/Paris");
        return date("Y-m-d H:i:s");
    }


    public function __construct(string $pseudo, string $mdp, string $nom, string $prenom, string $telephone, string $email, string $civilite, int $statut, ?string $date_enregistrement = null)
    {
        $this->setPseudo($pseudo);
        $this->setMdp($mdp);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setTelephone($telephone);
        $this->setEmail($email);
        $this->setCivilite($civilite);
        $this->setStatut($statut);
        $this->setDate_enregistrement($date_enregistrement ? $date_enregistrement : $this->getNow());

    }
    public function create()
    {
        $userModel = new UserModel();
        $userModel->create($this->getPseudo(), $this->getMdp(), $this->getNom(), $this->getPrenom(), $this->getTelephone(), $this->getEmail(), $this->getCivilite(), $this->getStatut(), $this->getDate_enregistrement());
    }
    public function update(int $id_membre)
    {
        $userModel = new UserModel();
        $userModel->update($id_membre, $this->getPseudo(), $this->getMdp(), $this->getNom(), $this->getPrenom(), $this->getTelephone(), $this->getEmail(), $this->getCivilite(), $this->getStatut(), $this->getDate_enregistrement());
    }

    public function fetchAll()
    {
        $userModel = new UserModel();
        return $userModel->fetchAll();
    }

    public function fetchOne(int $id_membre)
    {
        $userModel = new UserModel();
        return $userModel->fetchOne($id_membre);
    }

    public function delete(int $id_membre)
    {
        $userModel = new UserModel();
        $userModel->delete($id_membre);
    }


    public function setPseudo(string $pseudo): string
    {
        $pseudo = htmlentities($pseudo);
        return $this->pseudo = $pseudo;
    }
    public function getPseudo(): string
    {
        $pseudo = html_entity_decode($this->pseudo);
        return $pseudo;
    }

    public function setMdp(string $mdp): string
    {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        return $this->mdp = $mdp;
    }
    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setNom(string $nom): string
    {
        $nom = htmlentities($nom);
        return $this->nom = $nom;
    }
    public function getNom(): string
    {
        $nom = html_entity_decode($this->nom);
        return $nom;
    }

    public function setPrenom(string $prenom): string
    {
        $prenom = htmlentities($prenom);
        return $this->prenom = $prenom;
    }
    public function getPrenom(): string
    {
        $prenom = html_entity_decode($this->prenom);
        return $prenom;
    }

    public function setTelephone(string $telephone): string
    {
        return $this->telephone = $telephone;
    }
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setEmail(string $email): string
    {
        $email = htmlentities($email);
        return $this->email = $email;
    }
    public function getEmail(): string
    {
        $email = html_entity_decode($this->email);
        return $email;
    }

    public function setCivilite(string $civilite): string
    {
        return $this->civilite = $civilite;
    }
    public function getCivilite(): string
    {
        return $this->civilite;
    }

    public function setStatut(int $statut): int
    {
        return $this->statut = $statut;
    }
    public function getStatut(): int
    {
        return $this->statut;
    }

    public function setDate_enregistrement(string $date_enregistrement): string
    {
        return $this->date_enregistrement = $date_enregistrement;
    }
    public function getDate_enregistrement(): string
    {
        return $this->date_enregistrement;
    }

}

?>