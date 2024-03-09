<!DOCTYPE html> <!-- Déclaration de type de document indiquant que le document est un document HTML -->
<html lang="en"> <!-- Balise d'ouverture de l'élément HTML avec l'attribut lang défini en anglais -->

<head> <!-- Balise d'ouverture de l'élément Head contenant les informations d'en-tête de la page -->
    <meta charset="UTF-8"> <!-- Définition de l'encodage de caractères de la page en UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Définition de la compatibilité avec Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Définition de la largeur de l'affichage et de l'échelle initiale -->
    <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script> <!-- Ajout du script pour utiliser les icônes de Font Awesome -->
    <link rel="stylesheet" href="AS.css"> <!-- Ajout du fichier de style CSS -->
    <title>Admin</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <!--  l'élément <link> qui définit l'icône de page-->
    <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
</head>

<body> <!-- Balise d'ouverture de l'élément Body contenant le contenu de la page -->
    <div class="side-menu"> <!-- Élément contenant le menu latéral -->
        <div class="brand-name">
      <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a> <!-- Logo cliquable redirigeant vers la page d'accueil -->

        </div>
    </br>
        <ul> <!-- Élément contenant la liste des liens du menu latéral -->

            <a href="accueil.html"  ><li><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span>Home</span> </li></a> <!-- Lien vers la page d'accueil avec une icône de maison -->
            <a href="espace_admin.php"  ><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span>My profile</span> </li></a> <!-- Lien vers la page du profil de l'administrateur avec une icône de colonnes de table -->
            <a href="all_influencer.php"  ><li><i class="fa-solid fa-users" style="color: #ffffff;"></i><span>Influencers</span></li></a> <!-- Lien vers la page listant tous les influenceurs avec une icône d'utilisateur -->
            
            <a href="all_brands.php"  ><li><i class="fa-solid fa-store" style="color: #ffffff;"></i><span>Brands</span> </li></a> <!-- Lien vers la page listant toutes les marques avec une icône de magasin -->
            <a href="all_partenariat.php"  ><li><i class="fa-solid fa-regular fa-file-signature" style="color: #ffffff;"></i><span>Partnerships</span></li></a> <!-- Lien vers la page listant tous les partenariats avec une icône de signature de fichier -->

            <a href="demande_Supp.php"><li><i class="fa-solid fa-trash" style="color: white;"></i><span>Deletion request</span> </li></a> <!-- Lien vers la page pour faire une demande de suppression avec une icône de poubelle -->

            <a href="Admin_contact.php"><li><i class="fa-sharp fa-solid fa-bell" style="color: #ffffff;"></i><span>Notifications</span> </li></a> <!-- Lien vers la page pour voir les messages et les questions des utilisateur de la platforme -->

             <a href="logoutadmin.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span>Log out</span> </li></a><!--Le lien hypertexte <a href="logoutadmin.php"> renvoie à une page de déconnexion pour l'administrateur. Le code de l'icône <i class="fa-solid fa-key"> montre une clé solide, qui est un symbole communément utilisé pour représenter la sécurité et l'authentification-->
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                
                <div class="user">
                    <?php // Se connecter à la base de données
                $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer le nom du fichier d'image de l'administrateur à partir de la base de données
$requete = "SELECT Profile, Username FROM administrateur WHERE id = 1"; 
$resultat = $pdo->query($requete);
$donnees = $resultat->fetch();
$nom_utilisateur = $donnees['Username'];
$nom_fichier = $donnees['Profile'];


// Afficher les informations de l'administrateur


echo '<div class="user-info">';
echo '<div class="admin-greeting">Hey, Admin</div>';

echo '<div class="nom">' . $nom_utilisateur . '</div>';
echo '<img class="imguser" src="uploads/' . $nom_fichier . '">';

echo '</div>';
    
?> 
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                <div class="card">
                     <?php
                      // Se connecter à la base de données
                    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Compter le nombre d'entrées dans la table "influencer"
                   $requete_count = "SELECT COUNT(*) FROM influencer";
                   $result_count = $pdo->query($requete_count);
                   $count = $result_count->fetch(PDO::FETCH_NUM)[0];
                   // Afficher le résultat de la requête
                   echo '<div class="box">';
                   echo '<h1>' . $count . '</h1>';
                   echo '<h3>Influencers</h3>';
                   echo '</div>';
                   ?>
                    <div class="icon-case">
                        <i class="fa-solid fa-users"  ></i><!-- Afficher une icône de compte utilisateur -->
                    </div>
                </div>
                <div class="card"> <!-- Afficher le nombre d'éléments de la table "Brand" de la base de données -->
                     <?php
                     // Établir une connexion à la base de données MySQL
                    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
                     // Définir le mode d'erreur de la connexion à "ERRMODE_EXCEPTION"
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       // Exécuter une requête SQL pour compter le nombre d'éléments dans la table "Brand"
                   $requete_count = "SELECT COUNT(*) FROM Brand";
                   $result_count = $pdo->query($requete_count);
                   $count = $result_count->fetch(PDO::FETCH_NUM)[0];
                      // Afficher le nombre d'éléments dans une boîte de comptage
                   echo '<div class="box">';
                   echo '<h1>' . $count . '</h1>';// Afficher le nombre d'éléments
                   echo '<h3>Brands</h3>';// Afficher le nom de la table
                   echo '</div>';
                   ?>
                    <div class="icon-case">
                        <i class="fa-solid fa-store"></i> <!-- Affiche l'icône du magasin -->
                    </div>
                </div>
                
                 <div class="card">
                     <?php
                         // Établir une connexion avec la base de données
                    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   
    // Effectuer une requête pour compter le nombre de partenariats dans la table "partenariat"
                   $requete_count = "SELECT COUNT(*) FROM partenariat";
                   $result_count = $pdo->query($requete_count);
                   $count = $result_count->fetch(PDO::FETCH_NUM)[0];
                     // Afficher le nombre de partenariats dans une boîte avec un titre
                   echo '<div class="box">';
                   echo '<h1>' . $count . '</h1>';
                   echo '<h3>Partnerships</h3>';
                   echo '</div>';
                   ?>
                    <div class="icon-case">
                        <i class="fa-solid fa-handshake"></i> <!-- Affiche l'icône de la poignée de main -->

                    </div>
                </div>
            </div>
                       <div class="content-2">
                <div class="new">
                    <div class="title">
                        <h2>New Influencers</h2>
                        <a href="all_influencer.php" class="btn">View All</a>
                    </div>


                    <?php 
