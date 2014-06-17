<?php
//email pour prévenir le vendeur
$mailTo="Gheberg <contact@gheberg.eu>";
 
//permet de traiter le retour ipn de paypal
// lire la publication du système PayPal et ajouter 'cmd'
$req = 'cmd=_notify-validate';
 
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
 
// renvoyer au système PayPal pour validation
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
 
//www.sandbox.paypal.com pour la phase de test
//www.paypal.com pour la phase réel.
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
 
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
		if (strcmp ($res, "VERIFIED") == 0) {
if ($payment_status == "Completed")
{

$pseudo = $custom;
$dated = date('d');
$datem = date('m');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$nouvellem = $datem + "1";
if ($nouvellem > "12") {$nouvellem = "01";}
$nouvelle = "$dated/$nouvellem";

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
$email=mysql_result($requete,0,"email");
$prenom=mysql_result($requete,0,"prenom");
$requete3=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
	if(mysql_num_rows($requete3)==0)
	{
	mysql_db_query($sql_bdd,"insert into heberg_sauvegarde values ('', '$pseudo', '$nouvelle')",$db_link) or die(mysql_error());
	}
	else
	{
	$daterequete3=mysql_result($requete3,0,"date");
	$renew = explode("/", $daterequete3);
	$nouvellerenew = $renew[1] + "1";
	$nouvelledate = "$renew[0]/$nouvellerenew";
	
	mysql_connect("localhost", "root", "***");
	mysql_select_db("db252300216");
	mysql_query("UPDATE heberg_sauvegarde SET date='$nouvelle' where pseudo='$pseudo'");
	}
	   
$Destinataire = "$email";
$Sujet = "[Gheberg] Offre sauvegarde";
$From='From: "GHeberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Vous venez de souscrire à une offre de sauvegarde pour votre produit. Votre souscription est valable jusqu'au $nouvelle .<br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);
mysql_db_query($sql_bdd,"insert into heberg_sauvegarde_allopass values ('', '$RECALL')",$db_link) or die(mysql_error());

mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', '$ip', 'Offre de sauvegarde : $nouvelle', '$idd')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$nouvelle', 'backup on')",$db_link) or die(mysql_error());




}
		}
		else if (strcmp ($res, "INVALIDE") == 0) {
			mail($mailTo,"Erreur sur une commande Paypal",$textMail,$headerMail);
		}
	}
	fclose ($fp);
}
?>