
<?php
include 'connexion.php';
session_start();


    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
     
        
        
        $password = md5($_POST['password']);
       
        $query = "SELECT * FROM utilisateur WHERE email='$email' AND password='$password'";
        $result = mysqli_query($cn, $query);

        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            $id = $data['id']; 
            $query = "UPDATE `utilisateur` SET `etat`='en Ligne' WHERE `id` = $id";
            mysqli_query($cn, $query);

            $_SESSION['id'] = $data['id'];
            $_SESSION['user'] = $data['nom'] .$data['prenom'];
          
            $_SESSION['role'] = $data['fonction'];
            
            switch ( $_SESSION['role']) {
                case'professeur':
                    header(header: "Location:professeur.php");
                    exit();
                case'Etudiant':
                    header("Location:etudiant.php");
                    exit();
                case'adm':
                    header("Location:admin.php");
                    exit();
                default:
                    header("Location:index.html");
                    exit();
            }
        } else {
            header("Location: index.html");
            exit();
        }
    } else {
        header("Location: index.html");
        exit();
    }

           
 ?>