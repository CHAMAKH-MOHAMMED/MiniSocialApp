<?php 
if(isset($_GET["id"])){
    $id = $_GET['id'];
    include("connexion.php");
    $sql = "SELECT * FROM `utilisateur` WHERE `id`='$id';";
    $result = mysqli_query($cn, $sql);
    $data = mysqli_fetch_assoc($result);
    
   
    $interetsArray = explode(",", $data['interets']);
    
    ?>
    <form method="POST" action="userUpdate.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <h1><em>Modifier un utilisateur</em></h1>
        <ul>
            <li>
                <label for="nom">Nom:</label>
                <input type="text" name="nom" placeholder="entrer le nom..." required value="<?php echo $data['nom']; ?>">
            </li>
            
            <li>
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" placeholder="entrer le prénom..." required value="<?php echo $data['prenom']; ?>">
            </li>
            <li>
                Date de naissance:
                <input type="date" name="ddn" placeholder="jj/mm/aaaa" value="<?php echo $data['ddn'];?>">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $data['email']; ?>">
            </li>
            <li>
                <label for="sexe">Sexe:</label>
                <span class="sexe">
                    <label> Homme: <input type="radio" name="sexe" value="M" <?php if ($data['sexe'] == 'M') echo 'checked'; ?> required></label>
                    <label> Femme: <input type="radio" name="sexe" value="F" <?php if ($data['sexe'] == 'F') echo 'checked'; ?>></label>
                </span>
            </li>
            <li>
                <label for="filière">Filière:</label>
                <select name="filiere" id="filière">
                    <option class="options" value="dsi" <?php if ($data['filiere'] == 'dsi') echo 'selected'; ?>>Développement des Systèmes d’Information</option>
                    <option class="options" value="SE" <?php if ($data['filiere'] == 'SE')   echo 'selected'; ?>>Systèmes Electroniques</option>
                    <option class="options" value="CPI" <?php if ($data['filiere'] == 'CPI') echo 'selected'; ?>>Conception du Produit Industriel</option>
                    <option class="options" value="PME" <?php if ($data['filiere'] == 'PME') echo 'selected'; ?>>PME.PMI</option>
                </select>
            </li>
            <li>
                <label>Intérêts :</label><br>
                <input type="checkbox" name="interets[]" value="sport" <?php if (in_array('sport', $interetsArray)) echo 'checked'; ?>> Sport
                <input type="checkbox" name="interets[]" value="musique" <?php if (in_array('musique', $interetsArray)) echo 'checked'; ?>> Musique
                <input type="checkbox" name="interets[]" value="lecture" <?php if (in_array('lecture', $interetsArray)) echo 'checked'; ?>> Lecture
            </li>
            <li>
                Adresse :
                <input type="text" name="adresse" placeholder="entrer votre adresse..." value="<?php echo $data['adresse']; ?>">
            </li>
           
            <li>
                <input class="valider" type="submit" value="Envoyer">
                <input class="valider" type="reset" value="Réinitialiser">
            </li>
        </ul>
    </form>
<?php   
} else {
    echo "Aucun enregistrement trouvé.";
}
?>
