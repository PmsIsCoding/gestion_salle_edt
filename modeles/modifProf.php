<?php 
    require("dbConnect.php");
    require("dbHandler.php");

    $id = $_POST['id'];
    $matricule = $_POST['matricule'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $specialite = $_POST['specialite'];

    $insertUtilisateur = "UPDATE `utilisateurs` SET `matricule`=?,`nom_utilisateur`=?,`email`=? WHERE utilisateur_id = ?";
    dbSetter($insertUtilisateur,array($matricule,$userName,$email,$id));

    $insertProf = "UPDATE `enseignants` SET `specialite`=? WHERE utilisateur_id = ?";
    dbSetter($insertProf,array($specialite,$id));

    header("Location: ../views/gestProfs.php")
?>
