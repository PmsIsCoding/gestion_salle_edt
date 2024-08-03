<?php
    session_start();

    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");

    $addModule = "UPDATE `modules` SET `nom_module`=?,`volume_horaire`=?,`volume_fait`=?,`professeur_id`= ?WHERE module_id = ?";

    dbSetter($addModule,array($_POST["nomModule"],$_POST["volumeTotal"],$_POST["volumeFait"],$_POST["professeur_responsable_id"],$_POST["id"]));

    header("Location: ../views/gestModules.php")
?>