<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include("connexion.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo json_encode(array("Vous devez être connecté."));
    exit;
}
$session_id = $_SESSION['id'];

// Vérifier si l'ID est fourni dans GET et est numérique
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(array("ID invalide."));
    exit;
}
$friend_id = $_GET['id'];

// Vérifier si les deux utilisateurs sont amis
    $sql = "SELECT u.nom, u.prenom 
    FROM amie a
    JOIN utilisateur u ON (a.id_utilisateur = u.id AND a.id_amie = $session_id) 
    OR (a.id_amie = u.id AND a.id_utilisateur = $session_id)
    WHERE (a.id_utilisateur = $friend_id OR a.id_amie = $friend_id) AND a.etat = 'accepter'";

$result = mysqli_query($cn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo json_encode(array("Vous n'êtes pas amis avec cet utilisateur."));
    exit;
}

$row = mysqli_fetch_assoc($result);
$nom = $row['nom'];
$prenom = $row['prenom'];

// Récupérer le nom et prénom de l'utilisateur avec l'ID GET
$sql = "SELECT nom, prenom FROM utilisateur WHERE id = $friend_id";
$result = mysqli_query($cn, $sql);

if ($row = mysqli_fetch_array($result)) {
    $nom = $row['nom'];
    $prenom = $row['prenom'];
} else {
    echo json_encode(array("Utilisateur introuvable."));
    exit;
}

// Récupérer tous les messages entre les deux utilisateurs, ordonnés par date
$sql = "SELECT * FROM message WHERE (expediteur_id = $session_id AND destinataire_id = $friend_id) OR (expediteur_id = $friend_id AND destinataire_id = $session_id) ORDER BY date_envoi ASC";
$result = mysqli_query($cn, $sql);

$messages = array();
if (mysqli_num_rows($result) == 0) {
    $messages[] = array("Aucun message");
} else {
    while ($row = mysqli_fetch_array($result)) {
        $expediteur_id = $row['expediteur_id'];
        $contenu = $row['contenu'];
        $date_envoi = $row['date_envoi'];

        // Déterminer qui est l'expéditeur
        $sender = ($expediteur_id == $session_id) ? "Vous" : $prenom . " " . $nom;

        // Ajouter chaque message au tableau
        $messages[] = array($sender, $contenu, $date_envoi);
    }
}

// Structurer la réponse finale
$response = array(
    array($nom, $prenom),  // Informations de l'ami
    $messages              // Liste des messages
);

// Retourner la réponse en JSON
echo json_encode($response);
?>