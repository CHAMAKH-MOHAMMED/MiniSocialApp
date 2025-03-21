<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitations</title>
    <link rel="stylesheet" href="stayle.css">
    <style> .search-results {
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
        

        .btn-accepter {
            background: #28a745;
            color: white;
        }

        .btn-accepter:hover {
            background: #1e7e34;
        }

        .btn-supprimer {
            background: #dc3545;
            color: white;
        }

        .btn-supprimer:hover {
            background: #bb2d3b;
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
                <h2>Invitations en attente</h2>
                
                <div class="search-results">
                    <?php


                    // Récupérer les invitations
                    $query = "SELECT u.id, u.nom, u.prenom, u.photo, u.fonction 
                            FROM `invitation` i inner JOIN `utilisateur` u ON u.id = i.emetteur

                            WHERE i.recipient = $id AND i.etat = 'en attente' " ;
                    $result = mysqli_query($cn, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($invitation = mysqli_fetch_array($result)) {
                            echo "<div class='search-card'>";
                            echo "<img src='userData/user_" . $invitation['id'] . "/" . $invitation['photo'] . "' class='profile-photo' alt='photo'>";
                            echo "<div class='user-info'>";
                            echo "<p class='name'>" . $invitation['nom'] . " " . $invitation['prenom'] . "</p>";
                            echo "<p class='fonction'>Fonction: " . $invitation['fonction'] . "</p>";
                            echo "<div class='buttons'>";
                            echo "<a href='accepter_invitation.php?id=" . $invitation['id'] . "' class='btn btn-accepter'>Accepter</a>";
                            echo "<a href='supprimer_invitation.php?id=" . $invitation['id'] . "' class='btn btn-supprimer'>Supprimer</a>";
                            echo "</div> </div></div>";
                          
                        }
                    } else {
                        echo "<p>Aucune invitation en attente.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>