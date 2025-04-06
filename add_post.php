<?php
session_start();
include("connexion.php");

if (!isset($_SESSION['id'])) {
    exit("Non connecté");
}

$idUser = $_SESSION['id'];

if (isset($_POST['contenu'])) {
    $contenu = mysqli_real_escape_string($cn, $_POST['contenu']);
    $photo = null;

    // Gestion de l'upload de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // Vérification de la taille et du type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5 Mo
        if (in_array($_FILES['photo']['type'], $allowedTypes) && $_FILES['photo']['size'] <= $maxSize) {
            $userdirectory = "userData/user_" . $idUser;
            if (!file_exists($userdirectory)) {
                mkdir($userdirectory, 0777, true);
            }
            $photo = basename($_FILES['photo']['name']);
            $source = $_FILES['photo']['tmp_name'];
            $destination = $userdirectory . '/' . $photo;
            if (!move_uploaded_file($source, $destination)) {
                echo "Erreur lors de l'upload de la photo.";
                exit();
            }
        } else {
            echo "Fichier invalide : type non autorisé ou taille excessive (max 5 Mo).";
            exit();
        }
    }

    // Insertion dans la base de données
    $query = "INSERT INTO posts (id_utilisateur, contenu, doc) VALUES ($idUser, '$contenu', " . ($photo ? "'$photo'" : "NULL") . ")";
    if (mysqli_query($cn, $query)) {
        header("Location: posts.php"); // Redirection vers la page des posts
        exit();
    } else {
        echo "Erreur lors de l'ajout : " . mysqli_error($cn);
        exit();
    }
} else {
    echo "Aucun contenu fourni";
    exit();
}
?>