<?php
    session_start();
    if(isset($_POST["deconnexion"]) && $_POST["deconnexion"]==true){
        session_unset();
        session_destroy();
    }
    $logged=false;
    // on recupère $_POST['login'] et $_POST['password'] ici
    // tester dans la base de donnée si ces entrées existent 
    if(isset($_POST['login']) && isset($_POST['password'])){
        $_SESSION["login"]=$_POST['login'];
        $logged=true;
    }
    elseif(isset($_SESSION["login"])){
        $logged=true;
    }
    if($logged==false){
        header('Location: frontend/connexion.php');
        exit();
    }
    
    if(isset($_GET["page"])){
        $page=$_GET["page"];
    }
    else{
        $page="accueil";
    }
    require_once("frontend/php/menu.php");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>iMM</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="frontend/css/styles.css" rel="stylesheet" />
    </head>



<body>
<!--
<div class="header">
    
</div>  
    --> 
    <nav class="navbar navbar-expand-lg bg-secondary header" id="mainNav">
            <div class="containerperso">
                <?php 
                if($logged){
                    echo "<div>
                            <h1 class=\"grostitre\">Bienvenue ".$_SESSION["login"]." </h1>
                            </div>";
                    echo "<div>
                            <form action='index.php' method='POST' >
                            <input class=\"btn-primary\" type='submit' value='Déconnexion' name='deconnexion'>
                            </form>
                        </div>";
                }
                ?>
            </div> 
            <a class="iMangerMieux" href="index.php">iMangerMieux</a>           
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    <?php 
                            renderMenuToHTML($page);
                        ?>
                    </ul>
                </div>
            
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
            
        </nav>
        <!-- Masthead-->

        