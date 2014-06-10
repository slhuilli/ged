<form name="saisie" method="post" action="index.php">
    <div class="gauche">
	Numéro d'ordre du nouvel état : </div><div style="float:left;"><input type="text" name="nro_ordre" value="">
	<div class="gauche">Nom du nouvel état : </div><div style="float:left;"><input type="text" name="nom_ordre" value="">
	<input type="submit" value="Valider" name="valider_etat" >
    </div>
</form>

<?php
    $sql = "select nro_etat, description_etat from workflow order by nro_etat";
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $row = 0;
    $id = mysql_query($sql, $res);
   ?>

<div id="ordre">
<?php
    echo "<ul>";
    while (@mysql_fetch_row($id))
    {
	$nro_etat = mysql_result($id, $row, 0);
	$description_etat = mysql_result($id, $row, 1);

	$row++;
	echo "<li>" . $nro_etat . " - " . $description_etat . " <a href='index.php?action=supp_workflow&etat=".$nro_etat."'>Supprimer</a></li>";
    }
    echo "</ul>";
    @mysql_free_result($id);
    mysql_close($res);
?>
</div>