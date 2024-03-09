<?php
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page d'acceuil.
if(!isset($_SESSION["user_id"])){
    header("Location: accueil.php");
    exit(); 
}

try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}



// Récupérez les informations de l'utilisateur à partir de la base de données en utilisant l'ID de l'utilisateur.
$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM influencer WHERE id_inf = ?");
$stmt->execute([$user_id]);
$userinfo = $stmt->fetch();
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
        <link rel="stylesheet" href="espace_inf.css">
        <title>Influencer</title>
</head>

<body>


      <div class="side-menu">
        <div class="lg">
          <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
        </div>
       </br>
       <ul> <!--liste de lien vers differents page web -->
            <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a>
            <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a>
            <a href="index_N.php"><li><i class="fa-regular fa-message"></i><span class="titre ">New message</span></li></a>
            <a  href="newcollaboration.php"><li><i class="fa-solid fa-plus" style="color: #ffffff;"></i><span class="titre" >New Partnership</span></li></a>
            <a  href="partenariat_inf.php"><li><i class="fa-solid fa-regular fa-file-signature" style="color: #ffffff;"></i><span class="titre" >Partnership</span></li></a>
            <a href="marque.php"><li><i class="fa-solid fa-store" style="color: #ffffff;"></i><span class="titre" >Brands</span></li></a>
            
            <a  href="modification_inf.php"><li><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i><span class="titre ">Modifiy my acccount</span></li></a>
            
            <a  href="delete_inf.php"><li><i class="fa-solid fa-trash" style="color: #ffffff;"></i><span class="titre ">Delete my account</span></li></a> 
            <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
        </ul>
    </div>


                                    <h1> Welcome to your profile </h1>
                   <p> Be the voice of the brand and share your unique perspective </p>
    <div class="profile-body">
            <!--Le profil est divisé en deux parties : "photo" et "profile" -->
            <div class="photo"> 
                <img src="uploads/<?php echo $userinfo['Profile_pic']; ?>" class="image--cover">
            </div>
        <div class="profile">
    
            <!-- Affichage des informations de l'influenceur -->
            <!-- utilise les informations récupérées de la base de données à travers la variable $userinfo pour remplir les champs nécessaires -->
           <center>   <h1 class="username"><?php echo $userinfo['Name']; ?></center></h1>
           <div class="info">
            <!--la balise "<B>" est utilisée pour rendre ces informations en gras-->
           <B> Username </B> : <?php echo $userinfo['Username']; ?> <br />
           <B> Age : </B><?php echo $userinfo['Age']; ?>  <br />
           <B>Social media accounts : </B> <?php echo $userinfo['Media']; ?> <br />
  
          </div>

                
       </div>
    </div>
         
</body>

</html>