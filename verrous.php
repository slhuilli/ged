Choisir les fichiers à verrouiller (ils sont triés par noms) <a href="index.php?action=verrous&tri=dates">Tris par dates</a>&nbsp;|&nbsp;<a href="index.php?action=verrous&tri=noms">Tris par nom</a>

<div style="border:2px #000 dotted;padding-left: 25px; height: 300px;overflow-y: auto;">
    <form name="saisie" method="post" action="index.php" >
	<?php
            switch ($_GET["tri"]) {
    case "dates":
        $sql = "select nro_fichier, nom from fichiers where verrouille=0 order by date";
        break;
    case "noms":
        $sql = "select nro_fichier, nom from fichiers where verrouille=0 order by nom";
        break;
    default:
        $sql = "select nro_fichier, nom from fichiers where verrouille=0 order by nom";
        break;
}
            
	   
                            include("connexion.php");
			    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
			    mysql_select_db($database_name);
			    
			    $id = mysql_query($sql, $res);
			    $row=0;
			    while (mysql_fetch_row($id))
			    {
				$nom = mysql_result($id, $row, 1);
				$nro_fic = mysql_result($id, $row, 0);
				echo '<input type="checkbox" name="nom_fichier[]" value="'.$nro_fic.'" >'.$nom."<br>";
				$row++;
			    }
			    @mysql_free_result($id);
			    mysql_close($res);
	?>
	
    
</div>
<div>
    <input type="submit" name="verrouiller" value="Verrouiller">
</div></form>