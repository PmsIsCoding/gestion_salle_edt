<?php

    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");

    $getSallesDispos = "SELECT s.* FROM salles s LEFT JOIN emploisdutemps e ON s.salle_id = e.salle_id 
        AND e.jour = ? 
        AND e.heure_debut = ? 
        AND e.heure_fin = ?
    WHERE e.salle_id IS NULL
    ";
    $sallesDispos = dbGetter($getSallesDispos,array($_GET['jour'],$_GET['debut'],$_GET['fin']));
?>
<option value="default" disabled selected>--Choisissez une salle--</option>
<?php foreach($sallesDispos as $row) :  ?>
    <option value="<?php echo $row['salle_id'] ?>"><?php echo $row['nom_salle'] ?></option>
<?php  endforeach; ?>