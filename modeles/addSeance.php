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

    $setSeance = "INSERT INTO `emploisdutemps`(`classe_id`, `module_id`, `utilisateur_id`, `heure_debut`, `heure_fin`, `jour`) VALUES (?,?,?,?,?,?)";   
    dbSetter($setSeance,array($_POST['idClasse'],$_POST['module'],$_POST['professeur'],$_POST['debut'],$_POST['fin'],$_POST['jour']));

    $updateDispo = "UPDATE `disponibilites` SET `etat`= 'pris' WHERE jour = ? AND heureDebut = ? AND heureFin = ? AND utilisateur_id = ?";
    dbSetter($updateDispo,array($_POST['jour'],$_POST['debut']."h",$_POST['fin']."h",$_POST['professeur']));

    header("Location: ../views/emploisDuTempsClasse.php");
?>