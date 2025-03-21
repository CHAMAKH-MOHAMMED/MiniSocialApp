<?php
//etablir la connixion avec la base de donnes
include("connexion.php");

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$ddn = $_POST['ddn'];
$sexe = $_POST['sexe'];
$filiere = $_POST['filiere'];
$adresse = $_POST['adresse'];
$password = md5($_POST['password']);
$fonction = $_POST['fonction'];
$profile=$_FILES['photo'];
if (isset($_POST['interets']) ) {
    // Récupérer les valeurs 
    $interetsArray = $_POST['interets'];
    // Convertir en une chaîne par la fonction join
    
    $interets = join(",", $interetsArray);
} else {
    // Aucun intérêt sélectionné
    $interets = '';
}   
if (isset($_FILES['photo']) && $_FILES['photo']['error']==0   && $_FILES['photo']['size'] < 10000000    ) {
    $profile=$_FILES['photo']['name'];
     
// Requête d'insertion
$query = "INSERT INTO utilisateur (id, nom, prenom, email, ddn, sexe, filiere, adresse, password,interets,photo,fonction) 
          VALUES (NULL, '$nom', '$prenom', '$email', '$ddn', '$sexe', '$filiere', '$adresse', '$password','$interets','$profile','$fonction')";
          mysqli_query($cn,$query);

//creation dossier user+id
$id=mysqli_insert_id($cn);
$userdirectory="userData/user_".$id;

mkdir($userdirectory);



$source=$_FILES['photo']['tmp_name'];
$destination = $userdirectory.'/'.$profile;
move_uploaded_file($source,$destination);
mysqli_close($cn);
header('Location:login.html');
}
else{

    $profile="defaultImage.jpeg";
    $query = "INSERT INTO utilisateur (id, nom, prenom, email, ddn, sexe, filiere, adresse, password,interets,photo) 
          VALUES (NULL, '$nom', '$prenom', '$email', '$ddn', '$sexe', '$filiere', '$adresse', '$password','$interets','$profile')";
         mysqli_query($cn,$query);
         
         mysqli_close($cn);
         header('Location:login.html');
}

?>
