<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Commande</title>
<meta name="keywords" content="heberg gratuit, hebergement gratuit,hébergement gratuit,hébergement,gratuit,hébergeur gratuit,hebergeur gratuit,hebergement mutualise,hébergement mutualisé,hébergeur free,hebergeur free, hébergeur php, hebergeur php" />
<meta name="description" content="Solution d'hébergement internet, de serveurs dédiés et serveurs virtuel (vps). Support technique gratuit. " />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="stylevps.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="maxheight.js" type="text/javascript"></script>
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
       	  		<div class="indent"><a href="connect.php">Connexion</a> &nbsp;  &nbsp; &nbsp; <a href="oubli.php">Mot de passe oublié</a></div>
                <a href="index.html"><img alt="" src="images/logo.gif" class="logo" /></a><br />
                <div class="block">
                	<div class="block-left">
                    	<div class="block-right">
                            <ul>
                                <li class="first"><a href="index.html">Accueil</a></li>
                                <li><a href="hebergement.html">Hébergement</a></li>
								<li><a href="https://www.gratuit-domaine.eu">Noms de domaine</a></li>
                                <li><a href="vps.html">VPS</a></li>
                                <li><a href="dedie.html">Serveurs Dédiés</a></li>
							    <li><a href="jeux.html" class="current">Serveur Jeux</a></li>
                                <li class="last"><a href="contact.php">Assistance</a></li>
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
    <h6>Commande / Inscription</h6>

<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$id = mysql_real_escape_string($_POST['idd']);

mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");
$reponse = mysql_query("SELECT * FROM heberg_bdc_allopass WHERE idd_bdc=\"$id\" ORDER BY id");
$i=0;
while ($donnees = mysql_fetch_array($reponse) )
{
$i++;
}

