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
    <div style="height: 350px; overflow-y: scroll;">
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
</form>
<div style="border:1px #000 dotted;">
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
        mysql_free_result($id);
        mysql_close($res);
        echo $resultat;
    }
    ?>
</div>
<div id="contenu"></div>
<div style="float:left;width:300px;">
    <span style="text-decoration: underline;">Légende : </span>
    <br><img src="images/_plus.png">Ajouter le fichier <span style="font-style: italic;"><?php echo $_POST["nom_fichier"]; ?> </span>à une rubrique/un dossier
    <br><img src="images/dhtmlgoodies_plus.gif">Ouvrir le dossier envisagé
    <br><img src="images/dhtmlgoodies_minus.gif">Fermer le dossier envisagé
    <br><img src="images/oeil.png">Voir le contenu
</div>
<div style="margin-top: 30px;font-style: italic;color: white;background-color: red;margin-left: 350px;text-align: center;border-radius: 7px;"><a href="index.php" style="color:white;">TERMINER</a></div><br>
<div style="margin:30px;padding:2px;color:red;font-style: italic;">Le premier clic est le positionnement du fichier, les autres clic seront le positionnement d'<span style="text-decoration: underline;">alias</span> dans la hiérarchie</div>
