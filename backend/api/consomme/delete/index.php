<?php
header("Content-type: application/json");

$idconsomme=$_POST["idconsomme"];

    try{
        require_once("../../header_api.php");
        $res = $bdd->query("DELETE FROM `consomme`where idconsomme=$idconsomme");
        $result = array();
        array_push($result,"success");
 
        echo json_encode($result);
}catch(Exception $e){
    echo $e->getMessage();
}

?>