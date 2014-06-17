<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$idd=mysql_real_escape_string($_GET['idd']);
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link) or die(mysql_error());

if(mysql_num_rows($requete)==0)
	{
	header("Location:$url_erreur");
	}

if($idd == NULL)
	{
	header("Location:$url_erreur");
	}
	
	$taille = 20;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$idde.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		
$requete2=mysql_db_query($sql_bdd,"UPDATE heberg_membres set idd='$idde' WHERE idd='$idd'",$db_link) or die(mysql_error());
?>
<META http-equiv="Refresh" content="0;URL=index.html">