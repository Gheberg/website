<?php
$choix = htmlentities($_GET['choix'],ENT_QUOTES);
$p = htmlentities($_GET['p'],ENT_QUOTES);
$check = htmlentities($_POST['checkbox'],ENT_QUOTES);
$backup = htmlentities($_GET['backup'],ENT_QUOTES);
$disk = htmlentities($_GET['disk'],ENT_QUOTES);
$promo = htmlentities($_POST['promo'],ENT_QUOTES);
if ($p != "vps2013_6" and $p != "vps2013_5" and $p != "vps2013_4" and $p != "vps2013_3" and $p != "vps2013_2" and $p != "vps2013_1" and $p != "low" and $p != "mb1" and $p != "voip1" and $p != "voip2" and $p != "m1" and $p != "m2" and $p != "m3" and $p != "vps11" and $p != "vps1" and $p != "vps2" and $p != "vps3" and $p != "vps4" and $p != "vps5" and $p != "vps6" and $p != "vps7" and $p != "h1" and $p != "h2" and $p != "h3"  and $p != "sd14_1" and $p != "sd14_2" and $p != "sd14_3" and $p != "sd14_4" and $p != "sd14_5" and $p != "cloud1" and $p != "cloud2" and $p != "cloud3")
{
die;
}

if ($p == "voip1" or $p == "voip2")
{
$info =  $_POST['ligne'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Commande</title>
<meta name="keywords" content="heberg gratuit, hebergement gratuit,hébergement gratuit,hébergement,gratuit,hébergeur gratuit,hebergeur gratuit,hebergement mutualise,hébergement mutualisé,hébergeur free,hebergeur free, hébergeur php, hebergeur php" />
<meta name="description" content="Solution d'hébergement internet, de serveurs dédiés et serveurs virtuel (vps). Support technique gratuit. " />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="maxheight.js" type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'fr'}
</script>
<script language="JavaScript"> 
	function affich(quel){
		obj=document.getElementById(quel);
		if (obj.style.display=="none"){
		obj.style.display="block";}
		
		obj=document.getElementById(2);
			obj.style.display="block";
	}
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
							    <li><a href="jeux.html" >Serveurs Jeux</a></li>
                                <li class="last"><a href="contact.html">Assistance</a></li>
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
                    <div class="container1">

	                        <div class="col-1">
                        	<div class="title"><h6>Support technique</h6></div>
                           <img src="images/leftside-support.jpg"><br>
						   Support technique rapide et efficace accessible par notre centre d'assistance, forum ou chat.
							<br><br><br>
							<div id="2" style="display:none">
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							</div>
							</div>
						
<h6>Commande / Inscription</h6><br>

<table>
<tr><td><b>Produit : </b></td><td><?php echo $p;?></td></tr>

<?php 
	$taille = 8;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$idd.=substr($lettres,(rand()%(strlen($lettres))),1);
		}

if ($p == "h1") {$tarif = 9;$allopass = 9;}
if ($p == "h2") {$tarif = 1.5;$allopass = 1;}
if ($p == "h3") {$tarif = 3;$allopass = 2;}

if ($p == "sd14_1") {$tarif = 5;$allopass = 5;}
if ($p == "sd14_2") {$tarif = 13;$allopass = 13;}
if ($p == "sd14_3") {$tarif = 25;$allopass = 22;}
if ($p == "sd14_4") {$tarif = 50;$allopass = 45;}
if ($p == "sd14_5") {$tarif = 62;$allopass = 55;}

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

if ($p == "cloud1") {$tarif = 2;$allopass = 2;}
if ($p == "cloud2") {$tarif = 5;$allopass = 5;}
if ($p == "cloud3") {$tarif = 10;$allopass = 10;}

