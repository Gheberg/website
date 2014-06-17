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
$pseudo=mysql_result($requete,0,"pseudo");
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
$requete2=mysql_db_query($sql_bdd,"select * from heberg_sms where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());

if(mysql_num_rows($requete2)==0)
	{
echo"<b>Votre compte SMS n'est pas créé.</b><br>
<a href=\"zonemembre_monitoring_activ_gra.php?idd=$idd\">Cliquer ici pour l'activer ou effectuez votre premier achat</a>";
	}
else
{
$solde=mysql_result($requete2,0,"sms");
$requete3=mysql_db_query($sql_bdd,"select * from heberg_ping where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete3)!=0)
	{
$activ_sms=mysql_result($requete3,0,"sms");
$email =mysql_result($requete3,0,"email");
$tel=mysql_result($requete3,0,"num");
}
echo"<b>Solde sms : $solde<br></b>";
if($activ_sms == NULL AND $email == NULL)
{
echo"<font color=\"red\"><b>Monitoring désactivé</b></font><br><br>";
}
else
{
echo"<font color=\"green\"><b>Monitoring activé</b></font><br><br>";
}
echo"
Les alertes sont envoyées toutes les heures si il n'y a pas de changement d'état de votre serveur.<br>
Vous pouvez choisir le monitoring sms ou e-mail :
<form action=\"zonemembre_monitoring_activ.php?idd=$idd&action=start\" method=\"post\">
<label><input type=\"radio\" name=\"radio\" value=\"sms\">SMS : </label><input type=\"text\" name=\"tel\" value=\"$tel\"> Numéro tel <i>(format internationnal +33612345678)</i><br>
<label><input type=\"radio\" name=\"radio\" value=\"email\">E-MAIL :</label> <input type=\"text\" name=\"email\" value=\"$email\"><br><br>
<input type=\"submit\" value=\"Activer\"  class=\"boiteFormulaire5\">
</form>
<br>
<form action=\"zonemembre_monitoring_activ.php?idd=$idd&action=stop\" method=\"post\">
<input type=\"submit\" value=\"Désactiver\" class=\"boiteFormulaire5\">
</form>
";
}
?>
<br>
Pour créditer votre compte de 15 sms, veuillez effectuer un paiement allopass en cliquant sur le logo ci-dessous : <br><br>
<center>
<script type="text/javascript" src="https://payment.allopass.com/buy/checkout.apu?ids=226116&idd=977563&lang=fr&data=<?php echo"$idd";?>"></script>
<noscript>
 <a href="https://payment.allopass.com/buy/buy.apu?ids=226116&idd=977563&data=<?php echo"$idd";?>" style="border:0">
  <img src="https://payment.allopass.com/static/buy/button/fr/162x56.png" style="border:0" alt="Buy now!" />
 </a>
</noscript>
</center>
<br><br>
<b>Logs monitoring :</b><br>
  <?php
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");

$reponse = mysql_query("SELECT * FROM heberg_log WHERE pseudo=\"$pseudo\" AND ip=\"monitoring\" ORDER BY ID");

while ($donnees = mysql_fetch_array($reponse) )
{
$date= nl2br(stripslashes($donnees['date']));
$info= nl2br(stripslashes($donnees['info']));
echo "$info $date<br>";
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



