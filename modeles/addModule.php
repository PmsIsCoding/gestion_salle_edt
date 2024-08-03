<?php
    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "professeur"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");

    $addModule = "INSERT INTO `modules`(`nom_module`, `volume_horaire`, `classe_id`, `volume_fait`, `professeur_id`) VALUES (?,?,?,0,?)";

    dbSetter($addModule,array($_POST["nomModule"],$_POST["volumeTotal"],$_POST["idClasse"],$_POST["professeur_responsable_id"]));

    header("Location: ../views/gestModules.php")
?>