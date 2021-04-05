<div class="acprincipal">

<h2> Sur combien de jours en remontant depuis vote dernier repas souhaitez vous voir votre consommation ? </h2> 
<h3 class="voirconso"> <input class="voirinput" type="number" id="jours" placeholder="7"  > jours </intput> <button id="boutonvoir" class="btn btn-primary" onclick="creategraphs();"> Voir </button> </h3>
<br>
<div class="legende">
    <h3 > Légende : </h3> 
    <p style= " color: #007bff ; font-weight: bold; font-size: 20px;" > Consommation </p> 
     <p style= " color: #eb3e20; font-weight: bold; font-size: 20px;" >Seuils moyens recommandés pour votre profil</p>
</div>

    <div class="graphstop">
        <div class="graphtop1">
            <h3> Calories sur les derniers jours selectionnés </h3> <br>
            <svg id="graph1" width=80% height=350px></svg>
        </div>
        <div class="graphtop1">
            <h3> Protéines sur derniers jours selectionnés </h3> <br>
            <svg id="graph2" width=80% height=350px></svg>
        </div>  
    </div>
    <div class="graphstop">
        <div class="graphtop1">
            <h3> Lipides sur les derniers jours selectionnnés </h3> <br>
            <svg id="graph3" width=80% height=350px></svg>
        </div>
        <div class="graphtop1">
            <h3> Glucides sur les derniers jours selectionnnés</h3> <br>
            <svg id="graph4" width=80% height=350px></svg>
        </div>
    </div>  


</div>


<script>

function creategraphs(){
    document.getElementById("graph1").innerHTML ="";
    document.getElementById("graph2").innerHTML ="";
    document.getElementById("graph3").innerHTML ="";
    document.getElementById("graph4").innerHTML ="";

    let jours = document.getElementById("jours").value;
    if(jours==""){
        jours=7;
    }
   
    let graph1 = new jsGraphDisplay({
                    margin: {
                        top: 25,
                        right: 10,
                        bottom: 50,
                        left: 10,
                    },
                    axe: {
                        arrow : false,
                        x: {	
                            min: 0,
                            max: jours,
                            step: 1,	
                        },
                        y: {
                            title: "Calories en kCal",
                            min: 0,	
                        },
                    },
                    grid: {
                        x:{
                            thickness: 0,
                        },
                        y:{
                            thickness: 0,
                        },
                    },
                    });
    
    let graph2 = new jsGraphDisplay({
                    margin: {
                        top: 25,
                        right: 10,
                        bottom: 50,
                        left: 10
                    },
                    axe: {
                        arrow : false,
                        x: {	
                            min: 0,
                            max:  jours,
                            step: 1,	
                        },
                        y: {
                            title : "Protéines en grammes",
                            min: 0,	
                        },
                    },
                    grid: {
                        x:{
                            thickness: 0,
                        },
                        y:{
                            thickness: 0,
                        },
                    },

                    });
    graph2.DataDelete();
    let graph3 = new jsGraphDisplay({
                    margin: {
                        top: 25,
                        right: 10,
                        bottom: 50,
                        left: 10
                    },
                    axe: {
                        arrow : false,
                        x: {	
                            min: 0,
                            max:  jours,
                            step: 1,	
                        },
                        y: {
                            title : "Lipides en grammes",
                            min: 0,	
                        },
                    },
                    grid: {
                        x:{
                            thickness: 0,
                        },
                        y:{
                            thickness: 0,
                        },
                    },

                    });

    graph3.DataDelete();
    let graph4 = new jsGraphDisplay({
                    margin: {
                        top: 25,
                        right: 10,
                        bottom: 50,
                        left: 10
                    },
                    axe: {
                        arrow : false,
                        x: {	
                            min: 0,
                            max:  jours,
                            step: 1,	
                        },
                        y: {
                            title : "Glucides en grammes",
                            min: 0,	
                        },
                    },
                    grid: {
                        x:{
                            thickness: 0,
                        },
                        y:{
                            thickness: 0,
                        },
                    },

                    });
    graph4.DataDelete();
    let id= <?php echo $_SESSION["userid"]; ?>;
    let sexe = "<?php echo $_SESSION["usersexe"] ; ?>";
    let age =  <?php echo $_SESSION["age"] ; ?> ;
    let nvsport = <?php echo $_SESSION["intensite"] ; ?>;
    let moycal= 0;
    $.ajax({
            url: "../projet/backend/api/accueil/get/index.php", 
            method: "POST",
            data : {id: id, jours: jours},
            success: function(result){
                
                if(sexe=="Homme"){
                    moycal = 66.5+(13.75*77.4)+(5*175.6)-(6.77*age) ; 
                }else{
                    moycal = 655+(9.56*63)+(1.85*165)-(4.67*age) ;
                }
                console.log(moycal);
                switch(nvsport){
                    case 1: 
                        moycal= moycal*1.2 ; 
                        break;
                    case 2: 
                        moycal= moycal*1.375 ;
                        break;
                    case 3:
                        moycal= moycal*1.55 ;
                        break;
                }
                moycal= parseInt(moycal);
            
                let moyprot = parseInt((moycal*0.15)/4);
                
                let moylipbas = parseInt((moycal*0.35)/9);
                let moyliphaut = parseInt((moycal*0.40)/9);
                let moyglucbas = parseInt((moycal*0.45)/4);
                let moygluchaut = parseInt((moycal*0.65)/4);
                console.log(moycal,moyprot,moylipbas,moyliphaut,moyglucbas,moygluchaut);
//graphique des calories
                let cal= [];
                let seuil=[];
                for( i=0;i<result.length;i++){
                    let p = parseInt(result[i][1]);
                    cal.push([jours-i,p]); 
                }
                for(i=0; i<=jours ; i++){
                    seuil.push([i,moycal]);
                }
             
                graph1.DataAdd({
                    display:{
                        linkType: "bezier",
                        linkWidth: 3,
                        linkColor:"#007bff",
                    },
                    title: "cal",
                    data: cal,
                    });

                graph1.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkColor: "#eb3e20",
                        linkWidth: 4,
                    },
                    data: seuil,
                });
                
                graph1.Draw('graph1');
//graphique des protéines
                let prot= [];
                let seuilprot=[];
                for(let i=0;i<result.length;i++){
                    let c = parseInt(result[i][4]);
                    prot.push([jours-i,c]);
                }
                for(i=0; i<= jours ; i++){
                    seuilprot.push([i,moyprot]);
                }
            
                graph2.DataAdd({
                    display:{
                        linkType: "bezier",
                        linkWidth: 3,
                        linkColor:"#007bff",
                    },
                    data: prot,
                });

                graph2.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkWidth: 4,
                        linkColor: "#eb3e20",
                    },
                    data: seuilprot,
                });

                graph2.Draw('graph2');
