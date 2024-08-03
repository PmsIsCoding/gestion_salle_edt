<?php
session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if ($_SESSION["logged"] != true) {
    header("Location: auth.php");
    exit;
} elseif ($_SESSION["role"] != "administrateur") {
    die("Vous n'avez pas les droits d'accès à cette page !!!");
}

$classe_id = $_POST["classe_id"];
$nom_classe = $_POST["nom_classe"];
$professeur_responsable_id = $_POST["professeur_responsable_id"];


$update = "UPDATE classes SET nom_classe = ?, professeur_responsable_id = ? WHERE classe_id = ?";
$params = array($nom_classe, $professeur_responsable_id, $classe_id);

$result = dbSetter($update, $params);

header("Location: ../views/gestClasses.php");

?>