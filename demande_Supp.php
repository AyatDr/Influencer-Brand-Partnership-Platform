<?php
try {
    // Se connecter à la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// Récupérer les informations sur les demandes de suppression d'influenceurs à partir de la base de données

        $contenud_inf = $pdo->query('SELECT *FROM influencer INNER JOIN  demande_suppression_inf  ON influencer.id_inf = demande_suppression_inf.id_inf;');
        $contenud_inf->execute();

        // Récupérer les informations sur les demandes de suppression de marques à partir de la base de données
        $contenud_m = $pdo->query('SELECT *FROM  brand INNER JOIN  demande_suppression_br  ON brand.id_br = demande_suppression_br.id_br;');
        $contenud_m->execute();


         
         
?>

<!DOCTYPE html> <!-- Déclaration de type de document indiquant que le document est un document HTML -->
<html lang="en"> <!-- Balise d'ouverture de l'élément HTML avec l'attribut lang défini en anglais -->

<head>
    <title>Deletion requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
    <meta charset="UTF-8">
    <link href="all_influencer.css" rel="stylesheet" /> <!-- Ajout du fichier de style CSS -->
    <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script><!-- Ajout du script pour utiliser les icônes de Font Awesome -->


</head>

<body> <!-- Balise d'ouverture de l'élément Body contenant le contenu de la page -->
<div class="side-menu"> <!-- Élément contenant le menu latéral -->
        <div class="brand-name">
        <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a> <!-- Logo cliquable redirigeant vers la page d'accueil -->
          
        </div>
    </br>

    <ul><!-- Élément contenant la liste des liens du menu latéral -->
       
            <br>
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

<table >
    <!-- Titre de la table -->
<h2 align="center" style="color: #84abc2"; >Deletion request of influencers   </h2>

<thead>
    <!-- En-têtes de la table -->
  <th>supprimer</th>

<th>Id</th>
<th>Username</th>
<th>Age</th>
<th>Media account</th>
<th>Profile</th>


</tr>
</thead>


<?php while($ligne = $contenud_inf->fetch()) { ?>
        <!-- Ligne de la table pour chaque résultat de la requête SQL -->
    <tr>            
    <td ><!-- Bouton de suppression --> 
        <a class="spr"  href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" > <i class="fa-solid fa-user-xmark" style="color: #00000b;"></i></a> </td>
                 
                 <td><!-- ID de l'influenceur -->
                     <a   href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" ><?php echo $ligne['id_inf']; ?></a></td>
                 <td> <!-- Nom d'utilisateur de l'influenceur -->
                     <a   href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" ><?php echo $ligne['Username']; ?></a></td>
                 <td><!-- Age de l'influenceur -->
                     <a   href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" ><?php echo $ligne['Age'];?></a></td>
                 <td><!-- Compte média de l'influenceur -->
                     <a  href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" ><?php echo $ligne['Media']; ?></a></td>
                 <td> <!-- Image de profil de l'influenceur -->
                     <a   href="supprimer_inf.php?id=<?php echo $ligne['id_inf']; ?>" ><img src="uploads/<?php echo $ligne['Profile_pic']; ?>" width='40px' style='border-radius: 80%;'></a></td>
                    
             </tr>

    <?php }?>
</table>
<br/><br/>
  <!-- Titre de la table -->
<h2 align="center" style="color: #84abc2";>Deletion request of brands   </h2>

<table ><!-- Création d'un tableau HTML -->
<thead> <!-- Création des en-têtes de colonnes -->
<th>supprimer</th> 
<th>Id</th>
<th>Username</th>
<th>Brand Name</th>
<th>Busness Area</th>
<th>Turnover</th>

<th>Logo</th>
</tr>
</thead>

<!-- Utilisation d'une boucle pour afficher chaque ligne de données -->
<?php while($ligne = $contenud_m->fetch()) { ?>
                 <!-- Création d'une nouvelle ligne de tableau pour chaque élément de la boucle -->
    <tr>
        <!-- Création d'une colonne pour le bouton de suppression de l'élément -->
        <td><a class="spr" href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><i class="fa-solid fa-user-xmark" style="color: #00000b;"></i></a></td>
        <!-- Création d'une colonne pour l'identifiant de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><?php echo $ligne['id_br']; ?></a></td>
        <!-- Création d'une colonne pour le nom d'utilisateur de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><?php echo $ligne['Login']; ?></a></td>
        <!-- Création d'une colonne pour le nom de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><?php echo $ligne['Brand_Name']; ?></a></td>
        <!-- Création d'une colonne pour le secteur d'activité de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><?php echo $ligne['Business_area']; ?></a></td>
        <!-- Création d'une colonne pour le chiffre d'affaires de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><?php echo $ligne['Brand_Turnover']; ?></a></td>
        <!-- Création d'une colonne pour le logo de la marque -->
        <td><a href="supprimer_br.php?id=<?php echo $ligne['id_br']; ?>"><img src="uploads/<?php echo $ligne['Brand_Logo']; ?>" width='40px' style='border-radius: 80%;'></a></td>
    </tr>
<?php } ?>
</table>

               </div>
            </div>
       
</div>
</body>