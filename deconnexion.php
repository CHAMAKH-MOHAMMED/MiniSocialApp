<?php 
session_start();
include("connexion.php");
//recuperation de id de l'utilisateur
$id = $_SESSION['id'];
//cree une requet qui mise ajour etat de utlisteur hors ligne
$sql = "UPDATE utilisateur SET etat = 'Hors ligne' WHERE id = $id";
//executer la requet
mysqli_query($cn, $sql);
//detruire la session
session_unset();
session_destroy();
//rediriger vers la page de connexion
header("location:index.html");

exit();
?>