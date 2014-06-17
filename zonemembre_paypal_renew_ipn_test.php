<?php
//email pour prévenir le vendeur
$mailTo="Gheberg <contact@gheberg.com>";
 
//permet de traiter le retour ipn de paypal
// lire la publication du système PayPal et ajouter 'cmd'
$req = 'cmd=_notify-validate';
 
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
 
// renvoyer au système PayPal pour validation
//$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
//$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
//$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.paypal.com\r\n";
$header .= "Connection: close\r\n\r\n";
 
//www.sandbox.paypal.com pour la phase de test
//www.paypal.com pour la phase réel.
//$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
 
// affecter les variables publiées aux variables locales
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$custom = $_POST['custom'];
 
$headerMail= "Content-Type:text/html;charset=iso-8859-1\n";//permet d'envoyer les message au format html
$headerMail.= "Content-Transfer-Encoding: 8bit\n";//permet d'envoyer les message au format html
$headerMail.="From: me";//pour répondre au message
 
//on prépare le texte de l'email
$textMail="
	<img src=\"https://www.gratuit-domaine.eu/images/logo.jpg\"><br><br>
Bonjour , il y a eu une commande sur le document  ".$item_name." pour ".$custom.".<br>
Cordialement,<br>
L'équipe Gratuit-Domaine
";
 
if (!$fp) {
mail($mailTo,"Erreur sur une commande Paypal",$textMail,$headerMail);
} 
else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp (trim($res), "VERIFIED") == 0) {
if ($payment_status == "Completed")
{

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete=mysql_db_query($sql_bdd,"select * from heberg_bdc where idd=\"$custom\"",$db_link) or die(mysql_error());
$pseudo=mysql_result($requete,0,"pseudo");

$requete9=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
$email=mysql_result($requete9,0,"email");
$date=mysql_result($requete9,0,"date");
$prenom=mysql_result($requete9,0,"prenom");
$p=mysql_result($requete9,0,"produit");

$ancien_mois = explode("/", $date);
$nouveau_mois =  $ancien_mois[1] + "1";
if ($nouveau_mois > "12") {$nouveau_mois = "01";}
$date_jour = date('d');
$nouveau_date = "$ancien_mois[0]/$nouveau_mois";


$requete3=mysql_db_query($sql_bdd,"UPDATE heberg_membres set date=\"$nouveau_date\" where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$nouveau_date', 'renew')",$db_link) or die(mysql_error());

$Destinataire = "$email";
$Sujet = "[Gheberg] Prolongement de votre espace d'hébergement";
$From='From: "Gheberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Merci, votre produit vient d'être prolongé de 31 jours. Il sera actif jusqu'au $nouveau_point .<br><br>
Vous pouvez dès maintenant vous connectez à votre espace d'admininstration.
<br><br>
Merci et a bientot!<br>L'équipe Gheberg.eu";
mail($Destinataire,$Sujet,$Message,$From);

$date2 = date('d/m/Y');
$heure = date('H:i:s');
mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date2 $heure', 'Paypal', 'Renouvellement hébergement', '')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$custom', '$txn_id', '$date2 $heure')",$db_link) or die(mysql_error());
}
		}
		else if (strcmp (trim($res), "INVALID") == 0) {
			mail($mailTo,"Erreur sur une commande Paypal",$textMail,$headerMail);
		}
	}
	fclose ($fp);
}
  ?>