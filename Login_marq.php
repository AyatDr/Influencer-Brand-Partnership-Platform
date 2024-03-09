<?php

    /* La fonction PDO prend en paramètres l'hôte, le port, le nom de la base de données, le nom d'utilisateur et le mot de passe pour se connecter à la base de données.*/
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     /* vérifie si la méthode de requête HTTP est POST, ce qui signifie qu'un formulaire a été soumis*/
    /* récupère le nom d'utilisateur et le mot de passe soumis dans le formulaire à l'aide de $_POST*/
    $username = $_POST['username'];
    $password = $_POST['password_plain'];
    /* requête SQL préparée est exécutée pour récupérer l'utilisateur correspondant au nom d'utilisateur fourni*/
    $stmt = $pdo->prepare("SELECT * FROM brand WHERE Login = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['Password'])) {
        // utilisateur trouvé et mot de passe correct
        // une session est démarrée pour stocker les informations de l'utilisateur
        session_start();
        $_SESSION['user_id'] = $user['id_br'];
        $_SESSION['user_name'] = $user['Login'];
        
        header('Location: espace_br.php'); // en utilisant la fonction header() de PHP faire la redirection vers autre page
        exit;
    } else {
        // utilisateur non trouvé ou mauvais mot de passe
    echo "<div style='text-align:center;font-size:40px;margin-top:200px;'>Error: Invalid username or password</div>";
       echo "<style> body { background-color: #84abc2; } </style>";
    }
}
?>
