<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Utilisateur</title>
    <link rel="stylesheet" href="stayle.css">   
    
    <?php
    session_start();
    include("connexion.php");
    $id=$_SESSION['id'];
    $sql = "SELECT * FROM utilisateur WHERE id=$id";
    $result = mysqli_query($cn, $sql);
    $row = mysqli_fetch_array($result);
    $photo = $row["photo"];
    $img = "userData/user_" . $id . "/" . $photo;
    ?>
</head>

<body>
<?php include("navBar.php"); ?>
    <div class="main-grid">
 
    <?php include("sidebar.php"); ?>
    

        <div class="content">
            <div class="card">
                <h2>Profil Utilisateur</h2>
                
                
                <div class="profile-grid">
                    <img src="<?php echo $img ?>" class="profile-photo" alt="Photo de profil">
                    <div class="profile-info">
                        <p><strong>Nom:</strong> <?php echo $row['nom']; ?></p>
                        <p><strong>Prénom:</strong> <?php echo $row['prenom']; ?></p>
                        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                        <p><strong>Date de naissance:</strong> <?php echo date('d/m/Y', strtotime($row['ddn'])); ?></p>
                        <p><strong>Sexe:</strong> <?php echo ($row['sexe'] == 'M' ? 'Masculin' : 'Féminin'); ?></p>
                        <p><strong>Filière:</strong> <?php echo $row['filiere']; ?></p>
                        <p><strong>Adresse:</strong> <?php echo $row['adresse']; ?></p>
                        <p><strong>Intérêts:</strong> <?php echo $row['interets']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>