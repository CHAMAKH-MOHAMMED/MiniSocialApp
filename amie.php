<?php
session_start();
include("connexion.php");

// Vérification de la session
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$idUser = $_SESSION['id'];
$sql = "SELECT * FROM utilisateur WHERE id=$idUser";
$result = mysqli_query($cn, $sql);
$row = mysqli_fetch_array($result);
$photo = $row["photo"];
$img = "userData/user_" . $idUser . "/" . $photo;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Amis</title>
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
            margin-bottom: 15px;
            border: 3px solid #007bff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-left: auto;
            margin-right: auto; 
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
            justify-content: center;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-profile {
            background: #007bff;
        }

        .btn-profile:hover {
            background: #0056b3;
        }

        .btn-block {
            background: #dc3545;
        }

        .btn-block:hover {
            background: #bb2d3b;
        }



        /* //css de la partie de la liste des amis */
          
        .FriendHeadr{
            display:flex;
            justify-content: space-between;
            align-items: center;
            background: #007bff;
            padding: 10px;
        }

       .FriendConteinr{
        padding: 10px;
       }
        .friend-list {
        width: 250px;
            padding: 0;
       }
    

.friend-list  ul {
    display: column;
    list-style: none;
    padding: 0;
    margin: 0;
}
.friend-item {
     display: flex;          
    justify-content: space-between;
 
    align-items: center; 
    background: #ffffff;
    border-radius: 12px black;
    padding: 0;
    margin:0 ;
}
.friend-item .profile-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin:0 ;
    border: 2px solid #007bff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.friend-info .name {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
    color: #333;
}

.status {
    display: block;
    font-size: 12px;
    margin-top: 5px;
}

.status.online {
    color: #28a745;
}

.status.offline {
    color: #dc3545;
}

