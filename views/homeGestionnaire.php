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

$selectGest = "SELECT * FROM utilisateurs WHERE utilisateur_id = ?";
$gestionnaire = dbGetter($selectGest,array($_SESSION['id']));
// var_dump($gestionnaire);

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
        <button type="button" class="loSrc">Se deconnecter</button>
    </header>
    <main>
        <h1>Espace Gestionnaires</h1>
        <section class="infos">
            <ul>
                <li>Matricule : <span><?php echo $gestionnaire[0]["matricule"]  ?></span></li>
                <li>Nom d'utilisateur : <span><?php echo $_SESSION['username'] ?></span></li>
                <li>Email : <span><?php echo $_SESSION['login'] ?></span></li>
                <li><button type="button" class="btn">Gérer le profil</button></li>
            </ul>
        </section>
        <section class="gestions">
            <div class="items">
                <a href="gestionSalles.php">
                    <div class="gest salles">
                        <img src="assets/salle.png" alt="disponibilite">
                        <p>Les Salles</p>
                    </div>
                </a>
                <a href="emploisDuTempsAllClasses.php">
                    <div class="gest edtClasses">
                        <img src="assets/edts.png" alt="Emploi du temps">
                        <p>Classes</p>
                    </div>
                </a>
                <a href="emploisDuTempsAllSalles.php">
                    <div class="gest edtSalles">
                        <img src="assets/edts.png" alt="Cours">
                        <p>Salles</p>
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