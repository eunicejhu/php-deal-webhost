<?php
// require_once("../config/database.php");
// require_once("../model/PhotoModel.php");
// require_once("../util/date.php");
// require_once("../util/validate.php");

// $photoController = new PhotoController("php");
// // var_dump($photoController->fetchOne(43));
// // var_dump($photoController->update(43, "this is image url"));

// var_dump($photoController->delete(43));

class PhotoController
{
    private $photo1;
    private $photo2;
    private $photo3;
    private $photo4;
    private $photo5;


    public function __construct(string $photo1, ?string $photo2 = null, ?string $photo3 = null, ?string $photo4 = null, ?string $photo5 = null)
    {
        $this->setPhoto1($photo1);
        $this->setPhoto2($photo2);
        $this->setPhoto3($photo3);
        $this->setPhoto4($photo4);
        $this->setPhoto5($photo5);
    }

    public function create()
    {
        $photoModel = new PhotoModel();
        return $photoModel->create($this->getPhoto1(), $this->getPhoto2(), $this->getPhoto3(), $this->getPhoto4(), $this->getPhoto5());
    }

    public function fetchOne(int $id)
    {
        $photoModel = new PhotoModel();
        return $photoModel->fetchOne($id);
    }

    public function update(int $id_photo)
    {
        $photoModel = new PhotoModel();
        return $photoModel->update($id_photo, $this->photo1, $this->photo2, $this->photo3, $this->photo4, $this->photo5);
    }

    public function delete(int $id)
    {
        $photoModel = new PhotoModel();
        return $photoModel->delete($id);
    }

    /**
     * Get the value of photo1
     */
    public function getPhoto1()
    {
        return decode($this->photo1);
    }

    /**
     * Set the value of photo1
     *
     * @return  self
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = encode($photo1);

        return $this;
    }

    /**
     * Get the value of photo2
     */
    public function getPhoto2()
    {
        return is_null($this->photo2) ? $this->photo2 : decode($this->photo2);
    }

    /**
     * Set the value of photo2
     *
     * @return  self
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = is_null($photo2) ? $photo2 : encode($photo2);

        return $this;
    }

    /**
     * Get the value of photo3
     */
    public function getPhoto3()
    {
        return is_null($this->photo3) ? $this->photo3 : decode($this->photo3);
    }

    /**
     * Set the value of photo3
     *
     * @return  self
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = is_null($photo3) ? $photo3 : encode($photo3);

        return $this;
    }

    /**
     * Get the value of photo4
     */
    public function getPhoto4()
    {
        return is_null($this->photo4) ? $this->photo4 : decode($this->photo4);
    }

    /**
     * Set the value of photo4
     *
     * @return  self
     */
    public function setPhoto4($photo4)
    {
        $this->photo4 = is_null($photo4) ? $photo4 : encode($photo4);

        return $this;
    }

    /**
     * Get the value of photo5
     */
    public function getPhoto5()
    {
        return is_null($this->photo5) ? $this->photo5 : decode($this->photo5);
    }

    /**
     * Set the value of photo5
     *
     * @return  self
     */
    public function setPhoto5($photo5)
    {
        $this->photo5 = is_null($photo5) ? $photo5 : encode($photo5);

        return $this;
    }
}
?>