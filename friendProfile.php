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
   
    $amie=$_GET['amieid'];
    $sql = "SELECT * FROM utilisateur WHERE id=$amie";
    $result = mysqli_query($cn, $sql);
    $row = mysqli_fetch_array($result);
    $photo = $row["photo"];
    $imgP = "userData/user_" . $amie . "/" . $photo;
    //image de profil de utlisateur
    
    
    $id = $_SESSION["id"];
    $sqlP = "SELECT * FROM utilisateur WHERE id=$id;";
    $resultP = mysqli_query($cn, $sqlP);
    $rowP = mysqli_fetch_array($resultP);
    $photoP = $rowP["photo"];
    $img = "userData/user_" . $id . "/" . $photoP;

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
                    <img src="<?php echo $imgP ?>" class="profile-photo" alt="Photo de profil">
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