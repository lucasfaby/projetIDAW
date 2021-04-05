<?php
header("Content-type: application/json");
if(isset($_POST["login"])){
    $login = $_POST["login"];
    $password = $_POST["password"];
    try{
        
        
        require_once("../../header_api.php");

        $res = $bdd->query("select * from user where login='$login'");

        $jsonarr = array();

        if($res!=false){
            while($line = $res -> fetch()){
                
                if($line["login"]==$login && $line["password"]==$password){
                    if($line["sexe"]==1){
                        $sexe = "Homme";
                    }else{
                        $sexe ="Femme";
                    }


                    array_push($jsonarr,$line["id"]);
                    array_push($jsonarr,$login);
                    array_push($jsonarr,$password);
                    array_push($jsonarr,$sexe);
                    array_push($jsonarr,$line["age"]);
                    array_push($jsonarr,$line["intensite"]);
                    
                    session_start();
                    $_SESSION["login"] = $login;
                    $_SESSION["userid"]= $jsonarr[0];
                    $_SESSION["usersexe"] = $jsonarr[3];
                    $_SESSION["age"] = $jsonarr[4];
                    $_SESSION["intensite"]=$jsonarr[5];
                }
                else {
                    $jsonarr= array([" Authentification échouée"]);
                }


            }
        }else {
            $jsonarr= array([" Utilisateur non existant"]);
        }

    }catch(Exception $e){
        echo $e->getMessage();
    }
    
   
    echo json_encode($jsonarr);
    }
    
else{
echo json_encode($_POST);
}

?>