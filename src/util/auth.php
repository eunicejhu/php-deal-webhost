<?php
function auth()
{
    echo "<pre>";
    var_dump($_COOKIE);
    echo "</pre>";
    if (empty($_COOKIE["login"])) {
        header("Location: /deal/view/user/login.php");
    }
}
?>