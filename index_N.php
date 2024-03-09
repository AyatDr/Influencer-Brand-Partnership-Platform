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
            <a href="espace_inf.php"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a>
            <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a>
            <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
          </ul>
    </div>
      <br/></br><br/>
      <p style="color:#84abc2;"> Click on the brand to send a message or to view your inbox for this brand </p>
      <br/></br>

  <table style="text-align:center;" >
    <thead> <!-- l'en-tête d'un tableau HTML avec 4 colonnes -->
      <tr >
        
    <th style="text-align:center;" >Brand Logo</th>
    <th style="text-align:center;">Brand Name</th>
    <th style="text-align:center;">Brand Turnover</th>
    <th style="text-align:center;">Business Area</th>
    <th style="text-align:center;">Your inbox</th>



      </tr>
    </thead>
    <tbody>

       <?php 
       //requête SQL pour récupérer tous les utilisateurs marque de la table "Brand"
         $recupUser = $bdd->query('SELECT * FROM brand');
         //boucle sur les résultats de la requête pour afficher les informations de chaque utilisateur dans une ligne de tableau
          // Le lien "message_N.php" utilise l'identifiant de la marque pour afficher les messages associés à cet utilisateur
        while ($user = $recupUser->fetch()){
          echo '<tr>
             <td style="text-align:center;"><a href="message_N.php?Login='.$user['Login'].'"><img src="uploads/'.$user['Brand_Logo'].'"></a></td>
            <td style="text-align:center;"><a href="message_N.php?Login='.$user['Login'].'">'.$user['Brand_Name'].'</a></td>
            <td style="text-align:center;"><a href="message_N.php?Login='.$user['Login'].'">'.$user['Brand_Turnover'].'</a></td>
            <td style="text-align:center;"><a href="message_N.php?Login='.$user['Login'].'">'.$user['Business_area'].'</a></td>
            <td style="text-align:center;"><a href="message_N.php?Login='.$user['Login'].'"><i class="fa-solid fa-envelope" style="color: #84abc2; font-size: 35px;"></i></a></td>
            
           </tr>';
        }
        ?>

    </tbody>
  </table>
</body>
</html>

</body>
</html>
