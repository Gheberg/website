<?php
//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

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
$pseudo=mysql_result($requete,0,"pseudo");

if ($p == "h1") {$tarif = "1.5€ / mois";}
if ($p == "h2") {$tarif = "1.5€";}
if ($p == "h3") {$tarif = "3€";}
if ($p == "sd1") {$tarif = "19€";}
if ($p == "sd2") {$tarif = "50€";}
if ($p == "sd3") {$tarif = "62€";}
if ($p == "sd4") {$tarif = "62€";}
if ($p == "sd5") {$tarif = "87€";}
if ($p == "css1") {$tarif = "3.5€";}
if ($p == "css2") {$tarif = "4.5€";}
if ($p == "css3") {$tarif = "2.5€";}
if ($p == "vps11") {$tarif = "1.5€";}
if ($p == "vps1") {$tarif = "3.5€";}
if ($p == "vps2") {$tarif = "4.5€";}
if ($p == "vps3") {$tarif = "12€";}
if ($p == "vps4") {$tarif = "16.5€";}
if ($p == "vps5") {$tarif = "22€";}
if ($p == "vps6") {$tarif = "32€";}
if ($p == "vps7") {$tarif = "42€";}
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
<fieldset id="fieldset"><legend><h1>Module de paiement sécurisé</h1></legend> 
Vous pouvez renouveller votre produit pour une durée de 1 mois. Cette durée ce rajoute à la date d'expiration de votre produit.<br>

<?php 
	$taille = 8;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$idde.=substr($lettres,(rand()%(strlen($lettres))),1);
		}

if ($p == "h1") {$tarif = 1.5;$allopass = 1;}
if ($p == "h2") {$tarif = 1.5;$allopass = 1;}
if ($p == "h3") {$tarif = 3;$allopass = 2;}
if ($p == "sd1") {$tarif = 19;$allopass = 17;}
if ($p == "sd2") {$tarif = 50;$allopass = 45;}
if ($p == "sd3") {$tarif = 62;$allopass = 55;}
if ($p == "sd4") {$tarif = 62;$allopass = 55;}
if ($p == "sd5") {$tarif = 87;$allopass = 77;}
if ($p == "css1") {$tarif = 2.5;$allopass = 2;}
if ($p == "css2") {$tarif = 3.5;$allopass = 3;}
if ($p == "css3") {$tarif = 4.5;$allopass = 4;}
if ($p == "vps11") {$tarif = 1.5;$allopass = 1;}
if ($p == "vps1") {$tarif = 3.5;$allopass = 3;}
if ($p == "vps2") {$tarif = 4.5;$allopass = 5;}
if ($p == "vps3") {$tarif = 12;$allopass = 10;}
if ($p == "vps4") {$tarif = 16.5;$allopass = 15;}
if ($p == "vps5") {$tarif = 22;$allopass = 20;}
if ($p == "vps6") {$tarif = 32;$allopass = 30;}
if ($p == "m1") {$tarif = 14;$allopass = 40;}
if ($p == "voip1") {$tarif = 2;$allopass = 1;}

$date2 = date('d/m/Y');
$heure = date('H:i:s');

mysql_db_query($sql_bdd,"insert into heberg_bdc values ('', '$pseudo', '$date2 $heure', '$p', '$tarif', 'renew', '$idde')",$db_link);

//PAYPAL
$tarifHT = round($tarif / 1.196,2);
$tva = round($tarifHT * 19.6 / 100,2);

require('./paypal/PaypalCrypt.class.php');
// Initialisation cryptage Paypal
$paypalCrypt = new PaypalCrypt();
$paypalCrypt->setPrivateKey('./paypal/cleprivPAYPAL.pem');
$paypalCrypt->setPublicKey('./paypal/certpubPAYPAL.pem');
$paypalCrypt->setPaypalKey('./paypal/paypal_cert.pem');
$paypalCrypt->addData('cert_id','LMXBPZMQAAXGS')
            ->addData('business','contact@gheberg.eu')
            ->addData('cbt','Retour sur la boutique')
            ->addData('custom', $idde)
            ->addData('return','https://www.gheberg.eu/return.php')
            ->addData('notify_url','https://www.gheberg.eu/zonemembre_paypal_renew_ipn_test.php')
            ->addData('amount',$tarifHT)
	    ->addData('tax',$tva)
            ->addData('item_name', 'Renouvellement '.$idde);
$data = $paypalCrypt->getCryptedData();

?>
<center>
<br>
<b>Tarif pour votre produit :</b> <?php echo"$tarif";?> €<br>
<b>Date : </b><?php echo "$date2 $heure"; ?><br>
<b>Bon de commande n°</b> <?php echo $idde; ?><br><br>
<form action="https://www.paypal.com/fr/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="encrypted" value="<?php echo $data?>"/>
    <input type="image" value="Commander" class="input_button" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif">
</form>
<br>
<img src="https://payment.allopass.com/static/buy/button/fr/162x56.png" OnClick="affich(1);">
<br><br>
<div id="1" style="display:none;text-align:center;">
<center>

<table border="0" cellpadding="0" cellspacing="0" width="450" style="border-color:black;text-align:center">
<tr>
<td align="center" valign="top">
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
<IFRAME src="command_code.php?ref=<?php echo"$idde";?>" frameborder="no" width="500" height="95" style="background-color: #F5F5F5"></IFRAME>
<?php
}
?>
<form action="zonemembre_renew_allopass_test.php?idd=<?php echo"$idd";?>" method="post">
<input type="hidden" name="idde" value="<?php echo"$idde";?>">
<input type="submit" value="TERMINER" class="boiteFormulaire5">
</form>
</div>


</center></fieldset>
				
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