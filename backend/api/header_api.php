<?php
$options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
          );           
        $bdd = new PDO("mysql:host=localhost;dbname=lucas_faby", "user1", "Idaw2021;",$options);
?>