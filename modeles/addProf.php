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
    $specialite = $_POST['specialite'];

    $insertUtilisateur = "INSERT INTO `utilisateurs`(`matricule`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`) VALUES (?,?,'UCAD2024',?,'professeur')";
    dbSetter($insertUtilisateur,array($matricule,$userName,$email));

    $lastId = $bd->lastInsertId();

    $insertProf = "INSERT INTO `enseignants`(`utilisateur_id`, `specialite`) VALUES (?,?)";
    dbSetter($insertProf,array($lastId,$specialite));

    header("Location: ../views/gestProfs.php")
?>
