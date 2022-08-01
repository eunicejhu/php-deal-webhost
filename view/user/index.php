<?php
require_once("../../src/config/database.php");
require_once("../../src/model/UserModel.php");
require_once("../../src/controller/UserController.php");

// date_default_timezone_set("Europe/Paris");
// $userController = new UserController("pseudo", "12345678", "nom", "ss", "037293", "nom1@gmail.com", 'f', 0, date("Y-m-d H:i:s")); 


if (!(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) && $_POST["type"] == "create") {

    $userController = new UserController($_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"]);
    echo "type" . $_POST["type"] . "</br>";
    $userController->create();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>List of users</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <h1>List of users</h1>
    <form action="./index.php" method="POST">
        <label for="firstname">Firstname</label>
        <input id="firstname" name="firstname" type="text" value="<script></script>" required />

        <label for="lastname">Lastname</label>
        <input id="lastname" name="lastname" type="text" required />

        <label for="email">Email</label>
        <input id="email" name="email" type="email" required />

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required />
        <input type="hidden" name="type" value="create" />
        <input type="submit" value="Create" />
    </form>
    <?php
foreach ($users as $user):
?>
    <p></p>
    <p>
        <li><?= $user["firstname"] ?> <?= $user["lastname"] ?> <a href="edit.php?id=<?= $user["id"] ?>"> Edit</a>
            <a href="delete.php?id=<?= $user["id"] ?>"> Delete</a>
        </li>

    </p>
    <?php
endforeach; ?>

</body>

</html>

<!-- 
    How to secure form?
    - validation of data
    - clean data
        -- htmlentities / htmlspecialchars : we only have text
        -- strip_tags: it delete html tags and php tags
        
        -- addSlashes: it allows to add antislashes to a string. (setters)
        -- stripslashes: it allows to remove the antislashes. (getters)

        -- trim: it allows remove the spaces at the beginning or the end of string.
        -- strtolower: it remove the capital letters.


    - xss
    - SQL injection
-->