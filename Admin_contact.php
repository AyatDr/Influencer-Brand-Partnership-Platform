<!DOCTYPE html>
<html lang="en">

<head>
        <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="utf-8">
        <!--d'ajouter des icônes à la page-->
        <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--les propriétés de l'affichage initial de la page sur les différents types d'appareils-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="contactAd.css">
         <!--d'ajouter des icônes à la page-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
        <title>Partnership</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
          <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
         </div>
      </br>
        <ul><!-- Élément contenant la liste des liens du menu latéral -->
        <a href="accueil.html"  ><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span>Home</span> </li></a> <!-- Lien vers la page d'accueil avec une icône de maison -->
            <br>
            <a href="espace_admin.php"  ><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span>My profile</span> </li></a><!-- Lien vers la page du profil de l'administrateur avec une icône de colonnes de table -->
            <br>
             <a href="logoutadmin.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span>Log out</span> </li></a><!--Le lien hypertexte <a href="logoutadmin.php"> renvoie à une page de déconnexion pour l'administrateur. 
             Le code de l'icône <i class="fa-solid fa-key"> montre une clé solide, qui est un symbole communément utilisé pour représenter la sécurité et l'authentification-->
        </ul>
    </div>

    <div class="container">
        
  
        <div class="content">
              <div class="content-2">
                <div class="recent">
                    <div class="title">
                        <h2>Messages received</h2>
                    </div>
        <?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Requête SQL pour récupérer les informations de la table "message"
$sql = "SELECT name, email, subject, message FROM contact";

// Exécuter la requête SQL
$result = $pdo->prepare($sql);
$result->execute();

if (!$result) {
    echo "La récupération des données a rencontré un problème!";
} else {
?>

<table>
    <tr>
        <th>Name complet</th>
        <th>Email </th>
        <th>Subject</th>
        <th>Message</th>
        <th>Reply</th>
    </tr>

    <?php
    // une boucle while pour parcourir les résultats ligne par ligne, et la méthode fetch() pour extraire chaque ligne sous forme de tableau associatif
    while ($ligne = $result->fetch(PDO::FETCH_NUM)) {
        echo "<tr>";
        echo "<td>" . $ligne[0] . "</td>";
        echo "<td>" . $ligne[1] . "</td>";
        echo "<td>" . $ligne[2] . "</td>";
        echo "<td>" . $ligne[3] . "</td>";
        echo "<td><a href='https://mail.google.com/?to=" . $ligne[1] . "'><i class='fa fa-envelope' style='color: #84abc2;'></i></a></td>";

        echo "</tr>";
    }
    ?>
</table>

<?php
    // Cette instruction permet de libérer les ressources associées au résultat de la requête
    $result->closeCursor();
}
?>


          
                </div>
            </div>
        </div>
        </body>
        </html>