$requete=mysql_db_query($sql_bdd,"select * from heberg_membres_temp where idd='$id'",$db_link);
if(mysql_num_rows($requete)!=0)
	{
	$prenom=mysql_result($requete,0,"prenom");
	$nom=mysql_result($requete,0,"nom");
	$tel=mysql_result($requete,0,"tel");
	$email=mysql_result($requete,0,"email");
	$pseudo=mysql_result($requete,0,"pseudo");
	$passe=mysql_result($requete,0,"passe");
	$p=mysql_result($requete,0,"p");
	
	//récupération de l'adresse
	$requete_addr=mysql_db_query($sql_bdd,"select * from heberg_add_temp where idd_bdc='$id'",$db_link);
	if(mysql_num_rows($requete_addr)!=0) $addr=mysql_result($requete_addr,0,"add");
	else echo "";
	
if ($p == "h1") {$tarif = 9;$allopass = 9;}
if ($p == "h2") {$tarif = 1.5;$allopass = 1;}
if ($p == "h3") {$tarif = 3;$allopass = 2;}
if ($p == "sd13_1") {$tarif = 13;$allopass = 13;}
if ($p == "sd13_2") {$tarif = 19;$allopass = 19;}
if ($p == "sd13_3") {$tarif = 25;$allopass = 22;}
if ($p == "sd13_4") {$tarif = 38;$allopass = 34;}
if ($p == "sd13_5") {$tarif = 50;$allopass = 45;}
if ($p == "css1") {$tarif = 2.5;$allopass = 2;}
if ($p == "css2") {$tarif = 3.5;$allopass = 3;}
if ($p == "css3") {$tarif = 4.5;$allopass = 4;}
if ($p == "vps11") {$tarif = 1.5;$allopass = 1;}
if ($p == "vps1") {$tarif = 3.5;$allopass = 3;}
if ($p == "vps2") {$tarif = 5.5;$allopass = 5;}
if ($p == "vps3") {$tarif = 9.5;$allopass = 9;}
if ($p == "vps4") {$tarif = 13;$allopass = 12;}
if ($p == "vps5") {$tarif = 17.5;$allopass = 17;}
if ($p == "vps6") {$tarif = 22.99;$allopass = 22;}
if ($p == "vps7") {$tarif = 32;$allopass = 30;}
if ($p == "m1") {$tarif = 14;$allopass = 13;}
if ($p == "m2") {$tarif = 26;$allopass = 24;}
if ($p == "m3") {$tarif = 38;$allopass = 35;}
if ($p == "voip1") {$tarif = 2;$allopass = 1;}
if ($p == "mb1") {$tarif = 1.24;$allopass = 1;}
if ($p == "low") {$tarif = 3;$allopass = 3;}

if ($p == "vps2013_1") {$tarif = 4.5;$allopass = 4;}
if ($p == "vps2013_2") {$tarif = 8;$allopass = 8;}
if ($p == "vps2013_3") {$tarif = 12;$allopass = 10;}
if ($p == "vps2013_4") {$tarif = 18;$allopass = 16;}
if ($p == "vps2013_5") {$tarif = 22;$allopass = 20;}
if ($p == "vps2013_6") {$tarif = 30;$allopass = 25;}

$test = $allopass - $i;
	
	if ($test != 0) die("Nombre de code incorrect. Veuillez rajouter $test code(s) sur <a href=command_bdc.php?idd=$id&pseudo=$pseudo>ce bon de commande</a>.<br><br><br>");
	
$requete2=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo='$pseudo'",$db_link);
if(mysql_num_rows($requete2)!=0)
{
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

mysql_db_query($sql_bdd,"insert into heberg_membres values ('', '$pseudo2', '$passe', '$nom', '$prenom', '$email', '$tel', '$sup', '$date', '$p')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_add values ('', '$pseudo', '$addr')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo2', '$date', 'creer $p')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$id', 'allopass', '$date2 $heure')",$db_link);

mysql_db_query($sql_bdd,"insert into heberg_voip_command values ('', '$pseudo2', '$infoligne')",$db_link);

// on va chercher le systeme dexploitation ou les infos si il sagit dun vps
if ($p == "vps11" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7" or $p == "css1" or $p == "css2" or $p == "css3")
{
$requete19=mysql_db_query($sql_bdd,"select * from heberg_vps_temp where idd='$id'",$db_link);
$sys=mysql_result($requete19,0,"sys");
mysql_db_query($sql_bdd,"insert into heberg_vps values ('', '$pseudo2', '$sys')",$db_link);
}

$Destinataire = "$email";
$Sujet = "Inscription à Gratuit-Domaine.com !";
$From='From: "GHeberg.eu"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions de votre inscription à GHeberg.eu . Votre produit est en cours de réalisation. Il sera disponible dans moins de 24heures, vous recevrez un mail de confirmation.<br><br>Voici vos identifiants de connexions:\n<li><b>$pseudo2</b></li>\n<li><b>$passe</b></li><br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);

echo "Votre commande est en cours de réalisation. Vous recevrez un mail dans moins de 24 heures pour vous confirmer la création de vos services. Merci de votre confiance.<br><br>
Vos identifiants de connexion sont les suivants :
<li>$pseudo2</li>
<li>$passe</li>";
}
else
{
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
mysql_db_query($sql_bdd,"insert into heberg_membres values ('', '$pseudo', '$passe', '$nom', '$prenom', '$email', '$tel', '$idd', '$date', '$p')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$date', 'creer $p')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$id', 'allopass', '$date2 $heure')",$db_link);

mysql_db_query($sql_bdd,"insert into heberg_voip_command values ('', '$pseudo', '$infoligne')",$db_link);

// on va chercher le systeme dexploitation ou les infos si il sagit dun vps
if ($p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps4"or $p == "vps4"or $p == "vps6" or $p == "vps6" or $p == "css1" or $p == "css2" or $p == "css3")
{
$requete19=mysql_db_query($sql_bdd,"select * from heberg_vps_temp where idd='$id'",$db_link);
$sys=mysql_result($requete19,0,"sys");
mysql_db_query($sql_bdd,"insert into heberg_vps values ('', '$pseudo', '$sys')",$db_link);
}

$Destinataire = "$email";
$Sujet = "Inscription à Gratuit-Domaine.com !";
$From='From: "GHeberg.eu"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions de votre inscription à GHeberg.eu . Votre produit est en cours de réalisation. Il sera disponible dans moins de 24heures, vous recevrez un mail de confirmation.<br><br>Voici vos identifiants de connexions:\n<li><b>$pseudo</b></li>\n<li><b>$passe</b></li><br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);

echo "Votre commande est en cours de réalisation. Vous recevrez un mail dans moins de 24 heures pour vous confirmer la création de vos services. Merci de votre confiance.<br><br>
Vos identifiants de connexion sont les suivants :
<li>$pseudo</li>
<li>$passe</li>";
}

if ($p == "h1") {
$requete40=mysql_db_query($sql_bdd,"select * from heberg_h1 where id='1'",$db_link);
	$n=mysql_result($requete40,0,"n");
	$nn = $n - "1";
$requete41=mysql_db_query($sql_bdd,"UPDATE heberg_h1 set n=\"$nn\" where id=\"1\"",$db_link);
}
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
<!-- Google Code for vps Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1031285118;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "qUEPCKLBrgIQ_tLg6wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1031285118/?label=qUEPCKLBrgIQ_tLg6wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>



