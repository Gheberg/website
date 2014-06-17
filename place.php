<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete40=mysql_db_query($sql_bdd,"select * from heberg_h1 where id='1'",$db_link) or die(mysql_error());
$place=mysql_result($requete40,0,"n");
echo "<font color=\"#FF0000\"><b>Place restantes pour aujourd'hui : $place</b></font>";
?>