<?php
// Démarre la session
session_start();
// Réinitialise toutes les variables de session
$_SESSION = array();
// Détruit la session
session_destroy();
// Redirige vers la page Login_marq.html
header("Location: Login_marq.html");
?>