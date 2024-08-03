<?php session_start();

require("../modeles/dbConnect.php");
require("../modeles/dbHandler.php");

if($_SESSION["logged"] != true){
    header("Location: auth.php");
}
elseif($_SESSION["role"] != "professeur"){
    die("Vous n'avez pas les droits d'accès à cette page !!!");
}

$checkResp = "SELECT * FROM utilisateurs JOIN classes on utilisateurs.utilisateur_id = classes.professeur_responsable_id WHERE classes.professeur_responsable_id = ?";
$check = dbGetter($checkResp,array($_SESSION['id']));

// var_dump($check);

$selectEtudiants = "SELECT * FROM utilisateurs,etudiant,inscriptions,classes WHERE etudiant.utilisateur_id = utilisateurs.utilisateur_id AND utilisateurs.utilisateur_id = inscriptions.etudiant_id AND inscriptions.statut = 'Approuvée' AND inscriptions.classe_id = classes.classe_id AND inscriptions.classe_id = ?";
$result = dbGetter($selectEtudiants,array($check[0]['classe_id']));

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
    <link rel="stylesheet" href="css/styleGestEtudiant.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Espace Admin</title>
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
        <h1>Gestion des <span>Etudiants de votre classe</span></h1>
        <div class="etudiants">
            <table>
                <thead>
                    <tr>
                        <th class="bg-principal">Numéro de Carte</th>
                        <th class="bg-principal">Nom d'utilisateur</th>
                        <th class="bg-principal">Email</th>
                        <th class="bg-principal">Telephone</th>
                        <th class="bg-principal">Adresse</th>
                        <th class="bg-principal">Sexe</th>
                        <th class="bg-principal">Modifier</th>
                        <th class="bg-principal">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row) : ?>
                            <tr>
                                <td><?php echo $row["matricule"] ?></td>
                                <td><?php echo $row["nom_utilisateur"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["telephone"] ?></td>
                                <td><?php echo $row["adresse"] ?></td>
                                <td><?php echo $row["sexe"] ?></td>
                                
                                <td><button type="button" data-id="<?php echo $row["etudiant_id"] ?>" data-id="<?php echo $row["etudiant_id"] ?>" data-userName="<?php echo $row["nom_utilisateur"] ?>" data-email="<?php echo $row["email"] ?>" data-telephone="<?php echo $row["telephone"] ?>" data-adresse="<?php echo $row["adresse"] ?>" data-sexe="<?php echo $row["sexe"] ?>" data-classe="<?php echo $row["nom_classe"] ?>" class="modifEtudiant modaleSrc" data-matricule="<?php echo $row["matricule"] ?>">Modifier</button></td>

                                <td><button type="button" data-option="etudiant" data-id="<?php echo $row["etudiant_id"] ?>" class="delete delSrc">Supprimer</button></a></td>
                            </tr>                            

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="bg-floue">
        </div>
        <div class="modaleDel">
            <h3>Voulez vous vraiment supprimer cet Etudiant ?</h3>
            <div class="btns">
                <a href=""><button type="button" class="btn-conf">Oui</button></a>
                <button type="button" class="btn-ann">Annuler</button>
            </div>
        </div>
        <form action="../modeles/modifEtudiant.php" method="post" class="formModif modaleForm">
            
            <h3>Modifier les Infos de cet Etudiant</h3>

            <input type="hidden" name="src" id="src">

            <input type="hidden" name="id" id="id">

            <label for="username">Prénom et Nom</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="emailInst">Email Institutionnel</label>
            <input type="email" name="emailInst" id="emailInst" required><br>
            
            <label for="numCarte">Numero de Carte Etudiant</label>
            <input type="text" name="numCarte" id="numCarte" required><br>
            
            <label for="telephone">Téléphone</label>
            <input type="number" name="telephone" id="telephone" required><br>
            
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" required><br>
            <label>Sexe : </label>
            <p>
                <input type="radio" id="M" name="sexe" value="M" required>
                <label for="M">Masculin</label>
            </p>
            <p>
                <input type="radio" id="F" name="sexe" value="F" required>
                <label for="F">Féminin</label>
            </p>
            <label for="classe">Classe à s'inscrire</label>
            <select name="classe" id="classe" required>
                <option value="" disabled selected>Choisissez une classe</option>
                <?php 
                    $sql = "SELECT * FROM classes";
                    $result = dbGetter($sql,array());
                    ?>
                    <?php foreach($result as $row) : ?>
                        <option value="<?php echo $row["classe_id"] ?>" id="<?php echo $row["nom_classe"] ?>"><?php echo $row["nom_classe"] ?></option>
                    <?php endforeach; ?>
            </select>
            <br>
            <div class="btns">
                <button type="submit">Modifier</button>
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
    <script src="js/scriptGestEtudiant.js"></script>
    <script src="js/scriptDelete.js"></script>
</body>
</html>