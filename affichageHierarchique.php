<div>Consultation de la GED</div>
<div style="background-color: lightyellow;width: 33%;height: 480px;overflow-y:scroll;overflow-x:scroll;float:left;margin:5px;text-overflow:ellipsis;">
    <?php
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = "select  nro_ordre ,label, prec,X,Y  from new_famille order by nro_ordre";

    $id = mysql_query($sql, $res) or die(mysql_errno() . " " . mysql_error());
    $row = 0;
    while (mysql_fetch_row($id))
    {
        $nro_ordre = mysql_result($id, $row, "nro_ordre");
        $nom = mysql_result($id, $row, "label");
        $prec = mysql_result($id,$row, "prec");
        $X = mysql_result($id, $row, "X");
       
        $Y = mysql_result($id, $row, "Y");
        for ($i=0;$i<$Y*2;$i++)
        {
            $str = $str."&nbsp;";
        }
        $row++;
        echo "<div style=\"width:5000px;\">".$str.$nom."<a href=\"index.php?action=affichageHierarchique&action=ajouter&orde_courant=".$nro_ordre."\"><img src=\"images/_plus.png\" alt = \"\" title=\"Créer un *sous* répertoire\"></a><a href=\"index.php?action=affichageHierarchique&voir=voir&ordre_courant=".$nro_ordre."\"><img src=\"images/oeil.png\" alt = \"\" title=\"Voir le contenu\"></a><a href=\"index.php?action=affichageHierarchique&action=supprimerRepertoire&orde_courant=".$nro_ordre."\"><img src=\"images/trash.gif\" alt = \"\" title=\"Créer un *sous* répertoire\"></a><br>";
        $str='';
    }
    ?>
</div>
<div style="width:100%;"><?php
    
    ?>
    <br>
    <div id="cadre-fihiers">Liste des fichiers de la rubrique 
        <?php

        $sql = "select label from new_famille where nro_ordre=".$_GET["ordre_courant"];
        $id = mysql_query($sql, $res) or die("Erreur : " . mysql_error(). $sql);
        $nom = mysql_result($id,0,0);
        echo "<span style=\"color:red;\">" . utf8_encode($nom) . "</span><br>";
        $sql = "select nom,chemin,type_mime,date,taille from fichiers_hierarchie,fichiers where fichiers_hierarchie.nro_fichier=fichiers.nro_fichier and nro_groupe=" . $_GET["ordre_courant"];
        $id = mysql_query($sql,$res) or die("La recherche a échoué. ".mysql_errno()." ".mysql_error());
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



