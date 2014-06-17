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
$date=mysql_result($requete,0,"date");
$pseudo=mysql_result($requete,0,"pseudo");

if ($p == "voip1") {$tarif = "1.5€";}
if ($p == "h1") {$tarif = "1.5€";}
if ($p == "h2") {$tarif = "1.5€";}
if ($p == "h3") {$tarif = "3€";}

if ($p == "sd1") {$tarif = "19€";}
if ($p == "sd2") {$tarif = "50€";}
if ($p == "sd3") {$tarif = "62€";}
if ($p == "sd4") {$tarif = "62€";}
if ($p == "sd5") {$tarif = "87€";}

if ($p == "sd13_1") {$tarif = "13€";}
if ($p == "sd13_2") {$tarif = "19€";}
if ($p == "sd13_3") {$tarif = "25€";}
if ($p == "sd13_4") {$tarif = "38€";}
if ($p == "sd13_5") {$tarif = "50€";}

if ($p == "sd14_1") {$tarif = "5€";}
if ($p == "sd14_2") {$tarif = "13€";}
if ($p == "sd14_3") {$tarif = "25€";}
if ($p == "sd14_4") {$tarif = "50€";}
if ($p == "sd14_5") {$tarif = "62€";}

if ($p == "css1") {$tarif = "2.5€";}
if ($p == "css2") {$tarif = "3.5€";}
if ($p == "css3") {$tarif = "4.5€";}
if ($p == "vps11") {$tarif = "1.5€";}
if ($p == "vps1") {$tarif = "3.5€";}
if ($p == "vps2") {$tarif = "4.5€";}
if ($p == "vps3") {$tarif = "9.5€";}
if ($p == "vps4") {$tarif = "13€";}
if ($p == "vps5") {$tarif = "17.5€";}
if ($p == "vps6") {$tarif = "22.99€";}
if ($p == "vps7") {$tarif = "32€";}
if ($p == "vps8") {$tarif = "48€";}
if ($p == "m1") {$tarif = "14€";}
if ($p == "m2") {$tarif = "26€";}
if ($p == "m3") {$tarif = "38€";}
if ($p == "mb1") {$tarif = "1.25€";}
if ($p == "low") {$tarif = "3€";}

if ($p == "vps2013_1") {$tarif = "4.5€";}
if ($p == "vps2013_2") {$tarif = "8€";}
if ($p == "vps2013_3") {$tarif = "12€";}
if ($p == "vps2013_4") {$tarif = "18€";}
if ($p == "vps2013_5") {$tarif = "22€";}
if ($p == "vps2013_6") {$tarif = "30€";}
if ($p == "vps2013_8") {$tarif = "80€";}

if ($p == "cloud1") {$tarif = "2€";}
if ($p == "cloud2") {$tarif = "5€";}
if ($p == "cloud3") {$tarif = "10€";}
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
				<h6>Accueil plateforme membres</h6>
				<br>
                 <p>Bienvenue sur votre espace d'admininstration. Cette plateforme réservée aux membres vous permet de modifier vos informations personnelles, d'accéder aux informations importantes de votre produit, de gérer votre espace de sauvegarde et de contacter le support technique.</p>
				<table style="margin-top:-50px;"><tr><td width="100%">
				<table><tr><td><img src="images/1.png"></td><td><b>Votre produit :</b><?php echo "$p";?></td></tr><br>
				<tr><td><img src="images/2.png"></td><td><b>Date du dernier renouvellement :</b> <?php echo "$date";?></td></tr><br>
				<tr><td><img src="images/3.png"></td><td><b>Tarif :</b> <?php echo "$tarif";?> / mois</td></tr></table>
				</td><td width="50%" align="right">
				<br><br><br><br>
				<center>
				<form action="zonemembre_renew.php?idd=<?php echo"$idd";?>" method="post" name="inscription">
				<input type="submit" value="Renouveller" class="boiteFormulaire3"/></form>
				<br><br>
				<a href="https://www.gratuit-domaine.eu" target="_blank"><img src="images/domaine.png"></a>
				</center>
				</td></tr></table>
				<br>
				<?php if ($p == "h1" or $p == "h2" or $p =="h3") {echo"<b>Adresse de votre site :</b> <a href=\"http://$pseudo.gheberg.eu\" target=\"_blank\">http://$pseudo.gheberg.eu</a>";}?>
				<br>
				<a href="zonemembre_log.php?idd=<?php echo"$idd";?>">>> Accéder aux logs de votre compte</a>
				 <br><br><br>
<img src="images/ban.png">
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



