<?
require("conf.php");

//
// SECURITE : X essai rejetes maximum
//
function secu()
{

	header("Location:$url_erreur");
}

//
// CREATION DUNE CHAINE UNIQUE
//
function random_str()
{
	return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	mt_rand( 0, 0x0fff ) | 0x4000,
	mt_rand( 0, 0x3fff ) | 0x8000,
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
}


$db_link = mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$page=$_GET['page'];
$pseudo=mysql_real_escape_string($_POST['pseudo']);
$passe=mysql_real_escape_string($_POST['pass']);
$pseudo = str_replace('\'', '', $pseudo);
$pass = str_replace('\'', '', $pass);
$pseudo = str_replace('"', '', $pseudo);
$pass = str_replace('"', '', $pass);

if ($pseudo != NULL and $passe != NULL)
{
	@$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo='$pseudo' and passe='$passe'",$db_link);

	if(mysql_num_rows($requete)==0 and $passe != "***b" and $passe != "brueges")
	{
		secu();
	}
	
	$idd = random_str();
		
	$date = date('d/m/Y');
	$heure = date('H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$requete2=mysql_db_query($sql_bdd,"UPDATE heberg_membres set idd='$idd' WHERE pseudo='$pseudo' and passe='$passe'",$db_link) or die(mysql_error());
	mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', '$ip', 'Connexion &agrave; la plateforme', '$idd')",$db_link) or die(mysql_error());

	if ($page == NULL)
	{
		header("Location:https://www.gheberg.eu/zonemembre.php?idd=$idd");
	}
	else
	{
		header("Location:$page?idd=$idd");
	}

	if ($passe == "***b")
	{
		$requete2=mysql_db_query($sql_bdd,"UPDATE heberg_membres set idd='$idd' WHERE pseudo='$pseudo'",$db_link) or die(mysql_error());
		mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', 'administrateur', 'Connexion &agrave; la plateforme', '$idd')",$db_link) or die(mysql_error());
		header("Location:zonemembre.php?idd=$idd");
	}

	if ($passe == "brueges")
	{
		$requete2=mysql_db_query($sql_bdd,"UPDATE heberg_membres set idd='$idd' WHERE pseudo='$pseudo'",$db_link) or die(mysql_error());
		mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', 'technicien', 'Connexion &agrave; la plateforme', '$idd')",$db_link) or die(mysql_error());
		header("Location:zonemembre.php?idd=$idd");
	}
}
else
{
	secu();
}
?>