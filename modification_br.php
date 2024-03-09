
<?php
// initialiser une session
session_start();
if(!isset($_SESSION["user_id"])){
   header("Location: accueil.html");
   exit(); 
}
   //connexion a la base de donnees
   $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 // Récupérez les informations de l'utilisateur à partir de la base de données en utilisant l'ID de l'utilisateur.
$user_id = $_SESSION["user_id"];
/*utilise PDO pour préparer et exécuter une requête SQL qui sélectionne des données dans une table nommée "brand" où la colonne id_br correspond à un identifiant utilisateur donné*/
$stmt = $pdo->prepare("SELECT * FROM brand WHERE id_br = ?");
$stmt->execute([$user_id]);
$userinfo = $stmt->fetch();
 
/*vérifie si une variable POST appelée "newusername" est définie et non vide et si elle est différente du nom d'utilisateur actuel de l'utilisateur */
if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $userinfo['Login']) {
   /*La fonction htmlspecialchars() est utilisée pour éviter les attaques de type XSS en encodant les caractères spéciaux et en empêchant leur exécution en tant que code*/
   $newpseudo = htmlspecialchars($_POST['newusername']);
   //la base de données est mise à jour en utilisant PDO
   $insertpseudo = $pdo->prepare("UPDATE brand SET Login = ? WHERE id_br = ?");
   $insertpseudo->execute(array($newpseudo, $user_id));

   // Mettre à jour le champ Brand_Login dans la table partenariat
    $update_partenariat = $pdo->prepare("UPDATE partenariat SET Brand_Login = ? WHERE Brand_Login = ?");
    $update_partenariat->execute(array($newpseudo, $userinfo['Login']));



   // Mettre à jour le champ Auteur dans la table message
    $update_sender = $pdo->prepare("UPDATE message SET autour = ? WHERE autour = ?");
    $update_sender->execute(array($newpseudo, $userinfo['Login']));
    
    // Mettre à jour le champ Destinataire dans la table message
    $update_recipient = $pdo->prepare("UPDATE message SET destinataire = ? WHERE destinataire = ?");
    $update_recipient->execute(array($newpseudo, $userinfo['Login']));

   header('Location: espace_br.php?id_br='.$user_id);

}

if(isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $userinfo['Brand_Name']) {
   //le nom de la marque est extrait de la variable POST
   $newname = htmlspecialchars($_POST['newname']);
   /*la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Brand_Name" de la table "brand" avec la nouvelle valeur du nom de la marque*/
   $insertN = $pdo->prepare("UPDATE brand SET Brand_Name  = ? WHERE id_br = ?");
   $insertN->execute(array($newname, $user_id));
   
   // Mettre à jour le champ Brand dans la table partenariat
   $update_partenariat = $pdo->prepare("UPDATE partenariat SET Brand = ? WHERE Brand = ?");
   $update_partenariat->execute(array($newname, $userinfo['Brand_Name']));

   header('Location: espace_br.php?id_br='.$user_id);

}

if(isset($_POST['newtur']) AND !empty($_POST['newtur']) AND $_POST['newtur']!= $userinfo[' Brand_Turnover']) {
   //le chiffre d'affaires est extrait de la variable POST
   $newage = htmlspecialchars($_POST['newtur']);
   /* la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Brand_Turnover" de la table "brand" avec la nouvelle valeur du chiffre d'affaires*/
   $insertage = $pdo->prepare("UPDATE brand SET Brand_Turnover = ? WHERE id_br = ?");
   $insertage->execute(array($newage, $user_id));
   header('Location: espace_br.php?id_br='.$user_id);

}

