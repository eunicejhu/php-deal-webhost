<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Zone d'administration</h1>

    <form action="../src/controller/ProductController.php" method="POST">
        <!-- Les attributs actions, method et name sont indispensables. -->
        <label for="entitled">Intitulé</label>
        <input type="text" id="entitled" name="entitled" required>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" required>

        <label for="price">Prix</label>
        <input type="text" id="price" name="price" required>

        <button>Ajouter le produit</button>
    </form>
</body>

</html>

<?php
require_once('../src/controller/ProductController.php');

// $productController = new ProductController(null, null, null);
// $products = $productController->callRead();

// var_dump($products);
// var_dump($_POST);
// $_POST contient l'ensemble des données du formulaire.

// echo '<pre>';
// print_r(get_declared_classes());
// echo '</pre>';
?>