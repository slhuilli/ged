Choisir les fichiers à expirer

<div style="border:2px #000 dotted;padding-left: 25px">
    <form name="saisie" method="post" action="index.php" >
        <?php
   
        
        /**
         * Une expiration de fichier correspond à un fichier que l'on souhaite 
         * "archiver" car il n'est plus d'actualité, tout en le basculant 
         * comme archive. Concrètement, il faut tester si  la date du jour est 
         * superieure ou inférieure à la date d'expiration du fichier de la table
         * fichier         
         * Il n'est pas possible de périmer un fichier verrouillé !          
         */
        
                    include("connexion.php");
                    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                    mysql_select_db($database_name);
                    $row = 0;
                    $sql = "select nro_fichier,nom, taille, version,chemin from fichiers where verrouille=0";
                    $id = mysql_query($sql, $res);


                    while (@mysql_fetch_row($id)) {
                        $nro_fichier =  mysql_result($id, $row, "nro_fichier");
                        $nom_fichier = mysql_result($id, $row, "nom");
                        $taille = mysql_result($id, $row, "taille");
                        $version = mysql_result($id, $row, "version");
                        $chemin = mysql_result($id, $row, "chemin");
                        if ($row % 2 == 0)
                        {
                            $couleur='#EFF8FB';
                        }
                        else
                        {
                            $couleur='#FBEFF2';
                        }
                        echo '<div style="background-color:'.$couleur.';width:100%;">';
                        echo '<INPUT type="checkbox" name="fichier[]" value="' . $nro_fichier . '">' . $nom_fichier ."(".$taille." octets) - Version : ".$version." stocké sur ".$chemin. "<br>";
                        echo '</div>';
                        $row++;
                    }
        ?>
        <input type="submit" name="expirer" value="Expirer">
    </form>
</div>
