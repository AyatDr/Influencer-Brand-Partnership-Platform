<?php
// initialise une session
session_start();
// définit quatre variables qui stockent les informations de connexion pour la base de données MySQL
    $dbHost = "localhost:3306";
    $dbName = "dataproject";
    $dbUsername = "root";
    $dbUserpassword = "";
    //utilise ces informations pour créer une connexion PDO à la base de données
     $connection = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUsername,$dbUserpassword);
    //La condition if vérifie si l'utilisateur est connecté en vérifiant si la variable de session user_id est définie
     if(isset($_SESSION['user_id'])) {

   // le code récupère l'ID de l'utilisateur à partir de la variable de session et l'insère dans une table appelée demande_suppression_inf en utilisant une requête préparée
   $user_id=$_SESSION['user_id'];
   $requser = $connection->prepare('INSERT  into demande_suppression_inf(id_inf)  VALUES (?)');
   $requser->execute(array($user_id));
   $userinfo = $requser->fetch();
    
?>


<!DOCTYPE html>
<html>
    <head>
        <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="utf-8">
        <!--d'ajouter des icônes à la page-->
        <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
        <!--les propriétés de l'affichage initial de la page sur les différents types d'appareils-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="delete.css">
        <title> Delete my account </title>
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
    </head>

    <body>
    <div class="side-menu">
           <div class="lg">
          <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
           </div>
         </br>
        <ul>     
            <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a>
            
            <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a>
            <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
         </ul>         
    </div>

     <div class="container">
     
    </br> </br>  
        <div class="content">
              <div class="content-2">
                <div class="recent">
                <h2 style="color:white ; font-size:20px;"><?php echo "Your request has been successfully sent to the site administrator, your account will be deleted soon.";} ?></h2>
               </div>
            </div>
       </div>  
    </body>
</html>
