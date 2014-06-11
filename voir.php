<?php
include("dhtmlgoodies_tree.class.php");
//echo "nro : " . $_SESSION["nro_fic"];
?>
<div style="width: 100%; text-align: center;">
    <a href="#" onclick="expandAll();
            return false">Ouvrir tous les noeuds</a>&nbsp; | &nbsp;
    <a href="#" onclick="collapseAll();
            return false">Fermer tous les noeuds</a><br></div>
<form name="saisie" method="post" action="index.php">
    <div id="bloc-dossiers">
        <?php
        $tree = new dhtmlgoodies_tree(); // Creating new tree object
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
        $tree->drawTree();

        //Si le répertoire a été selectionné, confirmer celui-ci

        /* echo $_SESSION["nom_fichier"];
          echo $_SESSION["chemin="]; */
        ?>
    </div>
    <div id="bloc-fichiers">
        Liste des répertoires auxquels sera affecté ce fichier : 
    </div>
</form>

<div style="float:left;width: 100%;">
   
    <div style="width:300px;">
    <span style="text-decoration: underline;">Légende : </span>
    <br><img src="images/_plus.png">Ajouter le fichier <span style="font-style: italic;"><?php echo $_POST["nom_fichier"]; ?> </span>à une rubrique/un dossier
    <br><img src="images/dhtmlgoodies_plus.gif">Ouvrir le dossier envisagé
    <br><img src="images/dhtmlgoodies_minus.gif">Fermer le dossier envisagé
   <!--<br><img src="images/oeil.png">Voir le contenu-->
</div>
</div>


