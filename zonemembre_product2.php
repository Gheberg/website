<?php
//connexion base de donnees
require("conf.php");
require("conf_vps.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);

//requete
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link) or die(mysql_error());

if(mysql_num_rows($requete)==0)
	{
	header("Location:$url_erreur"); exit;
	}

if($idd == NULL)
	{
	header("Location:$url_erreur"); exit;
	}

//recuperation des informations
$prenom=mysql_result($requete,0,"prenom");
$nom=mysql_result($requete,0,"nom");
$p=mysql_result($requete,0,"produit");
$date=mysql_result($requete,0,"date");
$pseudo=mysql_result($requete,0,"pseudo");

$requete2=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)!=0)
	{
		$date_sauvegarde=mysql_result($requete2,0,"date");
		$sauvegarde = "oui";
	}
else { $sauvegarde = "non";}

if ($p == "vps2013_1" or $p == "vps2013_2" or $p == "vps2013_3" or $p == "vps2013_4" or $p == "vps2013_5" or $p == "vps2013_6" or $p == "sd1" or $p == "sd2" or $p == "sd3" or $p == "sd4" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps2 + 50% core" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7" or $p == "css1" or $p == "css2" or $p == "css3"  or $p == "vps11")
{
$requete3=mysql_db_query($sql_bdd,"select * from heberg_dedie where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete3)!=0)
	{
		$systeme=mysql_result($requete3,0,"sys");
		$ip=mysql_result($requete3,0,"ip");
		$mac=mysql_result($requete3,0,"mac");
		$vnc=mysql_result($requete3,0,"vnc");

		$server = explode('.', $vnc);

		if ($server[0] == "chic") $host = "ns222693.ovh.net";
		if ($server[0] == "dudu") $host = "ns224339.ovh.net";
		if ($server[0] == "leon") $host = "ns227943.ovh.net";
		if ($server[0] == "noob") $host = "ns229237.ovh.net";
		if ($server[0] == "pixl") $host = "ns222268.ovh.net";
		if ($server[0] == "mush") $host = "ns222268.ovh.net";
		if ($server[0] == "moth") $host = "ns214173.ovh.net";
		if ($server[0] == "fafa") $host = "ns214707.ovh.net";
		if ($server[0] == "master") $host = "ns220049.ovh.net";
		if ($server[0] == "iron") $host = "ns211769.ovh.net";
		if ($server[0] == "pong") $host = "ns226734.ovh.net";

	}
}

//ACTION SPECIALE POUR LES VPS
if ($p == "vps2013_1" or $p == "vps2013_2" or $p == "vps2013_3" or $p == "vps2013_4" or $p == "vps2013_5" or $p == "vps2013_6" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7"  or $p == "vps11")
{
require("conf_vps.php");
$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);
$requete_vps=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete_vps)!=0)
	{
		$status=mysql_result($requete_vps,0,"status");
	}
if ($status == "1") {$statu = "démarré";}
if ($status == "2") {$statu = "arrété";}
if ($status == "3") {$statu = "Action en cours";}

if ($_GET['action'] == "reversevps")
{
$reverse = $_GET['reverse'];
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.22.wsdl");
 $session = $soap->login("***-ovh", "***","fr", false);
 $soap->dedicatedReverseModify($session, "$host", "$ip", "$reverse");
 $soap->logout($session);
} catch(SoapFault $fault) {
if ($fault == NULL) echo"<SCRIPT language=javascript>alert(\"La modification sera effective dans 5 minutes.\")</SCRIPT>";
else echo"<SCRIPT language=javascript>alert(\"La requête NS n'a pas pu être résolu. Merci de réessayer ultérieurement ou vérifier votre entrée DNS.\")</SCRIPT>";
}
}
}