.btn-message {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-message:hover {
    background: #0056b3;}
            .FriendListe{
                position: fixed;
                right: 0;
                bottom:0;
                padding: 10px;
                background: #ffffff;
                border-radius: 12px;
                
            }
       
/*  partie des massgecontainer */
.messageBoxContenir{
    position:fixed;
    bottom: 10px;
    right: 320px;
   

    display:flex;
   
    flex-wrap: wrap;
    
    gap: 10px;
    margin: 0;
   }
   
.message-container {
    height: 350px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    
}

.message-header {
    height: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #007bff;
    color: white;
    padding: 5px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    
}



.message-header button {
    height: 20px;
    background-color: transparent;
    border: none;
    color: white;
    font-size: 12px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.message-header button:hover {
    color: #d4d4d4;
}

.message-list {
    height: 200px;
 overflow-y: auto;
    padding: 10px;
    background-color: #f9f9f9;
}

.message-list div {
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.5;
}

.message-list strong {
    color: #007bff;
    font-weight: 600;
}


.message-container{
    height: 320px;
width: 220px;
    border-radius: 12px;
}


.message-container input[type="text"] {
    width: calc(100% - 40px);
    padding: 10px;
    margin: 10px ;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}



    /* //css de la partie message de conversation */
   
    .MesMessage {
        margin-left: 10%;
        word-break: break-word;
    background-color:rgb(204, 223, 243);
    Border-radius: 12px;
    color: black;
    align-self: flex-end;

    padding: 10px;  }
    .AmiesMessage {
        word-break: break-word;
        align-self: flex-start;
        margin-right: 10%;
    background-color:rgb(189, 185, 185);
    Border-radius: 12px;
    color: black;
    padding: 10px;  }
    
    .message-list em {
        font-size: 0.7em;
        margin-top: 2px;
        color: #666;
        display: block;
        text-align: right;
    }

    </style>
</head>

<body>
<?php include("navBar.php"); ?>

    <div class="main-grid">
       <?php include("sidebar.php"); ?>

        <div class="content">
            <div class="card">
                <h2>Mes Amis</h2>

                <div class="search-results">
                    <?php
                    // Récupérer la liste des amis

                    
                    
                    $query = "SELECT u.id, u.nom, u.prenom, u.photo, u.fonction 
                              FROM utilisateur u 
                              inner JOIN amie a ON (u.id = a.id_utilisateur OR u.id = a.id_amie)
                              WHERE (a.id_utilisateur = $idUser OR a.id_amie = $idUser) AND u.id <> $idUser";
                    $result = mysqli_query($cn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($ami = mysqli_fetch_array($result)) {
                            echo "<div class='search-card'>";
                            echo "<img src='userData/user_" . $ami['id'] . "/" . $ami['photo'] . "' class='profile-photo' alt='photo'>";
                            echo "<div class='user-info'>";
                            echo "<p class='name'>" . $ami['nom'] . " " . $ami['prenom'] . "</p>";
                            echo "<p class='fonction'>Fonction: " . $ami['fonction'] . "</p>";
                            echo "<div class='buttons'>";
                            echo "<a href='friendProfile.php?amieid=" . $ami['id'] . "' class='btn btn-profile'>Voir Profil</a>";
                            echo "<a href='bloquer_ami.php?id=" . $ami['id'] . "' class='btn btn-block'>Bloquer</a>";
                            echo "</div> </div></div>";
                        }
                    } else {
                        echo "<p>Vous n'avez pas encore d'amis.</p>";
                    }
                    ?>
             
</div>
            </div>
        </div>
    </div>
 

        <div class="messageBoxContenir" id="messageBoxContenir">

            </div>
                

<div class="FriendListe">
                <div class="FriendHeadr">
                    <div>Friend Liste</div><button onclick="toggleFriendList()">--</button>
                </div>
<div id="FriendConteinr" class="FriendConteir">
        
          
</div>
        </div>            
    </div>


    
    <script>
     function createMessageBox(id, friendInfo) {
    const nomComplete = friendInfo[0] + " " + friendInfo[1];
    const msgBoxName = "container-" + id;

    // Création du conteneur principal
    const body = document.createElement("div");
    body.classList.add("message-container");
    body.id = msgBoxName;
        let checkExist = document.getElementById(msgBoxName);
        if (checkExist) {
            return;
        }
    // Création de l'en-tête
    const header = document.createElement("div");
    header.classList.add("message-header");
    header.innerHTML = `<div>${nomComplete}</div><button onclick='closeMessageContainer("${msgBoxName}")'>Fermer</button>`;

    // Création de la zone de messages
    const messageList = document.createElement("div");
    messageList.classList.add("message-list");

    // Création du champ de saisie
    const messageInput = document.createElement("input");
    messageInput.type = "text";
    messageInput.placeholder = "Écrire un message...";
    messageInput.onkeydown = function(event) {
        if (event.key === "Enter") {
       
            sendMessage(this.value, id);
            this.value = "";
        }
    };

    // Assemblage des éléments
    body.appendChild(header);
    body.appendChild(messageList);
    body.appendChild(messageInput);

    // Ajout au DOM
    document.getElementById("messageBoxContenir").appendChild(body);

    return {
        container: body,
        messageList: messageList,
        input: messageInput
    };
}

function populateMessageList(messageListElement, messages) {
    // Nettoyer le contenu existant
    messageListElement.innerHTML = "";

    if (messages.length === 1 && messages[0][0] === "Aucun message") {
        messageListElement.innerHTML = "<p>Aucun message</p>";
    } else {
        messages.forEach(msg => {
            const messageDiv = document.createElement("div");
            const message = document.createElement("div");
            
            message.innerHTML = `${msg[1]} <em>(${msg[2]})</em>`;
            message.classList.add(msg[0] === "Vous" ? "MesMessage" : "AmiesMessage");
            
            messageDiv.appendChild(message);
            messageListElement.appendChild(messageDiv);
        });
    }
}


function openMessageBox(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "messageService.php?id=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.responseText);
            
            if (response.length === 1 && typeof response[0] === "string") {
                alert(response[0]);
                return;
            }

            const friendInfo = response[0];
            const messages = response[1];
            
            // Création de la boîte
            const messageBox = createMessageBox(id, friendInfo);
            
            // Remplissage des messages
            populateMessageList(messageBox.messageList, messages);
            setInterval(() => {
                getMessages(id, messageBox.messageList);
            }, 2000);
        }
    };
    xhr.send();
}

//fonction that remplir msg every 10s fromm messageService.php
function getMessages(id, messageListElement) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "messageService.php?id=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.responseText);
            const messages = response[1];
            populateMessageList(messageListElement, messages);
        }
    };
    xhr.send();
}

// Fonction pour fermer le conteneur de messages
function closeMessageContainer(msgBoxName) {
    let container = document.getElementById(msgBoxName);
    if (container) {
        container.remove();
    }
}

//function that send the message
function sendMessage(message, id) {
    let xhr = new XMLHttpRequest();
    let friend_id = id;
    
    xhr.open("GET", "EnvoyerMessage.php?friend_id=" + friend_id + "&message=" + (message), true);
    xhr.send();
}

 function toggleFriendList() {
        let liste = document.getElementById("FriendConteinr");
        if (liste.style.display === "none") {
            liste.style.display = "block";
        } else {
            liste.style.display = "none";
        }
    }
    //creat function with ajax that use to get friend list
    function getFriendList() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "amiesListe.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("FriendConteinr").innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    }
    // Call the function getFriendList() every 5 seconds
    setTimeout(function() {
        setInterval(getFriendList, 5000);
    }, 0);
    // Call the function getFriendList() when the page is loaded
    window.onload = getFriendList;
</script>

</body>
</html>
