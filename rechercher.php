<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher</title>
    <link rel="stylesheet" href="stayle.css">   
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
            width: 250px;
            transition: transform 0.3s ease;
    
}

.search-card:hover {
    transform: translateY(-5px);
}

.profile-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-left: auto;
    margin-right: auto; 
    margin-bottom: 15px;
    border: 3px solid #007bff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
    gap: 6px;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn img {
    width: 18px;
    height: 18px;
}

.btn-profile {
    background: #007bff;
    color: white;
}


.btn-profile:hover {
    background: #0056b3;
}

.btn-message {
    background: #28a745;
    color: white;
}

.btn-message:hover {
    background: #1e7e34;
}

.btn-inviter {
    background: #ffc107;
    color: white;
}

.btn-inviter:hover {
    background: #e0a800;
}

.card h2 {
        margin-bottom: 25px;
        color: #2c3e50;
        font-size: 24px;
        text-align: center;
    }

    form {
        max-width: 600px;
        margin: 0 auto 30px;
        display: flex;
        gap: 10px;
    }

    input[type="text"] {
        flex: 1;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    }

    form button {
        padding: 12px 25px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    form button:hover {
        background: #0056b3;
        transform: translateY(-1px);
    }

    </style>
    
    <?php
    session_start();
    include("connexion.php");
    $id = $_SESSION['id'];
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
                <h2>Rechercher un utilisateur</h2>
                
                <form action="rechercher.php" method="GET">
            <input type="text" name="search" placeholder="Nom ou Prénom">
            <button type="submit">
                
                Rechercher
            </button>
        </form>

                <div class="search-results">
                    <?php
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = mysqli_real_escape_string($cn, $_GET['search']);
                        $query = "SELECT * FROM utilisateur WHERE (nom LIKE '%$search%' OR prenom LIKE '%$search%') AND id != $id";
                        $result = mysqli_query($cn, $query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_array($result)) {
                                echo "<div class='search-card'>";
                                echo "<img src='userData/user_" . $user['id'] . "/" . $user['photo'] . "' class='profile-photo' alt='photo'>";
                                echo "<div class='user-info'>";
                                echo "<p class='name'>" . $user['nom'] . " " . $user['prenom'] . "</p>";
                                echo "<p class='fonction'>Fonction: " . $user['fonction'] . "</p>";
                                echo "<div class='buttons'>";
                                echo "<a href='friendProfile.php?amieid=" . $user['id'] . "' class='btn btn-profile'><img src=\"TOF/profil.png\" title=\"Voir Profil\"></a>";
       
                                echo "<a href='inviter.php?id=" . $user['id'] . "' class='btn btn-inviter'><img src=\"TOF/ajouter.png\"  title=\"Envoyer une Invitations\"></a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>Aucun utilisateur trouvé.</p>";
                        }
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
