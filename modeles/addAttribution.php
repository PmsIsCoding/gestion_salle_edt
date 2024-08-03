<?php

    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "gestionnaire"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");

    $updateSalle = "UPDATE `emploisdutemps` SET `salle_id`= ? WHERE emploi_id = ?";
    dbSetter($updateSalle,array($_POST['selectSalle'],$_POST['seance']));
    
    $referer = $_SERVER['HTTP_REFERER'];

    header("Location: $referer")
?>