//VOIP
if ($p == "voip1" or $p == "voip2")
{
	$requete_voip=mysql_db_query($sql_bdd,"select * from heberg_voip where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
	if(mysql_num_rows($requete_voip)!=0)
	{
		$ligne=mysql_result($requete_voip,0,"numero");
		$voipatt = 0;
	}
	else $voipatt = 1;	
	
	if ($_GET['sonnerie'] == "msave")
	{
		$choix = $_POST['choix'];
		$url = $_POST['url'];
		
		
		try {
		 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.33.wsdl");
		 $session = $soap->login("***-ovh", "***","fr", false);

		 //telephonyToneRemoteUpload
		 $soap->telephonyToneRemoteUpload($session, "$ligne", "FR", "$choix", "$choix", "$url");
		 $soap->telephonyTonesOptionsModify($session, "$ligne", "FR", true, true, true, true);
		 $soap->logout($session);
		} catch(SoapFault $fault) {
		}
		
		echo"<script language=\"javascript\">alert(\"La modification sera effective dans quelques minutes.\");</script>";
	}
	
	if ($_GET['sonnerie'] == "mdelete")
	{
		$choix = $_POST['choix'];
		
		try {
		 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.33.wsdl");
		 $session = $soap->login("***-ovh", "***","fr", false);

		 //telephonyToneDelete
		 $soap->telephonyToneDelete($session, "$ligne", "FR", "$choix");
		 $soap->logout($session);
		} catch(SoapFault $fault) {
		}
		
		echo"<script language=\"javascript\">alert(\"La modification sera effective dans quelques minutes.\");</script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Zone Membres</title>
<meta name="keywords" content="heberg gratuit, hebergement gratuit,hébergement gratuit,hébergement,gratuit,hébergeur gratuit,hebergeur gratuit,hebergement mutualise,hébergement mutualisé,hébergeur free,hebergeur free, hébergeur php, hebergeur php" />
<meta name="description" content="Solution d'hébergement internet, de serveurs dédiés et serveurs virtuel (vps). Support technique gratuit. " />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="maxheight.js" type="text/javascript"></script>
<script language="JavaScript">
function reversededie()
 {
    var handball = prompt("Indiquer le reserve pour votre adresse <?php echo"$ip";?>","")
	window.location.replace("zonemembre_product.php?idd=<?php echo"$idd";?>&action=reversededie&reverse="+handball);
  }

function reversevps()
 {
    var handball = prompt("Indiquer le reserve pour votre adresse <?php echo"$ip";?>","")
	window.location.replace("zonemembre_product.php?idd=<?php echo"$idd";?>&action=reversevps&reverse="+handball);
  }
</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'fr'}
</script>
</head>

<body id="page2">
<div class="right_bgd"></div>
<div class="tail-top">
  	<div class="tail-bottom">
    	<div class="main">
          	<div id="header">
       	  		<div class="indent"><center><a href="loginout.php">Deconnexion</a><br><?php echo"$nom $prenom";?></center></div>
                <a href="index.html"><img alt="" src="images/logo.gif" class="logo" /></a><br />
                <div class="block">
                	<div class="block-left">
                    	<div class="block-right">
                            <ul>
                                <li class="first"><a href="zonemembre.php?idd=<?php echo"$idd";?>">Accueil</a></li>
                                <li><a href="zonemembre_compte.php?idd=<?php echo"$idd";?>">Votre Compte</a></li>
								<li><a href="zonemembre_product.php?idd=<?php echo"$idd";?>">Votre Produit</a></li>
                                <li><a href="zonemembre_vip.php?idd=<?php echo"$idd";?>">Support VIP</a></li>
                                <li><a href="forum.php">Forum</a></li>
							    <li><a href="zonemembre_faq.php?idd=<?php echo"$idd";?>">F.A.Q</a></li>
                                <li class="last"><a href="zonemembre_contact.php?idd=<?php echo"$idd";?>">Assistance</a></li>
                            </ul>
                         
                        </div>
                    </div>
                </div>
                <div class="block1">
                	<div class="block1-indent">
                    	<img alt="cluster de serveurs sécurisés" src="images/title1.gif" /><br />
                    	<img alt="bande passante garantie" src="images/title2.gif" /><br />
                    	<img alt="trafic illimité" src="images/title3.gif" /><br />
                    	<img alt="support technique gratuit" src="images/title4.gif" /><a href="tous-produits.html"><img alt="voir tous les produits" src="images/button.gif" /></a><br />
                    </div>
                </div>
      		</div>
      		<div id="content">		
                <div class="indent-main2">
				<h6>Votre produit</h6>

<img src="images/lock.png"> Cette page vous permet de retrouver les informations essentielles sur votre hébergement ou serveur dédié.
<br><br>
<?php
$requete=mysql_db_query($sql_bdd,"select * from heberg_admin where pseudo=\"$pseudo\" and info LIKE \"creer %\"",$db_link) or die(mysql_error());

if(mysql_num_rows($requete) == 1)
	{
?>
<fieldset id="fieldsetrouge"> 
<center>
<b>Votre produit est actuellement en cours de création.<b><br>
Un mail vous sera envoyé une fois le produit disponible.</center>
</fieldset>
<?php
}
?>
<fieldset id="fieldset"><legend><h1>Informations</h1></legend> 
<b>Identifiant client :</b> <?php echo"$pseudo";?><br>
<b>Type de compte :</b> 
<?php 
if ($p == "h1") {echo "First"; $support = "oui";}
elseif ($p == "h2" or $p == "h3") {echo "First";}
elseif ($p == "vps2013_1" or $p == "vps2013_2" or $p == "vps2013_3" or $p == "vps2013_4" or $p == "vps2013_5" or $p == "vps2013_6" or $p == "vps1" or $p == "vps2" or $p == "vp3"  or $p == "vps5" or $p == "vps6" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7"   or $p == "vps11") {echo "Semi-pro";}
else {echo"Pro"; $support = "pro";}
?>
<br>
<b>Support technique par email :</b> oui<br>
<b>Support live :</b>
<?php
if ($support == "non") {echo "non";}
else {echo "oui";}
?>
<br>
<b>Support technique par sms :</b> 
<?php
if ($support == "pro") {echo "oui";}
else {echo "non <i>réservé serveur dédié</i>";}
?>
<br>
<br>
<b>Votre produit :</b> <?php echo"$p";?><br>
<b>Date dernier renew :</b> <?php echo"$date";?><br>
<br>
<?php
if ($p == "h1" or $p == "h2" or $p == "h3") 
{
?>
<b>Serveur :</b> Rack (87.98.129.225)<br>
<b>Administration :</b> <a href="https://87.98.129.225:8443/login.php3" target="_blank">https://87.98.129.225:8443/login.php3</a>
<br><br>
<b>Sauvegarde (backup) :</b> <?php echo"$sauvegarde";?><br>
<b>Date d'expiration :</b> <?php echo"$date_sauvegarde";?>
<br><br>
Si vous souhaitez utiliser nos serveurs DNS pour votre domaine, merci de l'indiquer ici.
<form method="post" action="zonemembre_domaine.php?idd=<?php echo"$idd";?>"> 
<input type="submit" value="Ajouter" class="boiteFormulaire5"> 
</form>
<?php
}
if ($p == "voip1" or $p == "voi2")
{
	if ($voipatt == 0)
	{
		 try {
		 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.30.wsdl");
		 $session = $soap->login("***-ovh", "***","fr", false);

		$type = $soap->telephonyNumberInfo($session, $ligne, "FR");
		$offerInfo = $soap->telephonyOfferInfo($session, $ligne, "FR");
		$linelog = $soap->telephonyLineLogs($session, $ligne, "FR", "", "");
		$option = $soap->telephonyLineOptionsList($session, $ligne, "FR");
		$result = $option;
		$tone = $soap->telephonyToneStatus($session, $ligne, "");
		$soap->logout($session);

		} catch(SoapFault $fault) {}
	?>
	
	<h3>Informations techniques :</h3>
Propriétaire : <?php echo "$nom $prenom"; ?><br>
Ligne : <?php echo $ligne; ?><br>
Type : <?php echo $type; ?><br>
Appel(s) simultané(s) : <?php echo $offerInfo->simultaneousLines; ?><br><br>

<h3>Information SIP :<br></h3>
Username : <?php echo $offerInfo->sipAccount->username; ?><br>
Domain : <?php echo $offerInfo->sipAccount->domain; ?>
<br><br>
<h3>Options <small><a href="?idd=<?php echo $idd ; ?>&type=appels&mod=gene">Modifier</a></small></h3>
<?php
echo 'Masquer le numero : ';
         if (empty($result->identificationRestriction)){echo 'Non Active';}
        else
        {echo 'Active';}
echo '<br><br>';

echo '<h3>Transfert d\'appel <small><a href="?type=appels&mod=trans&idd='.$idd.'">Modifier</a></small></h3>';
echo 'Redirection vers numero : ';
	if (empty($result->forwardUnconditional)){ echo 'Non Active'; }
	else 
{
		if ($result->forwardUnconditionalNumber=='voicemail')
		{echo 'Messagerie';}
		else
		{echo $result->forwardUnconditionalNumber;}
	}
echo '<br>';
echo 'Si pas de reponse avant '.$result->forwardNoReplyDelay.' sec : ';
	if (empty($result->forwardNoReply)){echo 'Non Active';}
	else
	{
	if ($result->forwardNoReplyNumber=='voicemail')
                {echo 'Messagerie';}
                else{echo $result->forwardNoReplyNumber;}
	}
echo '<br>';
echo 'Si la ligne est occupee : ';
	if (empty($result->forwardBusy)){echo 'Non Active';}
	else
	{
		if ($result->forwardBusyNumber=='voicemail')
                {echo 'Messagerie';}
		else
		{echo $result->forwardBusyNumber;}
	}
echo '<br>';
echo 'Si la ligne n\'est pas disponible : ';
	if (empty($result->forwardBackup)){echo 'Non Active';}
	else
	{
		if ($result->forwardBackupNumber=='voicemail')
                {echo 'Messagerie';}
		else
		{echo $result->forwardBackupNumber;}
	}


echo '<br><br>';

// Rejet d'appel
echo '<h3>Rejet d\'appel <small><a href="?type=appels&mod=rejet&idd='.$idd.'">Modifier</a></small></h3>';

echo 'Rejet des Appels Sortant : ';
         if (empty($result->lockOutCall)){echo 'Non Active';}
        else
        {echo 'Active';}
echo '<br>';
echo 'Rejet des Appels Anonymes : ';
	 if (empty($result->anonymousCallRejection)){echo 'Non Active';}
        else
        {echo 'Active';}
echo '<br>';
echo 'Ne pas Deranger : ';
         if (empty($result->doNotDisturb)){echo 'Non Active';}
        else
        {echo 'Active';}
echo '<br>';
echo 'Abonne Absent : ';
         if (empty($result->absentSuscriber)){echo 'Non Active';}
        else
        {echo 'Active';}
?>

<br><br>
<h3>Sonneries <small><a href="?idd=<?php echo"$idd";?>&sonnerie">Modifier</a></small></h3>
Sonnerie de pré-décroché : <?php if ($tone->ringback == 1) echo "Actif"; else echo "Non actif";  ?><br>
Musique d'attente : <?php if ($tone->onhold == 1) echo "Actif"; else echo "Non actif"; ?><br>
Toutes lignes occupées : <?php if ($tone->callwaiting == 1) echo "Actif"; else echo "Non actif"; ?><br><br>
<?php
if (isset($_GET['sonnerie']))
{
?>
<form action="?sonnerie=msave&idd=<?php echo"$idd";?>" method="post">
<table>
<tr><td>URL du son : </td><td><input type="text" name="url"> <small>ex. : http://monsite.fr/monson.mp3</small></td></tr>
	<tr><td></td><td><input type="radio" name="choix" value="ringback">Pre-decroche</td></tr>
	<tr><td></td><td><input type="radio" name="choix" value="onhold">Attente</td></tr>
	<tr><td></td><td><input type="radio" name="choix" value="callwaiting">Occupes</td></tr>
</td></tr>
</table>
<input type="submit" value="Envoyer">
</form>
<small>Taille max. : 3Mo, formats principaux autorisés : wav, mp3, mp4, ogg et wma</small>
<br><br>
<form action="?sonnerie=mdelete&idd=<?php echo"$idd";?>" method="post">
Supprimer une sonnerie :
<table>
	<tr><td></td><td><input type="radio" name="choix" value="ringback">Pre-decroche</td></tr>
	<tr><td></td><td><input type="radio" name="choix" value="onhold">Attente</td></tr>
	<tr><td></td><td><input type="radio" name="choix" value="callwaiting">Occupes</td></tr>
</td></tr>
</table>
<input type="submit" value="Envoyer">
</form>
<br><br>
<?php
}
$typetel = $_GET['appel'];

if ($typetel=='landLine'){$typetel2 = 'Fixe';}
if ($typetel=='special'){$typetel2 =  'Special';}
if ($typetel=='mobile'){$typetel2 = 'Mobile';}

// Fionction addition temps
function AddTime($time1,$time2) {
            list( $hr1, $min1, $sec1 ) = split( ":", $time1);
            $UTime1 = mktime(1,$min1,$sec1,01,01,1970);
            list( $hr2, $min2, $sec2 ) = split( ":", $time2);
            $UTime2 = mktime(1,$min2,$sec2,01,01,1970);
            $UTimeTotal = $UTime1 + $UTime2;
            $UTimeTotal = $UTimeTotal - 3600;
            $timeTotal = date ("H:i:s",$UTimeTotal);
            list( $hr3, $min3, $sec3 ) = split( ":", $timeTotal);
            $hrTotal = $hr1 + $hr2;
            if ($hr3 >= 1)
                $hrTotal = $hrTotal + $hr3;
            $timeTotal = $hrTotal.":".$min3.":".$sec3;
            return $timeTotal;
        }



$typeappel = $_GET['type'];

if (empty($typeappel)){$typeappel='0';}

if ($typeappel==0)
{$type='Sortant';
$callReceived='';}
if ($typeappel==1){
$type='Entrant';
$callReceived='true';}


//telephonyCallsList

$typetel = $_GET['appel'];
if (empty($typetel))
{
$typetel = 'landLine';
}

//if ($typeappel==1){$typetel='all';}


try {
$soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.30.wsdl");
$session = $soap->login("***-ovh", "***","fr", false);

$result = $soap->telephonyCallList($session, "$ligne", "fr", "", "", "$typetel", "", $callReceived);
//print_r($result);
   echo "<br/>";

   } catch(SoapFault $fault) {
    echo "Error : ".$fault;
    }

echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;">Appel '.$typetel2.' du '.$result->fromDate.' au '.$result->toDate.'</h2>';
echo '<div style="height:1px;background:#0b4499;margin-bottom:1px;font-size:0;"></div>';

// Couleur Font tableau
$colorbg = '#DDDDDD';

// Determination type d'appel
if ($typeappel==0)
{$lappel = 'Entrant';
$type2 = '1';
$color = '#FF0000';
}
else
{$lappel = 'Sortant';
$type2 = '0';
$color = '#009900';
}

echo '<h2 style="font-size:8px;color:#0b4499;margin-bottom:0px;text-align:right;"><a href="?idd='.$idd.'&tel_conso='.$ligne.'&type='.$type2.'&appel=all">Afficher appel '.$lappel.'</a></h2>';

if ($typeappel==0)
{
echo '<center><i><a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=landLine&type=0">Fixe</a> | 
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=mobile&type=0">Mobile</a> | 
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=special&type=0">Speciaux</a> |
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=all&type=0">Tous</a>';
echo '<br></center>';
}

if ($typeappel==1)
{
echo '<center><i><a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=voicemail&type=1">Messagerie</a> |
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=incoming&type=1">Reçu</a> |
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=miss&type=1">En Abscence</a> |
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=transfert&type=1">Transfert</a> |
      <a href="?idd='.$idd.'&tel_conso='.$ligne.'&appel=all&type=1">Tous</a>';
echo '<br></center>';
}

echo '<center><table style="width:100%;">';

echo '<tr style="background:#ddd;text-align:center;">';
echo '<td>Date</td>';
echo '<td>N° Appelé</td>';
echo '<td>Durée</td>';
echo '<td>Destination</td>';
if ($typeappel<>1){echo '<td>Nature</td>';}
if ($typeappel<>1){echo '<td>Coût</td>';}
echo '</tr>';


$i=0;
$pricetotal = 0;
while($result->list[$i]){
echo '<tr style="text-align:center;">';
echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">'.$result->list[$i]->date.'<font></td>';
echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">';

if ($typeappel==0)
{
$number = $result->list[$i]->number;
}
else
{
$number = $result->list[$i]->callingNumber;
}

	if ($number == 123 )
	{echo 'Repondeur';}
	else
	{echo $number;}
echo '<font></td>';
echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">'.$result->list[$i]->duration.'<font></td>';
if ($typeappel<>1){echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">'.$result->list[$i]->destination.'<font></td>';}
if ($typeappel==1){echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">';
if ($result->list[$i]->nature== voicemail){echo 'Messagerie'; }
if ($result->list[$i]->nature== incoming){echo 'Reçu'; }
if ($result->list[$i]->nature== miss){echo 'Manqué'; }
if ($result->list[$i]->nature== transfert){echo 'Transfert'; }
echo '<font></td>';}
else
{echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">'.$result->list[$i]->nature.'<font></td>';
}
if ($typeappel<>1){echo '<td bgcolor="'.$colorbg.'"><font size="1" color="'.$color.'">';
if ($result->list[$i]->priceWithoutVAT==0){echo 'Gratuit';}
else
{echo $result->list[$i]->priceWithoutVAT;}
echo '<font></td>';}


echo '</tr>';
$price =  $result->list[$i]->priceWithoutVAT;
$pricetotal = $pricetotal + $price;



$timeap = $result->list[$i]->duration;

$time = AddTime($time,$timeap);

$timetotal = $time;

$i++;
}

echo '<div align="left">';
echo ''.$i.' appels vers numéro ';
echo $typetel2.'<br>';
echo 'Hors Forfait '.$typetel2.' : '.$pricetotal.' &euro;HT<br>';
echo 'Durée : '.$timetotal.'<br>';
echo '</div>';
echo '<br>';
echo '</table></center>';


?>
<br>
<h3>Log d'erreur</h3>
<table border=1>
<tr align="center"><th>Date</th><th>Type</th><th>Message</th></tr>
<?php
foreach ($linelog->list as $value)
	echo '<tr align=center><td>'.$value->date.'</td><td>'.$value->type.'</td><td>'.$value->msg.'</td></tr>';
?>
</table>
<br>
<?php
		 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.30.wsdl");
		 $session = $soap->login("***-ovh", "***","fr", false);
		 
echo '<h3>Numéros abrégés <small><a href="?type=AbbreviatedNumber&modif=3&idd='.$idd.'">Ajouter</a></small></h3>';
echo '<div style="height:1px;background:#0b4499;font-size:0;"></div>';

$country = "fr";
try {
$resultAbbreviatedNumberList = $soap->telephonyAbbreviatedNumberList($session, "$ligne", "$country");

// Ajouter Numero Court
if ($_GET['modif']==3)
{
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Ajouter Numéros abrégés</a></h2><br><bR>';

if (empty($_POST['abbreviatedNumber']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="supp" value="1">';
echo 'Numero abrégé : <input type="text" name="abbreviatedNumber" value="2"><br><br>';
echo 'Numéro : <input type="text" name="relatedNumber" value=""><br><br>';
echo 'Nom : <input type="text" name="name" value=""><br><br>';
echo 'Prénom : <input type="text" name="surname" value=""><br><br>';
echo '<input type="submit" name="Submit" value="Ajouter" class="input">';
echo '</form>';

echo '<bR>';
echo '<div style="border:1px solid #ccc;background:#ffffab;margin-bottom:10px;padding:5px;">
<h5 style="text-decoration:underline;font-weight:bold;margin-bottom:5px;margin-top:0px;font-size:11px;">Informations :</h5>
Les numéro abrégé doivent obligatoirement commancer par le chiffre 2
</div>';

}
else
{
$abbreviatedNumber = $_POST['abbreviatedNumber'];
$relatedNumber = $_POST['relatedNumber'];
$name = $_POST['name'];
$surname = $_POST['surname'];
try {
$soap->telephonyAbbreviatedNumberAdd($session, "$ligne", "$country", "$abbreviatedNumber ", "$relatedNumber", "$name", "$surname");
}catch(SoapFault $fault) {
 echo $fault->faultstring;
}
if (empty($fault))
{echo '<center>Ajout effectuer avec succées</center>';}
}
echo '<bR><br>';
}

// Modification Numéro Court
if ($_GET['modif']==1)
{
$id = $_GET['id'];
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Modification Numéro '.$id.'</h2><br><bR>';
if (empty($_POST['abbreviatedNumber']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="supp" value="1">';
$i=0;
while($resultAbbreviatedNumberList[$i]){
if ($resultAbbreviatedNumberList[$i]->abbreviatedNumber==$id)
{
echo 'Numero abrégé : <input type="text" name="abbreviatedNumber" value="'.$resultAbbreviatedNumberList[$i]->abbreviatedNumber.'"><br><br>';
echo 'Numéro : <input type="text" name="relatedNumber" value="'.$resultAbbreviatedNumberList[$i]->relatedNumber.'"><br><br>';
echo 'Nom : <input type="text" name="name" value="'.$resultAbbreviatedNumberList[$i]->name.'"><br><br>';
echo 'Prénom : <input type="text" name="surname" value="'.$resultAbbreviatedNumberList[$i]->surname.'"><br><br>';
}
$i++;
}
echo '<input type="submit" name="Submit" value="Modifier" class="input">';
echo '</form>';

echo '<bR>';
echo '<div style="border:1px solid #ccc;background:#ffffab;margin-bottom:10px;padding:5px;">
<h5 style="text-decoration:underline;font-weight:bold;margin-bottom:5px;margin-top:0px;font-size:11px;">Informations :</h5>
Lors du changement du numéro abrégé, le nouveau numéro sera une copie de l\'ancien, celui ci ne sera pas supprimé.
</div>';

}
else
{
$abbreviatedNumber = $_POST['abbreviatedNumber'];
$relatedNumber = $_POST['relatedNumber'];
$name = $_POST['name'];
$surname = $_POST['surname'];
try {
$soap->telephonyAbbreviatedNumberModify($session, "$ligne", "$country", "$abbreviatedNumber", "$relatedNumber ", "$name", "$surname");
}catch(SoapFault $fault) {
 echo $fault->faultstring;
}
if (empty($fault))
{echo '<center>Modification effectuer avec succées</center>';}
}
echo '<br><br>';
}


// Suppression Numéro Court
if ($_GET['modif']==2)
{
$id = $_GET['id'];
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Suppression du Numéro abrégé '.$id.'</h2><br><bR>';

if (empty($_POST['abbreviatedNumber']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="supp" value="1">';
echo '<input type="hidden" name="abbreviatedNumber" value="'.$id.'">';
echo '<center><input type="submit" name="Submit" value="Confirmer la Suppression" class="input"></center>';
echo '</form>';
}
else
{
$abbreviatedNumber = $_POST['abbreviatedNumber'];
try {
$soap->telephonyAbbreviatedNumberDel($session, "$ligne", "$country", "$abbreviatedNumber");
}catch(SoapFault $fault) {
 echo $fault->faultstring;
}
if (empty($fault))
{echo '<center>Suppression effectuer avec succées</center>';}
}

echo '<br><br>';
}

$resultAbbreviatedNumberList = $soap->telephonyAbbreviatedNumberList($session, "$ligne", "$country");

echo '<center><table style="width:100%;">';
echo '<tr style="background:#ddd;text-align:center;">';
echo '<td>Numero abrégé</td>';
echo '<td>Numéro</td>';
echo '<td>Nom</td>';
echo '<td>Prénom</td>';
echo '</tr>';

$i=0;
while($resultAbbreviatedNumberList[$i]){
echo '<tr>';
echo '<td>'.$resultAbbreviatedNumberList[$i]->abbreviatedNumber.'</td>';
echo '<td>'.$resultAbbreviatedNumberList[$i]->relatedNumber.'</td>';
echo '<td>'.$resultAbbreviatedNumberList[$i]->name.'</td>';
echo '<td>'.$resultAbbreviatedNumberList[$i]->surname.'</td>';
echo '<td><a href="?idd='.$idd.'&type=AbbreviatedNumber&modif=1&id='.$resultAbbreviatedNumberList[$i]->abbreviatedNumber.'"><img src="images/edit.gif"></a></td>';
echo '<td><a href="?idd='.$idd.'&type=AbbreviatedNumber&modif=2&id='.$resultAbbreviatedNumberList[$i]->abbreviatedNumber.'"><img src="images/supprimer.png"></a></td>';
echo '</tr>';
$i++;
}

echo '</table></center>';

}catch(SoapFault $fault) {
}

	}
}
if ($_GET['type']==appels | empty($_GET['type']) AND empty($_GET['modif']))
{
if (isset($_GET['mod']))
{
echo '<br><br>';
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:left;">Appels</h2>';
echo '<div style="height:1px;background:#0b4499;font-size:0;"></div>';
}
// Modif Transfert d'appel
if ($_GET['mod']==trans)
{
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Modifier les Options de Transfert d\'appel</h2>';

if (empty($_POST['modok']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="modok" value="ok">';
echo '<input type="checkbox" name="forwardUnconditional" value="1"> Redirection vers : <input type="checkbox" name="forwardUnconditional1" value="voicemail"> Répondeur ou <input type="text" name="forwardUnconditional2" value="+33" size="13"><br>';
echo '<input type="checkbox" name="forwardNoReply" value="1"> Si pas de reponse : <input type="checkbox" name="forwardNoReplyNumber1" value="voicemail"> Répondeur ou <input type="text" name="forwardNoReplyNumber2" value="+33" size="13"> au bout de  <input type="text" name="forwardNoReplyDelay" value="25" size="2">sec<br>';
echo '<input type="checkbox" name="forwardBusy" value="1"> Si Ligne occupee : <input type="checkbox" name="forwardBusyNumber1" value="voicemail"> Répondeur ou <input type="text" name="forwardBusyNumber2" value="+33" size="13"><br>';
echo '<input type="checkbox" name="forwardBackup" value="1"> Si ligne non disponible : <input type="checkbox" name="forwardBackupNumber1" value="voicemail"> Répondeur ou <input type="text" name="forwardBackupNumber2" value="+33" size="13"><br>';
echo '<center><br><input type="submit" name="Submit" value="Modifier" class="input"></center>';
echo '</form>';
}
else
{
if ($_POST['forwardUnconditional']==1){$forwardUnconditional=true;}else{$forwardUnconditional=false;}
$forwardUnconditional1 = $_POST['forwardUnconditional1'];
$forwardUnconditional2 = $_POST['forwardUnconditional2'];
if ($_POST['forwardNoReply']==1){$forwardNoReply=true;}else{$forwardNoReply=false;}
$forwardNoReplyNumber1 = $_POST['forwardNoReplyNumber1'];
$forwardNoReplyNumber2 = $_POST['forwardNoReplyNumber2'];
$forwardNoReplyDelay = $_POST['forwardNoReplyDelay'];
if ($_POST['forwardBusy']==1){$forwardBusy=true;}else{$forwardBusy=false;}
$forwardBusyNumber1 = $_POST['forwardBusyNumber1'];
$forwardBusyNumber2 = $_POST['forwardBusyNumber2'];
if ($_POST['forwardBackup']==1){$forwardBackup=true;}else{$forwardBackup=false;}
$forwardBackupNumber1 = $_POST['forwardBackupNumber1'];
$forwardBackupNumber2 = $_POST['forwardBackupNumber2'];
if ($forwardUnconditional2=='+33'){$forwardUnconditionalNumber='voicemail';} else {$forwardUnconditionalNumber=$forwardUnconditional2;}
if ($forwardNoReplyNumber2=='+33'){$forwardNoReplyNumber='voicemail';} else {$forwardNoReplyNumber=$forwardNoReplyNumber2;}
if ($forwardBusyNumber2=='+33'){$forwardBusyNumber='voicemail';} else {$forwardBusyNumber=$forwardBusyNumber2;}
if ($forwardBackupNumber2=='+33'){$forwardBackupNumber='voicemail';} else {$forwardBackupNumber=$forwardBackupNumber2;}
try {
$soap->telephonyLineOptionsModify($session, "$ligne", "$country","","","" ,"" ,"" , "", $forwardUnconditional, "$forwardUnconditionalNumber", $forwardNoReply, "$forwardNoReplyDelay", "$forwardNoReplyNumber", $forwardBusy, "$forwardBusyNumber", $forwardBackup, "$forwardBackupNumber", "", "");
}
catch(SoapFault $fault) {
 echo $fault->faultstring;
}
if (empty($fault)){echo '<center>Modifications Effectuées.</center>';}
}
echo '<br><br>';
}

// Modif Rejet d'appel
if ($_GET['mod']==gene)
{
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Modifier Options Générales</h2>';

if (empty($_POST['modok']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="modok" value="ok">';
echo '<input type="checkbox" name="identificationRestriction" value="1"> Masquer le numero<br>';
echo '<center><br><input type="submit" name="Submit" value="Modifier" class="input"></center>';
echo '</form>';
}
else
{
$identificationRestriction = $_POST['identificationRestriction'];

try {
$soap->telephonyLineOptionsModify($session, "$ligne", "$country","$identificationRestriction","","" ,"" ,"" , "", "", "", "", "", "", "", "", "", "", "", "");
}
catch(SoapFault $fault) {
 echo $fault->faultstring;
}
if (empty($fault)){echo '<center>Modifications Effectuées.</center>';}

}
echo '<br><br>';
}


// Modif Rejet d'appel
if ($_GET['mod']==rejet)
{
echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Modifier les Rejet  d\'appel</h2>';

if (empty($_POST['modok']))
{
echo '<form method="post" action="">';
echo '<input type="hidden" name="modok" value="ok">';
echo '<input type="checkbox" name="lockOutCall" value="1"> Rejet des Appels Sortant : Password : <input type="password" name="lockOutCallPassword" value="" size="13"><br>';
echo '<input type="checkbox" name="anonymousCallRejection" value="1"> Rejet des Appels Anonymes <br>';
echo '<input type="checkbox" name="doNotDisturb" value="1"> Ne pas Deranger <br>';
echo '<input type="checkbox" name="absentSuscriber" value="1"> Abonne Absent <br>';
echo '<center><br><input type="submit" name="Submit" value="Modifier" class="input"></center>';
echo '</form>';
}
else
{

$lockOutCall = $_POST['lockOutCall'];
$anonymousCallRejection = $_POST['anonymousCallRejection'];
$doNotDisturb = $_POST['doNotDisturb'];
$absentSuscriber = $_POST['absentSuscriber'];
$lockOutCallPassword = $_POST['lockOutCallPassword'];

try {
$soap->telephonyLineOptionsModify($session, "$ligne", "$country","","$anonymousCallRejection","$doNotDisturb" ,"$absentSuscriber" ,"$lockOutCall" , "$lockOutCallPassword", "", "", "", "", "", "", "", "", "", "", "");
}
catch(SoapFault $fault) {
}
if (empty($fault)){echo '<center>Modifications Effectuées.</center>';}

}
}
}
if ($p == "vps1" or $p == "vps2" or $p == "vps3"  or $p == "vps5" or $p == "vps6" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7"   or $p == "vps11")
{
$requete_vps=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());
@$vmid=mysql_result($requete_vps,0,"vmid");
?>
<b>Adresse ip :</b> <?php echo"$ip";?><br>
<b>Adresse Mac :</b> <?php echo"$mac";?><br>
<b>Adresse VNC :</b> <a href="./vms/vnc.php?serveur=<?php echo"$vnc";?>" target="_blank"><?php echo"$vnc";?></a><br>
<b>Système :</b> <?php echo"$systeme";?><br>
<b>VMID :</b> <?php echo"$vmid";?>
<?php
}
if ($p == "sd1" or $p == "sd2" or $p == "sd3" or $p == "sd4" or $p == "sd5")
{
?>
<center>
<?php
if ($_GET['action'] == "reboot")
{
$vnc2 = substr($vnc, 0, 2);
if ($vnc2 == "ns") $serveur = "ovh.net";
if ($vnc2 == "ks") $serveur = "kimsufi.com";
echo"<font color=\"green\">Hard Reboot en cours. Votre serveur sera de nouveau disponible dans quelques minutes</font>";
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.21.wsdl");

 $session = $soap->login("***-ovh", "***","fr", false);
 $soap->dedicatedHardRebootDo($session, "$vnc.$serveur", "ssh down", "", "");
 $soap->logout($session);
} catch(SoapFault $fault) {
}
}

if ($_GET['action'] == "reversededie")
{


if ($vnc2 == "ns") $serveur = "ovh.net";
if ($vnc2 == "ks") $serveur = "kimsufi.com";
$reverse = $_GET['reverse'];
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.22.wsdl");
 $session = $soap->login("***-ovh", "***","fr", false);
 $soap->dedicatedReverseModify($session, "$vnc.$serveur", "$ip", "$reverse");
 $soap->logout($session);
} catch(SoapFault $fault) {
if ($fault == NULL) echo"<SCRIPT language=javascript>alert(\"La modification sera effective dans 5 minutes.\")</SCRIPT>";
else echo"<SCRIPT language=javascript>alert(\"La requête NS n'a pas pu être résolu. Merci de réessayer ultérieurement ou vérifier votre entrée DNS.\")</SCRIPT>";
}
}

$vnc2 = substr($vnc, 0, 2);
if ($vnc2 == "ns") $serveur = "ovh.net";
if ($vnc2 == "ks") $serveur = "kimsufi.com";

try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.22.wsdl");
 //login
 $session = $soap->login("***-ovh", "***","fr", false);
 //dedicatedRtmGetStatus
 $result = $soap->dedicatedRtmGetStatus($session, "$vnc.$serveur");

 //logout
 $soap->logout($session);
} catch(SoapFault $fault) {
}
echo "</center>";
echo '<b>Uptime : </b>'.$result->systemInfo->uptime.'<br><br>';

echo '<b>CPU : </b>'.$result->cpu->frequency.'MHz<br>';
echo '<b>Core : </b>'.$result->cpu->core.'<br>';
echo '<b>Name : </b>'.$result->cpu->name.'<br>';
echo '<b>Cache : </b>'.$result->cpu->cache.'<br><br>';
echo '<b>Kernel : </b>'.$result->systemInfo->kernel->version.' '.$result->systemInfo->kernel->release.'<br><br>';

echo '<b>LoadAverage1 : </b>'.$result->cpu->loadAvg->loadavg1.'<br>';
echo '<b>LoadAverage5 : </b>'.$result->cpu->loadAvg->loadavg5.'<br>';
echo '<b>LoadAverage15 : </b>'.$result->cpu->loadAvg->loadavg15.'<br><br>';

echo '<b>Hard drives : </b>'.$result->hardDrives[0]->device.'<br><br>';

echo '<b>Utilisation CPU : </b>'.$result->cpu->percentLoad.'%<br>';
echo '<b>Utilisation RAM : </b>'.$result->memory->memusage.'%<br>';
echo '<b>Utilisation SWAP : </b>'.$result->memory->swapusage.'%<br><br>';

echo '<b>Carte mère : </b>'.$result->motherboard->manufacture.' '.$result->motherboard->modelName.'<br><br>';

echo"<center>";
//GRAPHE MRTG DEDIE
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.13.wsdl");

 //login
 $session = $soap->login("***-ovh", "***","fr", false);
 $result = $soap->dedicatedMrtgInfo($session, "$vnc.$serveur", "traffic", "day", "$ip");
  $soap->logout($session);
 }
catch(SoapFault $fault) {}
foreach ($result as $w) {
$image = $result->image;
} 


?>
<img src="<?php echo"$image";?>"><br><br>
<table width="300">
<tr><td width="150" align="center"><a href="zonemembre_product.php?idd=<?php echo"$idd";?>&action=reboot" onclick="if (! confirm('ATTENTION : Votre serveur va être rebooter électriquement. Souhaitez vous effectuer un hard reboot maintenant ?')) { return false;}"><img src="images/reboot.gif"></a></td><td width="150" align="center"><a href="javascript:reversededie()"><img src="images/reverse.gif"></a></td></tr>
<tr><td align="center">Hard reboot</td><td align="center">Modifier reverse</td></tr>
</table>
<br>
<?php
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.13.wsdl");

 //login
 $session = $soap->login("***-ovh", "***","fr", false);
 //dedicatedHardRebootStatus
 $result = $soap->dedicatedHardRebootStatus($session, "$vnc.$serveur");

echo '<br><b>Etat du dernier Reboot Hard :<br></b>';
echo 'Demande du reboot : '.$result->start.'<br>';
echo 'Fin du reboot : '.$result->end.'<br>';

} catch(SoapFault $fault) {
echo '<b>Reboot en cours</b> ou <b>aucun historique</b>';
 //echo $fault;
}
?>
</center>

<?php
}
?>
</fieldset>
<br>
<fieldset id="fieldset"><legend><h1>Outils utiles</h1></legend>
<li><a href="./vms/vnc.php?serveur=<?php echo"$vnc";?>" target="_blank">Virtual Network Computing</a></li>
<li><a href="https://www.gheberg.eu/vms/vms.php" target="_blank">Visual Monitoring System</a><br></li>
<li><a href="http://www.gratuit-domaine.eu/travaux" target="_blank">Travaux en cours</a></li><br>
Pour modifier le système d'exploitation de votre serveur, merci de nous contacter par le support technique.

</fieldset>
<br>
<?php

if ($p == "vps2013_1" or $p == "vps2013_2" or $p == "vps2013_3" or $p == "vps2013_4" or $p == "vps2013_5" or $p == "vps2013_6" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps2 + 50% core" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7"  or $p == "vps11") {
?>
<fieldset id="fieldset"><legend><h1>API VPS</h1></legend>
<div style="width:100%;">
<div style="width:50%;float:left;">
<b>Etat actuel de votre vps :</b> <?php echo"$statu";?>
<br>
<table>
	<tr>
		<td align="center">
			<a href="vps_action.php?action=1&idd=<?php echo"$idd";?>"><img src="up.gif"></a>
		</td>
		<td width="20px"></td>
		<td align="center">
			<a href="vps_action.php?action=2&idd=<?php echo"$idd";?>"><img src="images/reboot.gif"></a>
		</td>
	</tr>
	<tr>
		<td align="center">
			Allumer
		</td>
		<td width="20px"></td>
		<td align="center">
			Eteindre
		</td>
	</tr>
</table>
</div>
<div style="width:40%;float:right;">
<table>
	<tr>
		
		<td align="center">
			<a href="javascript:reversevps()"><img src="images/reverse.gif"></a>
		</td>
		<td align="center">
			<a href="zonemembre_reinstall.php?idd=<?php echo"$idd";?>"><img src="images/reinstall.gif"></a>
		</td>
	</tr>
	<tr>
		<td align="center">
			Reverse IPV4
		</td>
		<td align="center">
			Réinstallation
		</td>
	</tr>
</table>
</div>
</div>
<br>

</fieldset>
<br>
<fieldset id="fieldset"><legend><h1>Monitoring</h1></legend>
Nous vous proposons un service de monitoring de votre serveur vps par mail ou sms.<br>
Pour l'activer, <a href="zonemembre_monitoring.php?idd=<?php echo"$idd";?>">cliquer ici.</a>
</fieldset><br>
<fieldset id="fieldset"><legend><h1>Système</h1></legend>
Systèmes d'exploitation disponible : <br>
<li>CentOS 5.2</li>
<li>Debian 5.0</li>
<li>Debian 6.0 (béta)</li>
<li>Ubuntu 8.04</li>
<li>Ubuntu 10.10 Desktop</li>
<li>Ubuntu 10.04 Desktop</li>
<li>Windows Server 2003 r2 </li>
<li>Windows Server 2008 (standard ou enterprise) </li>
<br>
Les licenses windows 2008 sont vendues 1.5€ (ou 1 code allopass) pour la durée de vie du vps. <a href="zonemembre_contact.php?idd=<?php echo"$idd";?>">Nous contacter.</a>
</fieldset><br>
<fieldset id="fieldset"><legend><h1>Accès</h1></legend>
Attention : le fait de changer votre identifiant de la plateforme n'influe en rien sur l'accès à votre machine.<br>
<li><b>login Windows :</b> Administrateur</li>
<li><b>login Debian :</b> root</li>
<br>Pensez à respecter les majuscules !<br>
Le mot de passe d'accès à votre serveur vous a été envoyé par mail.
</fieldset>
<?php
}
?>

                        <br class="clear" />
                    </div>
                </div>
            </div>	 
      		<div id="footer">
				<div id="left-footer"><a href="https://twitter.com/gheberg" target="_blank"><img src="images/twitter.png" title="twitter"></a> <span style="margin-left:5px;"><g:plusone></g:plusone></span></div>
               <div class="indent-footer">Gheberg.eu &copy; 2012 | <a href="cgu_heberg.html">Mentions légales</a></div>
            </div>
         </div>
     </div>
</div>
<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.gheberg.eu/piwik/" : "http://www.gheberg.eu/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.gheberg.eu/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
</body>
</html>



