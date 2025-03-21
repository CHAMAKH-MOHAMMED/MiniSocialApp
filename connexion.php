<?php 
    $severName="localhost:3306";
    $userName="root";
    $pawd="";
    $dataBaseName="bts";
    $cn=mysqli_connect($severName,$userName,$pawd,$dataBaseName);
    
    if(mysqli_connect_errno()){
        echo"Erreur de connexion:".mysqli_connect_error();
    }
    
?>