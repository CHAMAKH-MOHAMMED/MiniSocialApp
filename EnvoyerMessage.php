<?php
session_start();
include("connexion.php");

if(isset($_SESSION['id']) && isset($_GET['message'])) {
    // Protection basique contre les injections SQL
    $expediteur_id = $_SESSION['id'];
    
    $destinataire_id = $_GET['friend_id'];
    $contenu =  $_GET['message'];
    $date_envoi = date("Y-m-d H:i:s"); // Format datetime plus précis
    echo $date_envoi .$contenu.$destinataire_id.$expediteur_id;
    $sql = "INSERT INTO message (expediteur_id, destinataire_id, contenu, date_envoi)
            VALUES ('$expediteur_id', '$destinataire_id', '$contenu', '$date_envoi')";

    mysqli_query($cn, $sql);
      
    mysqli_close($cn);
    
}
else {
    echo "Erreur: Veuillez vous connecter pour envoyer un message.";
}

?>