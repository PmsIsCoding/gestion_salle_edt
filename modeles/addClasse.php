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

    $name = $_POST["nom_classe"];
    $responsable = $_POST["professeur_responsable_id"];

    $addProf = "INSERT INTO `classes`(`nom_classe`, `professeur_responsable_id`) VALUES (?,?)";

    $stmt = $bd->prepare($addProf);

    $stmt->execute(array($name,$responsable));

    header("Location: ../views/gestClasses.php")

?>