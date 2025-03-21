<?php
    if(isset($_GET["id"])){

        $id=$_GET["id"];
        include("connexion.php");

        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $ddn = $_POST['ddn'];
        $sexe = $_POST['sexe'];
        $filiere = $_POST['filiere'];
        $adresse = $_POST['adresse'];
        if (isset($_POST['interets']) ) {
            // Récupérer les valeurs 
            $interetsArray = $_POST['interets'];
            // Convertir en une chaîne par la fonction join
            $interets = join(",", $interetsArray);
        } else {
            // Aucun intérêt sélectionné
            $interets = '';
        }   
// Requête d'insertion
$sql = "UPDATE utilisateur SET 
nom='$nom', 
prenom='$prenom', 
email='$email', 
ddn='$ddn', 
sexe='$sexe', 
filiere='$filiere', 
adresse='$adresse', 
interets='$interets' 
WHERE id='$id'";

// Exécution de la requête
if (mysqli_query($cn, $sql)) {
    header('Location:listerUsers.php');

} else {
    echo "Erreur : " . mysqli_error($cn);
}

// Fermeture de la connexion
mysqli_close($cn);
        }else 
            echo "Pas d'identifiant correspondant";
        


?>