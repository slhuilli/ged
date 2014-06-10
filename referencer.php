<?php
    $chemin = $_SESSION["fichier"];
    $fichier = basename($chemin);
?>


<form name="fichiers" method="post" action="index.php">
    <div id="Tmain">
        <div style="width: 100%;">
            <div class="Tmenu">
                Nom de fichier :
            </div>
            <div class="Tcontenu">
                <span style="color:red;"> <?= $fichier ?> </span>
            </div>
        </div>
        
        <div style="width: 100%;">
            <div class="Tmenu">
                Chemin complet :
            </div>
            <div class="Tcontenu">
                <?= $chemin ?> 
                <input name="nom_fichier" type="hidden" value="<?= $fichier; ?>">
                <input name="chemin_fichier" type="hidden" value="<?= $chemin; ?>">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Type Mime :
            </div>
            <div class="Tcontenu">
                <input name="type_mime" type="hidden" value="<?= mime_content_type($chemin); ?>"><span style="color:red;"><?= mime_content_type($chemin); ?></span>
            </div>
        </div>

        <div style="width: 100%;">
            <div class="Tmenu">
                Date de dernier accès :
            </div>
            <div class="Tcontenu">
                <input name="dernier_acces" type="hidden" value="<?= fileatime($chemin); ?>"><span style="color:red;"><?= date('d/m/Y H:i:s', fileatime($chemin)); ?></span>
            </div>
        </div>

        <div style="width: 100%;">
            <div class="Tmenu">
                Date de création :            
            </div>
            <div class="Tcontenu">
                <input type="text" id="datepicker" name="date_creation">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Date de Modification:
            </div>
            <div class="Tcontenu">
                <input type="text" id="datepicker1" name="date_modification">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Date d'expiration: 
            </div>
            <div class="Tcontenu">
                <input type="text" id="datepicker2" name="date_expiration">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Version :
            </div>
            <div class="Tcontenu">
                <input type="text" id="version" name="version">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Taille :
            </div>
            <div class="Tcontenu">
                <?php
                $a = filesize($chemin);
                echo "<input name=\"tailleFic\" type=\"hidden\" value=\"" . $a . "\">";
                echo "<span style=\"color:red;\">" . $a . "</span> octets";
                ?>
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Groupes autorisés à lire ce fichier :
            </div>
            <div class="Tcontenu">
                <div class="liste_fichiers">
                    <?php
                    $sql = "select nom_groupe,nro_groupe from groupe order by nom_groupe";
                    include("connexion.php");
                    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
                    mysql_select_db($database_name);
                    $row = 0;
                    $id = mysql_query($sql, $res);


                    while (@mysql_fetch_row($id)) {
                        $nom_groupe = mysql_result($id, $row, 0);
                        $nro_groupe = mysql_result($id, $row, 1);
                        echo '<INPUT type="checkbox" name="groupes[]" value="' . $nro_groupe . '">' . $nom_groupe . "<br>";
                        $row++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Verrouillage du fichier:
            </div>
            <div class="Tcontenu">
                <input type="checkbox" id="verrouillage" name="verrouillage" value="1">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Mots-clefs séparés par des virgules :
            </div>
            <div class="Tcontenu">
                <input type="text" name="mots-clefs" value="">
            </div>
        </div>
        <div style="width: 100%;">
            <div class="Tmenu">
                Description, note... : 
            </div>
            <div class="Tcontenu">
                <textarea name="note" style="width:200px;height:100px;" ></textarea>
            </div>
        </div>

             
    </div>
    <input type="submit" name="referencer" value="valider">
</form>