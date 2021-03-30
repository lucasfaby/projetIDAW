<?php
$login = $_POST["login"];
$password = $_POST["password"];
$sexe = $_POST["sexe"];
$age = $_POST["age"];
$intensite = $_POST["intensite"];
try{
    $bdd = new PDO("mysql:host=localhost;dbname=lucas_faby", "user1", "Idaw2021;");
    $res = $bdd->query("select * from user");
    $users = array();
    $is_ok = true;
    while($line = $res -> fetch()){
        if($login == $line["login"]){
            $is_ok = false;
        }
    }
    if($is_ok){
        $sql = "INSERT INTO user (login,password,sexe,age,intensite) VALUES (\"".$login."\",\"".$password."\",".$sexe.",".$age.",".$intensite.")" ;
        $bdd->exec($sqladduser);
    }
    session_start();
    $_SESSION["login"] = $login;
    echo "l'utilisateur : ".$login." a bien été ajouté";
}catch(Exception $e){
    echo $e->getMessage();
}
?>