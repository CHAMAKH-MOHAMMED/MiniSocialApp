<?php 
session_start();
if(isset($_GET['id'])){
    include("connexion.php");
    $idExp = $_GET['id']; // L'expéditeur de l'invitation
    $idDest = $_SESSION['id']; // L'utilisateur connecté

    // Mettre à jour l'état de l'invitation
    $sql = "UPDATE invitation SET etat='accepter' WHERE emetteur='$idExp' AND recipient='$idDest'";
    mysqli_query($cn, $sql);

    // Ajouter dans la table des amis
    $sql2 = "INSERT INTO amie (id_utilisateur, id_amie, etat) VALUES ('$idDest', '$idExp', 'accepter')";
    mysqli_query($cn, $sql2);

    // Redirection vers la page des amis
    header('Location: amie.php');
}
?>
