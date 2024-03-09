<!DOCTYPE html>
<html lang="en">

<head>
        <!--définit l'encodage des caractères utilisé pour afficher la page, qui est UTF-8-->
        <meta charset="utf-8">
        <!--d'ajouter des icônes à la page-->
        <script src="https://kit.fontawesome.com/687f59c35b.js" crossorigin="anonymous"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Par.css">
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
        <ul><!--liste de lien vers differents page web de site web -->
            <a href="espace_inf.php"><li><i class="fa-solid fa-house" style="color: #ffffff;"></i><span class="titre ">Home</span></li></a> </br>
            <a href="espace_inf.php"><li><i class="fa-solid fa-user" style="color: #ffffff;"></i><span class="titre ">My Profile</span></li></a></br>
            <a  href="out.php"><li><i class="fa-solid fa-key" style="color: #ffffff;"></i><span class="titre ">Log out</span></li></a>
        </ul>
    </div>
    <div class="container">
      
    </br> </br>  
        <div class="content">
              <div class="content-2">
                <div class="recent">
                    <div class="title">
                        <h2>Your Partnerships</h2>
                    </div>
        <?php
                  //initaliser une session
                 session_start();
                 $user_id = $_SESSION['user_id'];
                // connexion a la base de donnees
                $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
               $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              // Récupérer username à partir de user_id
               $user_name_query = "SELECT Username FROM influencer WHERE id_inf = ?";
               $user_id_statement = $pdo->prepare($user_name_query);
               $user_id_statement->execute([$user_id]);
               $user_id_result = $user_id_statement->fetch();
               $user_id = $user_id_result['Username'];


               /*La requête sélectionne les influencers où la colonne "Influencer_Login" est égale à l'identifiant d'utilisateur stocké dans la variable $user_id */
              $requete = "SELECT Brand, influencer, amount, duration, Terme, Signature_inf, Signature_Brand, Brand_Login, Influencer_Login FROM partenariat WHERE Influencer_Login = ?";
              $result = $pdo->prepare($requete);
              $result->execute([$user_id]);

              if (!$result) {
              echo "La récupération des données a rencontré un problème!";
              } else {
        ?>

    <table>
        <tr>
            <th>Brand</th>
            <th>Influencer </th>
            <th>Amount</th>
            <th>Duration</th>
            <th>Terms</th>
            <th>Brand manager signature</th>
            <th>Influencer signature</th>
            <th>Brand Login</th>
            <th>Influencer Login</th>
        </tr>
        <?php
        /*une boucle while pour parcourir les résultats ligne par ligne, et la méthode fetch() pour extraire chaque ligne sous forme de tableau associatif*/
        while ($ligne = $result->fetch(PDO::FETCH_NUM)) {
    echo "<tr>";
    echo "<td>" . $ligne[0] . "</td>";
    echo "<td>" . $ligne[1] . "</td>";
    echo "<td>" . $ligne[2] . "</td>";
    echo "<td>" . $ligne[3] . "</td>";
    echo "<td>" . $ligne[4] . "</td>";
    echo "<td><img src='uploads/" . $ligne[5] . "' width='40px' style='border-radius: 80%;'></td>";
    echo "<td><img src='uploads/" . $ligne[6] . "' width='40px' style='border-radius: 80%;'></td>";
    echo "<td>" . $ligne[7] . "</td>";
    echo "<td>" . $ligne[8] . "</td>";

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