<?php 
session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if($_SESSION["logged"] != true){
    header("Location: auth.php");
}
elseif($_SESSION["role"] != "professeur"){
    die("Vous n'avez pas les droits d'accès à cette page !!!");
}

$checkResp = "SELECT * FROM utilisateurs JOIN classes on utilisateurs.utilisateur_id = classes.professeur_responsable_id WHERE classes.professeur_responsable_id = ?";
$check = dbGetter($checkResp,array($_SESSION['id']));

$selectModule = "SELECT * FROM modules m JOIN classes c ON m.classe_id = c.classe_id WHERE professeur_id = ?";
$modules = dbGetter($selectModule,array($_SESSION['id']));
// var_dump($modules);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontImport.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styleHeader.css">
    <link rel="stylesheet" href="css/styleMain.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Espace Professeur</title>
    <style>
        td{
            font-size: 15px;
        }
        .module{
            font-weight: bold;
        }
        .classe{
            color: red;
            font-weight: bold;
        }
        .moins,.plus{
            color: black;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            margin-right: 10px;
        }
        .vfait{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <a href="homeProf.php">
            <div class="logo">
                <img src="assets/logo.svg" alt="logo">
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="disponibiliteProf.php">Ma disponibilite</a></li>
                <li><a href="emploisDuTemps.php">Mon emplois du temps</a></li>
                <li><a href="mesCours.php">Mes Cours</a></li>
                <li>
                    <?php if(!empty($check)) : ?>
                        <a href="maClasse.php">Ma classe</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <button type="button" class="loSrc">Se deconnecter</button>
    </header>
    <main>
        <h1>Vos <span>Cours</span></h1>
        <table>
            <?php foreach($modules as $row) : ?>
                <tr>
                    <td class="module"><?php echo $row['nom_module'] ?></td>
                    <td class="vafaire"><?php echo $row['volume_horaire'] ?>h à faire</td>
                    <td class="classe"><?php echo $row['nom_classe'] ?></td>
                    <td>
                        <div class="volume_fait">
                            <span class="moins" data-module="<?php echo $row['module_id'] ?>">-</span>

                            <span class="vfait"><?php echo $row['volume_fait'] ?></span>h

                            <span class="plus" data-module="<?php echo $row['module_id'] ?>">+</span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="bg-floue"></div>
        <div class="confLogOut">
            <h3>Voulez-vous vraiment vous déconnecter ?</h3>
            <div class="btns">
                <a href="../modeles/logout.php"><button type="submit" class="btn-conf">Oui</button></a>
                <button type="button" class="btn-ann loAnn">Annuler</button>
            </div>
        </div>
    </main>
    <script src="js/jquery.js"></script>
   <script src="js/scriptModules.js"></script>
   <script src="js/scriptLogOut.js"></script>
</body>