<?php
$idplat = $_POST["idplat"];

try{
    require_once("../../header_api.php");
    $sql = "delete from plat where idplat=$idplat";
    $bdd->exec($sql);
    $result = array();
    $result["res"]=$sql;
    echo json_encode($result);
    
}catch(Exception $e){
    echo $e->getMessage();
}
?>