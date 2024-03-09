<?php
// inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // récupérer les valeurs soumises du formulaire
    $brand = $_POST['Brand'] ?? '';
    $influencer = $_POST['influencer'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $terme = $_POST['terme'] ?? '';
    $brand_login = $_POST['brand_login'] ?? '';
    $influencer_login = $_POST['influencer_login'] ?? '';
    $signature_inf = $_FILES['Signe']['name'] ?? '';
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["Signe"]["name"]);

    $signature_brand= $_FILES['Signe_brand']['name'] ?? '';
    $target_dire = "uploads/";
    $target_filee = $target_dire . basename($_FILES["Signe_brand"]["name"]);

   // préparer et exécuter la requête SQL pour insérer les données dans la table partenariat
$sql = "INSERT INTO partenariat (Brand, Influencer, amount, duration,Terme,Signature_inf,Signature_Brand,Brand_Login,Influencer_Login) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$brand, $influencer, $amount, $duration ,$terme,$signature_inf,$signature_brand,$brand_login,$influencer_login]);


    // vérifier si l'insertion a réussi et télécharger le fichier de la photo de profil dans le répertoire cible
    if ($stmt) {
        echo "User information stored successfully.";
        move_uploaded_file($_FILES["Signe"]["tmp_name"], $target_file);
        move_uploaded_file($_FILES["Signe_brand"]["tmp_name"], $target_filee);
        header('Location: espace_br.php'); // remplacer accueil.php par la page de redirection souhaitée
        exit;

    } else {
        echo "Error: " . $sql . "<br>" . $pdo->error;
    }
}
?>

