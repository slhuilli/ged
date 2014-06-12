<?php
include("dhtmlgoodies_tree.class.php");
//echo "nro : " . $_SESSION["nro_fic"];
?>
<div style="width: 100%; text-align: center;">

    <form name="saisie" method="post" action="index.php">
        <div style="background-color: lightyellow;width: 33%;height: 480px;overflow-y:scroll;float:left;">
            <?php
            // <div style="height: 350px; overflow-y: scroll;">
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
                echo "<a style=\"text-align:left;\" href=\"index.php?action=placementRubrique&BG=" . $NFM_BG . "&BD=" . $NFM_BD . "\" >" . utf8_encode($NFM_BG_desc) . "</a>\n";
            }

            echo '</ul>';
            ?>


            <?php
            /* $tree = new dhtmlgoodies_tree(); // Creating new tree object
              include("connexion.php");
              $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
              mysql_select_db($database_name);
              $sql = "SELECT pk, nom, parent, url, form, img FROM hierarchie ";
              $id = mysql_query($sql, $res);
              $row = 0;

              while (mysql_fetch_row($id))
              {
              $pk = mysql_result($id, $row, "pk");
              $nom = mysql_result($id, $row, "nom");
              $parent = mysql_result($id, $row, "parent");
              $url = mysql_result($id, $row, "url");
              $form = mysql_result($id, $row, "form");
              $img = mysql_result($id, $row, "img");
              // echo $pk." ".$nom." ".$parent." ".$url." ".$form." ".$img;
              $tree->addToArray($pk, $nom, $parent, $url, $form, $img);

              $row++;
              }

              $tree->writeCSS();
              $tree->writeJavascript();
              $tree->drawTree(); */

            //Si le répertoire a été selectionné, confirmer celui-ci

            /* echo $_SESSION["nom_fichier"];
              echo $_SESSION["chemin="]; */
            ?>
        </div>
    </form>
    <div style="border:1px #000 dotted;margin-left: 220px;">
        Le fichier est décrit comme appartenant aux rubriques :
        <?php
        if (isset($_GET["nro"]))
        {
            //On commence a tester si ce fichier est déjà présent. Si non, ce n'est pas un alias, si oui c'est est un !
            $sql = "select count(*) from fichiers_hierarchie where nro_groupe=" . $_GET["nro"];
            $id = mysql_query($sql, $res) or die(mysql_error());
            $nb = mysql_result($id, 0, 0);
            if ($nb == 0)
            {
                $sql = "insert into fichiers_hierarchie(nro_fichier,nro_groupe,alias) values('" . $_SESSION["nro_fic"] . "','" . $_GET["nro"] . "',0)";
                $id = mysql_query($sql, $res) or die(mysql_error());
                $resultat = "le fichier est référencé comme <span style=\"color:red;\">principal</span>";
            } else
            {
                $sql = "insert into fichiers_hierarchie(nro_fichier,nro_groupe,alias) values('" . $_SESSION["nro_fic"] . "','" . $_GET["nro"] . "',1)";
                $id = mysql_query($sql, $res) or die(mysql_error());
                $resultat = "le fichier est référencé comme <span style=\"color:orange;\">alias</span>";
            }
            $id = mysql_query($sql, $res);

            echo $resultat;
        }

        if (isset($_GET["action"]) == "placementRubrique")
        {
            echo '(' . $_SESSION["nro_fic"] . ') ' . $_SESSION["fichier"];

            echo "Boerd gauche : " . $_GET["BG"] . " bord droit : " . $_GET["BD"];

            //Recherche de l'ID du groupze
            $sql = "select nro_famille from new_famille where NFM_BG='" . $_GET["BG"] . "' and NFM_BD='" . $_GET["BD"] . "'";
            $id = mysql_query($sql, $res) or die(mysql_error());
            $nro_groupe = mysql_result($id, 0, 0);
            //On test si le fichier est déja rangé
            $sql = "select * from fichiers_hierarchie where nro_fichier=" . $_SESSION["nro_fic"] . " and nro_groupe=" . $nro_groupe;
          //echo $sql;
            $id = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " " . mysql_error());
            $nb = mysql_num_rows($id);
            if ($nb == 0)
            {
                $alias = 0;
                $desc_alias = "fichier primaire";
            } else
            {
                $alias = 1;
                $desc_alias = "fichier alias";
            }
            //Si deja présent, ce n'est pas un alias, sinon c'en est un
            $sql = "insert into fichiers_hierarchie(nro_groupe,alias,nro_fichier) values('".$nro_groupe."','".$alias."','".$_SESSION["nro_fic"]."');";
            $id = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " " . mysql_error());
            echo "<br>Fichier referencé en tant que ".$desc_alias;
        }
        mysql_free_result($id);
        mysql_close($res);
        ?>
    </div>
    <div id="contenu"></div>

    <div style="margin-top: 30px;font-style: italic;color: white;background-color: red;margin-left: 350px;text-align: center;border-radius: 7px;"><a href="index.php" style="color:white;">TERMINER</a></div><br>
    <div style="margin-left:10px;margin:30px;padding:2px;color:red;font-style: italic;">Le premier clic est le positionnement du fichier, les autres clic seront le positionnement d'<span style="text-decoration: underline;">alias</span> dans la hiérarchie</div>
