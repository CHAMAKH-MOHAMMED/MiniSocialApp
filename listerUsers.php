<?php
include("connexion.php");

// Requête pour récupérer les données
$sql = "SELECT * FROM utilisateur;";
$result = mysqli_query($cn, $sql);
$conteur = 0;
// Vérification des résultats
if (mysqli_num_rows($result) > 0) {
    // Début du tableau HTML
    echo "<table border=1>";
    echo "<thead><tr>
            <th hidden>Num</th>
            <th >NO</th>
             <th>photo</th>
            <th>Nom</th>
            <th>Prénom</th> 
            <th>Filière</th>
             <th COLSPAN='3'>options</th>
        </tr></thead>";



    // Boucle pour afficher chaque ligne de la table
    while ($data = mysqli_fetch_array($result)) {
        if ($data['photo'] <> 'defaultImage.jpeg') {
            $src = "userData/user_" . $data['id'] . "/" . $data['photo'] . "";
        } else
            $src = "userData/userDefaultProfile/defaultImage.jpeg";

        echo "<tr>
                <td hidden>" . $data["id"] . "</td>
                  <td>" . $conteur++ . "</td>
                  <th> <img  src=" . $src . "  width='50' height='60'> </th>
                <td>" . $data["nom"] . "</td>
                <td>" . $data["prenom"] . "</td>
                <td>" . $data["filiere"] . "</td>
                <td><a href=\"userDetails.php?id=" . $data['id'] . "\">details</a></td>
                <td><a href=\"userDelete.php?id=" . $data['id'] . "\">delete</a></td>
                <td><a href=\"userUpdateForm.php?id=" . $data['id'] . "\">update</a></td>
</tr>";
    }

    // Fin du tableau HTML
    echo "</table>";
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion
mysqli_close($cn);
?>