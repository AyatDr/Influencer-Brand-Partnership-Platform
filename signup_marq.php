<?php
// inclure le fichier de connexion à la base de données
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // récupérer les valeurs soumises du formulaire
    $Login = $_POST['Login'] ?? '';
    $brandN = $_POST['BrandN'] ?? '';
    $brandL = $_FILES['BrandL']['name'] ?? '';
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["BrandL"]["name"]);
    $brandT = $_POST['BrandT'] ?? '';
    $brandA = $_POST['area'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Vérifier si le mot de passe et la confirmation de mot de passe sont identiques
    if ($password !== $confirm_password) {
        echo "Error: Password and Confirm Password do not match.";
        exit;
    }

    // crypter le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si le Login est unique
    $sql_login_check = "SELECT Login FROM brand WHERE Login = ?";
    $stmt_login_check = $pdo->prepare($sql_login_check);
    $stmt_login_check->execute([$Login]);
    $result_login_check = $stmt_login_check->fetch(PDO::FETCH_ASSOC);

    if ($result_login_check) {
        echo "<div style='text-align:center;font-size:40px;margin-top:200px;'>Error: Username already exists.</div>";
       echo "<style> body { background-color: #84abc2; } </style>";
        exit;
    }

    // préparer et exécuter la requête SQL pour insérer les données dans la table influencer
    $sql = "INSERT INTO brand (Login, Brand_Name, Brand_Logo, Brand_Turnover, Business_area, Password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([ $Login, $brandN, $brandL, $brandT, $brandA , $hashed_password]);

    // vérifier si l'insertion a réussi et télécharger le fichier de la photo de profil dans le répertoire cible
    if ($stmt) {
        echo "User information stored successfully.";
        move_uploaded_file($_FILES["BrandL"]["tmp_name"], $target_file);
        header('Location: Login_marq.html'); // remplacer accueil.php par la page de redirection souhaitée
            exit;
    } else {
        echo "Error: " . $sql . "<br>" . $pdo->error;
    }
}
?>