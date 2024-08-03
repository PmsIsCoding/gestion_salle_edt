<?php 
    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "gestionnaire"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("dbConnect.php");
    require("dbHandler.php");

    $addDispo = "INSERT INTO `salles`(`nom_salle`, `capacite`) VALUES (?,?)";
    dbSetter($addDispo,array($_POST['nomSalle'],$_POST['capacite']));

    header("Location: ../views/gestionSalles.php");
?>