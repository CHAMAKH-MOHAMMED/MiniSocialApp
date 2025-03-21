<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTchamakh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: grid;
            grid-template-rows: auto 1fr;
            min-height: 100vh;
        }

        /* Navbar réduite */
        nav {
            background-color:rgb(23, 128, 233);
            color: # #f8f9fa;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
      
            height: 60px;
        }

        nav img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            
        }

        nav strong {
            margin-left: 8px;
            font-size: 0.9em;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            font-size: 0.9em;
        }
       
        /* Conteneur principal en grille */
        .main-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 20px;
            padding: 20px;
        }

        /* Menu latéral */
        .sidebar {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgb(252, 249, 249);
        }
        .user {
            color: white;
            display: flex;

            align-items: center;
            gap: 10px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            margin: 8px 0;
            background-color: #f8f9fa;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color:rgb(87, 146, 205);
        }

        /* Contenu principal */
        .content {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    <?php
    session_start();
    include("connexion.php");

    $id = $_SESSION["id"];
    $sql = "SELECT * FROM utilisateur WHERE id=$id;";
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
                <h2>Etudiant</h2>
                <p>Bienvenue <?php echo $_SESSION["user"] ?>!</p>
            </div>
        </div>
        </div>
</body>

</html>