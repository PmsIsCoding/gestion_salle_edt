<?php 
    require("dbConnect.php");
    require("dbHandler.php");

    $id = $_GET['id'];
    $updateStatut = "UPDATE `inscriptions` SET `statut`='Refusée' WHERE etudiant_id = ?";
    dbSetter($updateStatut,array($id))
?>