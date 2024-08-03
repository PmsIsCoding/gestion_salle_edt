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

$getSalles = "SELECT * FROM salles";
$salles = dbGetter($getSalles,array());
// var_dump($salles);

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
        <h1>Gestion des <span>Salles</span></h1>
        <button type="button" class="addSalle bg-principal btn-add modaleSrc" data-option="Salle">+ Ajouter une salle</button>
        <section class="salles">
            <?php foreach($salles as $row) : ?>
                <div class="gest">
                    <h2><?php echo $row['nom_salle'] ?></h2>
                    <h3><?php echo $row['capacite'] ?> personnes</h3>
                </div>
            <?php endforeach; ?>
        </section>
        <div class="bg-floue"></div>
        <form action="" method="post" class="modaleForm">
            <h3>Informations Salle</h3>
            <label for="nomSalle">Nom de la salle</label>
            <input type="text" name="nomSalle" id="nomSalle"><br>
            <label for="capacite">Capacité de la salle</label>
            <input type="number" name="capacite" id="capacite"><br><br>
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
    <script src="js/scriptModale.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>