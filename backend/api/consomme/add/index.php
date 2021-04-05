<?php
header("Content-type: application/json");

$idplat = $_POST["idplat"];
$idlogin = $_POST["userid"];
$quantite = $_POST["quantite"];
$date = $_POST["date"];


try{
    require_once("../../header_api.php");
    $sql = "insert into consomme (idclient, idplat, quantite, date) values ($idlogin,$idplat,$quantite,'$date')";
    $bdd->exec($sql);
    $result = array();
    echo json_encode($result);

}catch(Exception $e){
    echo $e->getMessage();
}



?>