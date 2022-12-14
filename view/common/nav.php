<?php

$isAdmin = $_COOKIE["is_admin"] ?? false;
$isUser = isset($_COOKIE["logged_id"]) && $_COOKIE["login"];
$isLoggedIn = $_COOKIE["login"] ?? false;

?>

<nav style="margin-bottom: 40px;" class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid" style="padding: 0;">
        <a class="navbar-brand" href="<?php echo $_ENV["BASE_URL"]; ?>/index.php">Deal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="<?php echo $_ENV["BASE_URL"]; ?>/index.php">Acceuil</a>
                </li>
                <?php if ($isUser): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Backoffice
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item"
                                href="<?php echo $_ENV["BASE_URL"]; ?>/view/post/list.php">Gestion des annonces</a>
                        </li>
                        <?php if ($isAdmin): ?>
                        <li><a class="dropdown-item"
                                href="<?php echo $_ENV["BASE_URL"]; ?>/view/user/list.php">Gestion des membres</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="<?php echo $_ENV["BASE_URL"]; ?>/view/category/list.php">Gestion des
                                cat??gorie</a></li>
                        <?php
    endif; ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">???? Nouvelle feature Bient??t!</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Gestion des commentaire</a></li>
                        <li><a class="dropdown-item" href="#">Statistique</a></li> -->
                    </ul>
                </li>
                <?php
endif; ?>
                <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_ENV["BASE_URL"]; ?>/view/post/create.php">D??poser une
                        annonce </a>
                </li>
                <?php
endif; ?>


            </ul>
            <form class="d-flex">
                <?php if ($isLoggedIn) { ?>
                <a class="btn btn-primary" href="<?php echo $_ENV["BASE_URL"]; ?>/view/user/logout.php">
                    D??conexion </a>
                <?php
}
else { ?>

                <a class="btn btn-primary" href="<?php echo $_ENV["BASE_URL"]; ?>/view/user/login.php">Login</a>
                <a class="nav-link" href="<?php echo $_ENV["BASE_URL"]; ?>/view/user/inscription.php">Inscription
                </a>
                <?php
}?>
                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
        </div>
    </div>
</nav>