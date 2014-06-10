<fieldset>
    <legend>Inscription</legend>
    <form name="saisie" method="post" action="index.php">
	<div class="gauche">Login :</div><div> <input type="text" name="login" value=""></div>
	<div class="gauche">Pass :  </div><div><input type="password" name="pass" value=""></div>
	<div class="gauche">Confirmer le mot de passe : </div><div><input type="password" name="pass" value="">
	    <div class="gauche">Affecter au groupe : </div><div><select name="groupe">
		    <option></option><?php
			$sql = "select nro_groupe, nom_groupe from groupe order by nom_groupe";
			include("connexion.php");
			$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
			mysql_select_db($database_name);
			$row = 0;
			$id = mysql_query($sql, $res);
			while (mysql_fetch_row($id))
			{
			    $gr = mysql_result($id, $row, 1);
			    $nro_gr = mysql_result($id, $row, 0);
			    echo "<option value=\"" . $nro_gr . "\">" . $gr . "</option>";
			    $row++;
			}
			@mysql_free_result($id);
			mysql_close($res);
		    ?>

		</select></div>
	    <br><input type="submit" name="valider_user" value="valider">
	    </form>

	    </fieldset>

	    <fieldset>
		<legend>Groupes</legend>
		<fieldset style="width:40%;float:left;margin-left:10px;margin-right:30px;">
		    <legend>Créer un groupes</legend>
		    <div style="float:left;">
			<form name="saisie" method="post" action="index.php">
			    <div class="gauche">Groupe :</div><div> 
				Nom :<br><input type="text" name="groupe" value="">
				Description <br><input type="text" name="description_groupe" value="">

			    </div>
			    <div>* Le nom du groupe sera en majuscules</div>
			    <input type="submit" name="valider_groupe" value="valider">
			</form></div>
		</fieldset>
		<fieldset style="width:40%;float:left;">
		    <legend>Affecter un utilisateur a  un groupe</legend>
		    <div style="float:left;height: 168px;">
			<form name="saisie" method="post" action="index.php">
			    <div class="gauche">Utilisateurs :</div>

			    <div>
				<select name="utilisateur">

				    <?php
					$sql = "select login from users where actif=1";
					include("connexion.php");
					$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
					mysql_select_db($database_name);
					$row = 0;
					$id = mysql_query($sql, $res);
					while (mysql_fetch_row($id))
					{
					    $login = mysql_result($id, $row, 0);

					    echo "<option value=\"" . $login . "\">" . $login . "</option>";
					    $row++;
					}
					@mysql_free_result($id);
					mysql_close($res);
				    ?>

				</select>
			    </div>
			    a affecter dans le groupe
			    <div>
				<select name="aff_groupe">
				    <?php
					$sql = "select nro_groupe, nom_groupe from groupe order by nom_groupe";
					include("connexion.php");
					$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
					mysql_select_db($database_name);
					$row = 0;
					$id = mysql_query($sql, $res);
					while (mysql_fetch_row($id))
					{
					    $gr = mysql_result($id, $row, 1);
					    $nro_gr = mysql_result($id, $row, 0);
					    echo "<option value=\"" . $nro_gr . "\">" . $gr . "</option>";
					    $row++;
					}
					@mysql_free_result($id);
					mysql_close($res);
				    ?>
				</select>
			    </div>
			    <br><input type="submit" name="valider_aff_groupe" value="valider">
			</form>
		    </div>

		</fieldset>



	    </fieldset>
	    <fieldset>
		<legend>Activation des comptes / Comptes inactifs</legend>
		<table style="width:100%;border: 1px solid black;border-collapse: collapse;">
		    <tr><th>Login</th><th>Nom du groupe</th><th>Description</th><th>Supprimer</th><th>Activer</th></tr>
		<?php
			$sql="select * from users where actif=0";
			include("connexion.php");
			$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
			mysql_select_db($database_name);
			$row = 0;
			$id = mysql_query($sql, $res);
			while (mysql_fetch_row($id))
			{
			    $login = mysql_result($id, $row, 0);
			    $nom_groupe = mysql_result($id, $row, 1);
			    $description = mysql_result($id, $row, 2);
			    $row++;
			    echo "<tr><td>" . $login . "</td><td>" . $nom_groupe . "</td><td>" . $description . "</td><td><a href='index.php?action=supp_utilisateur&login=" . $login . "'><img src=\"images/corbeille.gif\"></a></td><td><a href='index.php?action=activer&utilisateur=".$login."'>Activer</td></tr>";
			}
			@mysql_free_result($id);
			mysql_close($res);
		    ?>
		</table>
	    </fieldset>
	    <fieldset>
		<legend>Résumé des comptes actifs</legend>

		<table style="width:100%;border: 1px solid black;border-collapse: collapse;">
		    <tr><th>Login</th><th>Nom du groupe</th><th>Description</th><th>Supprimer</th><th>Desactiver</th></tr>
		    <?php
			//$sql = "select users.login,nom_groupe,groupe.description from users,groupe,groupe_users where groupe_users.nro_groupe = groupe.nro_groupe and users.groupe=groupe.nro_groupe";
			//$sql = "select users.login, users.password, groupe.nom_groupe, groupe.description, users.actif from users,groupe_users, groupe where users.login=groupe_users.login and groupe.nro_groupe=groupe_users.nro_groupe and users.actif=1";
			$sql="select * from users where actif=1";
			include("connexion.php");
			$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
			mysql_select_db($database_name);
			$row = 0;
			$id = mysql_query($sql, $res);
			while (mysql_fetch_row($id))
			{
			    $login = mysql_result($id, $row, 0);
			    $nom_groupe = mysql_result($id, $row, 1);
			    $description = mysql_result($id, $row, 2);
			    $row++;
			    echo "<tr><td>" . $login . "</td><td>" . $nom_groupe . "</td><td>" . $description . "</td><td><a href='index.php?action=supp_utilisateur&login=" . $login . "'><img src=\"images/corbeille.gif\"></a></td><td><a href='index.php?action=desactiver&utilisateur=". $login ."'>Désactiver</a></td></tr>";
			}
			@mysql_free_result($id);
			mysql_close($res);
		    ?>

		</table>
	    </fieldset>
   <fieldset>
		<legend>Liste des groupes présents</legend>

		<table style="width:100%;border: 1px solid black;border-collapse: collapse;">
		    <tr><th>Login</th><th>Nom du groupe</th><th>Description</th><th>Supprimer</th><th>Desactiver</th></tr>
		    <?php
			//$sql = "select users.login,nom_groupe,groupe.description from users,groupe,groupe_users where groupe_users.nro_groupe = groupe.nro_groupe and users.groupe=groupe.nro_groupe";
			//$sql = "select users.login, users.password, groupe.nom_groupe, groupe.description, users.actif from users,groupe_users, groupe where users.login=groupe_users.login and groupe.nro_groupe=groupe_users.nro_groupe and users.actif=1";
			$sql="select * from groupe";
			include("connexion.php");
			$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
			mysql_select_db($database_name);
			$row = 0;
			$id = mysql_query($sql, $res);
			while (mysql_fetch_row($id))
			{
			    $login = mysql_result($id, $row, 0);
			    $nom_groupe = mysql_result($id, $row, 1);
			    $description = mysql_result($id, $row, 2);
			    $row++;
			    echo "<tr><td>" . $login . "</td><td>" . $nom_groupe . "</td><td>" . $description . "</td><td><a href='index.php?action=supp_utilisateur&login=" . $login . "'><img src=\"images/corbeille.gif\"></a></td><td><a href='index.php?action=desactiver&utilisateur=". $login ."'>Désactiver</a></td></tr>";
			}
			@mysql_free_result($id);
			mysql_close($res);
		    ?>

		</table>
	    </fieldset>
