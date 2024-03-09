<?php
    /* La fonction PDO prend en paramètres l'hôte, le port, le nom de la base de données, le nom d'utilisateur et le mot de passe pour se connecter à la base de données.*/
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Vérifier si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises par l'utilisateur
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Préparer la requête SQL pour rechercher un utilisateur avec le nom d'utilisateur et le mot de passe fournis
    $stmt = $pdo->prepare("SELECT * FROM administrateur WHERE Username = ? AND Password = ?");
    $stmt->execute([$username, $password]);
    // Récupérer le résultat de la requête sous forme de tableau associatif
    $user = $stmt->fetch();
    
    if ($user) {
        // utilisateur trouvé, vous pouvez maintenant stocker les informations de l'utilisateur dans une session ou les utiliser pour l'authentification
        // Démarrer une session PHP pour stocker les données de l'utilisateur
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['Name'];
     
        
        // Rediriger l'utilisateur vers la page d'espace admin après l'authentification
        header('Location: espace_admin.php'); 
        exit;
    } else {

       // utilisateur non trouvé ou mauvais mot de passe
        echo "<div style='text-align:center;font-size:40px;margin-top:200px;'>Error: Invalid username or password</div>";
       echo "<style> body { background-color: #84abc2; } </style>";
    }

}
?>