//graphique des lipides
                let lip= [];
                let liphaut=[];
                let lipbas=[];
                for(let i=0;i<result.length;i++){
                    let c = parseInt(result[i][2]);
                    lip.push([jours-i,c]);
                }
                for(i=0; i<= jours ; i++){
                    lipbas.push([i,moylipbas]);
                    liphaut.push([i,moyliphaut]);
                }
                

                graph3.DataAdd({
                    display:{
                        linkType: "bezier",
                        linkWidth: 3,
                        linkColor:"#007bff",
                    },
                    data: lip,
                });
                graph3.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkWidth: 4,
                        linkColor:"#eb3e20",
                    },
                    data: lipbas,
                });
                graph3.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkWidth: 4,
                        linkColor:"#eb3e20",
                    },
                    data: liphaut,
                });

                graph3.Draw('graph3');
//graphique des glucides
                let gluc= [];
                let glucbas=[];
                let gluchaut=[];
                for(let i=0;i<result.length;i++){
                    let c = parseInt(result[i][3]);
                    gluc.push([jours-i,c]);
                }
                for(i=0; i<= jours ; i++){
                    glucbas.push([i,moyglucbas]);
                    gluchaut.push([i,moygluchaut]);
                }

                graph4.DataAdd({
                    display:{
                        linkType: "bezier",
                        linkWidth: 3,
                        linkColor:"#007bff",
                    },
                    data: gluc
                });

                graph4.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkWidth: 4,
                        linkColor:"#eb3e20",
                    },
                    data: glucbas,
                });
                graph4.DataAdd({
                    display:{
                        dataWidth: 0,
                        linkWidth: 4,
                        linkColor:"#eb3e20",
                    },
                    data: gluchaut,
                });


                graph4.Draw('graph4');

            },
            error: function(r){
                console.log(r);
            }
        });  

}

</script>