if($disk=="on") {$tarif+=2;$allopass+=2;}
if($backup=="on") {$tarif+=5;$allopass+=5;}

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
if ($check != NULL)
{
if ($choix == "2")
{
		$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
		$prenom = mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
		$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
		$tel = mysql_real_escape_string(htmlspecialchars($_POST['tel']));
		$pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
		$passe = mysql_real_escape_string(htmlspecialchars($_POST['passe']));
		$p2 = mysql_real_escape_string(htmlspecialchars($_GET['p']));
		if ($p != "voip1" and $p != "voip2") 
			$info = mysql_real_escape_string(htmlspecialchars($_GET['info']));
		
$date2 = date('d/m/Y');
$heure = date('H:i:s');

	$addr = $_POST['rue'].', '.$_POST['cp'].', '.$_POST['ville'];
	$addr=mysql_real_escape_string($addr);
	
mysql_db_query($sql_bdd,"insert into heberg_add_temp values ('', '$idd', '$addr')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_membres_temp values ('', '$pseudo', '$passe', '$nom', '$prenom', '$email', '$tel', '$p2', '$idd')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_vps_temp values ('', '$idd', '$info')",$db_link);
mysql_db_query($sql_bdd,"insert into heberg_bdc values ('', '$pseudo', '$date2 $heure', '$p2', '$tarif', '$info', '$idd')",$db_link);

	if (!empty($_COOKIE["never"]))
	{
		$cookie = $_COOKIE["never"];
		mysql_db_query($sql_bdd,"insert into heberg_affi_bdc values ('', '$idd', '$cookie')",$db_link);
	}	
}
if ($choix == "1")
{
		$pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
		$passe = mysql_real_escape_string(htmlspecialchars($_POST['passe']));
		$requete=mysql_db_query($sql_bdd,"select * from membres where pseudo='$pseudo' and passe='$passe'",$db_link);

	if(mysql_num_rows($requete)==0)
	{
	echo "Nous n'arrivons pas à vous identifier. Veuillez <a href=\"command.php?p=$p\">ré-essayer</a>.";
	$error = "1";
	}
	else
	{
	$prenom=mysql_result($requete,0,"prenom");
	$nom=mysql_result($requete,0,"nom");
	$pseudo=mysql_result($requete,0,"pseudo");
	$passe=mysql_result($requete,0,"passe");
	$tel=mysql_result($requete,0,"tel");
	$email=mysql_result($requete,0,"email");
	$p2 = mysql_real_escape_string(htmlspecialchars($_GET['p']));
	if ($p != "voip1" and $p != "voip2") 
		$info = mysql_real_escape_string(htmlspecialchars($_GET['info']));
		
	$addr = $_POST['rue'].', '.$_POST['cp'].', '.$_POST['ville'];
	$addr=mysql_real_escape_string($addr);
	
	mysql_db_query($sql_bdd,"insert into heberg_add_temp values ('', '1', '1')",$db_link);
	mysql_db_query($sql_bdd,"insert into heberg_membres_temp values ('', '$pseudo', '$passe', '$nom', '$prenom', '$email', '$tel', '$p2', '$idd')",$db_link);
	mysql_db_query($sql_bdd,"insert into heberg_vps_temp values ('', '$idd', '$info')",$db_link);
	mysql_db_query($sql_bdd,"insert into heberg_bdc values ('', '$pseudo', '$date2 $heure', '$p2', '$tarif', '$info', '$idd')",$db_link);
	
	if (!empty($_COOKIE["never"]))
	{
		$cookie = $_COOKIE["never"];
		mysql_db_query($sql_bdd,"insert into heberg_affi_bdc values ('', '$idd', '$cookie')",$db_link);
	}	
	
	}
}

if($disk=="on") {mysql_db_query($sql_bdd,"insert into heberg_option values ('', '$idd', 'disk', '2')",$db_link);}
if($backup=="on") {mysql_db_query($sql_bdd,"insert into heberg_option values ('', '$idd', 'backup', '5')",$db_link);}

//PAYPAL
$tarifHT = round($tarif / 1.196,2);
$tva = round($tarifHT * 19.6 / 100,2);

require('./paypal/PaypalCrypt.class.php');
// Initialisation cryptage Paypal
$paypalCrypt = new PaypalCrypt();
$paypalCrypt->setPrivateKey('./paypal/cleprivPAYPAL.pem');
$paypalCrypt->setPublicKey('./paypal/certpubPAYPAL.pem');
$paypalCrypt->setPaypalKey('./paypal/paypal_cert.pem');
$paypalCrypt->addData('cert_id','5KKXYZKRPXPUA')
            ->addData('business','contact@gheberg.eu')
            ->addData('cbt','Retour sur la boutique')
            ->addData('custom', $idd)
            ->addData('return','https://www.gheberg.eu/return.php')
            ->addData('cancel_return','https://www.gheberg.eu/command_bdc.php?idd='.$idd.'&pseudo='.$pseudo)
            ->addData('notify_url','https://www.gheberg.eu/command_paypal_ipn.php')
            ->addData('amount',$tarifHT)
			->addData('tax',$tva)
            ->addData('item_name', 'Bon de commande '.$idd);
$data = $paypalCrypt->getCryptedData();
?>
<tr><td><b>Nom : </b></td><td><?php echo $nom;?></td></tr>
<tr><td><b>Prénom : </b></td><td><?php echo $prenom;?></td></tr>
<tr><td><b>E-mail : </b></td><td><?php echo $email;?></td></tr>
<tr><td><b>Tel : </b></td><td><?php echo $tel;?></td></tr>
</table>
<br>
<b>Date : </b><?php echo "$date2 $heure"; ?><br>
<b>Bon de commande n°</b> <a href="command_bdc.php?idd=<?php echo $idd; ?>&pseudo=<?php echo $pseudo;?>" style="color:blue;text-decoration:underline"><?php echo strtoupper($idd); ?></a><br>
<br>
<table>
<?php
if($backup=="on" or $disk=="on") echo "Option(s) :";
if($disk=="on") {echo "<tr><td>+50 Go : </td><td>2 €</td></tr>";}
if($backup=="on") {echo "<tr><td>Backup journalier : </td><td>5 €</td></tr>";}
if($backup=="on" or $disk=="on") echo "<tr><td></td><td><br></td></tr>";

?>
<tr><td><b>Total TTC : </b></td><td><?php echo $tarif;?> €</td></tr>
</table>
<br>
<table style="margin-left:290px"><tr><td>
<form action="https://www.paypal.com/fr/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="encrypted" value="<?php echo $data?>"/>
    <input type="image" value="Commander" class="input_button" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif">
</form>
</td><td style="padding-left:20px">
<img src="https://payment.allopass.com/static/buy/button/fr/162x56.png" OnClick="affich(1);">
</td></tr></table>
<br><br>
<div id="1" style="display:none;text-align:center;margin-left:290px">
<table border="0" cellpadding="0" cellspacing="0" width="450" style="border-color:black">
<tr>
<td bgcolor="#FFFFFF" align="center" valign="top">
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=fr','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_fr.gif" width="35" height="29" alt="FR" title="FR" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=be','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_be.gif" width="35" height="29" alt="BE" title="BE" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=ch','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_ch.gif" width="35" height="29" alt="CH" title="CH" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=lu','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_lu.gif" width="35" height="29" alt="LU" title="LU" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=de','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_de.gif" width="35" height="29" alt="DE" title="DE" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=uk','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_uk.gif" width="35" height="29" alt="UK" title="UK" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=ca','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_ca.gif" width="35" height="29" alt="CA" title="CA" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=es','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_es.gif" width="35" height="29" alt="ES" title="ES" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=at','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_at.gif" width="35" height="29" alt="AT" title="AT" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=it','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_it.gif" width="35" height="29" alt="IT" title="IT" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=se','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_se.gif" width="35" height="29" alt="SE" title="SE" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=no','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_no.gif" width="35" height="29" alt="NO" title="NO" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=226116&idd=1102689&lang=fr&country=dk','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_dk.gif" width="35" height="29" alt="DK" title="DK" /></a>
  <a href="javascript:;" onclick="javascript:window.open('https://payment.allopass.com/acte/scripts/popup/access.apu?ids=v&idd=1102689&lang=fr&country=fi','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img border="0" src="https://payment.allopass.com/imgweb/common/flag_fi.gif" width="35" height="29" alt="FI" title="FI" /></a>
</td>
</tr>
</table>
<?php
echo "Nombre de code(s) : <b>$allopass</b><br>";
for ($i=0;$i<$allopass;$i++)
{
?>
<IFRAME src="command_code.php?ref=<?php echo"$idd";?>" frameborder="no" width="500" height="95"></IFRAME>
<?php
}
?>
<form action="command_heberg2.php" method="post">
<input type="hidden" name="idd" value="<?php echo"$idd";?>">
<input type="submit" value="TERMINER" class="boiteFormulaire5">
</form>
</div>
<?php
}
else echo"Vous devez accepter nos conditions générales. Utilisez la touches <b>retour</b> ou <b>précédent</b> de votre navigateur pour revenir à la page précédente.";
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



