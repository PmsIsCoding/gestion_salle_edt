<?php session_start();

if($_SESSION["logged"] != true){
    header("Location: auth.php");
}
elseif($_SESSION["role"] != "administrateur"){
    die("Vous n'avez pas les droits d'accès à cette page !!!");
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
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Espace Admin</title>
</head>
<body>
    <header>
        <a href="homeAdmin.php">
            <div class="logo">
                <img src="assets/logo.svg" alt="logo">
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="gestEtudiants.php">Etudiants</a></li>
                <li><a href="gestClasses.php">Classes</a></li>
                <li><a href="gestProfs.php">Enseignants</a></li>
                <li><a href="gestGestionnaires.php">Gestionnaires</a></li>
            </ul>
        </nav>
        <button type="button" class="loSrc">Se deconnecter</button>
    </header>
    <main>
        <section class="infos">
            <ul>
                <li>Nom d'utilisateur : <span><?php echo $_SESSION['username'] ?></span></li>
                <li>Email : <span><?php echo $_SESSION['login'] ?></span></li>
                <li><button type="button" class="btn">Gérer le profil</button></li>
            </ul>
        </section>
        <section class="gestions">
            <div class="items">
                <a href="gestEtudiants.php">
                    <div class="gest gestEtudiants">
                        <img src="assets/etudiant.png" alt="etudiant">
                        <p>Etudiants</p>
                    </div>
                </a>
                <a href="gestClasses.php">
                    <div class="gest gestClasses">
                        <img src="assets/classe.png" alt="classe">
                        <p>Classes</p>
                    </div>
                </a>
                <a href="gestProfs.php">
                    <div class="gest gestEnseignants">
                        <img src="assets/enseignant.png" alt="enseignant">
                        <p>Enseignants</p>
                    </div>
                </a>
                <a href="gestGestionnaires.php">
                    <div class="gest gestSalles">
                        <img src="assets/salle.png" alt="salle">
                        <p>Gestionnaires</p>
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