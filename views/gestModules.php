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

$getModules = "SELECT * FROM modules JOIN utilisateurs ON modules.professeur_id = utilisateurs.utilisateur_id WHERE classe_id = ?";
$allModules = dbGetter($getModules,array($check[0]["classe_id"]));

$selectProfs = "SELECT utilisateur_id, nom_utilisateur FROM utilisateurs WHERE role = 'professeur'";
$profs = dbGetter($selectProfs, array());
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
        <h1>Gestion des <span>Modules</span></h1>
        <button type="button" class="addModuleBtn bg-principal btn-add modaleSrc" data-option="Module" data-idClasse="<?php echo $check[0]['classe_id'] ?>">+ Ajouter un module</button>
        <table>
            <thead>
                <tr>
                    <th class="bg-principal">Module</th>
                    <th class="bg-principal">Volume Totale</th>
                    <th class="bg-principal">Professeur</th>
                    <th class="bg-principal">Volume Fait</th>
                    <th class="bg-principal">Modifier</th>
                    <th class="bg-principal">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allModules as $module) : ?>
                    <tr>
                        <td><?php echo $module["nom_module"] ?></td>
                        <td><?php echo $module["volume_horaire"] ?>h</td>
                        <td><?php echo $module["nom_utilisateur"] ?></td>
                        <td><?php echo $module["volume_fait"] ?>h</td>
                        <td><button type="button" class="modaleSrc modifModule" data-nom="<?php echo $module["nom_module"] ?>" data-volume="<?php echo $module["volume_horaire"] ?>" data-idProf="<?php echo $module["professeur_id"] ?>" data-vFait="<?php echo $module["volume_fait"] ?>" data-id="<?php echo $module["module_id"] ?>">Modifier</button></td>
                        <td><button type="button" class="delete delSrc" data-id="<?php echo $module["module_id"] ?>" data-option="module">Supprimer</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="bg-floue"></div>
        <form action="" method="post" class="addModule modaleForm">
            <h3>Infos Module</h3>
            <input type="hidden" name="idClasse" id="idClasse">
            <input type="hidden" name="id" id="id">
            <label for="nomModule">Nom du module</label><input type="text" name="nomModule" id="nomModule" required><br>
            <label for="volumeTotal">Volume Total</label><input type="number" name="volumeTotal" id="volumeTotal" required><br>
            <label for="professeur_responsable_id">Professeur</label>
            <select name="professeur_responsable_id" id="professeur_responsable_id" required>
                <option value="" disabled selected id="default">--Choix du Professeur--</option>
                <?php foreach ($profs as $prof) : ?>
                    <option value="<?php echo $prof['utilisateur_id']; ?>" id="<?php echo $prof['utilisateur_id']; ?>">
                        <?php echo $prof['nom_utilisateur']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="volumeFait" class="hidden vFait">Volume Fait</label><input type="number" name="volumeFait" id="volumeFait" class="hidden vFait"><br>
            <div class="btns">
                <button type="submit">Soumettre</button>
                <button type="button" class="btn-ann">Annuler</button>
            </div>
        </form>
        <div class="modaleDel">
            <h3>Voulez vous vraiment supprimer ce module ?</h3>
            <div class="btns">
                <a href=""><button type="button" class="btn-conf">Oui</button></a>
                <button type="button" class="btn-ann">Annuler</button>
            </div>
        </div>
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
    <script src="js/scriptGestModule.js"></script>
    <script src="js/scriptDelete.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>