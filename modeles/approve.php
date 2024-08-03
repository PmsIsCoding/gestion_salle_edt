<?php 

    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "administrateur"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("dbConnect.php");
    require("dbHandler.php");

    $id = $_GET['id'];
    $updateStatut = "UPDATE `inscriptions` SET `statut`='Approuvée' WHERE etudiant_id = ?";
    dbSetter($updateStatut,array($id))
?>