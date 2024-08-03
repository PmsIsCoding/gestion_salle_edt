<?php
    session_start();

    require("dbConnect.php");
    require("dbHandler.php");

    $login = $_POST['login'];
    $password = $_POST['password'];

    $array = array($login,$password);
    $sql = "SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
    $result = dbGetter($sql,$array);
    if(!empty($result)){
        $_SESSION['logged'] = true;
        $_SESSION['role'] = $result[0]['role'];
        $_SESSION['username'] = $result[0]['nom_utilisateur'];
        $_SESSION['login'] = $result[0]['email'];
        $_SESSION['id'] = $result[0]['utilisateur_id'];
        switch ($_SESSION['role']) {
            case 'etudiant':

                $getEtudiant = "SELECT * FROM utilisateurs JOIN inscriptions ON utilisateurs.utilisateur_id = inscriptions.etudiant_id WHERE inscriptions.etudiant_id = ?";
                $result = dbGetter($getEtudiant,array($_SESSION['id']));
                if($result[0]["statut"] == "En attente") 
                    header("Location: ../views/attente.php");
                elseif($result[0]["statut"] == "Refusée") 
                    header("Location: ../views/refus.php");
                else 
                    header("Location: ../views/homeEtudiant.php");
                break;

            case 'professeur':
                header("Location: ../views/homeProf.php");
                break;
            case 'administrateur':
                header("Location: ../views/homeAdmin.php");
                break;
            case 'gestionnaire':
                header("Location: ../views/homeGestionnaire.php");
                break;
            default:
                echo "Rôle inconnu!";
        }
    }
    else{
        $_SESSION['logged'] = false;
        header("Location: ../views/auth.php?error=1");
    }
?>