if(isset($_POST['newbes']) AND !empty($_POST['newbes']) AND $_POST['newbes'] != $userinfo['Business_area']) {
   //la zone d'activité est extraite de la variable POST
   $newfb = htmlspecialchars($_POST['newbes']);
   /* la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Business_area" de la table "brand" avec la nouvelle valeur de la zone d'activité*/
   $insertfb = $pdo->prepare("UPDATE brand SET Business_area = ? WHERE id_br = ?");
   $insertfb->execute(array($newfb, $user_id));
   header('Location: espace_br.php?id_br='.$user_id);

}
/*Ce code vérifie si un fichier a été téléchargé avec succès via un formulaire HTML à l'aide de la variable $_FILES*/
if (isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == 0) {
   // Vérifiez si le fichier téléchargé est une image
   $fileinfo = pathinfo($_FILES['brand_logo']['name']);
   $extension = strtolower($fileinfo['extension']);
   $allowed_extensions = array('jpg', 'jpeg', 'png');
   if (in_array($extension, $allowed_extensions)) {
      // Déplacez le fichier téléchargé vers le dossier d'uploads
      $new_filename = uniqid() . '.' . $extension;
      move_uploaded_file($_FILES['brand_logo']['tmp_name'], 'uploads/' . $new_filename);
      // Mettez à jour le nom de la photo de profil dans la base de données
      $Profile_pic = $new_filename;
      $update_pic = $pdo->prepare("UPDATE brand SET Brand_Logo = ? WHERE id_br = ?");
      $update_pic->execute(array($Profile_pic, $user_id));
      header('Location: espace_br.php?id_br=' . $user_id);
   } else {
     echo "Le fichier doit être une image (JPG, JPEG, PNG)";
   }
}
if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
   $mdp1 = $_POST['newmdp1'];
   $mdp2 = $_POST['newmdp2'];
   if($mdp1 == $mdp2) { //vérifiant que les deux nouveaux mots de passe entrés correspondent
      /*le mot de passe est haché avec la fonction password_hash() avant d'être stocké dans la base de données */
      $hash = password_hash($mdp1, PASSWORD_DEFAULT);
      $insertmdp = $pdo->prepare("UPDATE brand SET Password = ? WHERE id_br = ?");
      $insertmdp->execute(array($hash, $user_id));
      header('Location: espace_br.php?id_inf='.$user_id);
   } else { //un message d'erreur est affiché
       echo "Vos deux mots de passe ne correspondent pas !";
   }
}
?>


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
        <link rel="stylesheet" href="style_mod.css">
        <title>Modification</title>
      
   </head>
   <body>

   
      
   <div class="side-menu">
      <div class="lg">
         <a href="accueil.html"><img class="logo" src="images/logo.png" alt=""></a>
      </div>
      <br>
      <ul> <!--liste des liens vers des pages web diffrentes de ce site web -->
         <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a> <br>
         <a href="espace_br.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a> <br>
         <a  href="logout.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
      </ul>
   </div>

      <div align="center">
        
         <div class="care" align="left">
            <!--formulaire pour permettre à un utilisateur de mettre à jour les informations de son profil de marque -->
            <form method="POST" action="" enctype="multipart/form-data">
               <br>
               <!--vérifie si l'utilisateur a soumis une nouvelle valeur pour le champ "Nom d'utilisateur" et met à jour la base de données avec la nouvelle valeur si c'est le cas -->
               <input type="text" name="newusername" placeholder="Username" value="<?php echo !empty($_POST['newusername']) ? $_POST['newusername'] : ''; ?>" /><br /><br />
               <!-- vérifie si l'utilisateur a soumis une nouvelle valeur pour le champ "Nom de marque" et met à jour la base de données avec la nouvelle valeur si c'est le cas -->
               <input type="text" name="newname" placeholder="Brand_Name" value="<?php echo !empty($_POST['newname']) ? $_POST['newname'] : ''; ?>" /><br /><br />
               <!--vérifie si l'utilisateur a soumis une nouvelle valeur pour le champ "Chiffre d'affaires de la marque" et met à jour la base de données avec la nouvelle valeur si c'est le cas -->
               <input type="text" name="newtur" placeholder="Brand_Turnover" value="<?php echo !empty($_POST['newtur']) ? $_POST['newtur'] : ''; ?>" /><br /><br />
               <!-- vérifie si l'utilisateur a soumis une nouvelle valeur pour le champ "Domaine d'activité de l'entreprise" et met à jour la base de données avec la nouvelle valeur si c'est le cas. -->
               <input type="text" name="newbes" placeholder="Business_area" value="<?php echo !empty($_POST['newbes']) ? $_POST['newbes'] : ''; ?>" /><br /><br />
                <!--vérifie si l'utilisateur a téléchargé un nouveau fichier pour le logo de sa marque. Si le fichier est une image, il est téléchargé dans le dossier d'uploads et le nom du fichier est mis à jour dans la base de données -->
               <label>Upload a new logo picture</label><br>
               <input type="file" name="brand_logo"><br>
               <!-- vérifie si l'utilisateur a soumis une nouvelle valeur pour le champ de mot de passe et met à jour la base de données avec le nouveau mot de passe si les deux champs de mot de passe correspondent -->
               <input type="password" name="newmdp1" placeholder="password"/><br /> <br>
               <input type="password" name="newmdp2" placeholder="Confirmation of your password" /><br /><br />
               <input  class="boutton" type="submit" value="Update my profile !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
