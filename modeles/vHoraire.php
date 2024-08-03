<?php 
    require("../modeles/dbConnect.php");
    require("../modeles/dbHandler.php");

    $module_id = $_GET['module'];
    $option = $_GET['option'];

    $getModule = "SELECT * FROM modules WHERE module_id = ?";
    $module = dbGetter($getModule,array($module_id));
    // echo json_encode($module);

    $vFait = $module[0]['volume_fait'];
    $vTotal = $module[0]['volume_horaire'];

    if($option == "plus"){
        if($vFait == $vTotal){
            echo $vFait;
        }
        elseif($vFait < $vTotal){
            $vFait++;
            $addVolume = "UPDATE modules SET volume_fait = ? WHERE module_id = ?";
            dbSetter($addVolume,array($vFait,$module_id));
            echo $vFait;
        }
    }
    elseif($option == "moins"){
        if($vFait == 0){
            echo $vFait;
        }
        else{
            $vFait--;
            $addVolume = "UPDATE modules SET volume_fait = ? WHERE module_id = ?";
            dbSetter($addVolume,array($vFait,$module_id));
            echo $vFait;
        }
    }
?>