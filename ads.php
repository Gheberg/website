<?php
$pseudo=$_GET['p'];
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$date = date('d/m/Y');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

mysql_db_query($sql_bdd,"insert into heberg_pub values ('', '$pseudo', '$date', '$heure', '$ip', '".$_SERVER['HTTP_REFERER']."')",$db_link) or die(mysql_error());
?>

<script language=JavaScript>
var ord = new Date();
document.write('<scr'+'ipt language=JavaScript src="http://js.128b.com/packpopup.php?idsite=38745&data=1&random='+ord.getTime()+'"></scr'+'ipt>');
</script>