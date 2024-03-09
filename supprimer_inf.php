<?php
include 'connexion.php';
$id= $_GET['id'];

$statement1 = $pdo->prepare( " DELETE FROM influencer where id_inf=$id");
$statement1->execute();
$statement2 = $pdo->prepare( " DELETE FROM demande_suppression_inf where id_inf=$id");
$statement2->execute();

header('location:demande_Supp.php');

?>