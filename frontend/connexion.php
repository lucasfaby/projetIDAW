

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
    console.log("login="+lgn+"&password="+pwd);

    $.ajax({
        url: "/projet/backend/api/user/get/index.php", 
        method: "POST",
        data : { login: lgn, password: pwd },
        success: function(result){
            if(result["login"]!=null){
            window.location.href = "/projet/index.php?page=accueil";
        }
        },
        error: function(){
            alert("Une erreur s'est produite");
        }
    });
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
    <form  class="formconnexion" action='index.php' method='POST' name='connexion'>
        <input class="form-control" type='text' name='login' id='login' placeholder='Login' ><br>
        <input class="form-control" type='password' name='password' id='password' placeholder='Mot de passe'><br>          
    </form>
    <button type="button" class="btn btn-primary ml-5 mr-5" onclick="submit()">Se connecter</button>
    </div>


    <div class="connexion_droite">
        <h1> Pour vous inscrire veuillez remplir ce formulaire : </h1>
        <form action="index.php?page=adduser" class="formconnexion" method='POST'>
        <table>
            
                <tr> Login <input type="text" name="login" placeholder="gfaim" class="form-control"> </tr>
                <tr> Mot de passe <input type="password" name="password" class="form-control"> </tr>
                <tr> Sexe <select name="sexe" class="form-control">
                            <option value="Homme"> M </otpion>
                            <option value="Femme"> F </otpion>
                    </select>
                </tr>
                <tr> Niveau de sport <select name="nvsport" class="form-control">
                                        <option value="bas"> Bas </otpion>
                                        <option value="moyen"> Moyen </otpion>
                                        <option value="bas"> Haut </otpion>
                                    </select>
                </tr>
            <br>
            <tr> <input type="submit" class='btn btn-primary' value="S'inscrire"> </tr>
        </table>
    </form>
<!-- il faut tester ici si les valeurs passées sont conformes avant qu'elles soient envoyées -->
    </div>
</div>

<?php 
require_once('php/footer.php');
?>
</body>

</html>



