<?php 
session_start();
if(isset($_GET['id'])){
    include("connexion.php");
	$idDest = $_GET['id'];
	$idExp= $_SESSION['id'];
	$date=date("Y-m-d");
	$etat="en attente";
	$sql = "INSERT INTO `invitation`(`emetteur`, `recipient`, `etat`, `date`) VALUES ('$idExp','$idDest','$etat','$date')";
	mysqli_query($cn,$sql);
	header('Location:rechercher.php');
}

?>