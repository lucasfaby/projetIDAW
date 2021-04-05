<div class='Aliments'>
    <div class="alimenttitre">
        <h1> Voici tous les aliments disponibles </h1>
        <p> Vous pouvez bien sûr en rajouter ! <p>
    </div>

    <div class="barrederecherche">
        <form class="formconnexion" >
            <table>
               <td> <input type="text" id="recherche" class="form-control" placeholder="pomme"> </td>
               <td> <input type="integer" id="nblignes" class="form-control" placeholder="10"> </td>
               <td> <button type="button" class="btn btn-primary" onclick="editligne(-1)"> Rechercher</button> </td>
               <td> <button type="button" class="btn btn-primary ml-5 mr-2" onclick="movePage(-1)">Page précedente</button>    <span id ="CurrentPage" class="text-secondary font-weight-bold">1</span>           
                <button type="button" class="btn btn-primary" onclick="movePage(1)">Page suivante</button> </td>
    </div>

    <div class="alimenttable">
        <table  class="table">
            <thead class="tableheader">
                <td> Nom </td>
                <td> Calories (kCal)</td>
                <td> Lipides(g/100g) </td>
                <td> Glucides(g/100g) </td>
                <td> Protéines(g/100g) </td>
                
            </thead>
            <tbody id="tableau-aliments">
            </tbody>
        </table>
    </div>
    <div class='addaliment'>
        <h1> Remplissez le formulaire pour ajouter ou editer un aliment </h1>
        <p id="erreur"><p>
        <form id="form1" autocomplete="off" onSubmit="editligne(-2);"> 
            <table class="table">
            <tr>
                <th id='mandatory'>Nom</th>
                <td><input type="text" id="nom" placeholder="Pomme" ></td>
            </tr>
            <tr>
                <th>Calories (kCal/100g)</th>
                <td><input type="number" id="calories"  placeholder="5"> kCal</td>
            </tr>
            <tr>
                <th>Glucides (g/100g)</th>
                <td><input type="number" id="glucides" placeholder="6"> grammes</td>
            </tr>
            <tr>
                <th>Lipides (g/100g)</th>
                <td><input type="number" id="lipides" placeholder="3"> grammes</td>
            </tr> 
            <tr>
                <th>Protéines (g/100g)</th>
                <td><input type="number" id="proteines" placeholder="2"> grammes</td>

            </tr>
            <tr>
                <th></th>
                <td><button type="button"  class='btn btn-primary' id="Submit" value="Ajouter/editer" onclick="editligne(-2)">ajouter</button></td>
            </tr>    
            
            </table>
            </form>
    </div>
</div>

<script>
function Aliment(i,n,c,l,g,p){
    this.id=i;
    this.nom=n;
    this.calories=c;
    this.lipides=l;
    this.glucides=g;
    this.proteines=p;
}

let TabAli =new Array();
let currentPage=1;
let nbPages=1;

function movePage(nb){
    currentPage+= nb;
    if (currentPage<1){
        currentPage= 1;
    }
    else{
        console.log(currentPage);
    console.log(nbPages);
    editligne(-1);
    }
    
}



function deleteligne(value){ // value est ici l'identifiant de l'aliment dans la db, id de la ligne du tableau et de TabAli
    //suppression dans TabAli
    for(let i= 0 ; i<=TabAli.length; i++){
        if(TabAli[i].id==value){
            TabAli.splice(i,1);
            break;
        }
    }
    console.log("value : "+value);
    //suppression dans le tableau HTML
    document.getElementById(value).innerHTML = "";
    $.ajax({
            url: "backend/api/aliments/delete/index.php", 
            method: "POST",
            data: {idplat: value},
            success: function(result){ 
            },
            error: function(err){
                alert("Une erreur s'est produite");
                console.log(err);
            }
        }); 


    //suppression dans la base de données 
    //AJAX suppression de l'aliment d'id value dans la db
}

