<?php
header("Content-type: application/json");
$id=$_POST["id"];
$jours=$_POST["jours"];

try{
    require_once("../../header_api.php");
    $result=array();

    $res = $bdd->query("select date,SUM((calories*quantite)/100) as cal,SUM((lipides*quantite)/100) as lip,SUM((glucides*quantite)/100) as gluc,SUM((proteines*quantite)/100) as prot from consomme, plat where idclient=$id and consomme.idplat=plat.idplat GROUP BY date DESC limit $jours");
        while($line = $res -> fetch()){
                array_push($result,[$line["date"],$line["cal"],$line["lip"],$line["gluc"],$line["prot"]]);   
            }
            echo json_encode($result);
    
    }catch(Exception $e){
        echo $e->getMessage();
    }

?>