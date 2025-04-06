<?php
session_start();
include("connexion.php");

// Vérification de la session
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$idUser = $_SESSION['id'];
$sql = "SELECT * FROM utilisateur WHERE id=$idUser";
$result = mysqli_query($cn, $sql);
$row = mysqli_fetch_array($result);
$photo = $row["photo"];
$img = "userData/user_" . $idUser . "/" . $photo;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Amis</title>
    <link rel="stylesheet" href="stayle.css">
    <link rel="stylesheet" href="messageBox.css"> <!-- Inclusion du CSS du système de messagerie -->
    <style>
        .search-results {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: flex-start;
        }

        .search-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 200px;
            transition: transform 0.3s ease;
        }

        .search-card:hover {
            transform: translateY(-5px);
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #007bff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-left: auto;
            margin-right: auto;
        }

        .user-info {
            text-align: center;
            margin-bottom: 15px;
        }

        .name {
            font-size: 18px;
            font-weight: 600;
            margin: 10px 0;
            color: #333;
        }

        .fonction {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
            line-height: 1.4;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 10px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-profile {
            background: #007bff;
        }

        .btn-profile:hover {
            background: #0056b3;
        }

        .btn-block {
            background: #dc3545;
        }

        .btn-block:hover {
            background: #bb2d3b;
        }
    </style>
</head>
<body>
    <?php include("navBar.php"); ?>

    <div class="main-grid">
        <?php include("sidebar.php"); ?>

        <div class="content">
            <div class="card">
                <h2>Mes Amis</h2>

                <div class="search-results">
                    <?php
                    // Récupérer la liste des amis
                    $query = "SELECT u.id, u.nom, u.prenom, u.photo, u.fonction 
                              FROM utilisateur u 
                              INNER JOIN amie a ON (u.id = a.id_utilisateur OR u.id = a.id_amie)
                              WHERE (a.id_utilisateur = $idUser OR a.id_amie = $idUser) 
                              AND u.id <> $idUser AND a.etat = 'accepter'";
                    $result = mysqli_query($cn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($ami = mysqli_fetch_array($result)) {
                            echo "<div class='search-card'>";
                            echo "<img src='userData/user_" . $ami['id'] . "/" . $ami['photo'] . "' class='profile-photo' alt='photo'>";
                            echo "<div class='user-info'>";
                            echo "<p class='name'>" . $ami['nom'] . " " . $ami['prenom'] . "</p>";
                            echo "<p class='fonction'>Fonction: " . $ami['fonction'] . "</p>";
                            echo "<div class='buttons'>";
                            echo "<a href='friendProfile.php?amieid=" . $ami['id'] . "' class='btn btn-profile'>Voir Profil</a>";
                            echo "<a href='bloquer_ami.php?id=" . $ami['id'] . "' class='btn btn-block'>Bloquer</a>";
                            echo "</div></div></div>";
                        }
                    } else {
                        echo "<p>Vous n'avez pas encore d'amis.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion  de messagerie -->
    <?php include("messageBox.html"); ?>

   
</body>
</html>