<?php
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion.
if(!isset($_SESSION["user_id"])){
    header("Location: accueil.php");
    exit(); 
}

// Récupérez les informations de l'utilisateur à partir de la base de données en utilisant l'ID de l'utilisateur.
try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT * FROM brand WHERE id_br = ?");
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
        <link rel="stylesheet" href="espace_inf.css">
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
         <title>Brand</title>
</head>

<body>


    <div class="side-menu">
        

        <div class="lg">
      <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
          
        </div>
    </br>

        <ul>     <!--liste de lien vers differents page web --> 
            <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a>
            <a href="espace_br.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a>
      
             <a href="index_M.php"><li><i class="fa-regular fa-message"></i><span class="titre ">New message</span></li></a>
             <a  href="newco_br.php"><li><i class="fa-solid fa-plus" style="color: #ffffff;"></i><span class="titre" >New Partnership</span></li></a>
             <a  href="partenariat_br.php"><li><i class="fa-solid fa-regular fa-file-signature" style="color: #ffffff;"></i><span class="titre" >Partnership</span></li></a>
            <a href="influencers.php"><li><i class="fa-solid fa-users" style="color: #ffffff;"></i><span class="titre" >Influencers</span></li></a>
            <a  href="modification_br.php"><li><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i><span class="titre ">Modifiy my acccount</span></li></a>
            <a  href="delete_br.php"><li><i class="fa-solid fa-trash" style="color: #ffffff;"></i><span class="titre ">Delete my account</span></li></a> 
            <a  href="logout.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
            
         </ul>
    </div>


                                                     <h1> Welcome to your profile </h1>
          <br/>
                                     <p> Collaborate with influencers and amplify your brand's message </p>

     <div class="profile-body">
        <!--Le profil est divisé en deux parties : "photo" et "profile" -->
             <div class="photo">
             <img src="uploads/<?php echo $userinfo['Brand_Logo']; ?>" class="image--cover">
            </div>
            
        <div class="profile">
    
            <!-- Affichage des informations de l'influenceur -->
            <!-- utilise les informations récupérées de la base de données à travers la variable $userinfo pour remplir les champs nécessaires -->
             <center>   <h1 class="username"><?php echo $userinfo['Brand_Name']; ?></center></h1>
             <div class="info">
                <!--la balise "<B>" est utilisée pour rendre ces informations en gras-->
                     <B> Login </B> : <?php echo $userinfo['Login']; ?> <br />
                     <B> Turnover : </B><?php echo $userinfo['Brand_Turnover']; ?>  <br />
                     <B> Business Area : </B><?php echo $userinfo['Business_area']; ?>  <br />
             </div>

        </div>
   
     </div>


</body>

</html>
