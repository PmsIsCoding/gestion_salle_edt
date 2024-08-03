<?php session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if($_SESSION["logged"] != true){
    header("Location: auth.php");
}
elseif($_SESSION["role"] != "etudiant"){
    die("Vous n'avez pas les droits d'accès à cette page !!!");
}

$getClasse = "SELECT * FROM utilisateurs u JOIN inscriptions i WHERE u.utilisateur_id = i.etudiant_id AND u.utilisateur_id = ?";
$classe = dbGetter($getClasse,array($_SESSION['id']));

$id_classe = $classe[0]['classe_id'];

$getSeances = "SELECT * FROM emploisdutemps e,utilisateurs u,modules m,salles s WHERE e.classe_id = ? AND e.utilisateur_id = u.utilisateur_id AND e.module_id = m.module_id AND e.salle_id = s.salle_id ";
$seances = dbGetter($getSeances,array($id_classe));

// var_dump($seances);

function checkSeance($jour,$debut,$fin){
    global $seances;

    $node = "";

    foreach($seances as $row){
        if($row['jour'] == $jour && $row['heure_debut'] == $debut && $row['heure_fin'] == $fin){
            $node = "
            <div>
                <span class='cours'>".$row['nom_module']."</span><br/>
                <span class='prof'>".$row['nom_utilisateur']."</span><br/>
                <span class='salle'>".$row['nom_salle']."</span><br/>
            </div>";
        }
    }
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
    <link rel="stylesheet" href="css/styleHome.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/styleHomeEtudiant.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Espace Admin</title>
</head>
<body>
    <header>
        <a href="homeEtudiant.php">
            <div class="logo">
                <img src="assets/logo.svg" alt="logo">
            </div>
        </a>
        <button type="button" class="loSrc">Se deconnecter</button>
    </header>
    <main>
        <h1>Votre emplois du temps</h1>
        <section class="infos">
            <ul>
                <li>Nom d'utilisateur : <span><?php echo $_SESSION['username'] ?></span></li>
                <li>Email : <span><?php echo $_SESSION['login'] ?></span></li>
                <li><button type="button" class="btn">Gérer le profil</button></li>
            </ul>
        </section>
        <section class="edt">
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
        </section>
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
    <script src="js/scriptLogOut.js"></script>
</body>
</html>