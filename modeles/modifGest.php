<?php 
    require("dbConnect.php");
    require("dbHandler.php");

    $id = $_POST['id'];
    $matricule = $_POST['matricule'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];

    $insertUtilisateur = "UPDATE `utilisateurs` SET `matricule`=?,`nom_utilisateur`=?,`email`=? WHERE utilisateur_id = ?";
    dbSetter($insertUtilisateur,array($matricule,$userName,$email,$id));

    header("Location: ../views/gestGestionnaires.php")
?>
