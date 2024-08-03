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

$getClasses = "SELECT * FROM classes c JOIN utilisateurs u ON c.professeur_responsable_id = u.utilisateur_id";
$classes = dbGetter($getClasses,array());

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
        <h1>Toutes les classes</h1>
        <section class="salles">
            <?php foreach($classes as $row) : ?>
                <a href="EDT.php?idClasse=<?php echo $row['classe_id'] ?>">
                <div class="gest">
                    <h2><?php echo $row['nom_classe'] ?></h2>
                    <h5>Professeur responsable : <br><?php echo $row['nom_utilisateur'] ?></h5>
                </div>
                </a>
            <?php endforeach; ?>
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
    <script src="js/scriptModale.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>