<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

function random_str()
{
	return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	mt_rand( 0, 0x0fff ) | 0x4000,
	mt_rand( 0, 0x3fff ) | 0x8000,
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
}

$idd = random_str();
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('d/m/Y');
$heure = date('H:i:s');

setcookie('never', $idd, (time() + 2592000));
	
mysql_db_query($sql_bdd,"insert into heberg_affi_temp values ('', '$idd', '$date $heure', '$ip')",$db_link) or die(mysql_error());

header("Location:https://www.gheberg.eu/vps.html");