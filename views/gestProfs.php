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
        <h1>Gestion des <span>Enseignants</span></h1>
        <button type="button" class="ajout-prof bg-principal btn-add modaleSrc" data-option="Prof">+ Ajouter un Enseignant</button>
        <div class="etudiants">
            <table>
                <thead>
                    <tr>
                        <th class="bg-principal">matricule</th>
                        <th class="bg-principal">Nom d'utilisateur</th>
                        <th class="bg-principal">Email</th>
                        <th class="bg-principal">Spécialité</th>
                        <th class="bg-principal">Modifier</th>
                        <th class="bg-principal">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $selectProfs = "SELECT * FROM utilisateurs JOIN enseignants ON enseignants.utilisateur_id = utilisateurs.utilisateur_id";
                        $result = dbGetter($selectProfs,array());
                        // var_dump($result);
                        foreach($result as $row) : 
                    ?>

                            <tr>
                                <td><?php echo $row["matricule"] ?></td>
                                <td><?php echo $row["nom_utilisateur"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["specialite"] ?></td>
                                <td><button type="button" data-id="<?php echo $row["utilisateur_id"] ?>" data-matricule="<?php echo $row["matricule"] ?>" data-userName="<?php echo $row["nom_utilisateur"] ?>" data-specialite="<?php echo $row["specialite"] ?>" data-email="<?php echo $row["email"] ?>"class="modifProfs modaleSrc">Modifier</button></td>
                                <td><button type="button" data-id="<?php echo $row["utilisateur_id"] ?>" class="delete delSrc" data-option="professeur">Supprimer</button></td>
                            </tr>                            

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="bg-floue">
        </div>
        <div class="modaleDel">
            <h3>Voulez vous vraiment supprimer ce Enseignant ?</h3>
            <div class="btns">
                <a href=""><button type="button" class="btn-conf">Oui</button></a>
                <button type="button" class="btn-ann">Annuler</button>
            </div>
        </div>
        <form action="../modeles/addProf.php" method="post" class="addProf modaleForm">
            <h3>Infos Professeur</h3>
            <input type="hidden" name="id" id="idProf">
            <label for="matricule">Matricule</label><input type="text" name="matricule" id="matricule" required><br>
            <label for="userName">Nom d'utilisateur</label><input type="text" name="userName" id="userName" required><br>
            <label for="email">Email Institutionnel</label><input type="email" name="email" id="email" required><br>
            <label for="specialite">Spécialité</label><input type="text" name="specialite" id="specialite" required><br>
            <div class="btns">
                <button type="submit" class="add">Soumettre</button>
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
    <script src="js/scriptGestProfs.js"></script>
    <script src="js/scriptDelete.js"></script>
    <script src="js/scriptLogOut.js"></script>
</body>
</html>