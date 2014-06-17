<noscript>
    <meta http-equiv="Refresh" content="0;url=https://payment.allopass.com/error.apu?ids=226116&idd=1102689">
</noscript>
<script type="text/javascript" src="https://payment.allopass.com/api/secure.apu?ids=226116&idd=1102689"></script>
<?php
$data = $_GET['DATAS'];
$recall = $_GET['RECALL'];
$RECALL = $recall;
$date2 = date('d/m/Y');
$heure = date('H:i:s');


if( trim($RECALL) == "" )
{
$test = "1";
}
$RECALL = urlencode( $RECALL );
$AUTH = urlencode( "226116/1102689/2083861" );
$roo = @file( "https://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=$AUTH" );

if( substr($roo[0],0,2) != "OK" )  die;

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$requete2=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde_allopass where code=\"$recall\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)==0)
	{
mysql_db_query($sql_bdd,"insert into heberg_bdc_allopass values ('', '$data', '$date2 $heure', '$recall')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_sauvegarde_allopass values ('', '$recall')",$db_link) or die(mysql_error());
	}
else
	die;

?>
<center>
<font color="green">Code accept&eacute;</font>
</center>
