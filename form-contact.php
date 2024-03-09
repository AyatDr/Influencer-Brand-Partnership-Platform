
<?php
// inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    // récupérer les valeurs soumises du formulaire
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
   
    $message = $_POST['message'] ?? '';
     
    $sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";
    //préparer une requête SQL d'insertion
    $stmt= $pdo->prepare($sql);
     //exécute la requête SQL en passant les valeurs à la méthode execute() du statement PDO
    $stmt->execute([$name, $email,  $subject , $message ]);
    if ($stmt) {
        echo "User information stored successfully.";
      
        header("Location:contact.html"); 
        exit;

    } else {
        echo "Error: " . $sql . "<br>" . $pdo->error;
    }

 ?>