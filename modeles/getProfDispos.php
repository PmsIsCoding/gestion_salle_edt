<?php

    session_start();

    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");


    $getModulesBasingProfs = "SELECT * FROM modules m,utilisateurs u,disponibilites d WHERE classe_id = ? AND u.utilisateur_id = m.professeur_id AND d.utilisateur_id = m.professeur_id AND d.heureDebut = ? AND d.jour = ? AND d.heureFin = ?  AND d.etat='libre'";
    $modules = dbGetter($getModulesBasingProfs,array($_GET['classe'],$_GET['debut'],$_GET['jour'],$_GET['fin']));
?>
<option value=""disabled selected>--Choisissez un module--</option>
<?php foreach($modules as $row) : ?>
    <option value="<?php echo $row['module_id'] ?>" class="moduleChoice" data-prof="<?php echo $row['utilisateur_id'] ?>"><?php echo $row['nom_module'] ?>(<?php echo $row['nom_utilisateur'] ?>)</option>
<?php endforeach; ?>