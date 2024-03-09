<?php 
//démarrer une session et établit une connexion à la base de données
session_start();
$bdd = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="UTF-8">
        <!--la page doit être rendue dans la dernière version compatible d'Internet Explorer-->
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <!--les propriétés de l'affichage initial de la page sur les différents types d'appareils-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <!--d'ajouter des icônes à la page-->
       <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
       <link rel="stylesheet" href="message_inf.css">
        <title>Message</title>
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
</head>

<body>


    <div class="side-menu">
        <div class="lg">
           <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
         </div>
         </br>
         <ul> <!--une liste de liens de navigation.-->
            <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a>
            <a href="espace_br.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a>
            <a  href="logout.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
         </ul>
    </div>

      <br/></br><br/>
             <p style="color:#84abc2;"> Click on the influencer to send a message or to view your inbox for this influencer </p>

      <br/></br>

 <table>
      <thead> <!-- l'en-tête d'un tableau HTML avec 4 colonnes -->
         <tr>
           <th style="text-align:center;">Profile</th>
           <th style="text-align:center;">Username</th>
           <th style="text-align:center;">Media</th>
           <th style="text-align:center;">your reception</th>
         </tr>
      </thead>
      <tbody>

       <?php 
       //requête SQL pour récupérer tous les utilisateurs influents de la table "influencer"
         $recupUser = $bdd->query('SELECT * FROM influencer');
         while ($user = $recupUser->fetch()){
          //boucle sur les résultats de la requête pour afficher les informations de chaque utilisateur dans une ligne de tableau
          // Le lien "message_M.php" utilise l'identifiant de l'influenceur pour afficher les messages associés à cet utilisateur
            echo '<tr>
            <td style="text-align:center;"><a href="message_M.php?Username='.$user['Username'].'"><img src="uploads/'.$user['Profile_pic'].'"></a></td>
            <td style="text-align:center;"><a href="message_M.php?Username='.$user['Username'].'">'.$user['Username'].'</a></td>
            <td style="text-align:center;"><a href="message_M.php?Username='.$user['Username'].'">'.$user['Media'].'</a></td>
            <td style="text-align:center;"><a href="message_M.php?Username='.$user['Username'].'"><i class="fa-solid fa-envelope" style="color: #84abc2; font-size: 35px;"></i></a></td>
            
               </tr>';
            }
        ?>

    </tbody>
  </table>
</body>
</html>

</body>
</html>




