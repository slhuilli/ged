<html><head>	<style type="text/css">
            a{
                text-decoration:none;
                font-family:arial;
                font-size:0.8em;
            }
            p{
                font-family:arial;
                padding-left:5px;
            }
        </style>
    </head>
    <body>
        <p>The tree below is based on an unordered list which makes the tree fast and search engine friendly. PHP is required for this script.</p>
        <a href="#" onclick="expandAll();
                return false">Expand all nodes</a><br>
        <a href="#" onclick="collapseAll();
                return false">Collapse all nodes</a><br>
        <style type="text/css">
            /*

            This is one of the free scripts from www.dhtmlgoodies.com
            You are free to use this script as long as this copyright message is kept intact

            (c) Alf Magne Kalleland, http://www.dhtmlgoodies.com - 2005

            */
           
            .activeNodeLink{
                background-color: #316AC5;
                color: #FFFFFF;
                font-weight:bold;
            }
        </style>

     
        <?php
        $sql = "select NFM_LIB,niveau from new_famille order by ordre";
        include("connexion.php");
        $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
        mysql_select_db($database_name);
        $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
        $row = 0;
        $oldniveau=0;
        echo '<div id="dhtmlgoodies_tree">'."\n";
        echo "\t\t\t".'<ul id="dhtmlgoodies_topNodes">'."\n";
      
        while (mysql_fetch_row($result)) {
            
            $libelle = mysql_result($result, $row, "NFM_LIB");
            $niveau = mysql_result($result, $row, "niveau");
            if ($oldniveau == $niveau) {
                echo "\t\t\t\t".'<li class="tree_node" id="node_'.$row.'">'."\n";
                echo "\t\t\t\t\t".'<img id="plusMinus' . $row . '" class="tree_plusminus" src="images/dhtmlgoodies_plus.gif">'."\n";
                echo "\t\t\t\t\t".'<img src="images/dhtmlgoodies_folder.gif">'."\n";
                echo "\t\t\t\t\t".'<a class="tree_link" href="#">' . $libelle . '</a>'."\n";
            }
            if (($niveau > $oldniveau) && ($row>0)) {
                echo "\t\t\t\t\t".'<ul>'."\n";
                echo "\t\t\t\t\t".'<li class="tree_node">'."\n";
                echo "\t\t\t\t\t".'<img class="tree_node">'."\n";
                echo '    <img id="plusMinus' . $row . '" class="tree_plusminus" src="images/dhtmlgoodies_plus.gif">'."\n";
                echo '    <img src="images/dhtmlgoodies_folder.gif">'."\n";
                echo '<a class="tree_link" href="#">' . $libelle . '</a>'."\n";
                echo "</ul>"."\n";
            }
            if ($niveau < $oldniveau) {
                //On commmence par fermer le niveau courant
                echo "\t\t\t\t".'</li>'."\n";
                echo '   <li class="tree_node" id="node_1">'."\n";
            }

            $oldniveau = $niveau;
            $row++;
        }
       // echo '   </li>';
        echo "\t\t\t".'</ul>'."\n";
        echo ' </div>'."\n";
        @mysql_free_result($id);
        mysql_close($res);
        ?>

    </body>
</html>