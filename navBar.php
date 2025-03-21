<nav>
        <div class="user">
            <img src="<?php echo $img ?>" alt="photo de profil">
            <strong><?php echo $_SESSION["user"] ?></strong>
        </div>
        <ul>
            <li><a href="index.html"><img src="TOF/home.png" alt="Accueil" width="20" height="20"></a></li>
            <li><a href="deconnexion.php" class="header_logout">Logout</a></li>
        </ul>
    </nav>