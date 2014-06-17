<?php
require("conf.php");
require("conf_vps.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);

$idd=mysql_real_escape_string($_GET['idd']);

$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link) or die(mysql_error());

if(mysql_num_rows($requete)==0)
	{
	echo "NOK";
	exit;
	}

if($idd == NULL)
	{
	echo "NOK";
	exit;
	}


$pseudo=mysql_result($requete,0,"pseudo");

$requete1=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete1)==0)
	{
	echo "NOK";
	exit;
	}
else
	{
	$vmid=mysql_result($requete1,0,"vmid");
	}
	

$requete2=mysql_db_query($sql_bdd_vps,"select * from tasks where vid=\"$vmid\" and type=\"4\" order by id desc",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete2)==0)
	{
	echo "NOK";
	exit;
	}
else
	{
	$status=mysql_result($requete2,0,"status");
	switch ($status)
	{
	case 1:
		echo"OK";
		break;
	
	case 3:
		echo"LOAD";
		break;
		
	case 2:
		echo"NOK";
		break;
	}
	}
?>