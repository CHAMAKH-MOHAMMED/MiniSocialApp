<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color:rgb(193, 191, 191);
         
        }

        .main{
            margin-top: 20px;
         
            display: grid;
            grid-template-columns: 1fr 3fr;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            padding: 20px;
        }
        .sidebar{
            background: white;
            padding: 20px;
            height: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
            .sidebar a{
                display : block;
                text-decoration: none;
                color:black;
                padding: 10px;
                margin: 10px;
                border-radius: 8px;
                background:rgb(125, 126, 124);

            }
            .content{
                background: white;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);

            }
            .sidebar a:hover{
                color:white;
                background:rgb(24, 132, 214);
            }
            .card{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: white;

                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            nav{
            background-color: rgb(23, 128, 233);
            color: #f8f9fa;
            padding: 8px 15px;
            display: flex;
            justify-content: space-between;
            padding: 8px 15px;
            height: 60px;
            align-items: center;
            
            }
            nav a{
                text-decoration: none;
                color: white;
                padding: 8px 12px;
            }
            nav a:hover{
                color: black;
            }
            nav ul{
                text-decoration: none;
                color: white;
                padding: 8px 12px;
                
                display :flex;
                list-style: none;
                align-items: center;
                gap: 10px;
            }
            nav img{
                border-radius: 50%;
                width: 40px;
                height: 40px;
            }
        </style>
</head>
<body>

<nav>
    <div class="user">
        <img src="userData/userDefaultProfile/defaultImage.jpeg">
        <strong>Admin</strong>
    </div>
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="rechercher.php">Rechercher</a></li>
        <li><a href="etudiant.php">Etudiant</a></li>
        <li><a href="listUsers.php">Liste des utilisateurs</a></li>
    </ul>
</nav>


<div class="main">
<div  class="sidebar">  
<a href="profile.php? ">profile</a>
<a href="rechercher.php">Rechercher</a>     
<a href="invetation.php">invitation</a>
<a href="invetation.php">Message</a>
</div>
<div class="content">
    <h1>Profile</h1>
    <Hr>
    <div class="card">
      
      <img src="userData/userDefaultProfile/defaultImage.jpeg" width="100" height="100">
        <p>nom:chamakh</p>
        <p>prenom:marouane</p>
           <p>email:</p>
        </div>
      <p>nom:chamakh</p>
        <p>prenom:marouane</p>
           <p>email:</p>
        </div>
</div>
</div>

    <div style="position: fixed; bottom: 0; right: 0; background-color: black; color: white; width: 200px; padding: 10px; text-align: start;">
        <strong>Simoo:</strong>
        <p>hello</p>
        <em>(2021-06-01 12:00:00)</em>
    </div>
    <div style="position: fixed; bottom: 0; right: 300px;display:flex;justify-content:space-between;
     background-color: red; color: white; width: 100%; padding: 10px; text-align: end;">
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div> <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>
            <div>
                <strong>Admin:</strong>
                <p>hello</p>
                <em>(2021-06-01 12:00:00)</em>
            </div>

    </div>

</body>
</html>