<?
require("conf_vps.php");
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);
$action=mysql_real_escape_string($_GET['action']);

//requete
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link) or die(mysql_error());


if(mysql_num_rows($requete)==0)
	{
	header("Location:$url_erreur");
	}

if($idd == NULL)
	{
	header("Location:$url_erreur");
	}

//recuperation des informations
$prenom=mysql_result($requete,0,"prenom");
$nom=mysql_result($requete,0,"nom");
$p=mysql_result($requete,0,"produit");
$date=mysql_result($requete,0,"date");
$pseudo=mysql_result($requete,0,"pseudo");

$requete_vps=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());

if(mysql_num_rows($requete_vps)==0)
	{
	header("Location:$url_erreur");
	}

$vmid=mysql_result($requete_vps,0,"vmid");

if ($action == "1" or $action =="2")
{
$date = date('d/m/Y');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
mysql_db_query($sql_bdd_vps,"insert into tasks values ('', '$vmid', '$action', '0', '')",$db_link_vps) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', '$ip', 'Action sur serveur : $action', '$idd')",$db_link) or die(mysql_error());
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
</head>

<body id="page2">
<div class="right_bgd"></div>
<div class="tail-top">
  	<div class="tail-bottom">
    	<div class="main">
          	<div id="header">
       	  		<div class="indent"><a href="loginout.php">Deconnexion</a></div>
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
							    <li><a href="zonemembre_faq.php?idd=<?php echo"$idd";?>">Faq</a></li>
                                <li class="last"><a href="zonememebre_contact.php?idd=<?php echo"$idd";?>">Assistance</a></li>
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
				<h6>API VPS</h6>
L'action que vous avez demandé va être réalisé dans quelques secondes.<br>
<a href="zonemembre_product.php?idd=<?php echo"$idd";?>"><< Retour</a>

                        <br class="clear" />
                    </div>
                </div>
            </div>	 
      		<div id="footer">
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



