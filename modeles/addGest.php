<?php 

    session_start();

    if($_SESSION["logged"] != true){
        header("Location: auth.php");
    }
    elseif($_SESSION["role"] != "administrateur"){
        die("Vous n'avez pas les droits d'accès à cette page !!!");
    }

    require("dbConnect.php");
    require("dbHandler.php");

    $matricule = $_POST['matricule'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];

    $insertUtilisateur = "INSERT INTO `utilisateurs`(`matricule`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`) VALUES (?,?,'UCAD2024',?,'gestionnaire')";
    dbSetter($insertUtilisateur,array($matricule,$userName,$email));

    header("Location: ../views/gestGestionnaires.php")
?>
