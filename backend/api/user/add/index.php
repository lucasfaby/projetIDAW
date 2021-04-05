<?php

$login = $_POST["login"];
$password = $_POST["password"];
$sexe = $_POST["sexe"];
$age = $_POST["age"];
$intensite = $_POST["intensite"];
try{
    require_once("../../header_api.php");
    $res = $bdd->query("select * from user");
    $result=0;
    while($line = $res -> fetch()){
        if($login == $line["login"]){
            $result=1;
        }
    }
    if($result==0){
        $sql = "INSERT INTO user (login,password,sexe,age,intensite) VALUES ('$login','$password',$sexe,$age,$intensite)" ;
        $bdd->exec($sql);
    }
    
}catch(Exception $e){
    echo $e->getMessage();
}
echo $result;
?>