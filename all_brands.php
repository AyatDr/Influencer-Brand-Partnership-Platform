<!DOCTYPE html> <!-- Déclaration de type de document indiquant que le document est un document HTML -->
<html lang="en"> <!-- Balise d'ouverture de l'élément HTML avec l'attribut lang défini en anglais -->

<head> <!-- Balise d'ouverture de l'élément Head contenant les informations d'en-tête de la page -->
    <meta charset="UTF-8"> <!-- Définition de l'encodage de caractères de la page en UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Définition de la compatibilité avec Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Définition de la largeur de l'affichage et de l'échelle initiale -->
    <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script> <!-- Ajout du script pour utiliser les icônes de Font Awesome -->
   
    <link rel="stylesheet" href="all_influencer.css"> <!-- Ajout du fichier de style CSS -->
    <title>List Brands</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <!--  l'élément <link> qui définit l'icône de page-->
    <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
</head>
    <body> <!-- Balise d'ouverture de l'élément Body contenant le contenu de la page -->
    <div class="side-menu"> <!-- Élément contenant le menu latéral -->
        <div class="brand-name">
      <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a> <!-- Logo cliquable redirigeant vers la page d'accueil -->
          
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
                        <h2>Brands</h2>
                        
                    </div>

 <?php 
 // Se connecter à la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

// Récupérer les informations sur les MARQUES à partir de la base de données
  $requete = "SELECT Brand_Logo,Login,Brand_Name,Brand_Turnover,Business_area FROM Brand";
     $result = $pdo->query($requete);
// Vérifier si la requête a réussi
    if(!$result){
        echo" La récupération des données a rencontré un problème!";
        
    }else{   //Afficher les informations dans un tableau HTML  
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
    while ($ligne= $result->fetch(PDO::FETCH_NUM)){
    echo "<tr>";
    echo "<td><img src='uploads/" . $ligne[0] . "' width='40px' style='border-radius: 80%;'></td>"; //représente la colonne Brand_Logo, qui contient l'URL de l'image de logo de la marque. Cette URL est utilisée pour afficher l'image en utilisant la balise <img> HTML.
    echo "<td>" . $ligne[1] . "</td>";// représente la colonne Login, qui contient le nom d'utilisateur de la marque. Cette donnée est affichée dans une cellule de tableau HTML
    echo "<td>" . $ligne[2] . "</td>";// représente la colonne Brand_Name, qui contient le nom de la marque. Cette donnée est également affichée dans une cellule de tableau HTML
    echo "<td>" . $ligne[3] . "</td>";// représente la colonne Brand_Turnover, qui contient le chiffre d'affaire de la marque. Cette donnée est également affichée dans une cellule de tableau HTML
    echo "<td>" . $ligne[4] . "</td>";// représente la colonne Business_area, qui contient le domaine de la marque. Cette donnée est également affichée dans une cellule de tableau HTML
    echo "</tr>";
}
    ?>
  
</table>
 <?php 
    $result->closeCursor(); // Fermeture de la connexion à la base de données
    }
 ?> 

                </div>
            </div>
        </div>
        </body>
        </html>