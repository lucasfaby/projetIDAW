<?php
$id=$_POST["id"];

$login = $_POST["login"];
$newpassword = $_POST["newpassword"];
$pastpassword = $_POST["pastpassword"];
$sexe = $_POST["sexe"];
$age = $_POST["age"];
$intensite = $_POST["intensite"];
$result="ça marche pas";

try{
    require_once("../../header_api.php");

    $res = $bdd->query("select * from user where id=$id");

    if($res!=false){
        while($line = $res -> fetch()){
            if($line["password"]==$pastpassword){
                $sql="UPDATE user SET login ='$login', password = '$newpassword', sexe = $sexe, age=$age, intensite = $intensite  WHERE id = $id;";
                $bdd->exec($sql);
                $result="Utilisateur modifié, pour voir les modifications dans votre profil, veuillez vous reconnecter";
                
                
            } else {
                $result=" Mauvais mot de passe";
            }
        }
    }else{
        $result="Gros problème";
        echo json_encode($_POST);
    }

    }catch(Exception $e){
        echo $e->getMessage();
    }
echo $result;
?>