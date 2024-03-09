
<?php
// initialiser une session
session_start();
if(!isset($_SESSION["user_id"])){
   header("Location: accueil.php");
   exit(); 
}

  //connexion a la base de donnees
   $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 // Récupérez les informations de l'utilisateur à partir de la base de données en utilisant l'ID de l'utilisateur.
$user_id = $_SESSION["user_id"];
/*utilise PDO pour préparer et exécuter une requête SQL qui sélectionne des données dans une table nommée "influencer" où la colonne id_inf correspond à un identifiant utilisateur donné*/
$stmt = $pdo->prepare("SELECT * FROM influencer WHERE id_inf = ?");
$stmt->execute([$user_id]);
$userinfo = $stmt->fetch();
 
/*vérifie si une variable POST appelée "newusername" est définie et non vide et si elle est différente du nom d'utilisateur actuel de l'utilisateur */
if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $userinfo['Username']) {
    /*La fonction htmlspecialchars() est utilisée pour éviter les attaques de type XSS en encodant les caractères spéciaux et en empêchant leur exécution en tant que code*/

   $newpseudo = htmlspecialchars($_POST['newusername']);
   //la base de données est mise à jour en utilisant PDO
   $insertpseudo = $pdo->prepare("UPDATE influencer SET Username = ? WHERE id_inf = ?");
   $insertpseudo->execute(array($newpseudo, $user_id));
   
   // Mettre à jour le champ Username dans la table partenariat
    $update_partenariat = $pdo->prepare("UPDATE partenariat SET Influencer_Login = ? WHERE Influencer_Login = ?");
    $update_partenariat->execute(array($newpseudo, $userinfo['Username']));

    // Mettre à jour le champ Auteur dans la table message
    $update_sender = $pdo->prepare("UPDATE Message SET autour = ? WHERE autour = ?");
    $update_sender->execute(array($newpseudo, $userinfo['Username']));
    
    // Mettre à jour le champ Destinataire dans la table message
    $update_recipient = $pdo->prepare("UPDATE message SET destinataire = ? WHERE destinataire = ?");
    $update_recipient->execute(array($newpseudo, $userinfo['Username']));

   header('Location:espace_inf.php?id_inf='.$user_id);
}

if(isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $userinfo['Name']) {
    //le nom de l'influenceur est extrait de la variable POST
   $newname = htmlspecialchars($_POST['newname']);
   /*la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Name" de la table "influencer" avec la nouvelle valeur du nom de la marque*/
   $insertN = $pdo->prepare("UPDATE influencer SET Name = ? WHERE id_inf = ?");
   $insertN->execute(array($newname, $user_id));

   // Mettre à jour le champ Influencer dans la table partenariat
    $update_partenariat = $pdo->prepare("UPDATE partenariat SET Influencer = ? WHERE Influencer = ?");
    $update_partenariat->execute(array($newname, $userinfo['Name']));

   header('Location: espace_inf.php?id_inf='.$user_id);

}

if(isset($_POST['newage']) AND !empty($_POST['newage']) AND $_POST['newage']!= $userinfo[' Age']) {
   //l'age est extraite de la variable POST
   $newage = htmlspecialchars($_POST['newage']);
   /* la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Age" de la table "influencer" avec la nouvelle */
   $insertage = $pdo->prepare("UPDATE influencer SET Age = ? WHERE id_inf = ?");
   $insertage->execute(array($newage, $user_id));
   header('Location: espace_inf.php?id_inf='.$user_id);

}

