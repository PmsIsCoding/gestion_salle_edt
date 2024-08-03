<?php 
session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if($_SESSION["logged"] != true){
    header("Location: auth.php");
}
elseif($_SESSION["role"] != "gestionnaire"){
    die("Vous n'avez pas les droits d'accès à cette page !!!");
}

$getSeances ="SELECT * FROM emploisdutemps e,modules m,utilisateurs u WHERE e.module_id = m.module_id and e.classe_id = ? and u.utilisateur_id = m.professeur_id";
$seances = dbGetter( $getSeances,array($_GET['idClasse']));

$getNom = "SELECT nom_classe FROM classes WHERE classe_id = ?";
$nomSalle = dbGetter($getNom,array($_GET['idClasse']));

function checkSeance($jour,$debut,$fin){
    global $seances;
    $node = "";
    foreach($seances as $row) : 
        if($row['jour'] == $jour && $row['heure_debut'] == $debut && $row['heure_fin'] == $fin){
            if($row['salle_id'] == NULL){
                $node = "<div class=\"emploi modaleSrc\" data-id='".$row['emploi_id']."' data-debut=".$debut." data-fin=".$fin." data-jour=".$jour." data-option='Attribution' data-seance=".$row["emploi_id"]."><span class='nom'>".
                    $row['nom_module']."</span><br><span class='prof'>".
                    $row['nom_utilisateur']."</span><br>
                    (En attente de salle)"
                ."</div>";
            }else {
                $getSalle = "SELECT * FROM salles WHERE salle_id = ?";
                $salle = dbGetter($getSalle,array($row["salle_id"]));
                $node = "<div class=\"emploi modaleSrc\" data-id='".$row['emploi_id']."' data-debut=".$debut." data-fin=".$fin." data-jour=".$jour." data-option='Attribution' data-seance=".$row["emploi_id"]."><span class='nom'>".
                    $row['nom_module']."</span><br><span class='prof'>".
                    $row['nom_utilisateur']."</span><br><span class='salle'>".
                    $salle[0]['nom_salle']
                ."</span></div>";
            }
        }
    endforeach;
    echo $node;
}

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
    <style>
        td{
            height: 100px;
        }
        .emploi{
            cursor: pointer;
        }
    </style>
    <title>TimeHub : Espace Gestionnaires de salles</title>
</head>
<body>
    <header>
        <a href="homeGestionnaire.php">
            <div class="logo">
                <img src="assets/logo.svg" alt="logo">
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="gestionSalles.php">Les Salles</a></li>
                <li><a href="emploisDuTempsAllClasses.php">Emplois du temps Classes</a></li>
                <li><a href="emploisDuTempsAllSalles.php">Emplois du temps Salles</a></li>
            </ul>
        </nav>
        <button type="button"class="loSrc">Se deconnecter</button>
    </header>
    <main>
    <main>
        <h1>Emplois du Temps de <span>L3INFO</span></h1>
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
                <td><?php checkSeance("lundi", "8", "11") ?></td>
                <td><?php checkSeance("mardi", "8", "11") ?></td>
                <td><?php checkSeance("mercredi", "8", "11") ?></td>
                <td><?php checkSeance("jeudi", "8", "11") ?></td>
                <td><?php checkSeance("vendredi", "8", "11") ?></td>
                <td><?php checkSeance("samedi", "8", "11") ?></td>
            </tr>
            <tr>
                <td>11h-13h</td>
                <td><?php checkSeance("lundi", "11", "13") ?></td>
                <td><?php checkSeance("mardi", "11", "13") ?></td>
                <td><?php checkSeance("mercredi", "11", "13") ?></td>
                <td><?php checkSeance("jeudi", "11", "13") ?></td>
                <td><?php checkSeance("vendredi", "11", "13") ?></td>
                <td><?php checkSeance("samedi", "11", "13") ?></td>
            </tr>
            <tr>
                <td>15h-17h</td>
                <td><?php checkSeance("lundi", "15", "17") ?></td>
                <td><?php checkSeance("mardi", "15", "17") ?></td>
                <td><?php checkSeance("mercredi", "15", "17") ?></td>
                <td><?php checkSeance("jeudi", "15", "17") ?></td>
                <td><?php checkSeance("vendredi", "15", "17") ?></td>
                <td><?php checkSeance("samedi", "15", "17") ?></td>
            </tr>
        </table>
        <div class="bg-floue"></div>
        <form action="" method="post" class="modaleForm">
            <h3>Attribuer une salle</h3>
            <input style="display:none" name="seance" id="seance" class="seance"/>
            <label for="selectSalle">Salle : </label>
            <select name="selectSalle" id="selectSalle">
            </select><br><br>
            <div class="btns">
                <button type="submit">Soumettre</button>
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
    <script src="js/scriptGestSalle.js"></script>
    <script src="js/scriptModale.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>