// Établir une connexion avec la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     // Effectuer une requête pour récupérer les trois derniers profils d'influenceurs ajoutés
$requete = "SELECT Profile_pic, Username FROM influencer ORDER BY id_inf DESC LIMIT 3";
$result = $pdo->query($requete);

if(!$result){
    echo" La récupération des données a rencontré un problème!";   
}else{
?>
<!-- Afficher une table contenant les profils d'influenceurs récupérés -->
    <table>
        <tr>
            <th>Profile</th>
            <th>Name</th>
            
        </tr>
        <?php
            while ($ligne= $result->fetch(PDO::FETCH_NUM)){// boucle while qui parcourt chaque ligne de résultat de la requête SQL
                echo "<tr>";// boucle while qui parcourt chaque ligne de résultat de la requête SQL
                echo "<td><img src='uploads/" . $ligne[0] . "' width='40px' style='border-radius: 80%;'></td>";// affiche l'image de profil de l'influenceur
                echo "<td>" . $ligne[1] . "</td>"; // affiche le nom de l'influenceur
                echo "</tr>"; // termine la ligne de la table
            }
        ?>
                 </table>
                     <?php 
    $result->closeCursor(); // libère les ressources associées à la requête SQL
    }
 ?> 
  </div>
<div class="recent">
 <div class="title"> <!-- Titre de la section -->
  <h2>Recent Partnerships</h2>
          <!-- Bouton pour afficher tous les partenariats -->
    <a href="all_partenariat.php" class="btn">View All</a>
    </div>
  <?php 
// Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête SQL pour récupérer les trois derniers partenariats

$requete = "SELECT Brand, influencer,amount FROM partenariat ORDER BY id DESC LIMIT 3";
$result = $pdo->query($requete);

    // Vérifier si la requête a renvoyé des résultats
if(!$result){
    echo" La récupération des données a rencontré un problème!";   
}else{
?>
 <!-- Table pour afficher les partenariats -->
    <table>
        <tr>
            <th>Brand</th>
            <th>Influencer</th>
            <th>Amount</th>
            
        </tr>
         <?php
             // Boucle pour parcourir tous les partenariats renvoyés par la requête SQL
        while ($ligne = $result->fetch(PDO::FETCH_NUM)){
            echo "<tr>";
             // Affichage de la marque du partenariat
            echo "<td>" . $ligne[0] . "</td>"; 
              // Affichage de l'influenceur du partenariat
            echo "<td>" . $ligne[1] . "</td>"; 
               // Affichage du montant du partenariat
            echo "<td>" . $ligne[2] . "</td>"; 
            echo "</tr>";
        }
        ?>
                 </table>
                     <?php 
    $result->closeCursor();// Fermeture de la requête SQL
    }
 ?> 
                </div>
                <div class="new">
                    <div class="title">
                        <h2>New Brands</h2>
                        <a href="all_Brands.php" class="btn">View All</a>
                    </div>


                    <?php 
 // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête pour récupérer les logos et les noms de marque des dernières marques ajoutées

$requete = "SELECT Brand_Logo, Brand_Name FROM Brand ORDER BY id_br DESC LIMIT 3";
$result = $pdo->query($requete);
   // Vérification de la réussite de la requête
if(!$result){
    echo" La récupération des données a rencontré un problème!";   
}else{
   // Affichage d'un tableau avec les logos et les noms de marque
   echo '<table>';
   echo '<tr>';
   echo '<th>Logo</th>';
   echo '<th>Brand</th>';
   echo '</tr>';

        // Boucle pour récupérer chaque ligne du résultat de la requête
            while ($ligne= $result->fetch(PDO::FETCH_NUM)){
                echo "<tr>";
                echo "<td><img src='uploads/" . $ligne[0] . "' width='40px' style='border-radius: 80%;'></td>";
                echo "<td>" . $ligne[1] . "</td>"; 
            }
       
              echo  '</table>';
           // Fermeture de la connexion à la base de données                
    $result->closeCursor();
    }
 ?> 

                </div>
            </div>
        </div>
    </div>


</body>

</html>