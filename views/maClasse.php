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
$selectSpe = "SELECT * FROM enseignants JOIN utilisateurs ON utilisateurs.utilisateur_id = enseignants.utilisateur_id WHERE enseignants.utilisateur_id = ?";
$prof = dbGetter($selectSpe,array($_SESSION['id']));
$spe = $prof[0]["specialite"];

$checkResp = "SELECT * FROM utilisateurs JOIN classes on utilisateurs.utilisateur_id = classes.professeur_responsable_id WHERE classes.professeur_responsable_id = ?";
$check = dbGetter($checkResp,array($_SESSION['id']));
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
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Espace Professeur</title>
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
        <h1>Professeur Responsable</h1>
        <section class="infos">
            <ul>
                <li>Matricule : <span><?php echo $prof[0]["matricule"]  ?></span></li>
                <li>Nom d'utilisateur : <span><?php echo $_SESSION['username'] ?></span></li>
                <li>Email : <span><?php echo $_SESSION['login'] ?></span></li>
                <li>Specialite : <span><?php echo $spe ?></span></li>
                <li><button type="button" class="btn">Gérer le profil</button></li>
            </ul>
        </section>
        <section class="gestions">
            <div class="items">
                <a href="gestModules.php">
                    <div class="gest modules">
                        <img src="assets/module.png" alt="disponibilite">
                        <p>Modules</p>
                    </div>
                </a>
                <a href="emploisDuTempsClasse.php">
                    <div class="gest edtClasse">
                        <img src="assets/edts.png" alt="Emploi du temps">
                        <p>Emplois du Temps</p>
                    </div>
                </a>
                <a href="mesEtudiants.php">
                    <div class="gest etudiants">
                        <img src="assets/etudiant.png" alt="Cours">
                        <p>Etudiants</p>
                    </div>
                </a>
            </div>
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