<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dataproject", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database.<br>";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
