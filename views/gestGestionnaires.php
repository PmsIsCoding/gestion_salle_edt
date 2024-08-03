<?php session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

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
        <h1><span>Gestionnaires</span> des Salles</h1>
        <button type="button" class="addGestionnaire bg-principal btn-add modaleSrc" data-option="Gest">+ Ajouter un gestionnaire</button>
        <table>
            <thead>
                <tr>
                    <th class="bg-principal">Matricule</th>
                    <th class="bg-principal">Nom d'utilisateur</th>
                    <th class="bg-principal">Email</th>
                    <th class="bg-principal">Modifier</th>
                    <th class="bg-principal">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $selectEtudiants = "SELECT * FROM utilisateurs WHERE role = 'gestionnaire'";
                    $result = dbGetter($selectEtudiants,array());
                    // var_dump($result);
                    foreach($result as $row) : 
                ?>
                        <tr>
                            <td><?php echo $row["matricule"] ?></td>
                            <td><?php echo $row["nom_utilisateur"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><button type="button" data-id="<?php echo $row["utilisateur_id"] ?>" data-matricule="<?php echo $row["matricule"] ?>" data-userName="<?php echo $row["nom_utilisateur"] ?>" data-email="<?php echo $row["email"] ?>"class="modifGest modaleSrc">Modifier</button></td>
                            <td><button type="button" data-id="<?php echo $row["utilisateur_id"] ?>" class="delete delSrc" data-option="gestionnaire">Supprimer</button></a></td>
                        </tr>                            

                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="bg-floue">
        </div>
        <div class="modaleDel">
            <h3>Voulez vous vraiment supprimer ce Gestionnaire ?</h3>
            <div class="btns">
                <a href=""><button type="button" class="btn-conf">Oui</button></a>
                <button type="button" class="btn-ann">Annuler</button>
            </div>
        </div>
        <form action="" method="post" class="addGest modaleForm">
            <h3>Infos Gestionnaires</h3>
            <input type="hidden" name="id" id="id">
            <label for="matricule">Matricule</label><input type="text" name="matricule" id="matricule"><br>
            <label for="userName">Nom d'utilisateur</label><input type="text" name="userName" id="userName"><br>
            <label for="email">Email</label><input type="text" name="email" id="email"><br>
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
    <script src="js/scriptGestionnaire.js"></script>
    <script src="js/scriptDelete.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>