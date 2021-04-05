<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>iMM</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        
        <script src ="https://code.jquery.com/jquery-3.6.0.min.js" ></script>




<script>

function submit(){
    lgn = document.getElementById("login").value;
    pwd = document.getElementById("password").value;

    $.ajax({
        url: "../backend/api/user/get/index.php", 
        method: "POST",
        data : { login: lgn, password: pwd },
        success: function(result){
            if(result[1]==lgn){
                window.location.href = "/projet/index.php?page=accueil";
            }else{
                alert("Une erreur s'est produite");
            }
       
        },
        error: function(){
            alert("Une erreur s'est produite");
        }
    });
}

function inscription(){
    let login = document.getElementById("login2").value;
    let pass1 = document.getElementById("pass1").value;
    let pass2 = document.getElementById("pass2").value;
    let age = document.getElementById("age").value;
    let sexe = document.getElementById("sexe").value;
    let intensite = document.getElementById("nvsport").value;
    console.log(login,pass1,pass2,age,sexe,intensite);
    if(pass1!=pass2){
        alert("Les mots de passes ne correspondent pas, veuillez essayer de nouveau.")
    }else if(login=="" || age=="" || sexe=="" || intensite=="" || pass1==""){
        alert("Vous n'avez pas rempli tous les champs ! Veuillez essayer de nouveau.")
    }else{
        $.ajax({
        url: "../backend/api/user/add/index.php", 
        method: "POST",
        data : { login: login, password: pass1,age: age,sexe: sexe, intensite: intensite },
        success: function(result){
            if(result==0){
                alert( "Utilisateur créé, veuillez maintenant vous connecter avec votre login et mot de passe !");
            }else{
                alert( "Ce login existe déjà, veuillez en essayer un nouveau.");
            }
        },
        error: function(){
            alert("Une erreur s'est produite");
        }
    });
    }

}


</script>
        
    </head>



<body>
<!--
<div class="header">
    
</div>  
    --> 
    <nav class="navbar navbar-expand-lg bg-secondary header" id="mainNav">
    
            <a class="navbar-brand js-scroll-trigger" href="#page-top">iMangerMieux</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
        </nav>
        <!-- Masthead-->


        <div class="connexion">
    
    <div class="connexion_gauche">
        <h1>Si vous êtes déjà inscrits, connectez-vous ici</h1>
    <form  class="formconnexion" >
        <input class="form-control" type='text'  id='login' placeholder='Login' ><br>
        <input class="form-control" type='password' id='password' placeholder='Mot de passe'><br>          
    </form>
    <button  class="btn btn-primary ml-5 mr-5" onclick="submit();">Se connecter</button>
    </div>


    <div class="connexion_droite">
        <h1> Pour vous inscrire veuillez remplir ce formulaire : </h1>
        <form  class="formconnexion">
        
            <tr> Login <input type="text" id="login2" placeholder="gfaim" class="form-control"> </tr>
            <tr> Mot de passe <input type="password" id="pass1" class="form-control"> </tr>
            <tr> Confirmez votre mot de passe<input type="password" id="pass2" class="form-control"> </tr>
                <tr> Age <input type="number" id="age" class="form-control"> </tr>
                <tr> Sexe <select id="sexe" class="form-control">
                            <option value="1"> M </otpion>
                            <option value="2"> F </otpion>
                    </select>
                </tr>
                <tr> Niveau de sport <select id="nvsport" class="form-control">
                                        <option value="1"> Bas </otpion>
                                        <option value="2"> Moyen </otpion>
                                        <option value="3"> Haut </otpion>
                                    </select>
                </tr>       
        </form>
        <br>
        <button class='btn btn-primary' onclick="inscription();"> S'inscrire</button> 

    </div>
</div>

<?php 
require_once('php/footer.php');
?>
</body>

</html>



