

<?php
// On suppose que toutes les infos de le base de donnée sur le profil de l'utilisateur sont dans la variale $_SESSION
$id="1";
//$login="Wellan";
$password=" mot de passe";
$sexe=" masculin";
$mail="hugo.resseguier@gmail.com";
$niveausport="Haut";
if(isset($_SESSION["login"])){
    $login=$_SESSION["login"];
    // $id=$_SESSION['id'];
    // $password=$_SESSION['password'];
    // $sexe=$_SESSION['sexe'];
    // $mail=$_SESSION['mail'];
    // $niveausport=$_SESSION['niveausport']
}
echo "<h1>".$login."</h1>";
echo 
"<div class=\"Profil\">
        <div>
        <table class=\"table\">
            <tr> <td class=\"profil-champ\"> Login </td> <td>".$login."</td>
            <tr> <td class=\"profil-champ\"> Password </td> <td>".$password."</td>
            <tr> <td class=\"profil-champ\"> Sexe </td> <td>".$sexe."</td>
            <tr> <td class=\"profil-champ\"> Mail </td> <td>".$mail."</td>
            <tr> <td class=\"profil-champ\"> Niveau de sport </td> <td>".$niveausport."</td>
        </table> </div>"  ;    
?>
    <div>
        <button class="btn-primary" onclick='editprofil();'> Editer votre profil </button>
</div>
    <div id="formedit"></div>

</div>

<script>

function editprofil(){  //fait apparaitre le formulaire d'édition
    document.getElementById("formedit").innerHTML = 
            "<form id=\"form2\" autocomplete=\"off\"> <table class=\"table\">"+
            "<tr> <th >Login</th> <td><input type=\"text\" id=\"login\" ></td> </tr>"+
            "<tr> <th> Mot de Passe</th> <td><input type=\"text\" id=\"password\"></td></tr>"+
            "<tr> <th>Sexe</th> <td><input type=\"text\" id=\"sexe\"></td>  </tr>"+
            "<tr> <th>Mail</th> <td><input type=\"text\" id=\"mail\"></td>  </tr>"+
            "<tr> <th>Niveau de sport</th> <td><input type=\"text\" id=\"niveausport\"></td>   </tr>  </table>  </form>"+
            "<button class=\"btn-primary\" onclick='changeprofil();'> Valider </button> ";

    let login = "<?php  echo $_SESSION["login"] ; ?> ";
    // let mdp= " echo $_SESSION["password"] ; ?> ";
    // let sexe = "  echo $_SESSION["sexe"] ; ?> ";
    // let mail = "  echo $_SESSION["mail"] ; ?> ";
    // let nvsport = "  echo $_SESSION["niveausport"] ; ?> ";

   
    document.getElementById("login").value=login;
    // document.getElementById("password").value=mdp;
    // document.getElementById("sexe").value=sexe;
    // document.getElementById("mail").value=mail;
    // document.getElementById("niveausport").value=nvsport;
}

function changeprofil(){
    // let id = "  echo $_SESSION["id"] ; ?> ";
    let l = document.getElementById("login").value;
    let p = document.getElementById("password").value;
    let s = document.getElementById("sexe").value;
    let m = document.getElementById("mail").value;
    let n = document.getElementById("niveausport").value;

    
}


</script>
