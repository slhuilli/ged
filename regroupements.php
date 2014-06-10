Choisir les fichiers à regrouper

<div style="border:2px #000 dotted;padding-left: 25px">
    <form name="saisie" method="post" action="index.php" >
        Nom du regroupement : <input type="text" name="regroupement" value="">
     
    <?php
    $dossier="DOCUMENTS_NON_TRIES";
    function listeDossier($dossier) // Fonction qui liste un dossier de façon récursive
{
    if (is_dir($dossier))
    {
        if($dossierOuvert=opendir($dossier))
        {
            echo "<ul style=\"padding-left:5px;list-style-image:url('images/iconFolder.gif')\";>";
            while(($fichier=readdir($dossierOuvert))!== false)
            {
                if ($fichier==".." || $fichier=="." || $fichier=="index.php")
                {
                    continue;
                }
                else
                {
                     
                    if(is_dir("$dossier/$fichier"))
                    {
                       echo "<li>$fichier</li>";
			
                        listeDossier("$dossier/$fichier");
			
                    }
                    else
                    {
                        echo "<input type=\"checkbox\" name=\"fichier[]\" value=\"".$dossier."/".$fichier."\" >$fichier<br>";
                    }
                     
                }
            }
            echo "</ul>";
        }
    }
    else
    {
        echo "Erreur, le paramètre précisé dans la fonction n'est pas un dossier!";
    }
}
listeDossier($dossier);
    ?>
    </form>
</div>
