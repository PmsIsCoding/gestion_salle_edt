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

    // var_dump($check);

    $getSeances ="SELECT * FROM emploisdutemps e,modules m,utilisateurs u WHERE e.module_id = m.module_id and e.classe_id = ? and u.utilisateur_id = m.professeur_id";
    $allSeances = dbGetter( $getSeances,array($check[0]['classe_id']));

    function checkSeance($jour,$debut,$fin){
        global $allSeances;
        global $check;
        $node = "<div class=\"img modaleSrc addSeance\" data-jour=\"".$jour."\" data-debut=\"".$debut."\" data-fin=\"".$fin."\" data-option=\"Seance\" data-classe=".$check[0]["classe_id"]."><img src=\"assets/click.png\" alt=\"Click \"></div>";
        foreach($allSeances as $row) : 
            if($row['jour'] == $jour && $row['heure_debut'] == $debut && $row['heure_fin'] == $fin){
                if($row['salle_id'] == NULL){
                    $node = "<div class=\"seance delSrc delete\" data-id='".$row['emploi_id']."' data-option='seance'><span class='nom'>".
                        $row['nom_module']."</span><br><span class='prof'>".
                        $row['nom_utilisateur']."</span><br>
                        (En attente de salle)"
                    ."</div>";
                }else {
                    $getSalle = "SELECT * FROM salles WHERE salle_id = ?";
                    $salle = dbGetter($getSalle,array($row["salle_id"]));
                    $node = "<div class=\"seance delSrc delete\" data-id='".$row['emploi_id']."'><span class='nom'>".
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

<div class="seance"></div>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontImport.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styleHeader.css">
    <link rel="stylesheet" href="css/styleMain.css">
    <link rel="stylesheet" href="css/styleEDTClasse.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/styleDispo.css">
    <title>Espace enseignants : Emplois du temps de votre classe</title>
    <style>
        .prof{
            color: red !important;
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
        <h1>Emplois du Temps de <span>votre Classe</span></h1>
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
    <div class="modaleDel">
        <h3>Voulez vous vraiment supprimer cette séance ?</h3>
        <div class="btns">
            <a href=""><button type="button" class="btn-conf">Oui</button></a>
            <button type="button" class="btn-ann">Annuler</button>
        </div>
    </div>
    <form class="modaleForm" action="" method="POST">
        <h3>Ajoutez un cours ?</h3>
        <input type="hidden" name="idClasse" id="idClasse">
        <input type="hidden" name="jour" id="jour">
        <input type="hidden" name="debut" id="debut">
        <input type="hidden" name="fin" id="fin">
        <input type="hidden" name="professeur" id="professeur">
        <label for="module">Module</label>
        <select name="module" id="module" required ></select><br>
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
    <script src="js/scriptEDTClasse.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>