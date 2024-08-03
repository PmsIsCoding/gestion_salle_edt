<?php 

    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "professeur"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("dbConnect.php");
    require("dbHandler.php");

    $addDispo = "INSERT INTO `disponibilites`(`utilisateur_id`, `jour`, `heureDebut`, `heureFin`,etat) VALUES (?,?,?,?,'libre')";
    dbSetter($addDispo,array($_SESSION['id'],$_POST['jour'],$_POST['debut'],$_POST['fin']));

    header("Location: ../views/disponibiliteProf.php");
?>