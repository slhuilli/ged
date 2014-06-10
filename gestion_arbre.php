<?php

function recherche_toutes_feuilles() {
    // Rechercher toutes les feuilles
    $montab = array();
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BD - NFM_BG = 1';
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $row = 0;

    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;

    while (mysql_fetch_row($result)) {
        $NFM_BG = mysql_result($result, $row, 0);
        $NFM_BD = mysql_result($result, $row, 1);
        $NFM_LIB = mysql_result($result, $row, 2);
        $montab[$row]['BG'] = $NFM_BG;
        $montab[$row]['BD'] = $NFM_BD;
        $montab[$row]['LIB'] = $NFM_LIB;
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function feuilles_sous_un_element_de_reference($bordGauche, $bordDroit) {
    //Toutes les feuilles sous un élément de référence
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $montab = array();
    $sql = 'SELECT * FROM  NEW_FAMILLE WHERE  NFM_BD - NFM_BG = 1 AND NFM_BG > ' . $bordGauche . ' AND NFM_BD < ' . $bordDroit;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);

        $montab[$row]['nfm_bd'] = $NFM_BD;
        $montab[$row]['nfm_lib'] = $NFM_LIB;
        $row++;
    }
    mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function rechercher_tous_les_noeuds() {
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    //Rechercher tous les noeuds
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BD - NFM_BG > 1 ';
    $row = 0;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function lister_tous_les_noeud_sous_un_elt_de_reference($bord_gauche,$bord_droit) {
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    //Tous les noeuds sous un élément de référence
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BD - NFM_BG > 1 AND NFM_BG > '.$bord_gauche.' AND NFM_BD < '.$bord_droit;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);        
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function afficher_sous_arbre($bord_gauche, $bord_droit) {
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    //Tous les éléments dépendant d'un élément de référence (sous arbre)
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BG > ' . $bord_gauche . ' AND NFM_BD < ' . $bord_droit;
    $row = 0;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function complement_sous_arbre($bord_gauche, $bord_droit) {
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BG > ' . $bord_gauche . ' OR NFM_BD < ' . $bord_droit;
    $row = 0;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function peres_d_un_element_de_reference($bord_gauche, $bord_droit) {
    //Tous les pères d'un élément de référence
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BG > ' . $bord_gauche . ' OR NFM_BD < ' . $bord_droit;


    $sql = 'SELECT * FROM   NEW_FAMILLE WHERE  NFM_BG < ' . $bord_gauche . ' AND NFM_BD > ' . $bord_droit;
    $row = 0;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    while (mysql_fetch_row($result)) {
        $montab[$row]['nfm_bg'] = mysql_result($result, $row, 0);
        $montab[$row]['nfm_bd'] = mysql_result($result, $row, 1);
        $montab[$row]['nfm_lib'] = mysql_result($result, $row, 2);
        $row++;
    }
    @mysql_free_result($id);
    mysql_close($res);
    return $montab;
}

function comptes_feuilles() {
    //Compter les feuilles
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = 'SELECT COUNT(*) AS FEUILLES FROM NEW_FAMILLE WHERE NFM_BG = NFM_BD -1';
    $row = 0;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $nb_feuilles = mysql_result($result, $row, 0);
    @mysql_free_result($id);
    mysql_close($res);
    return $nb_feuilles;
}

function compte_noeuds() {
    //Compter les noeuds
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = 'SELECT COUNT(*) AS NOEUDS FROM NEW_FAMILLE WHERE NFM_BG <> NFM_BD -1';
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $row = 0;
    $nb_noeuds = mysql_result($result, 0, 0);
    @mysql_free_result($id);
    mysql_close($res);
    return $nb_noeuds;
}

//Insertion
function insertion($noeud_courant,$valeur_texte) {
    /* $noeud_courant est la feuille a laquelle rattacher a feuille que 
      l'on créee. Une fois la nouvelle feuille créée, $noeud_courant
      devient, à fortiori, la mere du nouveau noeud */
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $row = 0;
    $sql = 'UPDATE NEW_FAMILLE SET NFM_BD = NFM_BD + 2 WHERE NFM_BD >= ' . $noeud_courant;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = "UPDATE NEW_FAMILLE SET NFM_BG = NFM_BG + 2 WHERE NFM_BG >=  " . $noeud_courant;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = "INSERT INTO NEW_FAMILLE (NFM_BG, NFM_BD, NFM_LIB) VALUES (" . $noeud_courant . ", " . ($noeud_courant + 1) . ", 'Roller')";
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);    
    @mysql_free_result($id);
    mysql_close($res);
}

//Suppression d'un élément de cette arborescence
function suppression_element_de_l_arborescence_sans_trous($bord_droit_noeud_a_supprimer, $bord_gauche_noeud_a_supprimer) {
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = "DELETE FROM NEW_FAMILLE WHERE  NFM_BG >= " . $bord_gauche_noeud_a_supprimer . " AND NFM_BD <= " . $bord_droit_noeud_a_supprimer;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = "UPDATE NEW_FAMILLE SET NFM_BG = NFM_BG - 2 WHERE  NFM_BG >= " . $bord_gauche_noeud_a_supprimer;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = "UPDATE NEW_FAMILLE SET    NFM_BD = NFM_BD - 2 WHERE  NFM_BD >= " . $bord_droit_noeud_a_supprimer;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    @mysql_free_result($id);
    mysql_close($res);
}

function suppression_sous_arbre_avec_sans_trous($bord_gauche, $bord_droit) {
//Suppression d'un sous-arbre
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = "DELETE FROM NEW_FAMILLE WHERE  NFM_BG >= " . $bord_gauche . " AND NFM_BD <= " . $bord_droit;
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = " UPDATE NEW_FAMILLE SET NFM_BD = NFM_BD - " . ($bord_droit - $bord_gauche + 1) . " WHERE NFM_BD >= " . $bord_gauche; //35 - 22 + 1, soit 14
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $sql = "UPDATE NEW_FAMILLE SET NFM_BG = NFM_BG - " . ($bord_droit - $bord_gauche + 1) . " WHERE NFM_BG > " . $bord_gauche; //35 - 22 + 1, soit 14
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    @mysql_free_result($id);
    mysql_close($res);
}

function tableau_niveau()
{
    $niveaux = array();
  //Renvoie un tableau avec, pour chaque élément, son niveau (sa profondeur) dans la hierarchie
    include("connexion.php");
    $res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
    mysql_select_db($database_name);
    $sql = "SELECT node.NFM_LIB, (count( parent.NFM_LIB ) -1) AS depth FROM new_famille AS node, new_famille AS parent WHERE node.NFM_BG BETWEEN parent.NFM_BG AND parent.NFM_BD GROUP BY node.NFM_LIB";
    $result = mysql_query($sql, $res) or die("erreur : " . mysql_errno() . " - " . mysql_error() . " - " . $sql);
    $i=0;
    while (mysql_fetch_row($result))
    {
        $niveaux[$i][0] = mysql_result($result, $i,0);
        $niveaux[$i][1] = mysql_result($result, $i,1);
        
        //echo mysql_result($id, $i,0)." ".mysql_result($id, $i,1);
        $i++;
    }
    @mysql_free_result($id);
    mysql_close($res); 
  
    return $niveaux;
}


?>
