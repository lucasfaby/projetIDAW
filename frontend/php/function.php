<?php
function renderMenuToHTML($currentPageId) {
// un tableau qui d\'efinit la structure du site
$mymenu = array(
// idPage titre
'accueil' => array( 'Accueil'),
'profil' => array( 'Profil' ),
'aliments' => array('Aliments'),
'Journal' => array('Journal')

);




foreach($mymenu as $pageId => $pageParameters) {
    if($pageId== $currentPageId){
        //echo("<li><a href=\"index.php?page=".$pageId."&lang=".$lang."\"class = \"currentpage\">".$pageParameters[$lang_index]."</a></li>");
        //echo "<a class='navbar-brand' href='index.php?page=".$pageId."'>".$pageParameters[0]."</a>";
        echo "<li class=\"nav-item mx-0 mx-lg-1\"><a class=\"nav-link py-3 px-0 px-lg-3 rounded active\" href=\"index.php?page=".$pageId."\">".$pageParameters[0]."</a></li>";
    }    
    else{
        echo "<li class=\"nav-item mx-0 mx-lg-1\"><a class=\"nav-link py-3 px-0 px-lg-3\" href=\"index.php?page=".$pageId."\">".$pageParameters[0]."</a></li>";
    }
}


}
?>