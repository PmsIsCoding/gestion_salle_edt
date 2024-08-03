<?php 

require("dbConnect.php");
require("dbHandler.php");

$username = $_POST['username'];
$emailInst = $_POST['emailInst'];
$numCarte = $_POST['numCarte'];
$telephone = $_POST["telephone"];
$adresse = $_POST["adresse"];
$sexe = $_POST["sexe"];
$password = $_POST["password"];
$idClasse = $_POST["classe"];

$insertUtilisateur = "INSERT INTO `utilisateurs`(`matricule`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`) VALUES (?,?,?,?,'etudiant')";
dbSetter($insertUtilisateur,array($numCarte,$username,$password,$emailInst));

$lastId = $bd->lastInsertId();

$insertEtudiant = "INSERT INTO `etudiant`(`utilisateur_id`, `telephone`, `adresse`, `sexe`) VALUES (?,?,?,?)";
dbSetter($insertEtudiant,array($lastId,$telephone,$adresse,$sexe));

$insertDmd = "INSERT INTO `inscriptions`(`etudiant_id`, `classe_id`) VALUES (?,?)";
dbSetter($insertDmd,array($lastId,$idClasse));

header("Location: ../views/attente.php")

?>