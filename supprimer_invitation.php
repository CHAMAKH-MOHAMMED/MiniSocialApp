<?php 
session_start();
if(isset($_GET['id'])){
    include("connexion.php");
    $idExp = $_GET['id']; // L'expéditeur de l'invitation
    $idDest = $_SESSION['id']; // L'utilisateur connecté

    // Supprimer l'invitation de la base de données
    $sql = "DELETE FROM invitation WHERE emetteur='$idExp' AND recipient='$idDest'";
    mysqli_query($cn, $sql);

    // Redirection vers la page des invitations après suppression
    header('Location: invetation.php');
}
?>
