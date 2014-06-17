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

mail($mailTo,"Nouvelle commande Paypal",$textMail,$headerMail);

$id = $custom;
 
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete=mysql_db_query($sql_bdd,"select * from heberg_membres_temp where idd='$id'",$db_link) or die(mysql_error());

	$prenom=mysql_result($requete,0,"prenom");
	$nom=mysql_result($requete,0,"nom");
	$tel=mysql_result($requete,0,"tel");
	$email=mysql_result($requete,0,"email");
	$pseudo=mysql_result($requete,0,"pseudo");
	$passe=mysql_result($requete,0,"passe");
	$p=mysql_result($requete,0,"p");
	
$requete2=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo='$pseudo'",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)!=0)
{

	//récupération de l'adresse
	$requete_addr=mysql_db_query($sql_bdd,"select * from heberg_add_temp where idd_bdc='$id'",$db_link);
	if(mysql_num_rows($requete_addr)!=0) 
	{
		$addr=mysql_result($requete_addr,0,"add");
		mysql_db_query($sql_bdd,"insert into heberg_add values ('', '$pseudo', '$addr')",$db_link);
	}
	
	$taille = 3;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$sup.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
$pseudo2 = "$pseudo$sup";

$date = date('d/m');
$date2 = date('d/m/Y');
$heure = date('H:i:s');
	$taille = 10;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$idd.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
mysql_db_query($sql_bdd,"insert into heberg_membres values ('', '$pseudo2', '$passe', '$nom', '$prenom', '$email', '$tel', '$idd', '$date', '$p')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo2', '$date', 'creer $p')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$id', '$txn_id', '$date2 $heure')",$db_link) or die(mysql_error());

$Destinataire = "$email";
$Sujet = "[Gheberg] Enregistrement de votre commande";
$From='From: "GHeberg.eu"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions de votre inscription à Gheberg.eu . Votre produit est en cours de réalisation. Il sera disponible dans moins de 24heures, vous recevrez un mail de confirmation.<br><br>Voici vos identifiants de connexions:\n<li><b>$pseudo2</b></li>\n<li><b>$passe</b></li><br><br>Merci et a bientot!<br>L'équipe Gheberg.eu";
mail($Destinataire,$Sujet,$Message,$From);


}
else
{
$date = date('d/m');
$date2 = date('d/m/Y');
$heure = date('H:i:s');

mysql_db_query($sql_bdd,"insert into heberg_membres values ('', '$pseudo', '$passe', '$nom', '$prenom', '$email', '$tel', '$idd', '$date', '$p')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$date', 'creer $p')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$id', '$txn_id', '$date2 $heure')",$db_link) or die(mysql_error());

$Destinataire = "$email";
$Sujet = "[Gheberg] Enregistrement de votre commande";
$From='From: "GHeberg.eu"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions de votre inscription à Gheberg.eu . Votre produit est en cours de réalisation. Il sera disponible dans moins de 24heures, vous recevrez un mail de confirmation.<br><br>Voici vos identifiants de connexions:\n<li><b>$pseudo</b></li>\n<li><b>$passe</b></li><br><br>Merci et a bientot!<br>L'équipe Gheberg.eu";
mail($Destinataire,$Sujet,$Message,$From);

}

}
		}
		else if (strcmp (trim($res), "INVALID") == 0) {
			mail($mailTo,"Erreur sur une commande Paypal",$textMail,$headerMail);
		}
	}
	fclose ($fp);
}
?>