<?php

if (isset($_COOKIE["logged_id"])) {
    setcookie("logged_id", false, time() - 300, "/");
}
if (isset($_COOKIE["login"])) {
    setcookie("login", false, time() - 300, "/");
}
if (isset($_COOKIE["is_admin"])) {
    setcookie("is_admin", false, time() - 300, "/");
}

header("Location: /deal/index.php");

?>