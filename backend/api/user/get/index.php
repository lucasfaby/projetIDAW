<?php
header("Content-type: application/json");
$g = $_POST;
if(isset($_POST["login"])){
    $login = $_POST["login"];
    $password = $_POST["password"];
    try{
        
        
        require_once("../../header_api.php");

        $res = $bdd->query("select * from user");

        $users = array();

        while($line = $res -> fetch()){
            $users[$line["login"]]=$line["password"];

        }
        

    }catch(Exception $e){
        echo $e->getMessage();
    }
    
    $jsonarr = array('login'=>null);

    foreach($users as $usr_login => $usr_password){
        if($usr_login == $login && $usr_password == $password){
            $jsonarr = array("login"=>$login);
        }
    }
    session_start();
    $_SESSION["login"] = $login;
echo json_encode($jsonarr);
}
else{
echo json_encode($g);
}

?>