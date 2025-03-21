<?php
session_start();
include("connexion.php");

// Vérification de la session
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$idUser = $_SESSION['id'];

$query = "SELECT u.id, u.nom, u.prenom, u.photo, u.etat 
          FROM utilisateur u 
          INNER JOIN amie a ON (u.id = a.id_utilisateur OR u.id = a.id_amie)
          WHERE (a.id_utilisateur = $idUser OR a.id_amie = $idUser) AND u.id <> $idUser";

$result = mysqli_query($cn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<ul class="friend-list">';
    while ($ami = mysqli_fetch_array($result)) {
        $photo = !empty($ami['photo']) ? "userData/user_" . $ami['id'] . "/" . $ami['photo'] : "default-avatar.png";
        $status = ($ami['etat'] == 'en Ligne') ? "<span class='status online'>En ligne</span>" : "<span class='status offline'>Hors ligne</span>";

        echo "<li class='friend-item' id='friend-" . $ami['id'] . "'>";
        echo "<img src='$photo' class='profile-photo' alt='photo'>";
        echo "<div class='friend-info'>";
        echo "<p class='name'>" . $ami['nom'] . " " . $ami['prenom'] . "</p>";
        echo $status;
        echo "</div>";
        echo "<button class='btn-message' onclick='openMessageBox(" . $ami['id'] . ")'>Message</button>";
        echo "</li>";
    }
    echo '</ul>';
} 
?>