function consomme(id){
    //alert("vous avez mangé "+nom);
    console.log(id);
    var today = new Date();
    var date = prompt("Choisir une date :", "YYYY-MM-JJ");
    var quantite = prompt("Choisir une quantité en g:", 100);
    var userid = <?php echo $_SESSION["userid"];?>;
    $.ajax({
        
        url: "backend/api/consomme/add/index.php", 
        method: "POST",
        data: {quantite: quantite, idplat: id,date: date,userid: userid},
    success: function(result){           
            alert("Le plat a bien été ajouté à votre journal !");   
    },
    error: function(err){
        alert("Une erreur s'est produite");
        console.log(err);
    }
});
}


function editligne(id){//remplissage du tableau 
        // AJAX  récupération des aliments dans la base de donnée et les mets
        // dans TabAli ainsi que 
        // dans le tableau avec le champ "id" en identifiant de la ligne du tableau 
        // et les deleteligne(id) et editligne(id)

    if(id==-1){
        document.getElementById("tableau-aliments").innerHTML = "";
        let recherche = document.getElementById("recherche").value;
        let nblignes = document.getElementById("nblignes").value;
        $.ajax({
        
            url: "backend/api/aliments/get", 
            method: "GET",
            data: {recherche: recherche, nblignes: nblignes,currentPage: currentPage},
            success: function(result){
                
            nbPages=result[0];
            var element = document.getElementById("CurrentPage");
            element.innerHTML=currentPage+"/"+nbPages;


            for (i=1;i<result.length;i++){
                document.getElementById("tableau-aliments").innerHTML += 
            "<tr id="+result[i][0]+"> <td> "+result[i][1]+
            "</td> <td>"+result[i][2]+
            "</td> <td>"+result[i][3]+
            "</td> <td>"+result[i][4]+
            "</td> <td>"+result[i][5]+
            "</td> <td> <button type='button' class='btn-primary' onclick='consomme(\"" + result[i][0] + "\")'>Consommer</button></td></tr>";
            
            aliment = new Aliment(result[i][0],result[i][1],result[i][2],result[i][3],result[i][4],result[i][5]);
            TabAli.push(aliment);
            }
          
        },
        error: function(err){
            alert("Une erreur s'est produite");
            console.log(err);
        }
    });
    }
    else if(id==-2){
        // ajout d'un aliment via le formulaire
        let n=document.getElementById("nom").value;
        let c=document.getElementById("calories").value;
        let g=document.getElementById("glucides").value;
        let l=document.getElementById("lipides").value;
        let p=document.getElementById("proteines").value;

        $.ajax({
            url: "backend/api/aliments/add/index.php", 
            method: "POST",
            data: {nomplat: n, calories: c,glucides: g, lipides:l, proteines:p},
            success: function(result){
                console.log(result);  
                let i=result[0];      
                let newAliment= new Aliment(i,n,c,g,l,p);
                TabAli.push(newAliment);
                document.getElementById("tableau-aliments").innerHTML += 
                "<tr id="+i+"> <td> "+n+
                "</td> <td>"+c+
                "</td> <td>"+g+
                "</td> <td>"+l+
                "</td> <td>"+p+
                "</td> <td><button type='button'class='btn-primary' onclick='consomme(\"" + i + "\")'>Consommer</button> <button class='btn-primary' onclick='deleteligne("+i+")'>Supprimer</button></td></tr>"
                 ;
    
            },
            error: function(err){
                alert("Une erreur s'est produite");
                console.log(err);
            }
        }); 

        

    }
    else{

        // edition de la ligne dont l'id est en argument TabAli
    }
}


function nouvelindice(){
    let result = 0;
    if(TabAli.length>0){
        result = TabAli[0].id;
        for(let i = 0; i < TabAli.length; i++)
            if(TabAli[i].id>result){
                result=TabAli[i].id;
            }
        result+=1;
        }
    return(result);
}



editligne(-1);
</script>


