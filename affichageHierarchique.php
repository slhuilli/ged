<div>Consultation de la GED</div>
<div style="background-color: lightyellow;width: 33%;height: 480px;overflow-y:scroll;float:left;margin:5px;">
    <?php
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);


    $sql = "select  concat(repeat('<ul style=\"list-style-type: none;padding: 0px;margin-left: 10px;margin-top:1px;margin-bottom:2px;\"><li>', (count(parent.NFM_LIB)-1)),node.NFM_LIB,repeat('</li></ul>', (count(parent.NFM_LIB)-1))),  (count(parent.NFM_LIB)-1) as depth, node.NFM_BG, node.NFM_BD
from new_famille as node, new_famille as parent
where node.NFM_BG between parent.NFM_BG and parent.NFM_BD
group by node.NFM_LIB
order by node.NFM_LIB";

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

    echo '</ul>';
    ?>
</div>
<div style="width:100%;"><?php
    $sql = "select NFM_LIB, nro_famille from new_famille where NFM_BG=" . $_GET["NFM_BG"] . " and NFM_BD=" . $_GET["NFM_BD"];
    
    $id = mysql_query($sql, $res) or die(mysql_errno() . " " . mysql_error());
    $nom = mysql_result($id, 0, 0);
    $nro_famille = mysql_result($id, 0, 1);
    if ((isset($_GET["NFM_BG"]) && isset($_GET["NFM_BD"])) || ($_GET["action"] == "affichageHierarchique"))
    {

        echo '<div class="sous-menu" >';
        echo'<a href="index.php?action=affichageHierarchique&gestion=ajouter&NFM_BG=' . $_GET["NFM_BG"] . '& NFM_BD=' . $_GET["NFM_BD"] . '"><img src="images/folderopen.gif">Ajouter un sous-dossier</a>';
        echo '</div>';
        echo '<div class="sous-menu"  >';
        echo'<a href="index.php?action=affichageHierarchique&gestion=supprimer&NFM_BG=' . $_GET["NFM_BG"] . '& NFM_BD=' . $_GET["NFM_BD"] . '"><img src="images/trash.gif">Supprimer la rubrique courante (' . utf8_encode($nom) . ')</a>';
        echo '</div><br><br>';
    }
    ?>
    <br>
    <div id="cadre-fihiers">Liste des fichiers de la rubrique 
        <?php
        //Suppression de la rubrique
        if ($_GET["gestion"] == "supprimer")
        {


            $sql = "delete from new_famille where NFM_BG=" . $_GET["NFM_BG"] . " and NFM_BD=" . $_GET["NFM_BD"];
            // echo "<span style=\"color:red;\">".$sql."</span><br>";
            $id = mysql_query($sql, $res);
            echo "<script type=\"text/javascript\">
<!--
window.location = \"index.php?action=affichageHierarchique&gestion=supprimer&NFM_BG=".$_GET["NFM_BG"]."\"
//-->
</script>";
        }

        echo "<span style=\"color:red;\">" . utf8_encode($nom) . "</span><br>";
        $sql = "select nom,chemin,type_mime,date,taille from fichiers_hierarchie,fichiers where fichiers_hierarchie.nro_fichier=fichiers.nro_fichier and nro_groupe=" . $nro_famille;

        $id = mysql_query($sql, $res) or die("Erreur : " . mysql_error());
        echo "il y a " . mysql_num_rows($id) . " resultats;";
        $row = 0;
        echo "<div style=\"width:100%;text-align:center;\">";
        echo "<table style=\" border-width:1px;border-style:solid;border-color:black; border-collapse: collapse;\">";
        while (mysql_fetch_row($id))
        {
            $nom = mysql_result($id, $row, "nom");
            $chemin = mysql_result($id, $row, "chemin");
            $type_mime = mysql_result($id, $row, "type_mime");
            $date = mysql_result($id, $row, "date");
            $taille = mysql_result($id, $row, "taille");
            //On remet en ordre les histoires de slash et anti-slash
            $chemin_complet = $chemin;
            $chemin_complet = str_replace('\\', '/', $chemin_complet);
            echo "<tr><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\">" . $nom . "</td><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\">" . $chemin . "</td><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\">" . $type_mime . "</td><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\">" . $date . "</td><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\">" . $taille . "</td><td style=\"border-width:1px;border-style:solid;border-color:red;width:50%;\"><a target=\"_blank\" href=\"" . $chemin_complet . "\"><img alt=\"Telecharger\" src=\"images/download.png\"></a></td></tr>";
            $row++;
            //  echo "<tr><td>".$nom."</td><td>".$chemin."</td><td>".$type_mime."</td><td>".$date."</td><td>".$taille."</td></tr>";
        }
        echo "</table>";
        echo "</div>";
        if ($row == 0)
        {
            echo "<div style=\"width:100%;text-align:center;\">Aucun résultats</div>";
        }


        mysql_free_result($id);
        mysql_close($res);
        ?>

    </div> 
</div>



