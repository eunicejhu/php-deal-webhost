<?php

$isAdmin = true;
$isUser = isset($_COOKIE["logged_id"]) && $_COOKIE["login"];

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DEAL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/deal/index.php">Home</a>
                </li>
                <?php if ($isAdmin): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Backoffice
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Gestion des membres</a></li>
                        <li><a class="dropdown-item" href="#">Gestion des catégorie</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Gestion des commentaire</a></li>
                        <li><a class="dropdown-item" href="#">Statistique</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./view/post/create.php">Déposer une annonce </a>
                </li>
                <?php
endif; ?>
                <?php if (isset($_COOKIE["logged_id"]) && $_COOKIE["login"]) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Déconexion </a>
                </li>
                <?php
}
else { ?>

                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inscription </a>
                </li>
                <?php
}?>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>