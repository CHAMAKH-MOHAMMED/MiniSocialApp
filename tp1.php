<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php



$tab = array(3,33,363,123,23,0,4,6);


//fonction d"afichage par valeur

echo "fonction d'afichage par valeur"."<br>";
function affichageV1($tab){
 

    echo "<table border=1 ><tr>";

    foreach($tab as $item){
         echo "<td>$item </td>";
    }
    echo "</tr></table>";

}
affichageV1($tab);



//fonction d"afichage par adresse
echo "<br>";
echo "fonction d'afichage par adresse"."<br>";
function affichageV2(&$tab){
 

    echo "<table border=1 ><tr>";

    foreach($tab as $item){

         echo "<td>$item </td>";
    }
    echo "</tr></table>";

}
affichageV2($tab);


//fonction d"afichage par Variable globale
echo "<br>";
echo "fonction d'afichage par Variable globale"."<br>";
function affichageV3($tab){
 global $tab;

    echo "<table border=1 ><tr>";

    foreach($tab as $item){
         echo "<td>$item </td>";
    }
    echo "</tr></table>";

}
affichageV3($tab);

//fonction de tri  par selection
echo "<br>";
echo "fonction de tri  par  la selection "."<br>";
function triSelect(&$tab){
  


for($i=0;$i< sizeof($tab);$i++){
    $min=$i;
    for($j=$i+1;$j<sizeof($tab);$j++)
    {

        if ($tab[$j]<$tab[$min]) {


            $min=$j;
           
      
        } 
    
        
      }
      
      if ($min != $i){
        $temp=$tab[$i];
        $tab[$i]=$tab[$min];
        $tab[$min]=$temp;




      }
    

    }



}

triSelect($tab);
affichageV1($tab);



//fonction de tri  par insertion
echo "<br>";
echo "tableau non trie"."<br>";
$tab = array(3,33,363,123,23,0,4,6);
affichageV1($tab);
echo "<br>";
echo "fonction de tri  par  insertion "."<br>";

function triInsert(&$tab){
  


    for($i=1;$i< sizeof($tab);$i++){
        for($j=$i;$j>0 && $tab[$j] < $tab[$j-1]  ;$j--)
        {
    
        
    
                $temp=$tab[$j];
                $tab[$j]=$tab[$j-1];
                $tab[$j-1]=$temp;
              
             
          }
        }
        
    
        
    
    }
    
    triInsert($tab);
    affichageV1($tab);


    
//fonction de tri  a bulle
echo "<br>";
echo "tableau non trie"."<br>";
$tab = array(3,33,363,123,23,0,4,6);
affichageV1($tab);
echo "<br>";
echo "fonction de tri a  bulle"."<br>";

function triBulle(&$tab){
  


    for($i=0;$i< sizeof($tab)-1;$i++){
        for($j=$i+1;$j<sizeof($tab)   ;$j++)
        {
    
        
    if ($tab[$j] < $tab[$i]){

        $temp=$tab[$j];
        $tab[$j]=$tab[$i];
        $tab[$i]=$temp;


        
    }
                
              
             
          }
        }
        
    
        
    
    }
    
    triBulle($tab);
    affichageV1($tab);



  
//fonction recherche max

echo "<br>";
echo "fonction recherche max"."<br>";

function rechercheMax(&$tab){
  

    $max=$tab[0];
    for($i=0;$i< sizeof($tab);$i++){
        
    
        
    if ($tab[$i] > $max) {$max=$tab[$i];}


    }
        return $max;
}
    
    
     $max= rechercheMax($tab);
   
echo "le maximum de le tableau est :  $max";





  
//fonction recherche min

echo "<br>";
echo "fonction recherche Min"."<br>";

function rechercheMin(&$tab){
  

    $min=$tab[0];
    for($i=0;$i< sizeof($tab);$i++){
        
    
        
    if ($tab[$i] < $min) $min=$tab[$i];


        }
        
    
        return $min;
    
    }
    
     $min= rechercheMin($tab);
   
echo "le minumom  de le tableau est :  $min";




  
//fonction recherche  

echo "<br>";
echo "fonction recherche par élement"."<br>";

function recherche(&$tab,$x){
  

    
    for($i=0;$i< sizeof($tab);$i++){
        
    
        
    if ($tab[$i] ==$x)  return $i;


        }
        
    
    }
    

     $indexRecherche= recherche($tab,33);

     echo "<br>";
   
echo "l'index de élement chercher dans  le tableau est :  $indexRecherche";

    ?> 

</body>

</html>