<?php
session_start();
$monTab = array();
error_reporting(0);

function parcourirArborescence($repertoire)
{
    if (!preg_match('#[/|' . preg_quote(DIRECTORY_SEPARATOR) . ']$#', $repertoire))
    {
        $repertoire .= DIRECTORY_SEPARATOR;
    }
    if (@ $dh = opendir($repertoire))
    {
        while (($fichier = readdir($dh)) != FALSE)
        {
            if ($fichier == '.')
            {
                continue; // Skip it
            }
            if ($fichier == '..')
            {
                continue; // Skip it
            }
            echo "<a class='bouton' href='index.php?action=referencer&document=" . $repertoire . $fichier . "'>REFENCER</a>" . $repertoire . $fichier . "<br>"; // Affichage
            if (is_dir($repertoire . $fichier))
            {
                parcourirArborescence($repertoire . $fichier); // Récursivité
            } else
            {
                // Ce n'est pas un répertoire
            }
        }
        @ closedir($dh);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <title>GED</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        <link href="tree.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="./jQuery/jquery-1.7.min.js"></script>
        <script src="./jQuery/jquery-ui.min.js"></script>
        <script src="./jQuery/jquery.godtree.js"></script>

        <link rel="stylesheet" type="text/css" href="./jQuery/jquery-ui.css" />
        <script src="./jQuery/jquery-1.10.2.js"></script>
        <script src="jQuery/sample.js"></script>
        <script src="./js/datetimepicker/jquery.datetimepicker.js"></script>
        <script src="./js/jquery-ui.js"></script>
        <script src="./jQuery/jquery.maskedinput.js"></script>
        <script src="./js/jquery.treeview.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#tree_link*").clone().appendTo($("#bloc-fichiers"));
                $("#tree").treeview({
                    collapsed: true,
                    animated: "fast",
                    control: "#sidetreecontrol",
                    prerendered: true,
                    persist: "location"
                });
                $(document).ready(function() {
                    var tree = $('#tree').goodtree({'setFocus': $('.focus')});
                });
            })

        </script>

        <link rel="stylesheet" href="treeview.css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
            <script src="jquery/jquery-1.10.2.js"></script>
            <script src="jquery/jquery-ui-10.4/jquery-ui.js"></script>
            <!--            <link rel="stylesheet" href="/resources/demos/style.css">-->


            <script type="text/javascript">

                $(document).ready(function() {


                $('#all').click(function() {

                $('.tree li').each(function() {
                $(this).toggleClass('active');
                        $(this).children('ul').slideToggle('fast');
                });
                });
                        $("#datepicker").datepicker({dateFormat: "dd-mm-yy"});
                        $("#datepicker").datepicker();
                        $("#datepicker1").datepicker({dateFormat: "dd-mm-yy"});
                        $("#datepicker1").datepicker();
                        $("#datepicker2").datepicker({dateFormat: "dd-mm-yy"});
                        $("#datepicker2").datepicker();
                        $("#version").mask("9.9.9.9");
                        $("#spinner").spinner({
                step: 0.01,
                        numberFormat: "n"
                });
                        $("#culture").change(function() {
                var current = $("#spinner").spinner("value");
                        Globalize.culture($(this).val());
                        $("#spinner").spinner("value", current);
                });
            </script>


            <script src="http://code.jquery.com/jquery-1.7.2.min.js" type="text/javascript" ></script>
            <script src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
            <script src="js/sample.js"></script>
            <script src="./js/jquery-1.9.1.min.js"></script>
            <script src="./js/goodtree.plugin.js"></script>


    </head>
    <body>
        <div id="wrap">
            <div id="masthead">
                <h1>Gestion Electronique de Documents</h1>

            </div>
            <div id="menucontainer" >
                <div id="menu">
                    <ul>
                        <li><a href="index.php?action=ajouter_fichier">Ajouter un fichier</a></li>
                        <!--<li><a href="index.php?action=affecter-droits">Affecter des droits</a></li>-->
                        <li><a href="index.php?action=affichageHierarchique">Hiérarchie des fichiers</a></li>

                        <!--<li><a href="index.php?action=televersement">Téléverser des fichiers</a></li>-->
                        <li><a href="index.php?action=verrous">Verrouiller des fichiers</a></li>
                        <li><a href="index.php?action=regroupements">Regroupements des fichiers</a></li>
                        <li><a href="index.php?action=peremption">Péremption de fichiers</a></li>
                        <li><a href="index.php?action=workflow">Workflow</a></li>
                        <li><a href="index.php?action=recherche">Recherche avancée</a></li>
                        <li><a href="index.php?action=utilisateurs">Utilisateurs et groupes</a></li>
                    </ul>
                </div>
            </div>
            <div id="container">

                <div id="sidebar">

                    <img src="images/rose.jpg" alt="" />

                    <div id="navcontainer">

                    </div>
                    <form action="index.php" method="post">
                        <fieldset>
                            <legend>Recherche</legend>
                            <div> <span>
                                    <label for="txtsearch"> <img src="images/search.gif" alt="search" /> Recherche</label>
                                </span> <span>
                                    <input type="text" value="" name="txtsearch" title="Text input: search" id="txtsearch" size="25" />
                                    <input type="submit" name="recherche" value="recherche" />
                                </span> </div>
                        </fieldset>
                        <fieldset>
                            <legend>Connexion</legend>
                            <div> <span>
                                    <label for="txtsearch">  Login</label>
                                </span> <span>
                                    <input type="text" value="" name="txtLogin" title="" id="login" size="25" />


                                </span>
                                <span>
                                    <label for="txtsearch">  Password</label>

                                    <input type="password" value="" name="txtPass" title="" id="pass" size="25" />
                                    <input type="submit" name="conexion" value="connexion" />

                            </div>
                        </fieldset>
                    </form>
                </div>
                <div id="content">
                    <h3>Bienvenue sur notre gestion documentaire</h3>
                    <?php
                    if (($_GET["action"] == "supp_utilisateur") && (isset($_GET["login"])))
                    {
                        // echo "Action : ".$_GET["action"]."<br>Login".$_GET["login"];
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "delete from users where login='" . $_GET["login"] . "';";
                        echo $sql;
                        $id = mysql_query($sql, $res);
                    }
                    if (empty($_GET["action"]))
                    {
                        include("accueil.html");
                    }

                    switch ($_GET["action"])
                    {
                        case "ajouter_fichier" :
                            include("ajouter_fichier.php");
                            break;
                        case "affecter-droits" :
                            include "affecter-droits.php";
                            break;
                        case "lire_repertoire" :
                            include "lire_repertoire.php";
                            break;
                        case "referencer" :
                            $_SESSION["fichier"] = $_GET["document"];
                            include "referencer.php";
                            break;
                        case "verrous" :
                            include "verrous.php";
                            break;
                        case "regroupements" :
                            include "regroupements.php";
                            break;
                        case "peremption" :
                            include "peremption.php";
                            break;
                        case "utilisateurs" :
                            include("utilisateurs.php");
                            break;
                        case "workflow" :
                            //echo "toto";
                            include("workflow.php");
                            break;
                        case "affichageHierarchique" :
                            //echo "toto";
                            include("affichageHierarchique.php");
                    }
                    if (($_GET["action"] == "details") && isset($_GET["nro"]))
                    {

                        include("details.php");
                    }
                    if (($_GET["action"] == "hierarchie") && ($_GET["voir"] == "voir"))
                    {
                        echo '<SCRIPT LANGUAGE="JavaScript">
                                document.location.href="index.php?action=details&nro=' . $_GET["nro"] . '"
                              </SCRIPT>';
                        //header("Location: index.php?action=details&nro=".$_GET["nro"]);
                    }

                    if ($_POST["valider_user"] == "valider")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "insert into users values('" . $_POST["login"] . "','" . $_POST["pass"] . "',0);";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "L'utilisateur " . strtoupper($_POST["login"]) . " est bien créé<br><a href=\"index.php?action=utilisateurs\">retour</a>";
                    }

                    if ($_POST["valider_groupe"] == "valider")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "insert into groupe(nom_groupe,description) values('" . strtoupper($_POST["groupe"]) . "','" . $_POST["description_groupe"] . "');";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "Le groupe " . strtoupper($_POST["groupe"]) . " est bien créé<br><a href=\"index.php?action=utilisateurs\">retour</a>";
                    }

                    if ($_POST["valider_aff_groupe"] == "valider")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "insert into groupe-users(nro_groupe,login) values('" . $_POST["utilisateur"] . "','" . $_POST["aff_groupe"] . "');";
                        echo "L'utilisateur a bien changé de groupe<br><a href=\"index.php?action=utilisateurs\">retour</a>";
                    }
                    if (($_GET["action"] == "activer"))
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "update users set actif=1 where login='" . $_GET["utilisateur"] . "'";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "L'utilisateur a bien été activé<br><a href=\"index.php?action=utilisateurs\">retour</a>";
                    }
                    if (($_GET["action"] == "desactiver"))
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "update users set actif=0 where login='" . $_GET["utilisateur"] . "'";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "L'utilisateur a bien été desactivé<br><a href=\"index.php?action=utilisateurs\">retour</a>";
                    }
                    if ($_POST["valider_etat"] == "Valider")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "insert into workflow values('" . $_POST["nro_ordre"] . "','" . $_POST["nom_ordre"] . "')";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "Le nouvel état est bien créé";
                    }
                    if (($_GET["action"]) == "supp_workflow")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "delete from workflow where nro_etat='" . $_GET["etat"] . "'";
                        $id = mysql_query($sql, $res);
                        @mysql_free_result($id);
                        mysql_close($res);
                        echo "Le workflow n°" . $_GET["etat"] . " est supprimé";
                    }
                    if ($_POST["referencer"] == "valider")
                    {
                        $_SESSION["nom_fichier"] = $_POST["nom_fichier"];
                        $_SESSION["chemin="] = $_POST["chemin_fichier"];
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $t = explode("-", $_POST["date_creation"]);
                        $dc = $t[2] . "-" . $t[1] . "-" . $t[0];
                        $t = explode("-", $_POST["date_modification"]);
                        $dm = $t[2] . "-" . $t[1] . "-" . $t[0];
                        $t = explode("-", $_POST["date_expiration"]);
                        $de = $t[2] . "-" . $t[1] . "-" . $t[0];
                        $sql6 = "insert into fichiers(nom,chemin,type_mime,date,taille,date_creation,date_modification,version,date_expiration,verrouille,notes,workflow) ";
                        $sql6 .= " values ('" . $_POST["nom_fichier"] . "','" . $_POST["chemin_fichier"] . "','" . $_POST["type_mime"] . "','" . date("Y-m-j h:m:s") . "'," . $_POST["tailleFic"] . ",'" . $dc . "','" . $dm . "','" . $_POST["version"] . "','" . $de . "','" . $_POST["verrouillage"] . "','" . $_POST["note"] . "',100);";
                        $id6 = mysql_query($sql6, $res);
                        $nro_fic = mysql_insert_id();
                        $_SESSION["nro_fic"] = $nro_fic;
                        //Recuperation des mots clefs

                        $mots = explode(',', $_POST["mots-clefs"]);
                        $i = 0;
                        foreach ($mots as $unMot)
                        {
                            /**
                             * Methode : 
                             * 1. On insère le fichier dans la table fichiers
                             * 2. Il faut insérer les infos fichiers dans la base
                             * 3. On renotre les mots clefs associés
                             * 
                             */
                            //On rentre les mots clefs dans la base
                            $sql = "SELECT count(mot) FROM `mots_clefs` WHERE   mot=\"" . trim($unMot) . "\"";
                            $id2 = mysql_query($sql, $res) or die("erreur comptage mot");
                            $nb = mysql_result($id2, 0, 0);

                            if ($nb == 0)
                            {
                                //Il faut tester si le mot est déjà dans la base. Si oui, recupérer la PK dans le tableau
                                $sql1 = "select mot,nro_mots from  mots_clefs where mot='" . trim(utf8_decode($unMot)) . "';";
                                $id7 = mysql_query($sql1, $res) or die("recherche impossible de l'existence deja créee du mot dans la base");
                                $nb = mysql_num_rows($id7);
                                //Si le mot existe dans la base
                                if ($nb == 0)
                                {
                                    $sql1 = "insert into mots_clefs(mot) value('" . trim(utf8_decode($unMot)) . "');";
                                    $id1 = mysql_query($sql1, $res);
                                    $monTab[$i][0] = trim(utf8_decode($unMot));
                                    $monTab[$i][1] = mysql_insert_id();
                                    $a = mysql_insert_id();
                                } else
                                {
                                    $sql1 = "SELECT nro_mot from mots_clef where mot='" . trim(utf8_decode($unMot)) . "'";
                                    $id1 = mysql_query($sql1, $res);
                                    $monTab[$i][0] = mysql_result($id1, 0, "mot");
                                    $monTab[$i][1] = mysql_result($id1, 0, "nro_mots");
                                    $a = mysql_result($id1, 0, "nro_mots");
                                }
                                $sql = "insert into fichier_mots_clefs(nro_fichier,nro_mots) values('" . $nro_fic . "','" . $a . "');";

                                $id2 = mysql_query($sql, $res) or die("L'insertion du mot clef a échoué : " . $sql . mysql_errno() . " " . mysql_error());

                                $i++;
                            }
                        }
                        
                        echo "Insertion effectuée. Veuillez ranger désormais le fichier : ";
                        include("dhtmlgoodies-tree.html.php");
                        @mysql_free_result($id1);
                        @mysql_free_result($id);
                        mysql_close($res);
                    }
                    if ($_POST["verrouiller"] == "Verrouiller")
                    {

                        $i = 0;
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        echo "Le verrouillage des fichiers sélectionnés est bien effectué. Les fichiers suivants sont verrouillés : ";
                        echo "<ul>";
                        foreach ($_POST["nom_fichier"] as $monFic)
                        {
                            include("connexion.php");
                            $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                            mysql_select_db($database_name);
                            $sql = "update fichiers set verrouille=1 where nro_fichier=" . $_POST["nom_fichier"][$i];

                            $i++;
                            $id = mysql_query($sql, $res) or die($sql . " - Erreur  : " . mysql_errno() . " " . mysql_error());
                            $sql = "select nom from fichiers where nro_fichier=" . $monFic;
                            $id = mysql_query($sql, $res) or die($sql . " - Erreur  : " . mysql_errno() . " " . mysql_error());
                            $nom = mysql_result($id, 0, 0);
                            echo "<li>Le fichier <span style=\"color:red;\">" . $nom . "</span> est verrouillé</li>";
                        }
                        echo "</ul>";
                        mysql_free_result($id);
                        mysql_close($res);
                    }

                    if ($_POST["valider_repertoire"] == "valider")
                    {
                        $nniveau = $_POST["niveau"] + 1;
                        include("connexion.php");

                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);

                        $sql = "select max(ordre) from noeud";
                        $id = mysql_query($sql, $res) or die("erreur ordre");
                        $max = mysql_result($id, 0, 0);
                        $nrepertoire = $max + 1;
                        $niveau = $_GET["niveau"] + 1;
                        //1. On commence par renumeroter tous les repertorie strictement superieurs a celui que l'on ajoute
                        //2. On fait l'isertion au "trou" manquant
                        for ($i = $max; $i <= $_POST["ordre"]; $i--)
                        {
                            $sql = "update noeud set ordre=" . ($i + 1) . " where ordre=" . $i;
                            echo $sql . "<br>";
                            $id = mysql_query($sql, $res) or die("Renumerotation impossible : " . mysql_error());
                        }
                        //Maintenant que la renumerotation est faite, on insere l'element
                        $sql = "insert into noeud values('" . $_POST["repertoire"] . "','" . $nrepertoire . "'," . $_POST["niveau"] . ')';
                        $id = mysql_query($sql, $res) or die($sql . " - erreur insertion repertoire : " . mysql_errno() . " " . mysql_error());
                        //Renumerotation a faire

                        mysql_free_result($id);
                        mysql_close($res);
                        echo $sql . " Le répertoire " . $name . " est créé. <a href=\"index.php?action=hierarchie\">Retour</a>";
                    }
                    if ($_GET["action"] == "supprimer")
                    {
                        include("connexion.php");

                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        //recherche du premier

                        $sql = "select libelle, ordre, niveau from noeud where niveau=" . $_GET["niveau"] . ' order by ordre';

                        $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                        $row = 0;
                        $oldniveau = "";
                        while (mysql_fetch_row($id))
                        {

                            $ordre = mysql_result($id, $row, "ordre");
                            $libelle = mysql_result($id, $row, "libelle");
                            $niveau = mysql_result($id, $row, "niveau");
                            $row++;
                            if ($oldniveau <> $niveau)
                            {
                                $oldniveau = $niveau;
                            }
                        }
                        /* $sql = "select max(niveau) from noeud";
                          echo $sql . "<br>";
                          $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                          $niveau_depart = mysql_result($id, 0, 0);
                          $sql = "select niveau from noeud where niveau>=" . $niveau_depart . " order by niveau";
                          echo $sql;
                          $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                          $suivant = mysql_result($id, 0, 0);
                          echo "Suivant : " . $suivant;
                          for ($i = $_GET["niveau"]; $i < $niveau_depart; $i++) {
                          $sql = "delete from noeud where niveau=" . $i . " and ordre between " . $_GET["ordre"] . " and " . $suivant . ";";
                          echo "<br>" . $sql;
                          $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                          }
                          echo "Suppression effectuée<a href=\"index.php?action=hierarchie\">Retour</a>";
                         */
                        mysql_free_result($id);
                        mysql_close($res);
                    }

                    if ($_POST["expirer"] == "Expirer")
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);

                        foreach ($_POST["fichier"] as $monFic)
                        {

                            $sql = "update fichiers set date_expiration='" . date('Y-m-d') . "' where nro_fichier='" . $monFic . "';";
                            echo $sql;
                            $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                            $sql = "select nom from fichiers where nro_fichier='" . $monFic . "';";

                            $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                            $nomFichier = mysql_result($id, 0, 0);
                            echo "Le fichier <span style=\"color:red;\">" . $nomFichier . "</span> est désormais expiré.<br>";
                        }
                        mysql_free_result($id);
                        mysql_close($res);
                    }

                   
                    
                    if (($_GET["action"] == "hierarchie") && ($_GET["creer"] == "creer"))
                    {
                        include("connexion.php");
                        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                        mysql_select_db($database_name);
                        $sql = "select nom from hierarchie where pk=\"" . $_GET["nro"] . "\"";

                        $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                        $famille = mysql_result($id, 0, 0);

                        if (isset($_GET["nro"]) && isset($_SESSION["fichier"]))
                        {
                            //Tester si lr fichie est deja affecté a la famille. 
                            //Si oui, on fait rien, 
                            //si non, on fait l'ajout
                            $sql = "select count(*) from fichiers_hierarchie where nro_fichier=\"" . $_SESSION["nro_fic"] . "\" and nro_groupe=" . $_GET["nro"];
                            echo $sql."<br><br>";
                            $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                            $nombre = mysql_result($id, 0, 0);
                           // echo "Il y a $nombre resultats";
                            if ($nombre==0)
                            {
                                $sql = "insert into fichiers_hierarchie(nro_fichier,nro_groupe,alias) values('" . $_SESSION["nro_fic"] . "','" . $_GET["nro"] . "',0)";
                            } else
                            {
                                $sql = "insert into fichiers_hierarchie(nro_fichier,nro_groupe,alias) values('" . $_SESSION["nro_fic"] . "','" . $_GET["nro"] . "',1)";
                           }
                            
                            $id = mysql_query($sql, $res) or die(mysql_errno($res) . ": " . mysql_error($res) . "\n");
                            mysql_free_result($id);
                            mysql_close($res);
                            //Selon le cas si ca a été un insert ou pas, le message est différent
                            if (substr($sql,0,1) == 'i')
                            {
                                echo "<div id=\"resultat\">L'insertion du fichier est bien prise en compte. Si vous souhéitez créer des alias dans d'autre répertoires, veuillez choisi un autre répertoire.</div>";
                            }
                            else
                            {
                                echo "La création de cet alias s'est déroulée correctement";
                            }
                            echo "Le fichier <span style=\"color:red;\">" . $_SESSION["fichier"] . "</span> est bien affecté à la famille <span style=\"color:red;\">" . $famille . "</span>";
                            echo "<br>ce fichier a été referencé ".$nombre." fois (fichier d'origine + alias)";
                        
                            ECHO "<br><br><a href=\"index.php\" style=\"font-weight:bold;background-color:green;color:white;padding:20px;border-radius:5px;\">TERMINE</a>";
                            
                            }
                    }
                    ?>

                </div>
            </div>
            <div id="footer"> <a href="http://www.free-css.com/">homepage</a> | <a href="mailto:denise@mitchinson.net">contact</a> | <a href="http://validator.w3.org/check?uri=referer">html</a> | <a href="http://jigsaw.w3.org/css-validator">css</a> | &copy; 2007 Anyone | Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a><br/>
                L'infographie est sous licence <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 License</a> </div>
        </div>
    </body>
</html>
