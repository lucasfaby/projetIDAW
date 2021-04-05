<div class="alimenttable">
        <table  class="table">
            <thead class="tableheader">
                <td> Date </td>
                <td>Nomplat</td>
                <td> Quantité </td>                
            </thead>
            <tbody id="tableau-aliments">
            </tbody>
        </table>

    <script>
        function load_var(){
            document.getElementById("tableau-aliments").innerHTML = "";
            iduser = <?php echo $_SESSION["userid"];?>;
            $.ajax({
            
                url: "backend/api/consomme/get/index.php", 
                method: "POST",
                data: {iduser:iduser},
                success: function(result){                        
                    document.getElementById("tableau-aliments").innerHTML="";

                    for (i=0;i<result.length;i++){
                        document.getElementById("tableau-aliments").innerHTML += 
                        "<tr> <td> "+result[i][1]+
                        "</td> <td>"+result[i][2]+
                        "</td> <td>"+result[i][3]+
                        "g</td> <td> <button type='button' class='btn-primary' onclick='deleteid(\"" + result[i][0] + "\")'>Supprimer</button></td></tr>";               
                    }
                },
                error: function(err){
                    alert("Une erreur s'est produite");
                    console.log(err);
                }   
            }); 
        }

        function deleteid(idcons){
            $.ajax({
            
            url: "backend/api/consomme/delete/index.php", 
            method: "POST",
            data: {idconsomme:idcons},
            success: function(result){                        
                load_var();
            },
            error: function(err){
                alert("Une erreur s'est produite");
                console.log(err);
            }   
        }); 
        }

        load_var();
    </script>

    </div>