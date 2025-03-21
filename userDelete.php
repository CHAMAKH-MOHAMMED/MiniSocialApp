<?php
    if(isset($_GET['id'])){
        include("connexion.php");
        $id=$_GET['id'];
        $sql="DELETE FROM utilisateur WHERE id='$id'";
        $result=mysqli_query($cn,$sql);
        if($result){
            echo "L'utilisateur a été supprimé avec succès."; 
        }else{
            echo"Erreur :".mysqli_erro($cn);
            exit;
        }
        mysqli_close($cn);
        header('Location:listerUsers.php');
    }
?>