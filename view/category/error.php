<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error</title>
</head>

<body>
    <h1>Oops! Errors occur!</h1>

    <?php
if (!empty($_GET["error"])) {
    echo "<p>" . $_GET["error"] . "</p>";
}
?>
</body>

</html>