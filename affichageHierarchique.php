<?php
echo '<ul>';
$sql = "select concat(repeat('<ul><li>', (count(parent.NFM_LIB)-1)),node.NFM_LIB,repeat('</li></ul>', (count(parent.NFM_LIB)-1))),  (count(parent.NFM_LIB)-1) as depth, node.NFM_BG, node.NFM_BD
from new_famille as node, new_famille as parent
where node.NFM_BG between parent.NFM_BG and parent.NFM_BD
group by node.NFM_LIB
order by node.NFM_BG";
include("connexion.php");
$res = mysql_connect($hostname, $db_username, $db_password) or die("Connexion echouée");
mysql_select_db($database_name);
$id = mysql_query($sql, $res);
$row = 0;
while (mysql_fetch_row($id))
{
    $NFM_BG = mysql_result($id, $row, 0);
    $NFM_BD = mysql_result($id, $row, 1);
    $NFM_LIB = mysql_result($id, $row, 2);
    $row++;
    //echo '<li>'.utf8_encode($NFM_BG) . " - " . $NFM_BD . " - " . $NFM_LIB.'</li>'."\n";
    echo '<li>'.utf8_encode($NFM_BG) .'</li>'."\n";
}
mysql_free_result($id);
mysql_close($res);
echo '</ul>';
?>