if(isset($_POST['newmedia']) AND !empty($_POST['newmedia']) AND $_POST['newmedia'] != $userinfo['Media']) {
   //l'age est extraite de la variable POST
   $newM = htmlspecialchars($_POST['newmedia']);
   /* la base de données est mise à jour en utilisant PDO pour mettre à jour la colonne "Age" de la table "influencer" avec la nouvelle */
   $insertM= $pdo->prepare("UPDATE influencer SET Media = ? WHERE id_inf = ?");
   $insertM->execute(array($newM, $user_id));
   header('Location: espace_inf.php?id_inf='.$user_id);

}
/*Ce code vérifie si un fichier a été téléchargé avec succès via un formulaire HTML à l'aide de la variable $_FILES*/
if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == 0) {
   // Vérifiez si le fichier téléchargé est une image
   $fileinfo = pathinfo($_FILES['profilepic']['name']);
   $extension = strtolower($fileinfo['extension']);
   $allowed_extensions = array('jpg', 'jpeg', 'png');
   if (in_array($extension, $allowed_extensions)) {
      // Déplacez le fichier téléchargé vers le dossier d'uploads
      $new_filename = uniqid() . '.' . $extension;
      move_uploaded_file($_FILES['profilepic']['tmp_name'], 'uploads/' . $new_filename);
      // Mettez à jour le nom de la photo de profil dans la base de données
      $Profile_pic = $new_filename;
      $update_pic = $pdo->prepare("UPDATE influencer SET Profile_pic = ? WHERE id_inf = ?");
      $update_pic->execute(array($Profile_pic, $user_id));
      header('Location: espace_inf.php?id_inf=' . $user_id);
   } else {
      echo "Le fichier doit être une image (JPG, JPEG, PNG)";
   }
}
if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
   $mdp1 = $_POST['newmdp1'];
   $mdp2 = $_POST['newmdp2'];
   if($mdp1 == $mdp2) {//vérifiant que les deux nouveaux mots de passe entrés correspondent
      /*le mot de passe est haché avec la fonction password_hash() avant d'être stocké dans la base de données */
      $hash = password_hash($mdp1, PASSWORD_DEFAULT);
      $insertmdp = $pdo->prepare("UPDATE influencer SET Password = ? WHERE id_inf = ?");
      $insertmdp->execute(array($hash, $user_id));
      header('Location: espace_inf.php?id_inf='.$user_id);
   } else { //un message d'erreur est affiché
      $msg = "Vos deux mots de passe ne correspondent pas !";
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
      <ul><!--liste des liens vers des pages web diffrentes de ce site web -->
        <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a><br>
        <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a><br>
         <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
      </ul>
   </div>


      <div align="center" >
       
         <div class="care" align="left">
            <!--Ce formulaire permet à l'utilisateur de mettre à jour son profil en renseignant différentes informations personnelles -->
            <!--Le code utilise la méthode POST pour envoyer les données du formulaire à la même page et l'attribut "enctype" est défini à "multipart/form-data" pour permettre l'upload de fichiers -->
            <form method="POST" action="" enctype="multipart/form-data">
              <!--un champ de saisie de texte pour le nom d'utilisateur avec une valeur par défaut récupérée à partir de la variable $_POST['newusername'] -->
            <input type="text" name="newusername" placeholder="Username" value="<?php echo !empty($_POST['newusername']) ? $_POST['newusername'] : ''; ?>"/>
             <br /><br />
               <!--un champ de saisie de texte pour le nom avec une valeur par défaut récupérée à partir de la variable $_POST['newname'] -->
           <input type="text" name="newname" placeholder="Name" value="<?php echo !empty($_POST['newname']) ? $_POST['newname'] : ''; ?>" /><br /><br />
              <!--champ de saisie de texte pour l'âge avec une valeur par défaut récupérée à partir de la variable $_POST['newage'] -->
           <input type="text" name="newage" placeholder="Age" value="<?php echo !empty($_POST['newage']) ? $_POST['newage'] : ''; ?>"/><br /><br />
              <!--un champ de saisie de texte pour les médias avec une valeur par défaut récupérée à partir de la variable $_POST['newmedia'] -->
            <input type="text" name="newmedia" placeholder="Media" value="<?php echo !empty($_POST['newmedia']) ? $_POST['newmedia'] : ''; ?>" /><br /><br />
                <!--Affiche une étiquette pour le champ de téléchargement de l'image de profile -->
               <label>Upload a new profile picture</label><br>
               <!--Crée un champ pour télécharger une image de profil -->
               <input type="file" name="profilepic"><br>
                <!--Crée un champ de saisie de texte pour le mot de passe-->
               <input type="password" name="newmdp1" placeholder="password"/><br /><br />
               <input type="password" name="newmdp2" placeholder="Confirmation of your password" /><br /><br />
               <!--Crée un bouton de soumission pour mettre à jour le profil de l'utilisateur -->
               <input  class="boutton" type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
