<div>Consultation de la GED</div>
<div style="background-color: lightyellow;width: 33%;height: 480px;overflow-y:scroll;float:left;margin:5px;">
    <?php
    $sql = "select  concat(repeat('<ul style=\"list-style-type: none;padding: 0px;margin-left: 10px;margin-top:1px;margin-bottom:2px;\"><li>', (count(parent.NFM_LIB)-1)),node.NFM_LIB,repeat('</li></ul>', (count(parent.NFM_LIB)-1))),  (count(parent.NFM_LIB)-1) as depth, node.NFM_BG, node.NFM_BD
from new_famille as node, new_famille as parent
where node.NFM_BG between parent.NFM_BG and parent.NFM_BD
group by node.NFM_LIB
order by node.NFM_LIB";
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $id = mysql_query($sql, $res);
    $row = 0;
    while (mysql_fetch_row($id))
    {
        $NFM_BG_desc = mysql_result($id, $row, 0);
        $NFM_BG = mysql_result($id, $row, 2);
        $NFM_BD = mysql_result($id, $row, 3);
        $NFM_LIB = mysql_result($id, $row, 2);
        $row++;
        //echo '<li>'.utf8_encode($NFM_BG) . " - " . $NFM_BD . " - " . $NFM_LIB.'</li>'."\n";
        echo "<a href=\"index.php?action=affichageHierarchique&NFM_BG=" . $NFM_BG . "&NFM_BD=" . $NFM_BD . "\" >" . utf8_encode($NFM_BG_desc) . "</a>\n";
    }
    mysql_free_result($id);
    mysql_close($res);
    echo '</ul>';
    ?>
</div>
<div style="width:100%;"><?php
    if ((isset($_GET["NFM_BG"]) && isset($_GET["NFM_BD"])) || ($_GET["action"] == "affichageHierarchique"))
    {
        echo '<div class="sous-menu" >';
        echo'<a href="index.php?action=affichageHierarchique&gestion=ajouter&NFM_BG=' . $_GET["NFM_BG"] . '& NFM_BD=' . $_GET["NFM_BD"] . '"><img src="images/folderopen.gif">Ajouter un sous-dossier</a>';
echo '</div>';
        echo '<div class="sous-menu"  >';
        echo'<a href="index.php?action=affichageHierarchique&gestion=supprimer&NFM_BG=' . $_GET["NFM_BG"] . '& NFM_BD=' . $_GET["NFM_BD"] . '"><img src="images/trash.gif">Supprimer la selection</a>';
        echo '</div><br><br>';
    }
    
    
    ?>
    <br>
    <div style="width:70%; height: 430px; background-color: yellow;border:2px #000 dashed;margin-left: 180px;">sss</div> 
    

</div>



