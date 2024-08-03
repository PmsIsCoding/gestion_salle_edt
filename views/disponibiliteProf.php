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

    $getDispos = "SELECT * FROM disponibilites WHERE utilisateur_id = ? AND etat='libre'";
    $dispos = dbGetter($getDispos,array($_SESSION['id']));
    function checkDispo($jour,$debut,$fin){
        global $dispos;
        $node = "<div class=\"img addDispo modaleSrc\" data-jour=\"".$jour."\" data-debut=\"".$debut."\" data-fin=\"".$fin."\" data-option=\"Dispo\"><img src=\"assets/annuler.png\" alt=\"annuler\"></div>";
        foreach($dispos as $row){
            if($row['jour'] == $jour && $row['heureDebut'] == $debut && $row['heureFin'] == $fin){
                $node = "<div class=\"img delSrc delete\" data-id=\"".$row["id_dispo"]."\" data-option=\"disponibilite\"><img src=\"assets/disponible.png\" alt=\"disponible\"></div>";
            }
        }
        echo $node;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontImport.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styleHeader.css">
    <link rel="stylesheet" href="css/styleMain.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/styleDispo.css">
    <style>
        .modaleForm{
            height: 30vh;
        }
        td{
            height: 150px;
        }
    </style>
    <title>Espace enseignants : Votre disponibilite</title>
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
                <li><a href="emploisDuTemps.php">Emplois du temps</a></li>
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
    <table>
        <tr>
            <th class="bg-principal">Heure</th>
            <th class="bg-principal">Lundi</th>
            <th class="bg-principal">Mardi</th>
            <th class="bg-principal">Mercredi</th>
            <th class="bg-principal">Jeudi</th>
            <th class="bg-principal">Vendredi</th>
            <th class="bg-principal">Samedi</th>
        </tr>
        <tr>
            <td>8h-11h</td>
            <td><?php checkDispo("lundi", "8h", "11h") ?></td>
            <td><?php checkDispo("mardi", "8h", "11h") ?></td>
            <td><?php checkDispo("mercredi", "8h", "11h") ?></td>
            <td><?php checkDispo("jeudi", "8h", "11h") ?></td>
            <td><?php checkDispo("vendredi", "8h", "11h") ?></td>
            <td><?php checkDispo("samedi", "8h", "11h") ?></td>
        </tr>
        <tr>
            <td>11h-13h</td>
            <td><?php checkDispo("lundi", "11h", "13h") ?></td>
            <td><?php checkDispo("mardi", "11h", "13h") ?></td>
            <td><?php checkDispo("mercredi", "11h", "13h") ?></td>
            <td><?php checkDispo("jeudi", "11h", "13h") ?></td>
            <td><?php checkDispo("vendredi", "11h", "13h") ?></td>
            <td><?php checkDispo("samedi", "11h", "13h") ?></td>
        </tr>
        <tr>
            <td>15h-17h</td>
            <td><?php checkDispo("lundi", "15h", "17h") ?></td>
            <td><?php checkDispo("mardi", "15h", "17h") ?></td>
            <td><?php checkDispo("mercredi", "15h", "17h") ?></td>
            <td><?php checkDispo("jeudi", "15h", "17h") ?></td>
            <td><?php checkDispo("vendredi", "15h", "17h") ?></td>
            <td><?php checkDispo("samedi", "15h", "17h") ?></td>
        </tr>
    </table>
    <div class="bg-floue"></div>
    <div class="modaleDel">
        <h3>Voulez vous vraiment supprimer cette disponibilité ?</h3>
        <div class="btns">
            <a href=""><button type="button" class="btn-conf">Oui</button></a>
            <button type="button" class="btn-ann">Annuler</button>
        </div>
    </div>
    <form class="modaleForm" action="../modeles/addDispo.php" method="POST">
        <h3>Ajuoter cette disponibilité ?</h3>
        <input type="hidden" name="jour" id="jour">
        <input type="hidden" name="debut" id="debut">
        <input type="hidden" name="fin" id="fin">
        <div class="btns">
            <button type="submit" class="btn-conf">Oui</button>
            <button type="button" class="btn-ann">Annuler</button>
        </div>
    </form>
    <div class="confLogOut">
        <h3>Voulez-vous vraiment vous déconnecter ?</h3>
        <div class="btns">
            <a href="../modeles/logout.php"><button type="submit" class="btn-conf">Oui</button></a>
            <button type="button" class="btn-ann loAnn">Annuler</button>
        </div>
    </div>
    </main>
    <script src="js/jquery.js"></script> 
    <script src="js/scriptModale.js"></script>
    <script src="js/scriptDelete.js"></script>
    <script src="js/scriptDispoProf.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>