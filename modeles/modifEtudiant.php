<?php
    require("dbConnect.php");
    require("dbHandler.php");

    $username = $_POST['username'];
    $emailInst = $_POST['emailInst'];
    $numCarte = $_POST['numCarte'];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];
    $sexe = $_POST["sexe"];
    $id = $_POST["id"];
    $idClasse = $_POST["classe"];

    // echo $sexe

    $updateUser = "UPDATE `utilisateurs` SET `matricule`=?,`nom_utilisateur`=?,`email`= ? WHERE utilisateur_id = ?";
    dbSetter($updateUser,array($numCarte,$username,$emailInst,$id));

    $updateEtudiant = "UPDATE `etudiant` SET `telephone`=?,`adresse`=?,`sexe`=? WHERE utilisateur_id = ?";
    dbSetter($updateEtudiant,array($telephone,$adresse,$sexe,$id));

    if($_POST['src'] == "prof"){
        header("Location: ../views/mesEtudiants.php");
    }
    else {
        header("Location: ../views/gestEtudiants.php");
    }
    
?>