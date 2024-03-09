<?php
include 'connexion.php';
$id= $_GET['id'];

$statement1 = $pdo->prepare( " DELETE FROM brand where id_br=$id");
$statement1->execute();
$statement2 = $pdo->prepare( " DELETE FROM  demande_suppression_br where id_br=$id");
$statement2->execute();


header('location:demande_Supp.php');

?>