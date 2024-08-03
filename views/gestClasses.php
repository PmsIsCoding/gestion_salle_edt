<?php
session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if ($_SESSION["logged"] != true) {
    header("Location: auth.php");
    exit;
} elseif ($_SESSION["role"] != "administrateur") {
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
    <link rel="stylesheet" href="css/styleMain.css">
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
        <h1>Gestion des <span>Classes</span></h1>
            <button type="button" class="ajoutClasse bg-principal btn-add modaleSrc" data-option="Classe">+ Ajouter des Classes</button>
        <div class="classes">
            <table>
                <thead>
                    <tr>
                        <th class="bg-principal">Nom de la Classe</th>
                        <th class="bg-principal">Professeur Responsable</th>
                        <th class="bg-principal">Action</th>
                        <th class="bg-principal">Supprimer</th>
                    </tr>
                </thead>
                     
                <tbody>
                    <?php 
                        $selectClasses = "SELECT c.classe_id, c.nom_classe, c.professeur_responsable_id ,u.nom_utilisateur, u.utilisateur_id
                                          FROM classes c 
                                          JOIN utilisateurs u ON c.professeur_responsable_id = u.utilisateur_id";
                        $classes = dbGetter($selectClasses, array());

                        $selectProfs = "SELECT utilisateur_id, nom_utilisateur FROM utilisateurs WHERE role = 'professeur'";
                        $profs = dbGetter($selectProfs, array());

                        foreach ($classes as $class) : 
                    ?>
                    <tr>
                        <td><?php echo $class["nom_classe"] ?></td>
                        <td><?php echo $class["nom_utilisateur"] ?></td>
                        <td>
                            <button type="button" class="modifClass modaleSrc" data-id="<?php echo $class['classe_id']?>" data-classe="<?php echo $class['nom_classe']?>" data-prof-id="<?php echo $class['professeur_responsable_id']?>">Modifier</button>
                        </td>
                        <td>
                            <button type="button" class="delete delSrc" data-id="<?php echo $class['classe_id']?>" data-option="classe">Supprimer</button>
                        </td>
                    </tr>                            
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="bg-floue">
            </div>
            <form method="post" action="" class="modaleForm">
                <h3>Infos de la classe</h3>
                <input type="hidden" name="classe_id" id="classe_id">

                <label for="nom_classe">Nom de la Classe:</label>
                <input type="text" name="nom_classe" id="nom_classe"><br>

                <label for="professeur_responsable_id">Professeur Responsable:</label>
                <select name="professeur_responsable_id" id="professeur_responsable_id" required>
                    <option value="" disabled selected id="default">--Choix du Professeur Responsable--</option>
                    <?php foreach ($profs as $prof) : ?>
                        <option value="<?php echo $prof['utilisateur_id']; ?>" id="<?php echo $prof['utilisateur_id']; ?>">
                            <?php echo $prof['nom_utilisateur']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <div class="btns">
                    <button type="submit">Soumettre</button>
                    <button type="button" class="btn-ann">Annuler</button>
                </div>
            </form>
        </div>
        </div>
        <div class="modaleDel">
            <h3>Voulez vous vraiment supprimer cette classe ?</h3>
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
    <script src="js/scriptGestClasses.js"></script>
    <script src="js/scriptDelete.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html> 