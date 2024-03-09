

<?php

// inclure le fichier de connexion à la base de données
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // récupérer les valeurs soumises du formulaire
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $social_media = $_POST['social_media'] ?? '';
    $age = $_POST['age'] ?? '';
    $profile_pic = $_FILES['profile_picture']['name'] ?? '';
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

    // Vérifier si le mot de passe et la confirmation de mot de passe sont identiques
    if ($password !== $confirm_password) {
        echo "Error: Password and Confirm Password do not match.";
        exit;
    }

    // crypter le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // vérifier si le nom d'utilisateur est déjà utilisé
    $sql_check_username = "SELECT * FROM influencer WHERE Username = ?";
    $stmt_check_username = $pdo->prepare($sql_check_username);
    $stmt_check_username->execute([$username]);
    $user = $stmt_check_username->fetch();

    if ($user) {
        /* Si un utilisateur avec le même nom d'utilisateur est trouvé, le code affiche un message d'erreur indiquant que le nom d'utilisateur existe déjà*/ 
  echo "<div style='text-align:center;font-size:40px;margin-top:200px;'>Error: Username already exists.</div>";
  echo "<style> body { background-color: #84abc2; } </style>";
   exit;
}



    // préparer et exécuter la requête SQL pour insérer les données dans la table influencer
    $sql = "INSERT INTO influencer (Name, Username, Password, Media, Age, Profile_pic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$name, $username, $hashed_password, $social_media, $age, $profile_pic]);

    // vérifier si l'insertion a réussi et télécharger le fichier de la photo de profil dans le répertoire cible
    if ($stmt) {
        echo "User information stored successfully.";
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        header('Location: Login_inf.html'); // remplacer accueil.php par la page de redirection souhaitée
        exit;

    } else {
        echo "Error: " . $sql . "<br>" . $pdo->error;
    }
}

?>
