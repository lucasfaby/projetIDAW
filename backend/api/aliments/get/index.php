<?php
header("Content-type: application/json");

if(isset($_GET["nblignes"])&& $_GET['nblignes']!= null){
    $nblignes= $_GET["nblignes"];
} else {
    $nblignes =20;
}


if(isset($_GET["recherche"]) && $_GET["recherche"] == "" ){
    try{    
        require_once("../../header_api.php");
        
            $res = $bdd->query("select * from plat limit $nblignes");
            $result = array();

            while($line = $res -> fetch()){
                array_push($result,[$line["idplat"],$line["nomplat"],$line["calories"],$line["lipides"],$line["glucides"],$line["proteines"]]);
            }
            echo json_encode($result);
            }catch(Exception $e){
                echo $e->getMessage();
            }
}

        
        
else if(isset($_GET["recherche"]) && $_GET["recherche"] != "" ){
    try{
        $search =$_GET["recherche"];
        require_once("../../header_api.php");
        
            $res = $bdd->query("SELECT * from plat  WHERE nomplat LIKE \"%$search%\" limit $nblignes");
            $result = array();

            while($line = $res -> fetch()){
                array_push($result,[$line["idplat"],$line["nomplat"],$line["calories"],$line["lipides"],$line["glucides"],$line["proteines"]]);
            }
            echo json_encode($result);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }




?>