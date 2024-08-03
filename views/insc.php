<?php 
    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontImport.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styleInsc.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Inscription Etudiant</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo.svg" alt="logo">
        </div>
    </header>
    <main>
        <div class="image">
            <img src="assets/fond.jpeg" alt="fond">
        </div>
        <div class="form">
            <form action="../modeles/gestInsc.php" method="post">
                <h3>Inscrivez-vous</h3>
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
                
                <input type="radio" id="M" name="sexe" value="M" required>
                <label for="M">Masculin</label>
                <input type="radio" id="F" name="sexe" value="F" required>
                <label for="F">Féminin</label><br>
                
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required><br>
                
                <label for="confPassword">Confirmez le mot de passe</label>
                <input type="password" id="confPassword" name="confPassword" required><br>

                <label for="classe">Classe à s'inscrire</label>
                <select name="classe" id="classe" required>
                    <option value="" disabled selected>Choisissez une classe</option>
                    <?php 
                        $sql = "SELECT * FROM classes";
                        $result = dbGetter($sql,array());
                     ?>
                        <?php foreach($result as $row) : ?>
                            <option value="<?php echo $row["classe_id"] ?>"><?php echo $row["nom_classe"] ?></option>
                        <?php endforeach; ?>
                </select>
                
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </main>
</body>