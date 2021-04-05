<?php
header("Content-type: application/json");

$iduser=$_POST["iduser"];

    try{
        require_once("../../header_api.php");
        $res = $bdd->query("SELECT idconsomme,date,nomplat,quantite FROM `consomme`,plat where consomme.idplat=plat.idplat && consomme.idclient=$iduser ORDER BY date desc");
        $result = array();
        while($line = $res -> fetch()){
            array_push($result,$line);
        }    
        echo json_encode($result);
}catch(Exception $e){
    echo $e->getMessage();
}

?>