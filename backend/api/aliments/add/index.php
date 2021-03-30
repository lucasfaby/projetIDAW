<?php
header("Content-type: application/json");

$nomplat = $_POST["nomplat"];
$calories = $_POST["calories"];
$glucides = $_POST["glucides"];
$lipides = $_POST["lipides"];
$proteines = $_POST["proteines"];

try{
    require_once("../../header_api.php");
    $sql = "insert into plat (nomplat, glucides, lipides, proteines, calories) values ('$nomplat',$glucides,$lipides,$proteines,$calories)";
    $bdd->exec($sql);
    $res = $bdd->query("select * from plat where nomplat='$nomplat'");
    $result = array();
    while($line = $res -> fetch()){
                array_push($result,$line["idplat"]);
            }
    echo json_encode($result);

}catch(Exception $e){
    echo $e->getMessage();
}



?>