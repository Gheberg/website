<?php
//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['DATAS']);

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
$pseudo=mysql_result($requete,0,"pseudo");
$email=mysql_result($requete,0,"email");
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
				<h6>Monitoring Serveur</h6>
				<br>
	<?php
//DEBUT TEST
  $RECALL = mysql_real_escape_string($_GET["RECALL"]);
  if( trim($RECALL) == "" )
  {
$test = "1";
  }
  $RECALL = urlencode( $RECALL );
  $AUTH = urlencode( "226116/977563/2083861" );
  $roo = @file( "https://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=$AUTH" );

  if( substr($roo[0],0,2) != "OK" ) 
  {
$test = "1";
  }

else { $test = "0"; }

//FIN DU TEST

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
if ($test == "0") {
$requete2=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde_allopass where code=\"$RECALL\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)==0)
	{

$requete77=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde_allopass where code=\"$RECALL\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete77)==0)
	{
	mysql_db_query($sql_bdd,"insert into heberg_sms values ('', '$pseudo', '15')",$db_link) or die(mysql_error());
	}
else{
	$solde=mysql_result($requete,0,"sms");
	$nouveau_solde = $solde + 15;
	$requete3=mysql_db_query($sql_bdd,"UPDATE heberg_sms set sms=\"$nouveau_solde\" where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
	}

$Destinataire = "$email";
$Sujet = "[Gheberg] Compte SMS monitoring";
$From='From: "Gheberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>
Votre compte sms monitoring vient d'être crédité de 15 sms.
<br><br>
Merci et a bientot!<br>L'équipe Gheberg.eu";
mail($Destinataire,$Sujet,$Message,$From);

mysql_db_query($sql_bdd,"insert into heberg_sauvegarde_allopass values ('', '$RECALL')",$db_link) or die(mysql_error());

$date2 = date('d/m/Y');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date2 $heure', '$ip', 'Rechargement sms', '$idd')",$db_link) or die(mysql_error());

echo "
<h1>Commande effectuée avec succès,</h1>
Merci, votre commande vient d'être prise en compte. Votre compte sms vient d'être recharger de 15 sms.<br><br>
   <b>¤ Nouveau solde :</b> Votre espace est actif jusqu'au $nouveau_date .
";
	}
	else{
echo "
<h1>Commande refusé,</h1>
Votre commande est refusée !<br><br>Ceci peu venir de différente raisons :<br><li>Vous avez actualiser cette page</li><li>La requête au serveur Allopass à échouée</li><br><br>Pour tout problème, n'hésitez pas à nous contacter.</center>
   ";
	}}
	
	if ($test == "1") {
echo "
<h1>Commande refusée,</h1>
Votre commande est refusée !<br><br>Ceci peu venir de différente raisons :<br><li>Vous avez actualiser cette page</li><li>La requête au serveur Allopass à échouée</li><br><br>Pour tout problème, n'hésitez pas à nous contacter.</center>
   ";
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



