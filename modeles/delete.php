<?php  

require("dbConnect.php");
require("dbHandler.php");

$id = $_GET['id'];

if($_GET['option'] == "professeur"){
    $deleteProf = "DELETE FROM enseignants WHERE utilisateur_id = ?; DELETE FROM utilisateurs WHERE utilisateur_id = ?";
    dbSetter($deleteProf,array($id,$id));
    header("Location: ../views/gestProfs.php");
}
elseif($_GET['option'] == "gestionnaire"){
    $deleteProf = "DELETE FROM utilisateurs WHERE utilisateur_id = ?";
    dbSetter($deleteProf,array($id));
    header("Location: ../views/gestGestionnaires.php");
}
elseif($_GET['option'] == "etudiant"){
    $deleteEtudiant = "DELETE FROM inscriptions WHERE etudiant_id = ?;DELETE FROM etudiant WHERE utilisateur_id = ?;DELETE FROM utilisateurs WHERE utilisateur_id = ?";
    dbSetter($deleteEtudiant,array($id,$id,$id));
    header("Location: ../views/gestEtudiants.php");
}
elseif($_GET['option'] == "classe"){
    $deleteClasse = "DELETE FROM `classes` WHERE classe_id = ?";
    dbSetter($deleteClasse,array($id));
    header("Location: ../views/gestEtudiants.php");
}
elseif($_GET['option'] == "disponibilite"){
    $deleteClasse = "DELETE FROM `disponibilites` WHERE id_dispo = ?";
    dbSetter($deleteClasse,array($id));
    header("Location: ../views/disponibiliteProf.php");
}
elseif($_GET['option'] == "module"){
    $deleteModule = "DELETE FROM modules WHERE module_id = ?";
    dbSetter($deleteModule,array($id));
    header("Location: ../views/gestModules.php");
}
elseif($_GET['option'] == "seance"){
    $getSeance = "SELECT * FROM emploisdutemps WHERE emploi_id = ?";
    $seance = dbGetter($getSeance,array($id));

    $deleteSeance = "DELETE FROM emploisdutemps WHERE emploi_id = ?";
    dbSetter($deleteSeance,array($id));

    $updateDispo = "UPDATE `disponibilites` SET `etat`='libre' WHERE utilisateur_id = ? AND jour = ? AND heureDebut = ? AND heureFin = ?";
    dbSetter($updateDispo,array($seance[0]['utilisateur_id'],$seance[0]['jour'],$seance[0]['heure_debut']."h",$seance[0]['heure_fin']."h"));

    header("Location: ../views/emploisDuTempsClasse.php");
}
?>