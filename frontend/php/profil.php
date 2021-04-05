

<?php
// On suppose que toutes les infos de le base de donnée sur le profil de l'utilisateur sont dans la variale $_SESSION

$password="caché";
$login=$_SESSION["login"];
$id=$_SESSION["userid"];
$sexe=$_SESSION["usersexe"];
$age=$_SESSION["age"];
$niveausport=$_SESSION["intensite"];

echo "<h1>".$login."</h1>";
echo 
"<div class=\"Profil\">
        <div>
        <table class=\"table\">
            <tr> <td class=\"profil-champ\"> Login </td> <td>".$login."</td>
            <tr> <td class=\"profil-champ\"> Password </td> <td>".$password."</td>
            <tr> <td class=\"profil-champ\"> Sexe </td> <td>".$sexe."</td>
            <tr> <td class=\"profil-champ\"> Age </td> <td>".$age." ans </td>
            <tr> <td class=\"profil-champ\"> Niveau de sport </td> <td>".$niveausport."</td>
        </table> </div>"  ;    
?>
    <div>
        <button class="btn btn-primary" onclick='editprofil();'> Editer votre profil </button>
</div>
    <div id="formedit"></div>

</div>

<script>

function editprofil(){  //fait apparaitre le formulaire d'édition
    document.getElementById("formedit").innerHTML = 
            "<form id=\"form2\" autocomplete=\"off\"> <table class=\"table\">"+
            "<tr> <th >Login</th> <td><input type=\"text\" id=\"login\" ></td> </tr>"+
            "<tr> <th>Sexe</th> <td> <select  id=\"sexe\"> <option type=\"number\" value=1> M </otpion> <option type=\"number\" value=2> F </otpion></select> </td>  </tr>"+
            "<tr> <th>Age</th> <td><input type=\"number\" id=\"age\"></td>  </tr>"+
            "<tr> <th>Niveau de sport</th> <td><input type=\"text\" id=\"niveausport\"></td>   </tr> "+
            "<tr> <th>Nouveau mot de passe</th> <td><input type=\"password\" id=\"newpwd\"></td>   </tr>"+
            "<tr> <th>Ancien mot de passe</th> <td><input type=\"password\" id=\"pastpwd\"></td>   </tr> "+
            " <td> <button class=\"btn btn-primary\" onclick='changeprofil();'> Valider </button> </td> </table>  </form>";

    let login = "<?php  echo $_SESSION["login"] ; ?>";
    let sexe = "  <?php echo $_SESSION["usersexe"] ; ?> ";
    let age =   <?php echo $_SESSION["age"] ; ?> ;
    let nvsport = "<?php echo $_SESSION["intensite"] ; ?>";

   
    document.getElementById("login").value=login;
    document.getElementById("sexe").value=sexe;
    document.getElementById("age").value=age;
    document.getElementById("niveausport").value=nvsport;
}

function changeprofil(){
    event.preventDefault();

    let l = document.getElementById("login").value;
    let np = document.getElementById("newpwd").value;
    let pp =document.getElementById("pastpwd").value
    let s = document.getElementById("sexe").value;
    let a = document.getElementById("age").value;
    let n = document.getElementById("niveausport").value;
    let i = <?php echo $_SESSION["userid"] ?>;
    $.ajax({
        url: "../projet/backend/api/user/update/index.php", 
        method: "POST",
        data : { id: i, login: l, newpassword: np, pastpassword: pp,sexe: s, age: a, intensite: n },
        success: function(texte){
            alert(texte);
            console.log(texte);

            
        },
        error: function(){
            alert("Une erreur s'est produite");
        }
    });  
    
}
</script>
