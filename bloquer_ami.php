<?php 
session_start();
if(isset($_GET['id'])){
    include("connexion.php");
    $idAmie = $_GET['id']; // L'expéditeur de l'invitation
    $idutilisateur = $_SESSION['id']; // L'utilisateur connecté

    // Vérifier si la connexion à la base de données est établie
    if ($cn) {
        // Mettre à jour l'état de l'invitation
        $sql = "UPDATE `amie` SET `etat`='bloquer' WHERE id_utilisateur='$idutilisateur' AND id_amie='$idAmie' or id_utilisateur='$idAmie' AND id_amie='$idutilisateur'";
        mysqli_query($cn, $sql);
    } else {
        // Gérer l'erreur de connexion
        die("Erreur de connexion à la base de données.");
    }

    // Redirection vers la page des amis
    header('Location: amie.php');
}
?>
