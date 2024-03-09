<!DOCTYPE html>
<html lang="en">

<head>
        <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="utf-8">
        <!--d'ajouter des icônes à la page-->
        <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
        <!--les propriétés de l'affichage initial de la page sur les différents types d'appareils-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
        <link rel="stylesheet" href="Par.css">
        <title>Brands</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
          <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
        </div>
    </br>
        <ul><!--liste des liens vers des pages web diffrentes de ce site web -->
        <a href="espace_inf.php"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a><br>
        <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a><br>
        <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a> 
        </ul>
    </div>
    <div class="container">
        
    </br> </br>
        <div class="content">
              <div class="content-2">
                <div class="recent">
                    <div class="title">
                        <h2 style="color:#84abc2;">Brands to collaborate with</h2>
                    </div>

        <?php 
              //initialise une session
              session_start();
               $user_id = $_SESSION['user_id'];
               //connexion a une base de donnes
              $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


               // Récupérer login à partir de user_id
               $user_name_query = "SELECT Username FROM influencer WHERE id_inf = ?";
               $user_id_statement = $pdo->prepare($user_name_query);
               $user_id_statement->execute([$user_id]);
               $user_id_result = $user_id_statement->fetch();
               $user_id = $user_id_result['Username'];

              // utiliser votre login dans votre requête SQL pour filtrer les résultats
              $requete = "SELECT Brand_Logo, Login, Brand_Name, Brand_Turnover, Business_area FROM  brand WHERE Login NOT IN 
              (SELECT Brand_Login FROM partenariat WHERE Influencer_Login =?)"; 



               $result = $pdo->prepare($requete);
               $result->execute([$user_id]);

             if (!$result) {
              echo "La récupération des données a rencontré un problème!";
              } else {
        ?>
<table>
  <tr>
     <th>Brand_Logo</th>
    <th>Login</th>
    <th>Brand_Name</th>
    <th>Brand_Turnover</th>
    <th>Business_area</th>
  </tr>
      <?php
      /*une boucle while pour parcourir les résultats ligne par ligne, et la méthode fetch() pour extraire chaque ligne sous forme de tableau associatif*/
    while ($ligne= $result->fetch(PDO::FETCH_NUM)){
    echo "<tr>";
    echo "<td><img src='uploads/" . $ligne[0] . "' width='40px' style='border-radius: 80%;'></td>";
    echo "<td>" . $ligne[1] . "</td>";
    echo "<td>" . $ligne[2] . "</td>";
    echo "<td>" . $ligne[3] . "</td>";
    echo "<td>" . $ligne[4] . "</td>";
    echo "</tr>";
}
    ?>

  
</table>
 <?php 
  //Cette instruction permet de libérer les ressources associées au résultat de la requête
    $result->closeCursor();
    }
 ?> 

                </div>
            </div>
        </div>
        </body>
        </html>