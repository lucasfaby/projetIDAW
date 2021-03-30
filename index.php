<?php

if(isset($_GET["page"])){
    $page=$_GET["page"];
}
else{
    $page="accueil";
}
require_once("frontend/php/header.php");
require_once("frontend/php/content.php");
if (file_exists("frontend/php/".$page.".php" )) require_once("frontend/php/".$page.".php" );
else require_once("frontend/php/error.php"); 
require_once("frontend/php/footer.php");

?>