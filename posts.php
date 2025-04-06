<?php
session_start();
include("connexion.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id_utilisateur = $_SESSION['id'];
$requete = "SELECT * FROM utilisateur WHERE id=$id_utilisateur";
$resultat = mysqli_query($cn, $requete);
$ligne = mysqli_fetch_array($resultat);
$photo = $ligne["photo"];

$img = "userData/user_" . $id_utilisateur . "/" . $photo;

// Traiter les commentaires AJAX
if(isset($_POST['ajax_comment'])) {
    $post_id = (int)$_POST['id_post'];
    $texte_comment = mysqli_real_escape_string($cn, $_POST['contenu']);
    $requete_comment = "INSERT INTO commentaires (id_post, id_utilisateur, contenu) VALUES ($post_id, $id_utilisateur, '$texte_comment')";
    
    if(mysqli_query($cn, $requete_comment)) {
        // Récupérer les infos utilisateur
        $requete_user = "SELECT nom, prenom, photo FROM utilisateur WHERE id=$id_utilisateur";
        $resultat_user = mysqli_query($cn, $requete_user);
        $user = mysqli_fetch_array($resultat_user);
        
        $reponse = [
            'success' => true,
            'id_post' => $post_id,
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo' => $user['photo'],
            'contenu' => $texte_comment,
            'id_utilisateur' => $id_utilisateur
        ];
        
        echo json_encode($reponse);
        exit;
    } else {
        echo json_encode(['success' => false]);
        exit;
    }
}

// Charger les commentaires
if(isset($_GET['load_comments'])) {
    $post_id = (int)$_GET['load_comments'];
    $requete_comments = "SELECT c.*, u.nom, u.prenom, u.photo 
                      FROM commentaires c 
                      JOIN utilisateur u ON c.id_utilisateur = u.id 
                      WHERE c.id_post = $post_id
                      ORDER BY c.date_creation ASC";
    $resultat_comments = mysqli_query($cn, $requete_comments);
    
    $liste_comments = [];
    while($comment = mysqli_fetch_assoc($resultat_comments)) {
        $liste_comments[] = $comment;
    }
    
    echo json_encode($liste_comments);
    exit;
}

// Ajouter ou supprimer un like
if (isset($_POST['ajax_like'])) {
    $post_id = (int)$_POST['id_post'];
    $verif = "SELECT * FROM likes WHERE id_post = $post_id AND id_utilisateur = $id_utilisateur";
    $resultat = mysqli_query($cn, $verif);
    
    if (mysqli_num_rows($resultat) > 0) {
        $requete = "DELETE FROM likes WHERE id_post = $post_id AND id_utilisateur = $id_utilisateur";
        $a_like = false;
    } else {
        $requete = "INSERT INTO likes (id_post, id_utilisateur) VALUES ($post_id, $id_utilisateur)";
        $a_like = true;
    }
    
    mysqli_query($cn, $requete);
    
    // Compter les likes
    $requete_count = "SELECT COUNT(*) as total FROM likes WHERE id_post = $post_id";
    $resultat_count = mysqli_query($cn, $requete_count);
    $total = mysqli_fetch_assoc($resultat_count)['total'];
    
    echo json_encode(['success' => true, 'liked' => $a_like, 'count' => $total]);
    exit;
}

// Supprimer un post
if (isset($_GET['delete'])) {
    $post_id = (int)$_GET['delete'];
    $requete = "DELETE FROM posts WHERE id = $post_id AND id_utilisateur = $id_utilisateur";
    mysqli_query($cn, $requete);
    header("Location: posts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Publications</title>
    <link rel="stylesheet" href="stayle.css">
    <link rel="stylesheet" href="messageBox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --couleur-principale: #4361ee;
            --couleur-secondaire: #3f37c9;
            --couleur-like: #4cc9f0;
            --couleur-comment: #7209b7;
            --couleur-delete: #f72585;
            --couleur-fond: #f8f9fa;
            --couleur-card: #ffffff;
            --couleur-texte: #333333;
            --couleur-texte-leger: #666666;
            --arrondi: 12px;
            --ombre: 0 8px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--couleur-fond);
            color: var(--couleur-texte);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Zone pour créer un post */
        .zone-creation {
            max-width: 700px;
            margin: 20px auto 30px;
            background: var(--couleur-card);
            border-radius: var(--arrondi);
            padding: 25px;
            box-shadow: var(--ombre);
            transition: var(--transition);
        }

        .zone-creation:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .zone-creation textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: calc(var(--arrondi) - 4px);
            resize: none;
            height: 100px;
            font-family: inherit;
            font-size: 16px;
            transition: var(--transition);
            box-sizing: border-box;
        }

        .zone-creation textarea:focus {
            border-color: var(--couleur-principale);
            outline: none;
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .zone-creation .zone-fichier {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .zone-creation .label-fichier {
            padding: 10px 15px;
            background-color: #e9ecef;
            border-radius: calc(var(--arrondi) - 4px);
            cursor: pointer;
            margin-right: 10px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
        }

        .zone-creation .label-fichier:hover {
            background-color: #dee2e6;
        }

        .zone-creation .label-fichier i {
            margin-right: 8px;
        }

        .zone-creation input[type="file"] {
            display: none;
        }

        .nom-fichier {
            font-size: 14px;
            color: var(--couleur-texte-leger);
        }

        .zone-creation button {
            padding: 12px 20px;
            background: var(--couleur-principale);
            color: white;
            border: none;
            border-radius: calc(var(--arrondi) - 4px);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            font-size: 15px;
        }

        .zone-creation button:hover {
            background: var(--couleur-secondaire);
            transform: translateY(-2px);
        }

        /* Liste des posts */
        .liste-posts {
            display: flex;
            flex-direction: column;
            gap: 25px;
            max-width: 700px;
            margin: 0 auto;
        }

        .carte-post {
            background: var(--couleur-card);
            border-radius: var(--arrondi);
            padding: 25px;
            box-shadow: var(--ombre);
            transition: var(--transition);
        }

        .carte-post:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .entete-post {
            display: flex;
            align-items: center;
            justify-content:space-between;
            gap: 15px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
        }

        .entete-post .photo-profil {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--couleur-principale);
        }

        .entete-post .info-user .nom {
            font-size: 16px;
            font-weight: 600;
            color: var(--couleur-texte);
            margin: 0 0 3px 0;
        }

        .entete-post .info-user .date {
            font-size: 12px;
            color: var(--couleur-texte-leger);
            margin: 0;
        }
        
        .contenu-post {
            margin-bottom: 20px;
            font-size: 16px;
            color: var(--couleur-texte);
            line-height: 1.6;
            word-wrap: break-word;         
            overflow-wrap: break-word;    
            hyphens: auto;                 
            max-width: 100%;               
            overflow: hidden;             
        }

        .photo-post {
            width: 80%;
            max-height: 350px; 
            object-fit: contain;
            display: block;
            margin: 0 auto;
            border-radius: calc(var(--arrondi) - 4px);
            margin-top: 15px;
            margin-bottom: 20px;
            border: 1px solid #eaeaea;
        }

        .actions-post {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5%;
            margin-bottom: 20px;
        }

        .actions-post button, .actions-post a {
            padding: 10px 18px;
            border-radius: calc(var(--arrondi) - 4px);
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-like { 
            background: var(--couleur-like); 
        }
        
        .btn-like:hover { 
            background: #3aa8d9; 
            transform: translateY(-2px);
        }
        
        .btn-like.aime {
            background: #38b6ff;
        }
        
        .btn-comment {
            background: var(--couleur-comment);
        }
        
        .btn-comment:hover {
            background: #5c0791;
            transform: translateY(-2px);
        }
        
        .btn-delete { 
            background: var(--couleur-delete); 
        }
        
        .btn-delete:hover { 
            background: #d91a6f; 
            transform: translateY(-2px);
        }

        /* Section commentaires */
        .section-comment {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
            display: none; /* Masqué par défaut */
        }

        .liste-comments {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
        }

        .liste-comments::-webkit-scrollbar {
            width: 6px;
        }

        .liste-comments::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .liste-comments::-webkit-scrollbar-thumb {
            background: #c3c3c3;
            border-radius: 10px;
        }

        .liste-comments::-webkit-scrollbar-thumb:hover {
            background: #a3a3a3;
        }

        .comment {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .comment .photo-profil {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .contenu-comment {
            background: #f8f9fa;
            padding: 15px;
            border-radius: calc(var(--arrondi) - 4px);
            flex: 1;
            position: relative;
        }

        .contenu-comment::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 15px;
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid #f8f9fa;
        }

        .contenu-comment .nom {
            font-size: 14px;
            font-weight: 600;
            color: var(--couleur-texte);
            margin: 0;
        }

        .contenu-comment .texte {
            font-size: 14px;
            color: var(--couleur-texte-leger);
            margin: 8px 0 0;
            line-height: 1.5;
        }

        .form-comment {
            display: flex;
            gap: 10px;
            position: relative;
        }

        .form-comment input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: calc(var(--arrondi) - 4px);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-comment input:focus {
            border-color: var(--couleur-principale);
            outline: none;
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .form-comment button {
            padding: 12px 20px;
            background: var(--couleur-principale);
            color: white;
            border: none;
            border-radius: calc(var(--arrondi) - 4px);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .form-comment button:hover {
            background: var(--couleur-secondaire);
        }

        .chargement {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--couleur-principale);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .comments-vide {
            text-align: center;
            padding: 20px;
            color: var(--couleur-texte-leger);
            font-style: italic;
        }

        .pas-de-posts {
            text-align: center;
            padding: 40px 20px;
            background: var(--couleur-card);
            border-radius: var(--arrondi);
            box-shadow: var(--ombre);
            color: var(--couleur-texte-leger);
            font-size: 16px;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .zone-creation {
                padding: 15px;
                margin: 15px auto;
            }
            
            .zone-creation button {
                width: 100%;
                margin-top: 10px;
            }
            
            .nom-fichier {
                max-width: 150px;
            }
            
            .photo-post {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include("navBar.php"); ?>

    <div class="main-grid">
        <?php include("sidebar.php"); ?>

        <div class="content">
            <div class="card">
                <h2>Mes Publications</h2>

                <!-- Zone pour créer un post -->
                <div class="zone-creation">
                    <form id="form-post" method="POST" enctype="multipart/form-data" action="add_post.php">
                        <textarea id="texte-post" name="contenu" placeholder="Qu'est-ce que tu veux dire aujourd'hui?"></textarea>
                        <div class="zone-fichier">
                            <label for="photo-post" class="label-fichier">
                                <i class="fas fa-image"></i> Ajouter une photo
                            </label>
                            <input type="file" id="photo-post" name="photo" accept="image/*">
                            <span class="nom-fichier" id="nom-fichier"></span>
                        </div>
                        <button type="submit" name="add_post">
                            <i class="fas fa-paper-plane"></i> Publier
                        </button>
                    </form>
                </div>

                <!-- Liste des posts -->
                <div class="liste-posts" id="liste-posts">
                    <?php
                    $requete_posts = "SELECT p.*, u.nom, u.prenom, u.photo,
                            (SELECT COUNT(*) FROM likes WHERE id_post = p.id) as total_likes,
                            (SELECT COUNT(*) FROM likes WHERE id_post = p.id AND id_utilisateur = $id_utilisateur) as user_a_like,
                            (SELECT COUNT(*) FROM commentaires WHERE id_post = p.id) as total_comments
                            FROM posts p
                            JOIN utilisateur u ON p.id_utilisateur = u.id
                            ORDER BY p.date_creation DESC";
                    $resultat_posts = mysqli_query($cn, $requete_posts);

                    if (mysqli_num_rows($resultat_posts) > 0) {
                        while ($post = mysqli_fetch_array($resultat_posts)) {
                            echo "<div class='carte-post' data-post-id='" . $post['id'] . "'>";
                            
                            // Entête du post
                            echo "<div class='entete-post'>";
                            echo "<div><img src='userData/user_" . $post['id_utilisateur'] . "/" . $post['photo'] . "' class='photo-profil' alt='photo profil'> </div>";
                            echo "<div class='info-user'>";
                            echo "<p class='nom'>" . $post['nom'] . " " . $post['prenom'] . "</p>";
                            echo "<p class='date'>" . date('d/m/Y à H:i', strtotime($post['date_creation'])) . "</p>";
                            echo "</div></div>";
                            
                            // Contenu du post
                            echo "<div class='contenu-post'>" . (($post['contenu'])) . "</div>";
                            
                            // Photo du post
                            if ($post['doc']) {
                                echo "<img src='userData/user_" . $post['id_utilisateur'] . "/" . $post['doc'] . "' class='photo-post' alt='photo post'>";
                            }
                            
                            // Boutons d'action
                            echo "<div class='actions-post'>";
                            echo "<button type='button' class='btn-like " . ($post['user_a_like'] ? "aime" : "") . "' data-post-id='" . $post['id'] . "'>";
                            echo "<i class='fas fa-heart'></i> <span class='texte-like'>" . ($post['user_a_like'] ? "J'aime" : "J'aime") . "</span> <span class='total-like'>(" . $post['total_likes'] . ")</span>";
                            echo "</button>";
                            
                            echo "<button type='button' class='btn-comment' data-post-id='" . $post['id'] . "'>";
                            echo "<i class='fas fa-comment'></i> Commentaires <span class='total-comment'>(" . $post['total_comments'] . ")</span>";
                            echo "</button>";
                            
                            if ($post['id_utilisateur'] == $id_utilisateur) {
                                echo "<a href='posts.php?delete=" . $post['id'] . "' class='btn-delete' onclick='return confirm(\"Tu veux vraiment supprimer ce post?\")'>";
                                echo "<i class='fas fa-trash'></i> Supprimer</a>";
                            }
                            echo "</div>";
                            
                            // Section commentaires (cachée)
                            echo "<div class='section-comment' id='section-comment-" . $post['id'] . "'>";
                            
                            echo "<div class='liste-comments' id='liste-comments-" . $post['id'] . "'>";
                            echo "<div class='chargement'><div class='spinner'></div></div>";
                            echo "</div>";
                            
                            echo "<form class='form-comment' data-post-id='" . $post['id'] . "'>";
                            echo "<input type='text' name='contenu' placeholder='Écris ton commentaire ici...' required>";
                            echo "<button type='submit'><i class='fas fa-paper-plane'></i></button>";
                            echo "</form>";
                            
                            echo "</div>"; // Fin section commentaires
                            echo "</div>"; // Fin carte post
                        }
                    } else {
                        echo "<div class='pas-de-posts'>";
                        echo "<i class='fas fa-comment-slash fa-3x' style='margin-bottom: 15px; color: #ccc;'></i>";
                        echo "<p>Pas encore de publications.</p>";
                        echo "<p>Sois le premier à partager quelque chose!</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Système de messagerie -->
    <?php include("messageBox.html"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Afficher le nom du fichier sélectionné
        document.getElementById('photo-post').addEventListener('change', function() {
            const nomFichier = this.files[0] ? this.files[0].name : '';
            document.getElementById('nom-fichier').textContent = nomFichier;
        });

        // Gérer les commentaires et likes
        $(document).ready(function() {
            // Afficher/cacher les commentaires
            $('.btn-comment').on('click', function() {
                const postId = $(this).data('post-id');
                const sectionComment = $(`#section-comment-${postId}`);
                
                if (sectionComment.is(':visible')) {
                    sectionComment.slideUp(200);
                } else {
                    sectionComment.slideDown(200);
                    
                    // Charger les commentaires si pas encore fait
                    if (!$(`#liste-comments-${postId}`).hasClass('charge')) {
                        chargerComments(postId);
                    }
                }
            });
            
            // Fonction pour charger les commentaires
            function chargerComments(postId) {
                const listeComments = $(`#liste-comments-${postId}`);
                
                $.ajax({
                    url: 'posts.php',
                    type: 'GET',
                    data: {
                        load_comments: postId
                    },
                    dataType: 'json',
                    success: function(comments) {
                        listeComments.html('');
                        
                        if (comments.length > 0) {
                            comments.forEach(function(comment) {
                                const commentHtml = creerCommentHTML(comment);
                                listeComments.append(commentHtml);
                            });
                        } else {
                            listeComments.html('<div class="comments-vide">Pas encore de commentaires. Écris le premier!</div>');
                        }
                        
                        listeComments.addClass('charge');
                    },
                    error: function() {
                        listeComments.html('<div class="comments-vide">Erreur lors du chargement des commentaires.</div>');
                    }
                });
            }
            
            // Créer le HTML pour un commentaire
            function creerCommentHTML(comment) {
                return `
                    <div class="comment">
                        <img src="userData/user_${comment.id_utilisateur}/${comment.photo}" class="photo-profil" alt="photo profil">
                        <div class="contenu-comment">
                            <p class="nom">${comment.nom} ${comment.prenom}</p>
                            <p class="texte">${comment.contenu.replace(/\n/g, '<br>')}</p>
                        </div>
                    </div>
                `;
            }
            
            // Ajouter un commentaire
            $('.form-comment').on('submit', function(e) {
                e.preventDefault();
                
                const form = $(this);
                const postId = form.data('post-id');
                const input = form.find('input[name="contenu"]');
                const contenu = input.val().trim();
                
                if (contenu === '') return;
                
                $.ajax({
                    url: 'posts.php',
                    type: 'POST',
                    data: {
                        ajax_comment: true,
                        id_post: postId,
                        contenu: contenu
                    },
                    dataType: 'json',
                    success: function(reponse) {
                        if (reponse.success) {
                            // Ajouter le commentaire
                            const listeComments = $(`#liste-comments-${postId}`);
                            const commentHtml = creerCommentHTML(reponse);
                            
                            // Vider le message "pas de commentaires" si c'est le premier
                            if (listeComments.find('.comments-vide').length > 0) {
                                listeComments.empty();
                            }
                            
                            // Ajouter et reset
                            listeComments.append(commentHtml);
                            listeComments.scrollTop(listeComments[0].scrollHeight);
                            listeComments.addClass('charge');
                            input.val('');
                            
                            // Mettre à jour le compteur
                            const compteur = $(`.btn-comment[data-post-id="${postId}"] .total-comment`);
                            const nouveauTotal = parseInt(compteur.text().replace(/[()]/g, '')) + 1;
                            compteur.text(`(${nouveauTotal})`);
                        }
                    }
                });
            });
            
            // Gérer les likes
            $('.btn-like').on('click', function() {
                const bouton = $(this);
                const postId = bouton.data('post-id');
                
                $.ajax({
                    url: 'posts.php',
                    type: 'POST',
                    data: {
                        ajax_like: true,
                        id_post: postId
                    },
                    dataType: 'json',
                    success: function(reponse) {
                        if (reponse.success) {
                            // Mettre à jour
                            bouton.find('.total-like').text(`(${reponse.count})`);
                            
                            if (reponse.liked) {
                                bouton.addClass('aime');
                            } else {
                                bouton.removeClass('aime');
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>