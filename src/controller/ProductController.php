<?php
require_once('../src/model/ProductModel.php');

$productController = new ProductController($_POST['entitled'], $_POST['description'], $_POST['price']);
$productController->callCreate();

class ProductController {

    private $entitled;

    private $description;

    private $price;

    public function __construct($entitled, $description, $price){
        $this->setEntitled($entitled);
        $this->setDescription($description);
        $this->setPrice($price);
    }

    public function callCreate(){
        // Cette méthode à pour rôle de relier le model et le controller.
        // Elle appelle la méthode create.
        // Ici nous n'avons pas de système de route, c'est pour ça que c'est un peu répétitif.
        $productModel = new ProductModel();

        $productModel->create($this->entitled, $this->description, $this->price);
    }

    public function callRead(){
        $productModel = new ProductModel();

        return $productModel->read();
    }

    public function getEntitled(){
        return $this->entitled;
    }

    public function setEntitled($entitled){
        return $this->entitled = $entitled;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        return $this->description = $description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        return $this->price = $price;
    }

}

?>