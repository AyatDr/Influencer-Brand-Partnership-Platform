<!DOCTYPE html>
<html lang="en">

<head>
        <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="utf-8">
        <!--d'ajouter des icônes à la page-->
        <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
        <!--  l'élément <link> qui définit l'icône de page-->
        <link rel="icon" href="images/l.gif" sizes="128x128" style="border-radius: 50%;">
        <link rel="stylesheet" href="new.css">
        <title>Partnership</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
      <a href="accueil.html"  > <img class="logo"src="images/logo.png"   alt="" > </li> </a>
            
        </div>
    </br>
      <ul> <!--liste des liens vers des pages web diffrentes de ce site web -->
       <a href="accueil.html"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a> <br>
       <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a> <br>
       <a  href="logout.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
      </ul>
    </div>
  
                                 <h1>Let's start a new partnership together</h1>
                    


<form id="login" class="form-group" method="post" action="Partenariat.php" enctype="multipart/form-data">
   <div align="center">
     <div class="care" align="left">  
      <!-- Champ de saisie pour le nom de la marque -->
      <label for="Brand"></label>
      <input type="text" name="Brand"  id="Brand" placeholder="Brand name">
   
      <!-- Champ de saisie pour le login de la marque -->
      <label for="Brand"></label>
      <center>  <input type="text" name="brand_login"  id="login" placeholder="Brand login "></center>
   
     <!-- Champ de saisie pour le nom de l'influenceur -->
     <label  for="influencer"> </label>
      <input type="text" name="influencer" id="influencer" placeholder= "Influencer name" > 
    
    <!-- Champ de saisie pour le login de l'influenceur --> 
      <input type="text" name="influencer_login"  id="influencer" placeholder="Influencer login">
      <!-- Champ de saisie pour le montant -->
      <label for="amount"></label>
      <input type="text" name="amount" id="amount" placeholder="The amount" >
      
      <!-- Champ de saisie pour la durée en mois -->
      <label for="duration"></label>
      <input type="text" name="duration"  id="duration"  placeholder="The duration(in months)">
  
      <!-- Champ de saisie pour les termes et conditions -->
      <label  for="terme"></label>
      <input type="text" name="terme"  id="terme" placeholder="Terms and conditions">
    
  
      <!-- Champ de saisie pour la signature de l'influenceur -->
      <label  style="color:black; font-size:14px; font-weight: bold;"  for="Signe">Influencer signature</label>
      <input type="file" name="Signe"  id="Signe" >
   
       <!-- Champ de saisie pour la signature du gestionnaire de la marque -->
      <label style="color:black; font-size:14px; font-weight: bold;" for="Signe_brand">Brand manager signature</label>
      <input type="file" name="Signe_brand" id="Signe_brand" >
    <div >
      </div>
      
      <button type="submit" class="boutton">Send</button>
   
  
</form>

 </div>
      
        </body>
        </html>